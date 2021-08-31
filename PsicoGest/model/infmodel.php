<?php


header('Content-Type: text/html; charset=utf-8');
require_once '../conexion/db.php';
// Modelo de Informes. Consultas SQL.


class InfModel extends Db {
    // Crear informe
    function createInfModel($conn, $tituloinf,$descripcioninf,$data,$nombreinforme,$mime,$sessioninfID){
        $sql = "INSERT INTO informes(titulo,descripcion,archivos,nombreinforme,mime,session_inf_id) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/sesiones.php?errorpena=stmtfailed");
        exit();
        }
        mysqli_stmt_bind_param($stmt,"ssssss",$tituloinf,$descripcioninf,$data,$nombreinforme,$mime,$sessioninfID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        

        mysqli_stmt_close($stmt);
        header("location: ../views/pacientes.php?error=norerror");
        exit();
    }
    // Modificar Informe
    function modifyInfModel($conn,$titulo,$descripcion,$infID){
        $sql = "UPDATE informes SET titulo=?,descripcion=? WHERE informeID = ?";
        
        
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?errorm=stmtfailed");
        exit();
        }
        

        mysqli_stmt_bind_param($stmt,"sss",$titulo,$descripcion,$infID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?errorinf=none");
        exit();
    }
    // Eliminar Informe
    function deleteInfModel($conn,$infID){
        $sql = "DELETE FROM informes WHERE informeID = ?";
        
        
        $stmt = mysqli_stmt_init($conn);
        $acentos = $conn->query("SET NAMES 'utf8'");
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../views/patient.php?errorinf=stmtfailed");
        exit();
        }
        

        mysqli_stmt_bind_param($stmt,"s",$infID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        header("location: ../views/pacientes.php?errorinf=none");
        exit();
    }
    
    
    
    

    

  
}
?>