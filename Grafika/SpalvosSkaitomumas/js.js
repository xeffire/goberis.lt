let text = {
  kontrastas: ["Black", "on", "light", "color", "gives", "contrast"],
  vibracija: ["Vibrating", "colors", "make", "your", "eyes", "hurt"],
  geras: ["Opposite", "tone", "colors", "makes", "text", "readable"],
  blogas: ["Opposite", "hue,", "same", "lightness -", "hardly", "readable"],
  geras2: ["Readability", "is", "possible", "with", "similar", "colors"],
  blogas2: ["Too", "close", "of", "tones", "is", "unreadable"],
};
let disp = "kontrastas";
window.onload = () => {
  textChange();
  colorChange();
};
let int = setInterval(colorChange, 1000);

function getElems() {
  let HTMLcoll = document.getElementsByClassName("box");
  let array = [];
  for (let i = 0; i < HTMLcoll.length; i++) {
    array.push(HTMLcoll[i]);
  }
  return array;
}
function textChange() {
  let divs = getElems();
  for (let i = 0; i < 6; i++) {
    divs[i].innerHTML = text[disp][i];
  }
}

function colorChange() {
  let div = getElems();
  let flip = (perc) => {
    return 100 - perc;
  };
  let color = (h, s, l) => {
      return "hsl(" + h + ", " + s + "%, " + l + "%)";
  }
  for (let i = 0; i < div.length; i++) {
      let hue = Math.floor(Math.random() * 360.99);
    if (disp == "kontrastas") {
      let perc = Math.floor(Math.random() * 70 + 30);
      div[i].style.backgroundColor = color(hue, perc, perc)
      div[i].style.color = "#000";
    }
    if (disp == "vibracija") {
      div[i].style.backgroundColor = color(hue, 100, 50);
      div[i].style.color = color(hue + 180, 100, 50);
    }
    if (disp == "geras") {
      let perc = Math.floor(Math.random() * 20 + 70);
      perc = perc < 80 ? perc : flip(perc);
      div[i].style.backgroundColor = color(hue, perc, perc);
      div[i].style.color = color(hue + 180, 100 - perc, 100 - perc);
    }
    if (disp == "blogas") {
      let perc = Math.floor(Math.random() * 20 + 70);
      perc = perc < 80 ? perc : flip(perc);
      div[i].style.backgroundColor = color(hue, perc, perc);
      perc += Math.random() * 14 - 7;
      div[i].style.color = color(hue + 180, perc, perc);
    }
    if (disp == "geras2") {
      let perc = Math.floor(Math.random() * 20 + 70);
      perc = perc < 80 ? perc : flip(perc);
      div[i].style.backgroundColor = color(hue, perc, perc);
      hue += Math.random() > 0.5 ? 10 : -10;
      perc += perc > 50 ? -20 : 20;
      div[i].style.color = color(hue, perc, perc);
    }
    if (disp == "blogas2") {
      let perc = Math.floor(Math.random() * 20 + 70);
      perc = perc < 80 ? perc : flip(perc);
      div[i].style.backgroundColor = color(hue, perc, perc);
      hue += Math.random() > 0.5 ? 5 : -5;
      perc += perc > 50 ? -5 : 5;
      div[i].style.color = color(hue, perc, perc);
    }
  }
}

function handleDisp(str) {
  disp = str;
  textChange();
  colorChange();
}
