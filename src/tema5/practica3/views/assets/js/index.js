// Not the best way to do it, but is for not recreate de the view again writing the html
let firstHTML = ""

/**
 * Fetch some data from an API
 * @param url
 * @param options
 * @returns {Promise<any>}
 */
const fetchApi = async (url, options = {}) => {
  return fetch(url, options)
    .then((res) => res.json())
    .then((data) => data)
}

/**
 * Get the article text from the API
 * @param apiKey
 * @param articleTitle
 * @returns {Promise<any>}
 */
const getArticleTextRes = async (apiKey, articleTitle) => {
  return fetchApi('https://api.openai.com/v1/chat/completions', {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Authorization": `Bearer ${apiKey}`
    },
    body: JSON.stringify({
      model: "gpt-4o-mini",
      max_tokens: 200,
      messages: [
        {
          role: "system",
          content: "Eres un asistente que genera artículos de noticias sobre el titulo que se te pase, la respuesta" +
            " haz" +
            " que solo sea texto sin formatos markdown, ni estilos, solo el contenido, asegurate de poner los signos" +
            " de puntuación correctamente y que el texto sea corto y conciso, no hagas referencias a otros artículos"
        },
        {
          role: "user",
          content: `Título: ${articleTitle}`
        }
      ]
    })
  })
}

/**
 * Get the article image from the API
 * @param apiKey
 * @param articleTitle
 * @returns {Promise<any>}
 */
const getArticleImageRes = async (apiKey, articleTitle) => {
  return fetchApi('https://api.openai.com/v1/images/generations', {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Authorization": `Bearer ${apiKey}`
    },
    body: JSON.stringify({
      // model: "dall-e-3"
      n: 1,
      prompt: `Generame una imagen para una noticia sobre ${articleTitle}`,
      size: "1024x1024"
    })
  })
}

/**
 * Check if the article title is empty
 * @param articleTitleInp
 * @returns {boolean}
 */
const checkArticleTitle = (articleTitleInp) => {

  const errorParagraph = document.querySelector("#article-title-error")

  if (!articleTitleInp.value || articleTitleInp.value.trim() === "") {
    // Check if the element already exists
    if (errorParagraph) return false;

    // If not, create a new element
    const articleTitleError = document.createElement("p");
    articleTitleError.id = "article-title-error";
    articleTitleError.classList.add("text-red-600", "mb-4", "text-pretty");
    articleTitleError.textContent = "El título no puede estar vacío";

    // Insert after the input
    articleTitleInp.parentNode.insertBefore(articleTitleError, articleTitleInp.nextSibling);

    return false;
  }

  console.log(articleTitleInp.value)

  if (errorParagraph) errorParagraph.remove()

  return true;
}

/**
 * Check if the API key is empty or not valid
 * @param apiKeyInp
 * @returns {boolean}
 */
const checkApiKey = (apiKeyInp) => {
  const pattern = /^sk-proj/;

  const errorParagraph = document.querySelector("#apikey-error")

  if (!apiKeyInp.value || apiKeyInp.value.trim() === "" || !pattern.test(apiKeyInp.value)) {

    // Check if the element already exists
    if (errorParagraph) return false;

    // If not, create a new element
    const apiKeyError = document.createElement("p");
    apiKeyError.id = "apikey-error";
    apiKeyError.classList.add("text-red-600", "mb-4", "text-pretty");
    apiKeyError.textContent = "El campo API Key no puede estar vacío y debe ser válido";

    // Insert after the input
    apiKeyInp.parentNode.insertBefore(apiKeyError, apiKeyInp.nextSibling);

    return false;
  }

  if (errorParagraph) errorParagraph.remove()

  return true;
}

/**
 * Save the article in the database
 * @param articleTitle
 * @param articleText
 * @param articleImage
 * @returns {Promise<void>}
 */
const saveArticle = async (articleTitle, articleText, articleImage) => {
  const formData = new FormData();
  formData.append("new_article", "yes")
  formData.append("title", articleTitle)
  formData.append("content", articleText)
  formData.append("image", articleImage)

  const data = await fetchApi("index.php", {
    method: "POST",
    body: formData
  })

  const infoParagraph = document.createElement("p");
  infoParagraph.id = "info-paragraph";
  infoParagraph.classList.add("mb-4", "text-pretty");
  infoParagraph.textContent = data.info;

  if (data.ok) {
    infoParagraph.classList.add("text-green-600");
  } else {
    infoParagraph.classList.add("text-red-600");
  }

  const mainContainer = document.querySelector("#main-container");
  mainContainer.classList.add("max-w-sm")
  mainContainer.innerHTML = firstHTML;
  mainContainer.appendChild(infoParagraph);
}


/**
 * Check if the API key and the article title are valid and the print the article
 * @returns {Promise<void>}
 */
const generateArticle = async () => {
  const inpButton = document.querySelector("#generarArticulo")
  inpButton.disabled = true
  inpButton.innerText = "Generando artículo..."
  const apiKeyInp = document.querySelector("#apikey-input")
  const articleTitleInp = document.querySelector("#titulo")

  // Check if the inputs are valid
  const correctApiKey = checkApiKey(apiKeyInp)
  const correctTitle = checkArticleTitle(articleTitleInp)

  if (!correctApiKey || !correctTitle) {
    inpButton.disabled = false
    return;
  }

  // Save the api key in local storage
  localStorage.setItem("apiKey", apiKeyInp.value);

  const apiKey = apiKeyInp.value;
  const articleTitle = articleTitleInp.value;

  // Save the promises in an array
  const promises = []
  promises.push(getArticleTextRes(apiKey, articleTitle))
  promises.push(getArticleImageRes(apiKey, articleTitle))

  // Get the article text and image from the API
  let articleInfo = []
  try {
    articleInfo = await Promise.all(promises)
    console.log({articleInfo})
  } catch (error) {
    console.error(error);
    inpButton.disabled = false
    inpButton.innerText = "Generar artículo"
    return;
  }

  // Render the article
  const articleText = articleInfo[0].choices[0].message.content
  const articleImage = articleInfo[1].data[0].url

  console.log({articleInfo, articleText, articleImage})

  const main = document.querySelector("#main-container")
  main.classList.toggle("max-w-sm")
  main.innerHTML = `
    <article class="m-5 grid">
      <h2 class="text-center mb-5 text-2xl">${articleTitle}</h2>
      <p class="text-balance m-auto mb-5 p-2">${articleText}</p>
      <img class="m-auto" width="512" height="512" src="${articleImage}" alt="Imagen de artículo">
      <button
      id="guardarArticulo"
      class="mt-4 mx-auto py-2 px-4 rounded-lg bg-green-500 text-white hover:bg-green-700 focus:outline-none"
    >
      Guardar artículo
    </button>
    </article>
  `;

  const saveArticleButton = document.querySelector("#guardarArticulo")
  saveArticleButton.addEventListener("click", async () => {
    await saveArticle(articleTitle, articleText, articleImage)
    iniciar()
  })
}

function iniciar() {
  const apiKey = localStorage.getItem("apiKey");

  if (apiKey) {
    document.querySelector("#apikey-input").value = apiKey;
  }

  // Save the html to recover later
  firstHTML = document.querySelector("#main-container").innerHTML;

  document.querySelector("#generarArticulo").addEventListener("click", generateArticle);
}

window.onload = iniciar;