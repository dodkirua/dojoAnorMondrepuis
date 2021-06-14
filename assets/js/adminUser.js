

const identity = document.getElementById('identity');
const button = document.getElementsByClassName('button');
const add = document.getElementById('add');
const addButton = document.getElementById('addButton');
const select = document.getElementById('select');
const selectSubmit = document.getElementById('selectSubmit');
const articleSelect = document.getElementById('articleSelect');
const title = document.getElementById('title');

for (let i = 0 ; i < button.length ; i++){
    button[i].addEventListener('click',function (e){
        if (identity !== null){
            identity.innerHTML = '';
        }

        addButton.style.display = "none";
        switch (e.target.value) {
            case 'add':
                add.style.display = 'flex';
                select.style.display = 'none';
                break;
            case 'del':
                select.style.display = 'flex';
                selectSubmit.value = "Supprimer";
                articleSelect.setAttribute('name','del');
                title.innerHTML = "Suppression d'un utilisateur";
                break;
            case 'mod':
                select.style.display = 'flex';
                selectSubmit.value = "Modifier";
                articleSelect.setAttribute('name','mod');
                title.innerHTML = "Modification d'un utilisateur";
                break;
        }
    });
}
