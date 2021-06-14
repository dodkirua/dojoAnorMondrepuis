const buttonMenu = document.getElementById('buttonMenu');
const menu = document.getElementById('phone');



let token = true;
buttonMenu.addEventListener('click', function (){
    let  displayDoc = document.getElementById('articleDisplay');

    if (document.getElementById('accountDisplay')){
        displayDoc = document.getElementById('accountDisplay');
    }
    else if (document.getElementById('AdminArticleDisplay')){
        displayDoc = document.getElementById('AdminArticleDisplay');
    }
    display(displayDoc);
});


function display(displayDoc){
    if (token === true){
        menu.style.display = "flex";
        displayDoc.style.left = "26%";
        displayDoc.style.width = "70%";
        token = false;
    }
    else{
        menu.style.display = "none";
        displayDoc.style.left = "0";
        displayDoc.style.width = "100%";
        token = true;
    }
}