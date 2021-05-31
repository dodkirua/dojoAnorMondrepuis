import {validatePass, validate, comparePass} from "./function/security.js";



const regis = document.getElementById("registration");

document.addEventListener('keyup',validatePass);
document.addEventListener('keyup',comparePass);

regis.addEventListener("submit",function (e){
    e.preventDefault();
    if(validate()){
        regis.submit();
    }
});