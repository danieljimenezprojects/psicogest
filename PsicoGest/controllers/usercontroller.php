
<?php 
// Controlador de los usuarios. Corrige registros y llama al modelo. Obtiene información de formularios.
require_once '../model/usermodel.php';
session_start();
$conexion = new UserModel;
$conn = $conexion->connect();

class UserController extends UserModel {
      // controla los errores para el registro
      public function userErrorHandling($conn){
        
        if (isset($_POST["submit"])){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            
            require_once '../includes/functionsusers.inc.php';
            
              
              if (emptyInputSignup($username,$pwd,$email) !== false) {
                header("location: ../views/userview.php?error=emptyinput");
                exit();
              }
              if (invalidUid($username) !== false) {
                header("location: ../views/userview.php?error=invaliduid");
                exit();
              }
              if (invalidEmail($email) !== false) {
              header("location: ../views/userview.php?error=invalidemail");
              exit();
              }
             
             if ($this->uidExists($conn,$username,$email) !== false)  {
              
              header("location: ../views/userview.php?error=usernametaken");
              exit();
              }
              
              $this->createUser($conn, $username, $pwd, $email);

            } 
            else {
              
              header("location: ../views/pacientes.php");
              exit();
            }
          }
    // modificar usuario
      public function modifyErrorUser($conn){
          if (isset($_POST["submit"])){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $pwd = $_POST["pwd"];
            $userID = $_POST["userID"];
            require_once '../includes/functionsusers.inc.php';
            
              
              if (emptyInputSignup($username,$pwd,$email) !== false) {
                header("location: ../views/userview.php?error0=emptyinput");
                exit();
              }
              if (invalidUid($username) !== false) {
                header("location: ../views/userview.php?error0=invaliduid");
                exit();
              }
              if (invalidEmail($email) !== false) {
              header("location: ../views/userview.php?error0=invalidemail");
              exit();
              }
             
             if ($this->uidExists0($conn,$username,$email) !== false && $_SESSION['username'] !== $username && $_SESSION['email'] !== $email ) {
              header("location: ../views/userview.php?error0=usernametaken");
              exit();
              }
              
              $this->modifyUser($conn, $username, $pwd, $email,$userID);

            } 
            else {
              
              header("location: ../views/pacientes.php");
              exit();
            }
        }
      //eliminar usuario
      public function deleteUser($conn){
          if (isset($_POST["submit"])){
            $userID = $_POST["userID"];
          $this->deleteUserModel($conn,$userID);
          }  else {
              
            header("location: ../views/pacientes.php");
            exit();
          }
        }
   
   
   
      }
  

$userController = new UserController();

if(isset($_POST["action"])){
  switch ($_POST["action"]){
      case "signup":
          $userController->userErrorHandling($conn);
      break;
      case "modifyuser":
          $userController->modifyErrorUser($conn);
      break;
      case "deleteuser":
        $userController->deleteUser($conn);
    break;
      
  }
  } 




?>