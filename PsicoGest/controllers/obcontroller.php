<?php
require_once '../model/obmodel.php';

// Controlador de las observaciones. Corrige errores y llama al modelo. 
header('Content-Type: text/html; charset=utf-8');
$conexion = new ObModel;
$conn = $conexion->connect();



class ObController extends ObModel {
    
            //Modificar observaciones
            public function modifyObController($conn){
                if (isset($_POST["submit"])){
                  $descripcion = $_POST["descripcion"];
                  $obsID = $_POST["obsID"];
                  
                 
                    
                    $this->modifyObModel($conn,$descripcion,$obsID);
      
                  } 
                  else {
                    
                    header("location: ../views/pacientes.php?jeje");
                    exit();
                  }
            }
            //Eliminar observaciones
            public function deleteObController($conn){
                if (isset($_POST["submit"])){
                    $obsID = $_POST["obsID"];
                  
                 
                    
                    $this->deleteObModel($conn,$obsID);
      
                  } 
                  else {
                    
                    header("location: ../views/pacientes.php?jiji");
                    exit();
                  }
            }
    
}

$obCont = new ObController();

if(isset($_POST["action"])){
    switch($_POST["action"]){
        case "modifyob":
        $obCont-> modifyObController($conn);
        break;
        case "deleteob":
            $obCont->deleteObController($conn);
            break;
        
        
    }
    
}

?>