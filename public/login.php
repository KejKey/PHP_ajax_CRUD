    
    <link href="../style/signin.css" rel="stylesheet">
 </head>
<body >
<?php
include_once "../views/header.php";
require_once "../controls/login.php";
?>


<main class="form-signin">
  <form action="login.php" method="POST">  
    <h1 class="h3 mb-3 fw-normal">Zaloguj się</h1>
    <?php
        if (!$userError) 
        {
          echo
            "<div class='alert alert-danger' role='alert'>
            niepoprawny login lub hasło
            </div>";
        }
    ?>
    <label for="inputName" class="visually-hidden">Login</label>
    <input type="text" id="inputName" class="form-control"name="name" placeholder="Login" required autofocus autoComplete="off">
    <label for="inputPassword" class="visually-hidden">Hasło</label>
    <input type="password" id="inputPassword" class="form-control"  name="password" placeholder="Hasło" required>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Zaloguj się</button>
    
  </form>
</main>


<?php include_once "../views/footer.php"; ?>