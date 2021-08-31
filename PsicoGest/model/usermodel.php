<?php

require_once '../conexion/db.php';
// Este es el modelo de los usuarios. Consultas SQL


class UserModel extends Db {
    // Comprueba si existe el email o el username del usuario
    function uidExists($conn,$username,$email) {
        $sql = "SELECT * FROM users WHERE username=? OR email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/userview.php?error=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"ss",$username,$email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        

        if ($row = mysqli_fetch_array($resultData)){
            
            return $row;

        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);

    }
    // Comprueba si existe el email o el username del usuario pero para el caso de querer modificar usuario
    function uidExists0($conn,$username,$email) {
        $sql = "SELECT * FROM users WHERE username=? OR email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/userview.php?error0=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"ss",$username,$email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        

        if ($row = mysqli_fetch_array($resultData)){
            
            return $row;

        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);

    }
    // Crear Usuario 
    function createUser($conn,$username,$pwd,$email) {
        $sql = "INSERT INTO users(username,pwd,email) VALUES (?,?,?);";
        
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/userview.php?error=stmtfailed");
        exit();
        }
        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt,"sss",$username,$hashedPwd,$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/login.php?error=none");

    }
    // Modificar Usuario
    function modifyUser($conn,$username,$pwd,$email,$userID) {
        $sql = "UPDATE users SET username=?, pwd=?,email=? WHERE userID = $userID";
        
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/userview.php?error0=stmtfailed");
        exit();
        }
        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt,"sss",$username,$hashedPwd,$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?error=none");

    }
    // Eliminar Usuario
    function deleteUserModel($conn,$userID) {
        $sql = "DELETE FROM users WHERE userID = ?";
        
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/userview.php?error0=stmtfailed");
        exit();
        }
        

        mysqli_stmt_bind_param($stmt,"s",$userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../index.html");

    }
}





