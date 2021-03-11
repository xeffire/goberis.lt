function Ops() {
  this.getNumberBtns = function () {
    return [
      this.one,
      this.two,
      this.three,
      this.four,
      this.five,
      this.six,
      this.seven,
      this.eight,
      this.nine,
      this.zero,
    ];
  };
  this.getOpBtns = function () {
    return [this.add, this.sub, this.mul, this.div, this.point];
  };
  this.getFuncBtns = function () {
    return [this.ac, this.del, this.equal];
  };
  for (let btn of document.getElementsByTagName("button")) {
    switch (btn.innerText) {
      case "AC":
        this.ac = btn;
        break;
      case "DEL":
        this.del = btn;
        break;
      case "÷":
        this.div = btn;
        break;
      case "1":
        this.one = btn;
        break;
      case "2":
        this.two = btn;
        break;
      case "3":
        this.three = btn;
        break;
      case "×":
        this.mul = btn;
        break;
      case "4":
        this.four = btn;
        break;
      case "5":
        this.five = btn;
        break;
      case "6":
        this.six = btn;
        break;
      case "+":
        this.add = btn;
        break;
      case "7":
        this.seven = btn;
        break;
      case "8":
        this.eight = btn;
        break;
      case "9":
        this.nine = btn;
        break;
      case "-":
        this.sub = btn;
        break;
      case ".":
        this.point = btn;
        break;
      case "0":
        this.zero = btn;
        break;
      case "=":
        this.equal = btn;
        break;
      default:
        break;
    }
  }

}

let ops = new Ops();
let lastSymbol = "0";
let isLastNumFloat = false;
let freshCalc = true;
let last = document.getElementById('last');
let curr = document.getElementById("curr");

const assingFunctions = () => {
  for (let btn of [...ops.getNumberBtns(), ...ops.getOpBtns()]) {
    btn.addEventListener("click", appendSymbol);
  }
  ops.equal.addEventListener("click", calc);
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

  //(if last symb is operator and new symb is also) or (last is 0 and new is 0) - remove last symb before adding new
  if ((isOp && isLastOp) || (!isOp && curr.innerText === "0")) {
    curr.innerHTML = curr.innerText.slice(0, -1);
  }

  //if btn is operator but not '.': isFloat = false;
  if (isOp && btn.innerText != '.') {
    isLastNumFloat = false
  }

  curr.innerText += btn.innerText;

  // lastSymbol = curr.innerText[curr.innerText.length-1] == /\d/?btn.innerText:lastSymbol;
  lastSymbol = curr.innerText[curr.innerText.length-1];
  freshCalc = false;
};

const calc = () => {
  console.log(lastSymbol);
  //remove operator at the end if needed
  if (["+", "-", "×", "÷"].includes(lastSymbol)) {
    curr.innerText = curr.innerText.slice(0, -1);
    console.log(curr.innerText);
  }

  last.innerText = curr.innerText + ' =';

  // split numbers and operators to separate arrays.
  let numArr = curr.innerText.split(/[+\-×÷]/g).map(i => parseFloat(i));
  let opArr = curr.innerText.split(/[\d.]+/g).filter((el) => {return el != ''});
  console.log(curr.innerText + "   " + numArr + '   ' + opArr);

  //if first number arrays starts with NaN (first symbol is -): turn first num negative, fix order of nums and ops.
  if (isNaN(numArr[0])) {
    console.log(numArr);
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
  curr.innerText = numArr[0].toFixed(6).replace(/\.?0*$/,'');;
  last.innerText += numArr[0].toFixed(6).replace(/\.?0*$/,'');;
  lastSymbol = curr.innerText;
  isLastNumFloat = lastSymbol.search(/\./) > 0?true:false;
  freshCalc = true;
};

assingFunctions();
