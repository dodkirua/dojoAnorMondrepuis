

const button = document.getElementsByClassName('button');
const add = document.getElementById('add');
const addButton = document.getElementById('addButton');
const select = document.getElementById('select');
const selectSubmit = document.getElementById('selectSubmit');
const articleSelect = document.getElementById('articleSelect');
const title = document.getElementById('titleArticle');

for (let i = 0 ; i < button.length ; i++){
    button[i].addEventListener('click',function (e){
        console.log(e.target)
        addButton.style.display = "none";
        switch (e.target.value) {
            case 'add':
                add.style.display = 'flex';
                break;
            case 'del':
                select.style.display = 'flex';
                selectSubmit.value = "Sélectionner un utilisateur à supprimer";
                articleSelect.setAttribute('name','del');
                title.innerHTML = "Suppression d'un utilisateur"
                break;
            case 'mod':
                select.style.display = 'flex';
                selectSubmit.value = "Sélectionner un utilisateur à modifier";
                articleSelect.setAttribute('name','mod');
                title.innerHTML = "Modification d'un utilisateur";
                break;
        }
    });
}
