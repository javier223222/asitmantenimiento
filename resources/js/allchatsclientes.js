import axios from "axios"
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let id=document.getElementById("idchat").value
let sectionmessage=document.getElementById("sectionmessage")
let mesagges=[]
axios.get("/allchats?id="+id).then(response => {
    mesagges=mesagges.concat(response.data.result)
    console.log(mesagges)
    pinstarmesaages()
})

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;


var pusher = new Pusher('f5a37d38fd2093fcda1f', {
  cluster: 'us2'
});


var channel = pusher.subscribe('my-chat'+id);
channel.bind('my-event', function(data) {

  mesagges.push(data.sender)
  console.log(mesagges)
  pinstarmesaages()

});


const pinstarmesaages=()=>{
    sectionmessage.innerHTML=""
    mesagges.map((message)=>{
        let div=document.createElement("div")
        if(message.cliente!=null){
            div.style.backgroundColor="#2FB3F1"
            div.innerHTML=`
                <p>tu</p>
                <p>${message.message}</p>
            `
        }else{

            div.style.backgroundColor="#F1F1F1"
            div.innerHTML=`
                <p>encargado</p>
                <p>${message.message}</p>
            `
        }

        sectionmessage.appendChild(div)
    })

}
