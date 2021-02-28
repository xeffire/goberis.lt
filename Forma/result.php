<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    
    <link rel="stylesheet" href="css.css" />
</head>
<body>
    <form action="index.php">
        <p>Dauti duomenys iš formos:</p>
        <pre>
        <?php
            print_r($_POST);
        ?>
        </pre>
        <button class="btn btn-primary">Atgal</button>
    </form>
</body>
</html>