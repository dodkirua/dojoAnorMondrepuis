// display message
const xhr = new XMLHttpRequest();
const chat = document.getElementById('numChat');

xhr.onload = function () {
    let contenu = JSON.parse(xhr.responseText);
    const area = document.getElementById("area");
   contenu.forEach(msg => {
       const line = document.createElement('p');
       line.innerHTML = msg.user + " : " +msg.content;
       area.append(line) ;
   });

}
let url = "/Controller/chatRoom-get.php?num=" + chat.value;

xhr.open("GET",url);
xhr.send();


//send message



const addInput = document.getElementById('add');
const addButton = document.getElementById('submit');

addButton.addEventListener("click",function (){
    send(addInput);
    addInput.value = "";
});

addInput.addEventListener("keyup",function (e){

    switch (e.key){
        case 'Enter' :
            send(addInput);
            addInput.value = "";
            break;
        default:
            break;
    }

});

function send(content){
    const userId = document.getElementById('userId');
    const numChat = document.getElementById('numChat');
    if (content.value !== ""){
        const xhrSend = new XMLHttpRequest();
        xhrSend.onload = function() {
            location.reload();
        };

        let body = {
            content: content.value,
            date : '',
            user : userId.value,
            chat_room : numChat.value
        }

        xhrSend.open("POST", "/Controller/chatRoom-send.php");
        xhrSend.send(JSON.stringify(body));
    }

}