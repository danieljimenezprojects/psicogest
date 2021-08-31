<?php
// Esta clase solo se encarga de conectar con la base de datos.
class Db {
    private $servername;
    private $username;
    private $password;
    private $dbname;

     function connect(){
        $this ->servername = "localhost";
        $this ->username = "root";
        $this ->password = "";
        $this ->dbname = "psicogest";

        $conn = new mysqli($this ->servername,$this ->username, $this ->password,$this ->dbname) or die(" fallo en la conexión") ;

        return $conn;

    }
}


 
?>