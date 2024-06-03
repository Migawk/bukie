const nav = document.getElementById("nav");

const addToLib = async (bookId) => {
  const url = new URL(window.location.href);
  url.pathname = "api/lib.php";

  const body = new FormData();
  body.append("bookId", bookId);

  const req = await fetch(url, {
    method: "POST",
    body,
  }).then((res) => res.text());

  console.log(req);
};
