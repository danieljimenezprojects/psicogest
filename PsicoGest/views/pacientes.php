<?php
session_start();
require_once '../model/patientmodel.php';
// este archivo muestra la vista de pacientes una vez iniciado sesión. Si no has iniciado sesión daría error.

?>
<?php 

  class PatientsMainView extends PatientModel {
    // vista de la página de pacientes
     function mainPatientsView(){
      
      echo '  <html>
         <head>
          
          <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
          <title>PsicoGest - Pacientes</title>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <link rel="stylesheet" href="/styles/register.css">
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      </head>
      <body>

        <nav class="navbar navbar-light bg-dark py-0 pt-1 justify-content-between">
            <a class="navbar-brand text-primary" href="pacientes.php">PsicoGest</a>
              <div class="btn-group dropright mx-5 my-3">';?>
                <button class="btn btn-outline-primary my-2 my-sm-0 align-items-left" type="button" data-toggle="dropdown"  aria-expanded="false"> Hola <?php echo $_SESSION["username"] ?></button>
                <?php echo '<div class="dropdown-menu">
                        <form action="filterpatientview.php"><button class="dropdown-item" type="submit">Filtrar Datos</button></form>
                        <form action="../views/userview.php" method="POST">
                        <input name="action" type="hidden" value="modify">
                        <input name="id" type="hidden" value = "">
                        <button class="dropdown-item" type="submit">Modificar Usuario</button>
                        </form>
                        <form action="../controllers/logincontroller.php" method="POST">
                        <input name="action" type="hidden" value="logout">
                        <button class="dropdown-item text-danger" type="submit" name="submit">Cerrar Sesión</button>
                        </form>
                      </div>
               </div>
          </nav>';?>
          <?php
                if (isset($_SESSION["userID"])){
                 
                  ?> <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                  <strong> Bievenido <?php echo $_SESSION['username']?> </strong>, usted ha iniciado sesión correctamente.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> 
               <?php  
                } 
            ?>
            <?php
            echo '<div class="container">
            <div class="row my-4 ">
                <div class=" col-8 col-sm-6">
                    <h4 class="display-3 text-primary"> Lista de pacientes </h4>
                </div>
                <div class="col-0 col-sm-3">
                
                </div>
                <div class="col-4 col-sm-3 bg-light py-3">';?>
                <form action="../controllers/patientcontroller.php" method="POST">    
                <input name="action" type="hidden" value="search"/>
                <input name="userID" type="hidden" value="<?php echo $_SESSION["userID"] ?>">  
                <div class="input-group">
                         
                      <input type="search" name="name" id="name" class="form-control" placeholder="" />
                        <button type="submit" name="submit" class="btn btn-outline-primary">Buscar</button>
                        
                    </div>
                  </form>
                </div>
              </div>
              
            <div class="row">
                <div class="col">
                    <form action="patientviews.php" method="POST">
                    <input name="action" type="hidden" value="new"/>
                <input name="userID" type="hidden" value="<?php echo $_SESSION["userID"] ?>">
                    <button type="submit" name="submit" class="bg-primary btn btn-outline-primary text-white"> Nuevo Paciente </button>
                    </form>
                </div>
            </div> 
        </div>
        <?php 
        $conexion = new PatientModel();
        $conn = $conexion->connect();
        $userID = $_SESSION["userID"];
        $patientsData = $this -> mainPatientModelView($conn,$userID);
                while($row = mysqli_fetch_array($patientsData)){
        
        
       echo ' <div class="container my-5 px-5">
          <div class="row border-bottom border-dark">
          <div class="col-12 col-sm-8">
          
          
            <h2 class="display-5 ">'. $row['name']." ".$row['surname'].' </h2>
          
           
          
          </div>
         
          <div class="col-sm-1 col-6 mx-2">
          <a class="btn btn-light " data-toggle="collapse" href="#datosPaciente'.$row['patientID'].'" role="button" aria-expanded="false" aria-controls="datosPaciente">
              ver datos
            </a>
          </div>';?>
          <form action="sesiones.php" method="POST">
          <input name="patientID" type="hidden" value="<?php echo $row['patientID'] ?>">
          <div class="col-sm-1 col-6">
            <button class="btn btn-primary" name="submit" type="submit" >
                ver sesiones
              </button>
          </div>
          </form>
         <?php echo' 
        </div>
        <div class="container-fluid collapse" id="datosPaciente'.$row['patientID'].'">
          <div class="row mt-3">
              
              <div class="col-5 col-sm-3">
                  <h3 class="text-primary">Datos personales: </h3>
              </div>
              <div class="col-4 col-sm-2 text-right">';?>
                  <form action="../controllers/patientcontroller.php" method="POST">
                  <input name="action" type="hidden" value="modify"/>
                  <input name="patientID" type="hidden" value="<?php echo $row['patientID'] ?>"/>
                  <button type="submit" name="submit" class="btn btn-light mb-1 btn-sm" >
                      modificar
                    </button>
                  </form>
              </div>
              <div class="col-3 col-sm-5">
                  <form action="patientviews.php" method="POST">
                  <input name="action" type="hidden" value="delete"/>
                  <input name="name" type="hidden" value="<?php echo $row['name'] ?>"/>
                  <input name="patientID" type="hidden" value="<?php echo $row['patientID'] ?>"/>
                    <button type="submit" name="submit" class="btn btn-danger mb-1 btn-sm">
                      eliminar
                    </form>
               <?php echo'   
              </div>
            </div> 
          <div class="container mx-2 border border-primary py-2">
          <div class="row">
            <div class="col-1"></div>
                <div class="col-12 col-sm-4">
                        <p ><span class="text-primary"> Nombre: </span>'.$row['name'].' </p>
                </div>
                <div class="col-12 col-sm-4">
                        <p><span class="text-primary">Apellidos: </span>'.$row['surname'].' </p>
                </div>
                <div class="col-12 col-sm-3">
                  <p><span class="text-primary">Teléfono: </span> '.$row['tfn'].' </p>
            </div>
               </div>
            <div class="row">
            <div class="col-1"></div>
            <div class="col-12 col-sm-4">
                    <p><span class="text-primary">Diagnóstico: </span> '.$row['diag'].' </p>
            </div>
            <div class="col-12 col-sm-4">
                    <p><span class="text-primary">Email: </span> '.$row['email'].'</p>
            </div>';?>
            <?php
            $estado;
            if ($row['estado']== 0){
               $estado = "En tratamiento";
            } else {
             $estado = "Fuera de tratamiento";
            }
            
            ?> 
            
            
            <?php echo'
            <div class="col-12 col-sm-3">
              <p><span class="text-primary">Estado: </span> '.$estado.' </p>
            </div>
            </div>
          </div>         
                  
                </div>
              </div>'
              ;}
              ?>
          <?php
          echo '
              
                
              
                
                 
                                     
        
          </body>
        </html>';
    }
  }

  $pacientsView = new PatientsMainView();
  $pacientsView -> mainPatientsView();
              ?>