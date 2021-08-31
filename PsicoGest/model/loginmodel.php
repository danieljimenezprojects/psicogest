<?php

require_once '../conexion/db.php';
require_once 'usermodel.php';
// El modelo para el inicio de sesión



class LoginModel extends Db {
    
    // Inicio de Sesión. 
    function loginUser($conn,$username,$pwd) {
        $usermodel = new UserModel();

        $uidExists =  $usermodel->uidExists($conn,$username,$email);

        if ($uidExists === false){
            header("location: ../views/login.php?error=wronglogin");
            exit();
        }

        $pwdHashed = $uidExists["pwd"];
        $checkPwd = password_verify($pwd,$pwdHashed);

        if ($checkPwd === false) {
            header("location: ../views/login.php?error=wrongpassword");
        }
        else if ($checkPwd ===true){
            session_start();
            $_SESSION["userID"] = $uidExists["userID"];
            $_SESSION["username"] = $uidExists["username"];
            $_SESSION["pwd"] = $uidExists["pwd"];
            $_SESSION["email"] = $uidExists["email"];
            

            header("location: ../views/pacientes.php");
            exit();

        }
    
    }
}