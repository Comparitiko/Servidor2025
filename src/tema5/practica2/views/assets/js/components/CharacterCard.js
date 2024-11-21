export class CharacterCard extends HTMLElement {
  constructor() {
    super();
    this.id = this.getAttribute("id");
    this.nombre = this.getAttribute("nombre");
    this.img = this.getAttribute("img");
    this.raza = this.getAttribute("raza");
    this.ki = this.getAttribute("ki");
    if (this.nombre === "Zeno") this.raza = "Zeno Sama";
    if (this.ki === "unknown") this.ki = "Desconocido";
    this.render();
  }

  render() {
    this.innerHTML = `
        <article class="card">
          <a href="./index.php?action=show_character&character_id=${this.id}" class="card-link">
            <h1>${this.nombre}</h1>
            <img class="card-image" src="${this.img}" alt="Imagen de ${
      this.nombre
    }">
            <h2 class="card-ki">Ki: ${this.ki}</h2>
            <h2 class="card-race ${this.raza
      .split(" ")
      .slice(0, 1)
      .join("")
      .toLowerCase()}">${this.raza}</h2>
          </a>
        </article>
    `;
  }
}

customElements.define("character-card", CharacterCard);
