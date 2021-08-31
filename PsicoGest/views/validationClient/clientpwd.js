// Son dos funciones. La primera sirve para ver al password si da al botón ver contraseña.
// La otra da un mensaje personalizado si pone mal la contraseña

function verPassword(){
    var password = document.getElementById("pwd");
    if(password.type == "password"){
        password.type = "text";
    }else{
        password.type = "password";
    }
}

function validate(){

document.getElementById('pwd').setCustomValidity('8 dígitos con mayúscula,minúscula y número incluidos');


}

