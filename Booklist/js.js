class FetchState {
  static statusCont = document.querySelector("tfoot").children[0].children[0];
  static okSpan = this.statusCont.children[0].classList;
  static waitSpan = this.statusCont.children[1].classList;
  static failSpan = this.statusCont.children[2].classList;

  static ok() {
    this.waitSpan.add("d-none");
    this.failSpan.add("d-none");
    this.okSpan.remove("d-none");
  }

  static wait() {
    this.okSpan.add("d-none");
    this.failSpan.add("d-none");
    this.waitSpan.remove("d-none");
  }

  static fail() {
    this.okSpan .add("d-none");
    this.waitSpan .add("d-none");
    this.failSpan .remove("d-none");
  }
}

class Stars {
  constructor(stars) {
    this.stars = [...stars.children];
    this.stars.forEach((star) => {
      star.addEventListener("click", this.rate);
    });
    this.evt = new MouseEvent("click", {
      bubbles: true,
      cancelable: true,
      view: window,
    });
  }

  rate(e) {
    e.target.classList.toggle("text-success");
    console.log(this.parentNode.children);
    for (let star of [...this.parentNode.children]) {
      if (star === this) {
        break;
      }
      star.className = this.className;
    }
    Stars.changeInputValue.call(this.parentNode, this);
  }

  static changeInputValue(star) {
    this.nextElementSibling.value =
      [...this.children].reduce((acc, elem) => {
          if (elem.classList.contains('text-success')) {
              return acc + 1;
          } else {
              return acc;
          }
      }, 0)
  }
}

const tableCols = ["id", "title", "author", "pgsDone", "rating"];
const rate = new Stars(document.getElementsByClassName("stars")[0]);

document.getElementById("submit").addEventListener("click", () => {
  FetchState.wait();
  fetch("dbHandler.php", {
    method: "POST",
    body: new FormData(document.getElementById("new")),
  })
    .then((res) => res.json())
    .then((res) => refresh(res));
});

function refresh(data) {
  let tbody = document.getElementById("tbody");
  [...tbody.children].forEach((child) => child.remove());
  data.forEach((row) => {
    let tr = document.createElement("tr");
    for (field of tableCols) {
      let td = document.createElement("td");
      td.innerText = row[field];
      tr.appendChild(td);
    }
    for (icon of ["bi bi-pencil", "bi bi-trash"]) {
      let td = document.createElement("td");
      let pressable = document.createElement("i");
      pressable.className = icon;
      tr.appendChild(td).appendChild(pressable);
    }
    tbody.appendChild(tr);
  });
  [...document.getElementsByClassName("bi-pencil")].forEach((pencil) =>
    pencil.addEventListener("click", edit)
  );
  [...document.getElementsByClassName("bi-trash")].forEach((trash) =>
    trash.addEventListener("click", del)
  );
  FetchState.ok();
}

fetch("dbHandler.php", { method: "GET" })
  .then((res) => res.json())
  .then((res) => refresh(res));

let fieldList = {};

function edit(e) {
  let tr = e.target.parentNode.parentNode;
  let editBtn = e.target;
  fieldList["id"] = tr.children[0].innerText;
  [...tr.children].forEach((td, i) => {
    if (i == 0 || i == 5 || i == 6) {
      return true;
    }
    let field = document.createElement("input");
    field.setAttribute("type", "text");
    field.className = "form-control";
    field.value = td.innerText;
    fieldList[tableCols[i]] = field;
    [...td.childNodes].forEach((node) => node.remove());
    td.appendChild(field);
  });
  editBtn.className = "bi bi-check text-success";
  editBtn.removeEventListener("click", edit);
  editBtn.addEventListener("click", update);
  editBtn.addEventListener("click", confirmEdit);
}

function update() {
  FetchState.wait();
  let form = new FormData();

  for (let key in fieldList) {
    if (typeof fieldList[key] === "string") {
      form.set("id", fieldList[key]);
      continue;
    }
    form.set(key, fieldList[key].value);
  }
  form.set("method", "update");

  fetch("dbhandler.php", { method: "POST", body: form })
    .then((res) => res.json())
    .then((res) => console.log(res));
}
function confirmEdit(e) {
  let tr = e.target.parentNode.parentNode;
  let editBtn = e.target;
  [...tr.children].forEach((td, i) => {
    if (i == 0 || i == 5 || i == 6) {
      return true;
    }
    td.firstElementChild.remove();
    td.innerText = fieldList[tableCols[i]].value;
  });
  editBtn.className = "bi bi-pencil";
  editBtn.removeEventListener("click", update);
  editBtn.removeEventListener("click", confirmEdit);
  editBtn.addEventListener("click", edit);
  FetchState.ok();
}

function del(e) {
  let id = e.target.parentNode.parentNode.children[0].innerText;
  fetch(`dbhandler.php?id=${id}&method=delete`, { method: "GET" });
  e.target.parentNode.parentNode.remove();
}
