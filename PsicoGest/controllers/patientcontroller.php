<?php
require_once '../model/patientmodel.php';
require_once '../views/patientviews.php';
// Controlador de Paciente. Corrige errores y llama al modelo y a las vistas. Obtiene información de formularios
header('Content-Type: text/html; charset=utf-8');
$conexion = new PatientModel;
$conn = $conexion->connect();
$patientView = new PatientView();


class PatientController extends PatientModel {
    // para buscar pacientes
    function searchPatient($conn){
        if(isset($_POST["submit"])){

            $name = $_POST["name"];
            $userID = $_POST["userID"];
            
    
                require_once '../model/patientmodel.php';
        
    
            $resultData = $this->searchPatientModelView($conn,$name,$userID);
            return $resultData;
            
            
        } else {
            header("location: ../views/pacientes.php");
            exit();
        }
    }
    // para filtrar pacientes
    function filterPatient($conn){
        if(isset($_POST["submit"])){

            $order = $_POST["order"];
            $cantidad = $_POST["cantidad"];
            $userID = $_POST["userID"];
            
            if ($order === null || ($cantidad) === null) {
                header("location: ../views/pacientes.php");
                exit();
              }
    
                require_once '../model/patientmodel.php';
        
    
            $resultData = $this->filterPatientModelView($conn,$order,$cantidad,$userID);
            return $resultData;
            
            
        } else {
            header("location: ../views/pacientes.php");
            exit();
        }
    }
    // para crear pacientes
    public function createPatientController($conn){
        
        if (isset($_POST["submit"])){
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $tfn = $_POST["tfn"];
            $diag = $_POST["diag"];
            $email = $_POST["email"];
            $estado = $_POST["trat"];
            $user_code_id = $_POST["userID"];
            
              
              $this->createPatient($conn, $name,$surname,$tfn,$diag,$email,$estado,$user_code_id);

            } 
            else {
              
              header("location: ../views/pacientes.php?error01");
              exit();
            }
            }
    
            public function getModifyPatient($conn){
        if (isset($_POST["submit"])){
            $patientID = $_POST["patientID"];
            
            
              
              return $result = $this->getPatient($conn, $patientID);

            } 
            else {
              
              header("location: ../views/pacientes.php?error01");
              exit();
            }
            
            }
  // para modificar pacientes
    public function modifyPatientController($conn){
                if (isset($_POST["submit"])){
                  $name = $_POST["name"];
                  $surname = $_POST["surname"];
                  $tfn = $_POST["tfn"];
                  $email = $_POST["email"];
                  $diag = $_POST["diag"];
                  $estado = $_POST["trat"];
                  $patientID = $_POST["patientID"];
                 
                    
                    $this->modifyPatientModel($conn,$patientID,$name,$surname,$tfn,$diag,$email,$estado);
      
                  } 
                  else {
                    
                    header("location: ../views/pacientes.php?jeje");
                    exit();
                  }
              }
  //para eliminar pacientes
    public function deletePatientController($conn){
                if (isset($_POST["submit"])){
                  $patientID = $_POST["patientID"];
                  
                 
                    
                    $this->deletePatientModel($conn,$patientID);
      
                  } 
                  else {
                    
                    header("location: ../views/pacientes.php?jiji");
                    exit();
                  }
              }
    
}

$patientCont = new PatientController();

if(isset($_POST["action"])){
    switch($_POST["action"]){
        case "search":
        $patientView->searchPatientsView($patientCont->searchPatient($conn));
        break;
        case "filter":
            $patientView->filterPatientsView($patientCont->filterPatient($conn));
            break;
        case "create":
            $patientCont->createPatientController($conn);
            break;
        case "modify":
            $resultModifyID = $patientCont->getModifyPatient($conn);
            $patientView->modifyPatientView($resultModifyID);
                break;
        case "modify1":
            $patientCont->modifyPatientController($conn);
            break;
        case "delete":
                $patientCont->deletePatientController($conn);
                break;
        
    }
    
}

?>