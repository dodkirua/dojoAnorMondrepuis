const modify = document.getElementById("modifyInformation");
const check = document.getElementById("checkModify");
modify.addEventListener("submit",function (e){
    e.preventDefault();
    if(check.checked === true){
       modify.submit();
    }
});