let link = (rows) => {
    for (const row of rows) {
        row.addEventListener("click", () => window.open("zaidejai.php?id=" + row.dataset.gameid, "_self"));
        console.log(row.id);
    }
}
window.onload = () => {
    console.log("loaded");
    link(document.getElementsByClassName("row"));
};
