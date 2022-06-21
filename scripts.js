const title = document.querySelector("#container-title");
const categorie = document.querySelector("#container-categorie");
const message = document.querySelector("#container-message");
const btn = document.querySelector("container-btn")

let articleContainer = document.querySelector("#article-container");
let addArticle = document.querySelector("#new-article");

let addTitle = document.querySelector("#input-title");

let addCategorie = document.querySelector("#categorie-input");

let addmessage = document.querySelector("#message-input");

addArticle.onsubmit = (e) => {
  e.preventDefault();
  const title = document.createElement("div");
  title.id = "createTitle";
  const createArticle = document.createElement("div");
  createArticle.id = "createArticle";

  title.textContent = addTitle.value;
  articleContainer.appendChild(createArticle);
  createArticle.appendChild(title);

  const categorie = document.createElement("div");

  categorie.textContent = "Type d'article : " + addCategorie.value;
  categorie.id = "createcategorie";
  createArticle.appendChild(categorie);

  const article = document.createElement("div");
  article.id = "article";

  article.textContent = addmessage.value;
  createArticle.appendChild(article);

  const supp = document.createElement("button");
  supp.innerHTML = "Supprimer";
  supp.id = "btn-article";

  createArticle.appendChild(supp);

  supp.addEventListener("click", () => {
    createArticle.remove();
  });

  const details = document.createElement("button");
  details.innerHTML = "Détails";
  details.id = "btn-article";

  createArticle.appendChild(details);

};

