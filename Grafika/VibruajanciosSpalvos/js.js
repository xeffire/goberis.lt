colorChange();
let int = setInterval(colorChange, 1000);
function colorChange() {
let div = document.getElementsByTagName("div");
for (let i = 0; i < div.length; i++) {
  let col = Math.floor(Math.random() * 360);
  console.log(col);
  div[i].style.backgroundColor = "hsl(" + col + ", 100%, 50%)";
  console.log(div[i].style);
  col += 180;
  if (col > 360) {
    col -= 360;
  }
  div[i].style.color = "hsl(" + col + ", 100%, 50%)";
}
}