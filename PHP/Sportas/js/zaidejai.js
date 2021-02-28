let link = (rows) => {
  for (const row of rows) {
    row.addEventListener("click", () =>
      window.open(
        "stats.php?id=" +
          row.dataset.gameid +
          "&playerId=" +
          row.dataset.playerid,
        "_self"
      )
    );
    console.log(row.id);
  }
};
window.onload = () => {
  console.log("loaded");
  link(document.getElementsByClassName("row"));
};
