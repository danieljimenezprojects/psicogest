<!-- En este archivo se muestran las vistas para filtrar por nombre, filtrar por orden y cantidad, crear paciente, modificar paciente 
y eliminar paciente -->
<?php 
require_once '../model/patientmodel.php';
session_start();
// Las funciones que ponen $resultData en las dos primeras es porque necesita información del usuario y el paciente para 
// enseñarlos. El de "modify" lo tiene porque se da los datos al usuario del paciente en una página diferente.
    class PatientView extends PatientModel {
        // buscar por nombre
        function searchPatientsView($resultData){
               echo'
            <html>
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
               <a class="navbar-brand text-primary" href="../views/pacientes.php">PsicoGest</a>
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
                       <form action="../views/patientviews.php" method="POST">
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
           $resultData;
                   while($row = mysqli_fetch_array($resultData)){
           
           
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
             <form action="../views/sesiones.php" method="POST">
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
               </div>'; ?>
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
        // buscar por filtro
        function filterPatientsView($resultData){
          echo'
          <html>
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
             <a class="navbar-brand text-primary" href="../views/pacientes.php">PsicoGest</a>
               <div class="btn-group dropright mx-5 my-3">';?>
                 <button class="btn btn-outline-primary my-2 my-sm-0 align-items-left" type="button" data-toggle="dropdown"  aria-expanded="false"> Hola <?php echo $_SESSION["username"] ?></button>
                 <?php echo '<div class="dropdown-menu">
                         <form action="../views/filterpatientview.php"><button class="dropdown-item" type="submit">Filtrar Datos</button></form>
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
                 <form action="patientcontroller.php" method="POST">    
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
                     <form action="../views/patientviews.php" method="POST">
                     <input name="action" type="hidden" value="new"/>
                 <input name="userID" type="hidden" value="<?php echo $_SESSION["userID"] ?>">
                     <button type="submit" name="submit" class="bg-primary btn btn-outline-primary text-white"> Nuevo Paciente </button>
                     </form>
                 </div>
             </div> 
         </div>
         <?php 
         
         $userID = $_SESSION["userID"];
         $resultData;
                 while($row = mysqli_fetch_array($resultData)){
         
         
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
           <form action="../views/sesiones.php" method="POST">
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
        // crear paciente
        function createPatientView(){
            echo '<html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>PsicoGest - Añadir Paciente</title>
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
                            <h1 class="display-3"> Añade nuevo <span class="text-primary">Paciente</span></h1>
                        </div>
                    </div>
                </div>
                <div class="container bg-light pb-3 ml-3 pr-3">';?>
                   <form action="../controllers/patientcontroller.php" method="POST">
                    <div class="mb-3 pt-2">
                        <label for="nombre" class="form-label text-primary">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="name" placeholder="Ibai" required>
                      </div>
                      <div class="mb-3">
                        <label for="apellidos" class="form-label text-primary">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="surname" placeholder="Llanos" required>
                      </div>
                      <div class="mb-3">
                        <label for="telefono" class="form-label text-primary">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="tfn" placeholder="907345672">
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label text-primary">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="llanos@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                      </div>
                      <div class="mb-3">
                        <label for="diagnostico" class="form-label text-primary">Diagnóstico</label>
                        <input type="text" class="form-control" id="diagnostico" name="diag" placeholder="Ansiedad">
                      </div>
                      <div class="mb-3">
                        <label for="estado" class="form-label text-primary">Estado</label>
                        <select class="form-control" id="estado" name="trat" required>
                          <option id="0"  value="0">En Tratamiento</option>
                          <option id="1"  value="1">Fuera de Tratamiento</option>
                          
                        </select>
                      </div>
                      <input name="userID" type="hidden" value="<?php echo $_SESSION["userID"] ?>">
                      <input name="action" type="hidden" value="create"/>
                      <button type="submit" name="submit" class="btn btn-primary mb-3 text-white">Añadir</button>
                      
                    </form>  
                    <?php echo '
                </div>
              <div class="container bg-dark pb-1 ml-3 pr-3 mt-3">
                  <div class="row">
                      <div class="col">
                        <span class="text-white">¿Queda algún dato por añadir?</span>
                        <p class="text-white">No te preocupes, más adelante en el apartado "Ver Sesiones" podrás añadir todos los datos que necesites.</p>
                      </div>
                  </div>
              </div>   
              
            </body>
            </html>';
        }
        // modificar paciente 
        function modifyPatientView($resultData){
         echo ' <html>
          <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <title>PsicoGest - Modificar Paciente</title>
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
                          <h1 class="display-3"> Modifica a tu <span class="text-primary"> Paciente </span></h1>
                      </div>
                  </div>
              </div>
              <div class="container bg-light pb-3 ml-3 pr-3">';?>
              <?php 
              $resultData;
              $row = $row = mysqli_fetch_array($resultData);
              ?>
                 <form action="../controllers/patientcontroller.php" method="POST">
                  <div class="mb-3 pt-2">
                      <label for="nombre" class="form-label text-primary">Nombre</label>
                      <input type="text" class="form-control" name="name" id="nombre" value="<?php echo $row['name']?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="apellidos" class="form-label text-primary">Apellidos</label>
                      <input type="text" class="form-control" name="surname" id="apellidos" value="<?php echo $row['surname']?>" required>
                    </div>
                    <div class="mb-3">
                      <label for="telefono" class="form-label text-primary">Teléfono</label>
                      <input type="text" class="form-control" name="tfn" id="telefono" value="<?php echo $row['tfn']?>">
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label text-primary">Email</label>
                      <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                    <div class="mb-3">
                      <label for="diagnostico" class="form-label text-primary">Diagnóstico</label>
                      <input type="text" class="form-control" name="diag" id="diagnostico" value="<?php echo $row['diag']?>">
                    </div>
                    <div class="mb-3">
                      <label for="estado" class="form-label text-primary">Estado</label>
                      <select class="form-control" id="estado" name="trat" required>
                        <option id="activo" value="0">En Tratamiento</option>
                        <option id="pasivo" value="1">Fuera de Tratamiento</option>
                        
                      </select>
                    </div>
                    <input name="patientID" type="hidden" value="<?php echo $row["patientID"] ?>">
                      <input name="action" type="hidden" value="modify1"/>
                    <button type="submit" name="submit" class="btn btn-primary mb-3">Modificar</button>
                    
                  </form>  
              </div><?php echo'
            <div class="container bg-dark pb-1 ml-3 pr-3 mt-3">
                <div class="row">
                    <div class="col">
                      <span class="text-white">¿Te has confundido en algún dato?</span>
                      <p class="text-white">No te preocupes, Dale a Psicogest en el navegador y volverás atrás sin ningún problema.</p>
                    </div>
                </div>
            </div>   
            
          </body>
            </html>';
        }
        // eliminar paciente
        function deletePatientView(){
            echo '<html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>PsicoGest - Eliminar Paciente</title>
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
                            <h1 class="display-3"> Eliminar <span class="text-primary"> Paciente </span></h1>
                        </div>
                    </div>
                </div>
                <div class="container pb-3 ml-3 pr-3">
                   <div class="row">
                    <div class="col-3">
        
                    </div>   
                    <div class="col-6">';?>
                    <?php
                        $name = $_POST["name"];
                        $patientID = $_POST["patientID"];
                        
                    ?>

                    <form action="../controllers/patientcontroller.php" method="POST">
                    <div class="mb-3 pt-2 bg-light">
                        <h2>¿Quiéres eliminar a <?php echo $name ?>?</h2>
                        
                        <input name="action" type="hidden" value="delete"/>
                      <input name="patientID" type="hidden" value="<?php echo $patientID; ?>"/>
                      <div class="text-right mr-3">
                      <button type="submit" name="submit" class="btn btn-primary mb-3 ">Aceptar</button>

                      <button type="button"  class="btn btn-danger mb-3 "><a href="pacientes.php" class="text-white">Cancelar</a></button>
                    </div>
                </div>
                    </form>  
                    <?php echo'
                    </div>
                    <div class="col-3">
        
                    </div>
                </div>
                </div>
              <div class="container bg-dark pb-1 ml-3 pr-3 mt-3">
                  <div class="row">
                      <div class="col">
                        <span class="text-white"></span>
                        <p class="text-white">Una vez elimines al usuario, no podrás recuperarlo. Borra a tu paciente solo si estas completamente seguro.</p>
                      </div>
                  </div>
              </div>   
              
            </body>
            </html>';
        }
    }
    
    
$patientView = new PatientView();
if(isset($_POST["action"])){
switch ($_POST["action"]){
    case "new":
        $patientView->createPatientView();
    break;
    case "delete":
      $patientView->deletePatientView();
  break;
    
    
}
} 
   
?>