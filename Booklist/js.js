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
      star.addEventListener("click", this.changeVal);
    });
  }

  changeVal(e) {
    let val = 0;
    const stars = e.target.parentNode;
    for(let star of [...stars.children]) {
      val++;
      if(star === e.target) {break}
    }
    if (stars.nextElementSibling.value == val) {val = 0};
    stars.nextElementSibling.value = val;
    Stars.renderStars.call(stars, val);
  }

  static renderStars(val) {
    for (let star of [...this.children]) {
      star.classList.remove('text-success');
    }
    for (let i = 0; i < val; i++) {
      this.children[i].classList.add('text-success');
    }
  }
}

const tableCols = ["id", "title", "author", "pgsDone", "rating"];
const rate = new Stars(document.getElementsByClassName("stars")[0]);
let data = {};

document.getElementById("submit").addEventListener("click", e => {
  FetchState.wait();
  fetch("dbHandler.php", {
    method: "POST",
    body: new FormData(document.getElementById("new")),
  })
    .then(res => res.json())
    .then(res => {data = res; return data})
    .then(res => refresh(res));
  e.target.previousElementSibling.reset();
  Stars.renderStars.call(e.target.previousElementSibling.querySelector('.stars'), 0)
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
  .then(res => {data = res; return data})
  .then(res => refresh(res));

function edit(e) {
  let tr = e.target.parentNode.parentNode;
  let fieldList = [...data.filter(obj => obj.id == tr.firstElementChild.innerText)][0];
  let editBtn = e.target;
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

  //hide other edit btns
  [...document.getElementsByClassName('bi-pencil')].forEach(pencil => pencil.style.visibility = 'hidden');

  editBtn.removeEventListener("click", edit);
  editBtn.addEventListener("click", update);
  editBtn.addEventListener("click", confirmEdit);
}

function update(e) {
  FetchState.wait();
  let form = new FormData();
  const tr = e.target.parentNode.parentNode;
  let fieldList = [...data.filter(obj => obj.id == tr.firstElementChild.innerText)][0];
  
  for (let key in fieldList) {
    if (key === 'id') {form.set('id', fieldList[key]); continue}
    if (tableCols.indexOf(key) === -1) {continue}
    form.set(key, fieldList[key].value);
  }
  form.set("method", "update");

  fetch("dbhandler.php", { method: "POST", body: form })
    .then((res) => res.json())
    .then(res => {data = res; return data})
    .then(res => refresh(res));
}

function confirmEdit(e) {
  const tr = e.target.parentNode.parentNode;
  const fieldList = [...data.filter(obj => obj.id == tr.firstElementChild.innerText)][0];
  const editBtn = e.target;
  [...tr.children].forEach((td, i) => {
    if (i == 0 || i == 5 || i == 6) {
      return true;
    }
    td.firstElementChild.remove();
    td.innerText = fieldList[tableCols[i]].value;
  });
  editBtn.className = "bi bi-pencil";

    //show edit btns
    [...document.getElementsByClassName('bi-pencil')].forEach(pencil => pencil.style.visibility = 'visible');

  editBtn.removeEventListener("click", update);
  editBtn.removeEventListener("click", confirmEdit);
  editBtn.addEventListener("click", edit);
  FetchState.ok();
}

function del(e) {
  let id = e.target.parentNode.parentNode.children[0].innerText;
  fetch(`dbhandler.php?id=${id}&method=delete`, { method: "GET" })
    .then(res => res.json())
    .then(res => {data = res; return data})
    .then(res => refresh(res));
  e.target.parentNode.parentNode.remove();
}
