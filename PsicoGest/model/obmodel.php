<?php


header('Content-Type: text/html; charset=utf-8');
require_once '../conexion/db.php';

// El modelo para las observaciones. Consultas SQL.

class ObModel extends Db {
    // Modificar Observaciones
    function modifyObModel($conn,$descripcion,$obsID){
        $sql = "UPDATE obs SET descripcion=? WHERE obsID = ?";
        
        
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?errorm=stmtfailed");
        exit();
        }
        

        mysqli_stmt_bind_param($stmt,"ss",$descripcion,$obsID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?errorobs=none");
    }
    // Eliminar Observaciones
    function deleteObModel($conn,$obsID){
        $sql = "DELETE FROM obs WHERE obsID = ?";
        
        
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?errorm=stmtfailed");
        exit();
        }
        

        mysqli_stmt_bind_param($stmt,"s",$obsID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?errorobs=none");
    }
    
    
    
    

    

  
}
?>