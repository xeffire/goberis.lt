function toggleActive(obj) {
  let suffix = [" active", " nonactive"];
  obj.className.includes(suffix[0])
    ? (obj.className = obj.className.replace(suffix[0], suffix[1]))
    : (obj.className = obj.className.replace(suffix[1], suffix[0]));
}
function toggle(obj1) {
  let obj2 = obj1.className.includes("thumbsUpButton")
    ? document.querySelector(".thumbsDownButton")
    : document.querySelector(".thumbsUpButton");
  if (
    obj1.className.includes(" active") &&
    obj2.className.includes(" active")
  ) {
    toggleActive(obj2);
  }
}
function feedbackSubmit(parent) {
  let vote = () => {
    if (parent.querySelector(".thumbsUpButton").className.includes(" active")) {
      return 1;
    } else if (
      parent.querySelector(".thumbsDownButton").className.includes(" active")
    ) {
      return -1;
    } else {
      return 0;
    }
  };
  let message = parent.querySelector("textarea").value;
  let displayStatus = (text) => {
    document.querySelector(".submit").innerHTML = text;
    console.log(text);
  };
  let obj = {
    date: Date.now(),
    vote: vote(),
    comment: message,
  };
  //build form
  let form = new FormData();
  for (const item in obj) {
    form.append(item, obj[item]);
  }
  //send form
  let ajax = new XMLHttpRequest();
  ajax.onreadystatechange = () => {
    if (ajax.readyState == 4 && ajax.status == 200) {
      displayStatus(ajax.responseText);
    }
  };
  displayStatus("Waiting...");
  ajax.open("POST", "/database.php");
  ajax.send(form);
}
