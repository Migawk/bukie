async function deletePage(number, book_id) {
  let res = await fetch("/api/page.php", {
    method: "DELETE",
    body: JSON.stringify({
      number,
      book_id,
    }),
  });
  console.log(
    JSON.stringify({
      number,
      book_id,
    })
  );
  res = await res.text();
  if (res.length) {
    const answer = JSON.parse(res);
    console.error(answer);
  } else {
    const page = document.getElementById("page" + number);
    page.remove();
    const prevPage = document.getElementById("page" + (number - 1));

    const button = document.createElement("button");
    button.type = "button";
    button.className = "btn btn-danger deletePage";
    button.style.fontSize = ".5rem";
    button.textContent = "Delete";
    button.disabled = true;

    const event = button.addEventListener("click", () => {
      deletePage(number - 1, book_id);
      button.removeEventListener("click", event);
    });

    setTimeout(() => {
      button.disabled = false;
    }, 500);
    prevPage.children[0].append(button);
  }
}
async function addPage(book_id, number) {
  const list = document.getElementsByClassName("list")[0];

  if (!number) {
    number = list.children.length - 1;
  }

  let res = await fetch("/api/page.php", {
    method: "POST",
    body: JSON.stringify({
      number,
      book_id,
    }),
  });

  res = await res.json();
  if (res.status != "ok") {
    const answer = JSON.parse(res);
    console.error(answer);
  } else {
    document.getElementsByClassName("deletePage")[0] &&
      document.getElementsByClassName("deletePage")[0].remove();

    const last = list.children.length - 1;
    const tempCopy = list.children.item(last);
    list.removeChild(tempCopy);

    const page = document.createElement("div");
    page.className = "page d-flex gap-2 me-5";
    page.id = "page" + last;

    const pageLeft = document.createElement("div");
    pageLeft.style.width = "4.66rem";
    pageLeft.className =
      "number text-secondary d-flex flex-column align-items-end";

    const pageNumber = document.createElement("p");
    pageNumber.textContent = last;

    const button = document.createElement("button");
    button.type = "button";
    button.className = "btn btn-danger deletePage";
    button.style.fontSize = ".5rem";
    button.textContent = "Delete";
    button.disabled = true;

    const event = button.addEventListener("click", () => {
      deletePage(last, book_id);
      button.removeEventListener("click", event);
    });

    setTimeout(() => {
      button.disabled = false;
    }, 500);

    const textarea = document.createElement("textarea");
    textarea.className = "border p-3 w-100 pageEditing";
    textarea.name = res.body.id;

    pageLeft.append(pageNumber, button);
    page.append(pageLeft, textarea);
    list.append(page, tempCopy);
  }
}

// name.addEventListener("change", console.log);
async function check(name, description, image) {
  const submit = document.getElementById("formSubmit");
  const [fieldName, fieldDescription, fieldImage] = [
    document.getElementById("name").value,
    document.getElementById("description").value,
    document.getElementById("image").value,
  ];
  if (!submit || !fieldName || !fieldDescription) return;

  if (
    name === fieldName &&
    description.replaceAll("&#039;", "'") === fieldDescription &&
    image === fieldImage
  ) {
    submit.disabled = true;
  } else {
    submit.disabled = false;
  }
}
