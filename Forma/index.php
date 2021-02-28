
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registracija</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css.css" />
  </head>
  <body>
    <form action="result.php" method="POST" enctype="multipart/form-data">
      <label for="name" class="form-label">Vardas:</label>
      <input
        type="text"
        name="name"
        placeholder="Įveskite savo vardą ir pavardę"
        class="form-control"
      />
      <select name="select">
        <option value="optionOne">option 1</option>
        <option value="optionTwo">option 2</option>
      </select>
      <div class="form-check">
        <label for="radioOne" class="form-check-label">radio 1</label>
        <input
          type="radio"
          name="radioOne"
          id="radioOne"
          class="form-check-input"
        />
      </div>
      <div class="form-check">
        <label for="radioTwo" class="form-check-label">radio 2</label>
        <input
          type="radio"
          name="radioTwo"
          id="radioTwo"
          class="form-check-input"
        />
      </div>
      <div class="form-check">
        <label for="radioThree" class="form-check-label">radio 3</label>
        <input
          type="radio"
          name="radioThree"
          id="radioThree"
          class="form-check-input"
        />
      </div>
      <label for="avatar">File</label>
      <input type="file" name="avatar" class="form-control" />
      <div class="form-check">
        <label for="checkOne" class="form-check-label">check 1</label>
        <input type="checkbox" name="checkOne" class="form-check-input" />
      </div>
      <div class="form-check">
        <label for="checkTwo" class="form-check-label">check 2</label>
        <input type="checkbox" name="checkTwo" class="form-check-input" />
      </div>
      <div class="form-check">
        <label for="checkThree" class="form-check-label">check 3</label>
        <input type="checkbox" name="checkThree" class="form-check-input" />
      </div>
      <textarea
        name="textArea"
        cols="30"
        rows="10"
        class="form-control"
      ></textarea>
      <button class="btn btn-primary">Submit</button>
    </form>
    <!-- Bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
