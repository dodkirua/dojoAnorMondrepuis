

const button = document.getElementsByClassName('button');
const addArticle = document.getElementById('addArticle');
const addButton = document.getElementById('addButton');
const select = document.getElementById('select');
const selectSubmit = document.getElementById('selectSubmit');
const articleSelect = document.getElementById('articleSelect');
const title = document.getElementById('titleArticle');

for (let i = 0 ; i < button.length ; i++){
    button[i].addEventListener('click',function (e){
        console.log(articleSelect)
        addButton.style.display = "none";
        switch (e.target.value) {
            case 'addArticle':
                addArticle.style.display = 'flex';
                break;
            case 'delArticle':
                select.style.display = 'flex';
                selectSubmit.value = "Sélectionner article à supprimer";
                articleSelect.setAttribute('name','del');
                title.innerHTML = "Suppression d'un article"
                break;
            case 'modArticle':
                select.style.display = 'flex';
                selectSubmit.value = "Sélectionner article à modifier";
                articleSelect.setAttribute('name','mod');
                title.innerHTML = "Modification d'un article"
                break;
        }
    });
}
