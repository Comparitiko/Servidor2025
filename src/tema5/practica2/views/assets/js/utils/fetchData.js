export const fecthURL = async (url) => {
  const res = await fetch(url);
  return res.json();
};
