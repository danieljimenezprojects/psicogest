<?php
require_once '../model/sessionmodel.php';
require_once '../views/sessionview.php';
// Controlador de las sesiones. Corrige errores y llama al modelo. Obtiene información de formularios.
header('Content-Type: text/html; charset=utf-8');
$conexion = new SessionModel;
$conn = $conexion->connect();
$sessionView = new SessionView();

    $patientID = $_POST['patientID'];
    $sessionID = $_POST['sessionID'];
    $sessioncodID = $_POST['sessioncodID'];
    
    


class SessionController extends SessionModel {
    // crear sesiones
    function createSessionController($conn){

        $patientID = $_POST['patientID'];
        $this -> createSessionModel($conn, $patientID);
       
    }
    // elimina sesiones
    function deleteSessionController($conn){

        $sessionID = $_POST['sessionID'];
        $this -> deleteSessionModel($conn, $sessionID);
       
    } 
    // crea observaciones
    function createObsController($conn){
        $descripcion = $_POST['descripcion'];
        $sessioncodID = $_POST['sessioncodID'];
        $this -> createObsModel($conn, $sessioncodID,$descripcion);
       
    }
           
    
}

$sessionCont = new SessionController();

if(isset($_POST["action"])){
    switch($_POST["action"]){
        
        case "create":
            $sessionCont->createSessionController($conn);
            
            break;
        case "delete":
                $sessionCont->deleteSessionController($conn);
                
                break;
        case "createobs":
                $sessionCont->createObsController($conn);
                
                break;
       
        
    }
    
}

?>