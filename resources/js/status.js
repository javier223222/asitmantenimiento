
let id=document.getElementById("folio").value
let showinitial=document.getElementById("showinitial")
let showeventtype=document.getElementById("showeventtype")
let img=document.getElementById("img")
let imgexits=document.getElementById("imgexits")
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;


var pusher = new Pusher('f5a37d38fd2093fcda1f', {
  cluster: 'us2'
});


var channel = pusher.subscribe('status'+id);
channel.bind('changestatus', function(data) {


  showevent(data)




});


function showevent(data){
    showinitial.style.visibility="hidden"
    showeventtype.style.visibility="visible"
    showeventtype.innerHTML=`
    <p class="card-text">${data.status}</p>
`
if(data.urlimg!=null){
    imgexits.style.visibility="hidden"
    img.innerHTML=`<img src="${data.img}" class="card-img-top" alt="...">`
}
switch (data.status) {
    case "En fila":
        showeventtype.innerHTML+=`   <span class="material-symbols-outlined">
        hourglass_empty
        </span>`

        break;
    case "En Mantenimiento":
        showeventtype.innerHTML+=`   <span class="material-symbols-outlined">
        construction
        </span>`
        break;
    case "Listo":
        showeventtype.innerHTML+=`   <span class="material-symbols-outlined">
        done
        </span>`
        break;

    default:
        showeventtype.innerHTML+=` <span class="material-symbols-outlined">
        construction
        </span>`
        break;


}

}


