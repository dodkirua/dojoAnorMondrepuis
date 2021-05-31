/**
 * validate the password before validation
 */
export function validatePass()  {
    let msg;
    let token = 0;
    const elem = document.getElementById("pass");
    let str = elem.value;

    if (str.match( /[0-9]/g)){
        document.getElementById("number").className = "colorGreen";
    }
    else {
        document.getElementById("number").className = "colorRed";
    }

    if (str.match( /[A-Z]/g)){
        document.getElementById("maj").className = "colorGreen";
    }
    else {
        document.getElementById("maj").className = "colorRed";
    }

    if (str.match(/[a-z]/g)){
        document.getElementById("min").className = "colorGreen";
    }
    else{
        document.getElementById("min").className = "colorRed";
    }

    if (str.match( /[^a-zA-Z\d]/g)){
        document.getElementById("char").className = "colorGreen";
    }
    else {
        document.getElementById("char").className = "colorRed";
    }

    if (str.length >= 10) {
        document.getElementById("length").className = "colorGreen";
    }
    else {
        document.getElementById("length").className = "colorRed";
    }

    if (str.match( /[0-9]/g) &&
        str.match( /[A-Z]/g) &&
        str.match(/[a-z]/g) &&
        str.match( /[^a-zA-Z\d]/g) &&
        str.length >= 10) {
        token = true;
    }


    else {
        token = false;
    }
    return token;
}

/**
 * compare the password and the password repeat
 */
export function comparePass() {
    let msg;
    let token;
    let pass1 = document.getElementById("pass").value;
    let pass2 = document.getElementById("passVerify").value;

    if (pass1 === pass2){
        msg = "Les mots de passes correspondent";
        token = true;
    }
    else {
        msg = "Les mots de passes sont différents";
        token = false;
    }
    document.getElementById("checkVerify").innerHTML= msg;
    return token;
}

export function validate(){
    return !!(comparePass() && validatePass());
}