<?php

// Este es el modelo de las sesiones y también aprecen algunas funciones para informes y observaciones. Consultas sql.
header('Content-Type: text/html; charset=utf-8');
require_once '../conexion/db.php';



class SessionModel extends Db {
    
    // presenta las sesiones que estan hechas
    function mainSessionModel($conn,$patientID) {

        $sql = "SELECT * FROM session WHERE patient_cod_id=?";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/sesiones.php?errosr=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"s",$patientID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        return $resultData;

        mysqli_stmt_close($stmt);
    }
    // crear sesión
    function createSessionModel($conn, $patientID){
        $sql = "INSERT INTO session(fecha_session,patient_cod_id) VALUES (CURDATE(),?)";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/pacientes.php?error=stmtfailed");
        exit();
        }
       

        mysqli_stmt_bind_param($stmt,"s",$patientID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?error=norerror");
        exit();
    }
    // eliminar sesión
    function deleteSessionModel($conn, $sessionID){

        $sql = "DELETE FROM session WHERE session_ID = ?";
        
        
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?errors=stmtfailed");
        exit();
        }
        

        mysqli_stmt_bind_param($stmt,"s",$sessionID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?errors=none");
    }
    // Para mostrar las observaciones existentes (SELECT)
    function mainObsModel($conn,$sessionID) {

        $sql = "SELECT * FROM obs WHERE session_cod_id=?";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/sesiones.php?error=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"s",$sessionID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        return $resultData;

        mysqli_stmt_close($stmt);
    }
    // crea una observación
    function createObsModel($conn, $sessioncodID,$descripcion) {

        $sql = "INSERT INTO obs(descripcion,session_cod_id) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/sesiones.php?errorpene=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"ss",$descripcion,$sessioncodID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        

        mysqli_stmt_close($stmt);
        header("location: ../views/pacientes.php?error=norerror");
        exit();
    }
     // Para mostrar los informes existentes (SELECT)
    function mainInfModel($conn,$sessionID) {

        $sql = "SELECT * FROM informes WHERE session_inf_id=?";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/sesiones.php?error=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"s",$sessionID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        return $resultData;

        mysqli_stmt_close($stmt);
    }
}
?>