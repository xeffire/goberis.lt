let userData;
const timer = ms => new Promise(res => setTimeout(res, ms)) //timeris uzdelsimui

//pirmas veiksmas, kai uzsikrauna DOM medis
document.addEventListener('DOMContentLoaded', () => {dataRequest(generateCards)})

//asinkroninis requestas, kad gautu users duomenis is skripto esancio serveryje
let dataRequest = callback => {
let getData = new XMLHttpRequest();
getData.onreadystatechange = () => {
    if (getData.readyState == 4 && getData.status == 200) {
        userData = JSON.parse(getData.responseText);
        callback();
    }
}
getData.open("GET", window.location.href.replace("index.php", "getData.php"));
getData.send();
}

//visu korteliu generacija
let generateCards = () => {
    for(user of userData) {
        document.querySelector(".cardDisplay").appendChild(builder(user));
        cardAnim();
    }

}

//atskiros korteles generacija is kuriant ir sulipinant HTML elementus idedant atitinkama userio info
let builder = obj => {
    let tmp;
    let elem = document.createElement("div");
    elem.className = "card";
    elem.innerHTML = 
    `<img src='./profile-images/${obj.src}' alt='${obj.name}'>
    <h3 class='name'>${obj.name}</h3>
    <span><i class='fas fa-map-marker-alt'></i> ${obj.address}</span>
    <p>${obj.about}</p>
    <a>Get Connected!</a>
    <span class='contacts'>
        <i class='fab fa-facebook'></i>
        <i class='fab fa-twitter'></i>
        <i class='fab fa-google'></i>
        <i class='fab fa-instagram'></i>
    </span>`;
    return elem;
}

//galiausiai pritaikant inline stilius animuojamos korteles
let cardAnim = async () => {
        await timer(300);
        let cardCollection = [...document.getElementsByClassName("card")];
        for (var i = 0; i < cardCollection.length; i++) {
            cardCollection[i].style.opacity = "1";
            await timer(150);
        }
}