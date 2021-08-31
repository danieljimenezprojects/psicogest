<?php
// Algunas funciones para comprobar que los datos del registro e inicio de sesión son correctas
    // comprobar que no esta vacío los inputs del registro
    function emptyInputSignup($username,$email,$pwd) {
        $result;
        if(empty($username) || empty($email) || empty($pwd) ){
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
    // ver si es correcto el usuario
    function invalidUid($username) {
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
    // ver si es correcto el email
    function invalidEmail($email) {
        $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
    //comprobar que no esta vacio los inputs del login
    function emptyInputLogin($username,$pwd) {
        $result;
        if(empty($username) || empty($pwd) ){
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
    
    