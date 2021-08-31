<?php
// enseña el informe en una página aparte.
$dbh = new PDO("mysql:host=localhost;dbname=psicogest","root","");
$id = isset($_GET['session_inf_id'])? $_GET['session_inf_id'] : "";
$stat = $dbh->prepare("select * from informes where session_inf_id=?");
$stat -> bindParam(1, $id);
$stat -> execute();
$row = $stat -> fetch();
header('Content-type:' .$row['mime']);

echo $row['archivos'];