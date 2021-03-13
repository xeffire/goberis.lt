function Ops() {
  this.getNumberBtns = function () {
    return [
      this["1"],
      this["2"],
      this["3"],
      this["4"],
      this["5"],
      this["6"],
      this["7"],
      this["8"],
      this["9"],
      this["0"],
    ];
  };
  this.getOpBtns = function () {
    return [this["+"], this["-"], this["×"], this["÷"], this["."]];
  };
  //init: priskiria visus mygtukus kaip objekto properties
  for (let btn of document.getElementsByTagName("button")) {
    this[btn.innerText] = btn;
  }
}

let ops, last, curr;
let lastSymbol = "0";
let isLastNumFloat = false;
let freshCalc = true;

const assingFunctions = () => {
  for (let btn of [...ops.getNumberBtns(), ...ops.getOpBtns()]) {
    btn.addEventListener("click", appendSymbol);
  }
  ops["="].addEventListener("click", calc);
  ops.AC.addEventListener("click", clear);
  ops.DEL.addEventListener("click", delet);
  document.addEventListener("keydown", keyboardNav);
};

const appendSymbol = (event) => {
  const btn = event.target;

  //if latest number is float and btn is '.': break.
  if (isLastNumFloat && btn.innerText === ".") {
    return;
  }
  //if btn is '.': toggle isLastNumFloat
  if (btn.innerText === ".") {
    isLastNumFloat = true;
  }

  let isOp = ops.getOpBtns().includes(btn);
  let isLastOp = ["+", "-", "×", "÷", "."].includes(lastSymbol);

  //if starting calculation and btn is num: clear last calc result, break.
  if (freshCalc && !isOp) {
    curr.innerText = btn.innerText;
    freshCalc = false;
    return;
  }

  //if last symb is operator and new symb is also
  //or curr number is 0 and new symb is number
  //remove last symb before adding new
  if (isOp && isLastOp || curr.innerText == '0' && !isOp) {
    curr.innerHTML = curr.innerText.slice(0, -1);
  }

  //if btn is operator but not '.': isFloat = false;
  if (isOp && btn.innerText != ".") {
    isLastNumFloat = false;
  }

  curr.innerText += btn.innerText;
  lastSymbol = curr.innerText[curr.innerText.length - 1];
  freshCalc = false;
};

const calc = () => {
  //remove operator at the end if needed
  if (["+", "-", "×", "÷"].includes(lastSymbol)) {
    curr.innerText = curr.innerText.slice(0, -1);
  }

  last.innerText = curr.innerText + " =";

  // split numbers and operators to separate arrays.
  let numArr = curr.innerText.split(/[+\-×÷]/g).map((i) => parseFloat(i));
  let opArr = curr.innerText.split(/[\d.]+/g).filter((el) => {
    return el != "";
  });

  //if first number arrays starts with NaN (first symbol is -): turn first num negative, fix order of nums and ops.
  if (isNaN(numArr[0])) {
    numArr[0] = -numArr[1];
    numArr.splice(1, 1);
    opArr.splice(0, 1);
  }

  //Do operations till one number left.
  while (numArr.length > 1) {
    let i = opArr.indexOf("×");
    if (i > -1) {
      numArr[i] = numArr[i] * numArr[i + 1];
      numArr.splice(i + 1, 1);
      opArr.splice(i, 1);
      continue;
    }
    i = opArr.indexOf("÷");
    if (i > -1) {
      numArr[i] = numArr[i] / numArr[i + 1];
      numArr.splice(i + 1, 1);
      opArr.splice(i, 1);
      continue;
    }
    i = opArr.indexOf("-");
    if (i > -1) {
      numArr[i] = numArr[i] - numArr[i + 1];
      numArr.splice(i + 1, 1);
      opArr.splice(i, 1);
      continue;
    }
    i = opArr.indexOf("+");
    if (i > -1) {
      numArr[i] = numArr[i] + numArr[i + 1];
      numArr.splice(i + 1, 1);
      opArr.splice(i, 1);
      continue;
    }
  }

  curr.innerText = numArr[0].toFixed(6).replace(/\.?0*$/, "");
  last.innerText += numArr[0].toFixed(6).replace(/\.?0*$/, "");
  lastSymbol = curr.innerText;
  isLastNumFloat = lastSymbol.search(/\./) > 0 ? true : false;
  freshCalc = true;
};

const clear = () => {
  curr.innerText = "0";
  last.innerText = "0";
  lastSymbol = "0";
};

const delet = () => {
  curr.innerText = curr.innerText.slice(0, -1);
  if (curr.innerText.length === 0) {
    curr.innerText = "0";
  }
  lastSymbol = curr.innerText.substr(-1, 1);
};

const keyboardNav = (event) => {
  let btn = ops[event.key];
  switch (event.key) {
    case "Enter":
      btn = ops["="];
      break;
    case "Backspace":
      btn = ops["DEL"];
      break;
      case "Delete": 
      btn = ops['AC'];
      break;
    default:
      break;
  }
  if (btn == null) {
    return;
  }
  btn.click();
};

window.onload = () => {
  ops = new Ops();
  last = document.getElementById("last");
  curr = document.getElementById("curr");
  assingFunctions();
}