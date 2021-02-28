<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TTPDDPY2VX"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-TTPDDPY2VX');
    </script>
    <!-- Kontroliniu mygtuku generavimas (Git nuoroda, Komentaras) -->
    <script src="/control.js" defer></script>
    <!--  -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Koreguoti Rungtynes</title>
    <link rel="stylesheet" href="css.css" />
    <script>
      let visRungtynes = () => {
        let form = document.getElementById("formaRungtynes");
        form.style.visibility == "visible"
          ? (form.style.visibility = "hidden")
          : (form.style.visibility = "visible");
      };
    </script>
    <script src="https://kit.fontawesome.com/fea9832bc8.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php include("functions/SQLHandler.php"); ?>
    <div class="cont koreguoti">
      <div class="koreg">
        <h2>Rungtynes</h2>
        <table class="koreg">
          <thead>
            <tr>
              <th>Data</th>
              <th>Namuose</th>
              <th>Svečiuose</th>
              <th>Taškai</th>
              <th><i class="fa fa-trash"></i></th>
            </tr>
          </thead>
          <tbody>
            <?php getRungtynesTable($pdo);?>
            <tr>
              <td colspan="5">
                <a href="javascript:visRungtynes()">Pridėti naujas rungtynes</a>
              </td>
            </tr>
          </tbody>
        </table>
        <form id="formaRungtynes" action="" style="visibility: hidden">
          <input type="hidden" name="action" value="post" />
          <label for="date">Data:</label>
          <input type="date" name="date" value="<?php echo date('Y-m-d')?>" />
          <label for="home">Namuose:</label>
          <select name="home" value="getTeamName($pdo);">
            <?php getTeamsOptions($pdo)?>
          </select>
          <label for="visitors">Svečiuose:</label>
          <select name="visitors" id="visitors">
            <?php getTeamsOptions($pdo)?>
          </select>
          <label for="homeScore">Namų taškai:</label>
          <input
            type="number"
            name="homeScore"
            id="homeScore"
            value="<?php getTeamScore()?>"
          />
          <label for="visitorsScore">Svečių taškai:</label>
          <input
            type="number"
            name="visitorsScore"
            id="visitorsScore"
            value="<?php getTeamScore()?>"
          />
          <input type="submit" value="Pateikti" />
          <input type="reset" value="Ištrinti" />
        </form>
      </div>
      <div class="koreg">
        <h2>Komanda</h2>
        <table>
          <thead>
            <tr>
              <th>Komanda</th>
              <th><i class="fa fa-trash"></i></th>
            </tr>
          </thead>
          <tbody>
            <?php getTeamsTable($pdo)?>
          </tbody>
        </table>
        <form>
          <input type="hidden" name="action" value="postTeam">
          <input type="text" name="newTeam" value="<?php getNewTeamOptions();?>"/>
          <input type="submit" value="Pridėti">
        </form>
      </div>
      <div class="koreg">
        <h2>Zaidėjai</h2>
        <table>
          <thead>
            <tr><th>Vardas</th><th>Pavardė</th><th>Nuotrauka</th></tr>
          </thead>
          <tbody>
            <?php getPlayersTable($pdo, $team[0]);?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
