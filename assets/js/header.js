async function toSearch(e) {
  e.preventDefault();
  const {res, status} = await fetch("/api/book.php?name="+e.target.query.value).then(res => res.json());

  if(status === "ok") {
    const field = document.getElementById("categoriesField");
    field.innerHTML = "";

    res.forEach(answer => {
      const answerField = document.createElement("div");
      answerField.className = "d-flex gap-1";

      const index = document.createElement("div");
      const indexImg = document.createElement("img");
      index.className = "d-flex justify-content-center bg-success align-items-center p-1 rounded";
      index.style.width = "24px";
      index.style.height = "24px";
      indexImg.src = "./assets/svg/books.svg";

      const info = document.createElement("a");
      info.className = "link-secondary bg-gray-800 p-1 rounded text-decoration-none";
      info.textContent = answer.name + " - " + answer.authorName;
      info.href = "/book.php?id="+answer.id;

      index.append(indexImg);
      answerField.append(index, info);
      field.append(answerField);
    })
  }
  
};
const form = document.getElementById("searchQuery");
form.addEventListener("submit", toSearch, true);