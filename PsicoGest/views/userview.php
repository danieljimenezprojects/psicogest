<!-- En esta página se encuentra las vistas para el CRUD de Usuarios para crear, modificar o eliminar usuarios -->
<?php
session_start();
?>
<?php 

class UserView{
    // Formulario para crear usuario
    public function signUpUser(){

        echo " <html>
         <head>
             <meta charset='utf-8'>
             <meta name='viewport' content='width=device-width, initial-scale=1'>
             <title>PsicoGest - Register</title>
             <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
             <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
             <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
             <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
             <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
             <script src='validationClient/clientpwd.js' ></script>
      
         </head>
         <body>
             <nav class='navbar navbar-light bg-dark py-0 pt-1 justify-content-between'>
                 <a class='navbar-brand text-primary' href='index.html'>PsicoGest</a>
             </nav>
            <br>
             <div class='container-fluid'>
                 <div class='row'>
                     <div class='col'>
                         <h1 class='display-3'> Regístrate en <span class='text-primary'>PsicoGest</span></h1>
                     </div>
                 </div>
             </div>
             <div class='container bg-light pb-3 ml-3 pr-3'>
               <div class='row'>
                 <div class='col'>";?>
                <form action='../controllers/usercontroller.php' method='POST'>
                 <div class='mb-3 pt-2'>
                     <label for='usuario' class='form-label text-primary'>Usuario</label>
                     <input type='text' name='username' class='form-control' id='username' placeholder='Juan' required minlength='5' maxlength='12'>
                   </div>
                   <div class='mb-3'>
                     <label for='email' class='form-label text-primary'>Email</label>
                     <input type='email' name='email' class='form-control' id='email' placeholder='psicogest@gmail.com' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$' title='No es válido' required>
                   </div>
                   <label for='password'  class='form-label text-primary'>Contraseña</label>
                   <div class='mb-3 input-group'>
                   
                    
                  <input type='password' class='form-control' id='pwd' name='pwd' placeholder='********' minlength='8' maxlength='20' pattern='^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' oninput='setCustomValidity("")'  oninvalid='validate()'>
                       <div class='input-group-append'>
                       <input name='action' type='hidden' value='signup'>  
                       <button id='show_password' class='btn btn-primary' type='button' onclick='verPassword()'> <span class='fa fa-eye-slash icon'></span> </button>
                        
                         </div>
                     </div>
                   <div>
                   
                     <button type='submit' name='submit' class='btn btn-primary mb-3'>Regístrate </button>
                   </div>
                 </form>  
              
              <?php
            if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
                echo "<p> Falta algún campo por rellenar </p>";
             } else if ($_GET["error"] == "invaliduid"){
                echo "<p> Error en el nombre de usuario </p>";
                } else if ($_GET["error"] == "invalidemail"){
                 echo "<p> Error en el nombre del email </p>";
            } else if ($_GET["error"] == "usernametaken"){
                echo "<p> El nombre de usuario ya existe </p>";
            } else if ($_GET["error"] == "stmtfailed"){
                echo "<p> Algo fue mal, repita la operación, por favor </p>";
             } 
            }  
            ?>
             
          <?php       
          echo "
               </div> 
               </div>
             </div>
           <div class='container bg-dark pb-3 ml-3 pr-3 mt-3'>
               <div class='row'>
                   <div class='col'>
                     <p class='text-muted pt-2'>Al registrarte aceptas los Términos de Uso y las Condiciones de Servicio de la aplicación. La aplicación está diseñado acorde a Ley de Protección de Datos Española. Ningún dato que ofrezcas será utilizado por la empresa u otras empresas de forma lucrativa. Las cookies que utilizamos tienen el único fin de mejorar la experiencia de usuario.   </p>
                   </div>
               </div>
           </div>   
           
         </body>
         </html>";
                 
         
     
     }

     

 // Formulario para modificar y para eliminar usuario
    public function modifyUser(){
        echo"    <html>
            <head>
                    <meta charset='utf-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1'>
                    <title>PsicoGest - Modificar Usuario</title>
                    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
                    <link rel='stylesheet' href='/styles/index.css'>
                    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
                    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
                    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
                    <script src='validationClient/clientpwd.js'></script>
            </head>
            <body>
                    <nav class='navbar navbar-light bg-dark py-0 pt-1 justify-content-between'>
                        <a class='navbar-brand text-primary' href='pacientes.php'>PsicoGest</a>
                    </nav>
            <br>
             <div class='container-fluid'>
                    <div class='row'>
                        <div class='col'>

                        <h1 class='display-3'> Modificar datos de <span class='text-primary'>Usuario</span></h1>
                        </div>
                    </div>
             </div>
        <div class='container bg-light pb-3 ml-3 pr-3'>
        ";?>
           <form action="../controllers/usercontroller.php" method="POST">
            <div class='mb-3 pt-2'>
                <label for='usuario' class='form-label text-primary'>Usuario</label>
                <input type='text' class='form-control' id='username' name="username" value='<?php echo $_SESSION['username'] ?>'>
              </div>
              <div class='mb-3'>
                <label for='email' class='form-label text-primary'>Email</label>
                <input type='email' class='form-control' id='email' name="email"  value="<?php echo $_SESSION["email"] ?>" pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$' title='No es válido'>
              </div>
             
                <label for='password' class='form-label text-primary'>Pon tu nueva contraseña</label>
              <div class='mb-3 input-group'>
                
                <input type='password' class='form-control' id='pwd' name='pwd' placeholder='********' minlength='8' maxlength='20' pattern='^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$' oninvalid='validate()'>
                  <div class='input-group-append'>
                    <button id='verpwd' class='btn btn-primary' type='button' onclick='verPassword()'> <span class='fa fa-eye-slash icon'></span> </button>
                  </div>
                </div>
              <div>
              
             
              <div>
                <button type='submit' name="submit" class='btn btn-primary mb-3'>Modificar</button>
                <input name='userID' type='hidden' value='<?php echo $_SESSION['userID'] ?>'>
                <input name='action' type='hidden' value='modifyuser'>  
                <button type='submit' name="submit" class='btn btn-danger mb-3'><a class='text-white' href='pacientes.php'>Cancelar </a></button>
              </div>
            </form>  
            <?php
            if(isset($_GET["error0"])){
            if($_GET["error0"] == "emptyinput"){
                echo "<p> Falta algún campo por rellenar </p>";
             } else if ($_GET["error0"] == "invaliduid"){
                echo "<p> Error en el nombre de usuario </p>";
                } else if ($_GET["error0"] == "invalidemail"){
                 echo "<p> Error en el nombre del email </p>";
            } else if ($_GET["error0"] == "usernametaken"){
                echo "<p> El nombre de usuario ya existe </p>";
            } else if ($_GET["error0"] == "stmtfailed"){
                echo "<p> Algo fue mal, repita la operación, por favor </p>";
             } 
            }  
            ?> 
       <?php       
            
        echo "</div>
            <div class='container bg-dark pb-3 ml-3 pr-3 mt-3'>
                        <div class='row'>
                                <div class='col'>
                                    <p class='text-muted pt-2'> Si quiere eliminar el usuario, <a class='btn btn-light' data-toggle='modal' data-target='#eliminarusuario'>
                                        Pínche aquí
                                     </a></p>
                        </div>
                            </div>
        </div>   
            <div class='modal fade' id='eliminarusuario' tabindex='-1' role='dialog' aria-labelledby='eliminarusuario' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                             <h5 class='modal-title' id='eliminarusuario'>Eliminar Usuario</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                        </div>
                        <div class='modal-body'>
                                ¿Está seguro que desea eliminar su usuario?
                        </div>";?>
                    
                            <form action='../controllers/usercontroller.php' method='POST'>
                                <div class='modal-footer'>
                                
                                    <input name='userID' type='hidden' value='<?php echo $_SESSION['userID'] ?>'>
                                    <input name='action' type='hidden' value='deleteuser'>  
                                    <button type='submit' name='submit' class='btn btn-danger'>Si</button>
                                    <button type='button' class='btn btn-primary' data-dismiss='modal'>No</button>
                                </div>
                            </form>
                            <?php echo "
                        </div>
                    </div>
                </div>
            </body>
        </html>";

            }
}

// Aquí hay un switch que depende que pulse el usuario accede a un formulario u a otro.
$userView = new UserView();
if(isset($_POST["action"])){
switch ($_POST["action"]){
    case "new":
        $userView->signUpUser();
    break;
    case "modify":
        $userView->modifyUser();
    break;
    
}
} 

// Esto sirve para que cargue la página aunque de error
if(isset($_GET["error"])){
    $userView->signUpUser();
    
    }
if(isset($_GET["error0"])){
      $userView->modifyUser();
      
      }






?>