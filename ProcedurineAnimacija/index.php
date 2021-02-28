<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="js.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body class="flex-column m-auto">
<div class="d-flex w-100">
    <p class="alert alert-warning text-center w-100">Stroke storis 1-10px
    <input type="range" class="form-range" min="1" max="10" step="1" id="strokeWidth" value="5">
    </p>
    <p class="alert alert-warning text-center w-100">Animacijos greitis 1-10s
    <input type="range" class="form-range" min="1" max="10" step="1" id="speed" value="5">
    </p>
    </div>
    <div class="border">
        <?php echo file_get_contents('demo.svg');?>
        <div class='anim'>
        <?php echo file_get_contents('2021.svg');?>
        </div>
    </div>
</body>
</html>