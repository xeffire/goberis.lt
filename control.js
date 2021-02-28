
function elemBuilder(obj) {
    let elem = document.createElement(obj.elem);
    for(key of Object.keys(obj)){
        if(key === 'elem'){continue};
        elem[key] = obj[key];
    }
    return elem;
}

function gitTag() {
    //objektai apibudinantys elementus
    let gitLink = {
        elem: "a",
        href: "https://github.com/xeffire/Mokymai/tree/master"+window.location.pathname,
        target: "_blank",
    }
    let gitDiv = {
        elem: "div",
        id: "gitTag",
    }
    let gitImg = {
        elem: "i",
        id:'gitIcon',
        className: "fa fa-github",
    }
    // building elements and nesting
    let resNode = elemBuilder(gitLink);
    resNode.appendChild(elemBuilder(gitDiv));
    resNode.firstElementChild.appendChild(elemBuilder(gitImg));
    resNode.firstElementChild.appendChild(document.createTextNode('Git nuoroda'))
    //returning elements branch
    return resNode;
}

function commentTag() {
    let feedbackDiv = {
        elem: "div",
        className: 'feedback nonactive'
    }
    let textarea = {
        elem: "textarea",
        name: "mess",
        id: "mess",
        placeholder:"Komentarai, pastabos, pasiūlymai, bet neprivaloma :)" 
    }
    let commentImg = {
        elem: "i",
        className: "fa fa-comment comment",
        onclick: () => toggleActive(document.querySelector(".feedback")),
    } 
    let submitButton = {
        elem: "button",
        className: 'submit',
        onclick: () => feedbackSubmit(document.querySelector('.feedback')),
        innerHTML: 'Patvirtinti',
    }
    let thumbsUpButton = {
        elem: "i",
        className: "fa fa-thumbs-up thumbsUpButton nonactive",
        onclick: () => {toggleActive(document.querySelector(".thumbsUpButton")); toggle(document.querySelector(".thumbsUpButton"))}
    }
    let thumbsDownButton = {
        elem: "i",
        className: "fa fa-thumbs-down thumbsDownButton nonactive",
        onclick: () => {toggleActive(document.querySelector(".thumbsDownButton")); toggle(document.querySelector(".thumbsDownButton"))}
    }
        // building elements and nesting
        let resNode = elemBuilder(feedbackDiv);
        resNode.appendChild(elemBuilder(textarea));
        resNode.appendChild(elemBuilder(commentImg));
        resNode.appendChild(elemBuilder(submitButton));
        resNode.appendChild(elemBuilder(thumbsUpButton));
        resNode.appendChild(elemBuilder(thumbsDownButton));
        //returning elements branch
        return resNode;
}

function linkResources() {
    var head = document.getElementsByTagName("head")[0],
    cssLink = document.createElement("link");
    cssLink.href = "/gitTag.css";
    cssLink.rel = "stylesheet";
    jsComment = document.createElement("script");
    jsComment.src = "/comment.js";
    fontAwesome = document.createElement("script");
    fontAwesome.src = "https://kit.fontawesome.com/fea9832bc8.js";
    fontAwesome.crossOrigin = "anonymous";
    head.appendChild(cssLink);
    head.appendChild(jsComment);
    head.appendChild(fontAwesome);
}
function load() {
    document.body.appendChild(gitTag());
    document.body.appendChild(commentTag());
    linkResources();
}

document.addEventListener("DOMContentLoaded", load);
