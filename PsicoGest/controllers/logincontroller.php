<?php
require_once '../model/loginmodel.php';
// El controlador de el inicio de sesión. Corrige errores y llama al modelo.
$conexion = new LoginModel;
$conn = $conexion->connect();

class LoginController extends LoginModel {
        // Corrige los errores del login
        function loginErrors($conn){
             if(isset($_POST["submit"])){

            $username = $_POST["username"];
            $pwd = $_POST["pwd"];
    
                require_once '../model/loginmodel.php';
                require_once '../includes/functionsusers.inc.php';
    
            if (emptyInputLogin($username,$pwd) !== false) {
                header("location: ../views/login.php?error=emptyinput");
                exit();
            }
    
            $this->loginUser($conn,$username, $pwd);
            } else {
            header("location: ../login.php");
            exit();
            }
        }
        // Para cerrar sesión
        function logOut(){
            session_start();
            session_unset();
            session_destroy();
            header("location:../index.html");
            exit();
        }
}
$loginController = new LoginController();
if(isset($_POST["action"])){
    switch($_POST["action"]){
        case "login":
        $loginController->loginErrors($conn);
        break;
        case "logout":
        $loginController->logOut();
    }
    
}

