<?php 
// Aquí se encuentras las vistas del los informes. Modificar y eliminar informes. La de crear esta en las vistas de sesiones.
session_start();
require_once '../model/sessionmodel.php';

    class InfView extends SessionModel {
        // esta función es para modificar
        function modifyInfView(){
            
            $titulo = $_POST["tituloinf"];
            $descripcion = $_POST["descripcioninf"];
            $infID = $_POST["infID"];
           
            echo'
            <html>
            <head>
             <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>PsicoGest - Modificar Observación</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="/styles/index.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <script src="validation/verpassword.js"></script>
            </head>
            <body>
            <nav class="navbar navbar-light bg-dark py-0 pt-1 justify-content-between">
            <a class="navbar-brand text-primary" href="pacientes.php">PsicoGest</a>
            </nav>
            <br>
             <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="display-3"> Modificar datos de el <span class="text-primary">Informe</span></h1>
                </div>
            </div>
             </div>
             <div class="container bg-light pb-3 ml-3 pr-3">
           <form method="POST" action="../controllers/infcontroller.php">
            <div class="row">
                <div class="col">
            <label class="mx-2">Título</label>
                </div>
            </div>
                <div class="row" >
            <input class="form-control ml-3" type="text" name="tituloinf" id="titulo" value="'.$titulo.'" >
                </div>
            
            <label>Descripción</label>
            <textarea class="form-control mb-1" id="descripcion" rows="3" maxlength="255" name="descripcioninfm">'.$descripcion.'</textarea>
            <input name="obsID" type="hidden" value="'.$infID.'">
            <input name="action" type="hidden" value="modifyinf">
              <div>
                <button class=" btn btn-primary mb-3 text-white" type="submit" name="submit" >Modificar </button>
                <button type="submit" class="btn btn-danger mb-3"><a class="text-white" href="pacientes.php">Cancelar </a></button>
              </div>
            </form>   
              
            
            </div>
      
             </body>
            </html>';
        }
        // esta función es para eliminar
        function deleteInfView(){
        
            $infID = $_POST["infID"];    
            
            echo '
                <html>
                 <head>
                 <meta charset="utf-8">
                 <meta name="viewport" content="width=device-width, initial-scale=1">
                 <title>PsicoGest - Eliminar Informe</title>
                 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                 <link rel="stylesheet" href="/styles/index.css">
                 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                 </head>
                <body>
                <nav class="navbar navbar-light bg-dark py-0 pt-1 justify-content-between">
                    <a class="navbar-brand text-primary" href="pacientes.php">PsicoGest</a>
                </nav>
                <br>
                <div class="container-fluid">
                <div class="row">
                <div class="col">
                    <h1 class="display-3"> Eliminar <span class="text-primary"> Informe </span></h1>
                </div>
                </div>
                </div>
                <div class="container pb-3 ml-3 pr-3">
                <div class="row">
                <div class="col-3">

                </div>   
                <div class="col-6">
                <form method="POST" action="../controllers/infcontroller.php">
                <div class="mb-3 pt-2 bg-light">
                <h2>¿Quiéres eliminar el informe?</h2>
                
              
                <div class="text-right mr-3">
                <input name="infID" type="hidden" value="'.$infID.'">
                <input name="action" type="hidden" value="deleteinf"/>
                <button type="submit" name="submit" class="btn btn-primary mb-3 ">Aceptar</button>
                <button type="button" class="btn btn-danger mb-3 "><a href="sesiones.php" class="text-white">Cancelar</a></button>
                </div>
                 </div>
                </form>  
                </div>
                 <div class="col-3">

                </div>
                </div>
                </div>
                <div class="container bg-dark pb-1 ml-3 pr-3 mt-3">
                 <div class="row">
                    <div class="col">
                     <span class="text-white"></span>
                        <p class="text-white">Una vez elimines el informe, no podrás recuperarlo. Bórralo solo si estás completamente seguro.</p>
                    </div>
                 </div>
                </div>   
      
                    </body>
                </html>';
        }
    }
    $infView = new InfView();
if(isset($_POST["action"])){
switch ($_POST["action"]){
    case "modifyinf":
        $infView->modifyInfView();
    break;
    case "deleteinf":
      $infView->deleteInfView();
  break;
    }
}