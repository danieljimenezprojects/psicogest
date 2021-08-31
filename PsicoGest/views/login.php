<?php
// Muestra la vista de inicio de sesión. Se corrigieron algunos bugs.
class LoginView{
    // esta función es para iniciar sesión
    public function logInUser(){
        echo '<html>
   
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PsicoGest - Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </head>
        <body>
        <nav class="navbar navbar-light bg-dark py-0 pt-1 justify-content-between">
            <a class="navbar-brand text-primary" href="index.html">PsicoGest</a>
        </nav>
       <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-3"> Inicia Sesión en <span class="text-primary">PsicoGest</span></h1>
                </div>
            </div>
        </div>
        <div class="container bg-light pb-3 ml-2 pr-3">
           <div class="row">
            <div class="col-sm-12">
            <form action="../controllers/logincontroller.php" method="POST">
            <div class="mb-3 pt-2">
                <label for="usuario" class="form-label text-primary">Usuario</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Juan" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label text-primary">Contraseña</label>
                <input type="password" class="form-control" name="pwd" id="pwd" placeholder="********" minlength="8" required>
              </div>
              <input name="action" type="hidden" value="login">
              <button type="submit" name="submit" class="btn btn-primary mb-3">Enviar</button>
              <button type="button" class="btn btn-link pb-4">¿Olvidaste tu contraseña? </button>
            </form>';?>
            <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyInputLogin"){
                    echo "<p> Rellena todos los campos! </p>";
                } else if ($_GET["error"] == "wrongpassword"){
                    echo "<p> Error en la contraseña </p>";
                    }
    
            }
            ?> <?php
            echo '</div>
            </div>
        </div>
        <div class="container bg-dark pb-3 ml-3 pr-3 mt-3">
          <div class="row">
              <div class="col">
                <span class="text-white">¿Nuevo en Psicogest?</span>
                <form action="../views/userview.php" method="POST">
                <input name="action" type="hidden" value="new">
                <input name="id" type="hidden" value = "0">
                <button type="submit" name="button" class="btn btn-primary pb-2 text-white" > Regístrate ahora </button>
                </form>
            </div>
          </div>
        </div>   
      
        </body>
        </html>';
        
    }
}

    $loginView = new LoginView();
    if(isset($_POST["action"])){
        $loginView->logInUser();
    } 
    

    if(isset($_GET["error"])){
    $loginView->logInUser();
    
    }
    
?>