const addButton = document.getElementById('addButton');
const addArticle = document.getElementById('addArticle');

addButton.addEventListener('click',function (){
    addButton.style.display = "none";
    addArticle.style.display = 'flex';
});