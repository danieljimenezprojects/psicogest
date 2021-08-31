<?php

// Este es el modelo de las pacientes con consultas SQL.
header('Content-Type: text/html; charset=utf-8');
require_once '../conexion/db.php';



class PatientModel extends Db {
    
    // Para mostrar los pacientes existentes (SELECT)
    function mainPatientModelView($conn,$userID) {

        $sql = "SELECT * FROM patients WHERE user_cod_id=?";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/userview.php?error=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"s",$userID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        return $resultData;

        mysqli_stmt_close($stmt);
    }
     // Para mostrar los pacientes buscados (SELECT)
    function searchPatientModelView($conn,$name,$userID) {

        $sql = "SELECT * FROM patients WHERE name=? AND user_cod_id=? ";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?error=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"ss",$name,$userID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        return $resultData;
        
        mysqli_stmt_close($stmt);
       
            
    }
     // Para filtrar los pacientes  (SELECT)
    function filterPatientModelView($conn,$order,$cantidad,$userID){
        
        if($cantidad === "todos" && $order === "ASC"){
            $sql = "SELECT * FROM patients WHERE user_cod_id=? ORDER BY patientID ASC;";
        } else if ($cantidad ==="todos" && $order ==="DSC"){
            $sql = "SELECT * FROM patients WHERE user_cod_id=? ORDER BY patientID DESC;";
        } else if ($cantidad ==="cinco" && $order ==="ASC"){
            $sql = "SELECT * FROM patients WHERE user_cod_id=? ORDER BY patientID ASC LIMIT 5;";
        } else if($cantidad ==="cinco" && $order ==="DSC"){
            $sql = "SELECT * FROM patients WHERE user_cod_id=? ORDER BY patientID DESC LIMIT 5; ";
        }
        
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?error=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"s",$userID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        return $resultData;
        
        mysqli_stmt_close($stmt);
    }
    // Para crear pacientes
    function createPatient($conn, $name, $surname, $tfn,$diag,$email,$estado,$user_code_id){
        $sql = "INSERT INTO patients(name,surname,tfn,diag,email,estado,user_cod_id) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        

        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/pacientes.php?error=stmtfailed");
        exit();
        }
       

        mysqli_stmt_bind_param($stmt,"sssssss",$name, $surname, $tfn,$diag,$email,$estado,$user_code_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?error02=none");
    }
    // Para obtener el ID de un paciente
    function getPatient($conn,$patientID){
        $sql = "SELECT * FROM patients WHERE patientID=?";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?error=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"s",$patientID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        return $resultData;
        
        mysqli_stmt_close($stmt);
    }
    // Para modificar un paciente
    function modifyPatientModel($conn,$patientID,$name,$surname,$tfn,$diag,$email,$estado){
        $sql = "UPDATE patients SET name=?, surname=?,tfn=?,diag=?,email=?,estado=? WHERE patientID = $patientID";
        
        
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?errorm=stmtfailed");
        exit();
        }
        

        mysqli_stmt_bind_param($stmt,"ssssss",$name,$surname,$tfn,$diag,$email,$estado);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?errorm=none");
    }
    // Para eliminar un paciente
    function deletePatientModel($conn,$patientID){
       
        $sql = "DELETE FROM patients WHERE patientID = ?";
        
        
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?errorm=stmtfailed");
        exit();
        }
        

        mysqli_stmt_bind_param($stmt,"s",$patientID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?errord=none");

        
    }
}
?>