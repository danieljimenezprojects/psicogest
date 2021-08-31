<?php
require_once '../model/infmodel.php';
require_once '../model/sessionmodel.php';
//Controlador Informe. Corrige errores y llama al modelo.
header('Content-Type: text/html; charset=utf-8');
$conexion = new SessionModel;
$conn = $conexion->connect();


    $patientID = $_POST['patientID'];
    $sessionID = $_POST['sessionID'];
    $sessioninfID= $_POST['sessioninfID'];
    
   


    


class InfController extends InfModel {
    
    // Crea informe
    function createInfController($conn){
        
        $sessioninfID = $_POST['sessioninfID'];
        $tituloinf = $_POST['tituloinf'];
        $descripcioninf = $_POST['descripcioninf'];
        $nombreinforme = $_FILES['archivo']['name'];
        $mime = $_FILES['archivo']['type'];
        $data = file_get_contents($_FILES['archivo']['tmp_name']);
        $this -> createInfModel($conn, $tituloinf,$descripcioninf,$data,$nombreinforme,$mime,$sessioninfID);
       
    }
    // Modificar Informe
    function modifyInfController($conn){
        if (isset($_POST["submit"])){
          $titulo = $_POST["tituloinf"];
          $descripcion = $_POST["descripcioninfm"];
          $infID = $_POST["obsID"];
          
         
            
            $this->modifyInfModel($conn,$titulo,$descripcion,$infID);

          } 
          else {
            
            header("location: ../views/pacientes.php?jejeinf");
            exit();
          }
    }  
      // Eliminar Informe
    function deleteInfController($conn){
        if (isset($_POST["submit"])){
          
          $infID = $_POST["infID"];
          
         
            
            $this->deleteInfModel($conn,$infID);

          } 
          else {
            
            header("location: ../views/pacientes.php?jejeinf");
            exit();
          }
    } 
    
}

$infCont = new InfController();

if(isset($_POST["action"])){
    switch($_POST["action"]){
        case "createinf":
                $infCont->createInfController($conn);
                break;
        case "modifyinf":
                $infCont->modifyInfController($conn);
                break;
        case "deleteinf":
                $infCont->deleteInfController($conn);
                break;
        
    }
    
}

?>