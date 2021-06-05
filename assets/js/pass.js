import {validatePass, validate, comparePass} from "./function/security.js";

const passMod = document.getElementById("passModify");

document.addEventListener('keyup',validatePass);
document.addEventListener('keyup',comparePass);

passMod.addEventListener("submit",function (e){
    e.preventDefault();
    if(validate()){
        passMod.submit();
    }
});