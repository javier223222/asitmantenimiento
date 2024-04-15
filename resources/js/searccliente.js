console
.log('searchcliente.js');

const input=document.getElementById('search');
const showall=document.getElementById('swoall');
const showresults=document.getElementById('showresults');
let mostrarmapeo=document.getElementById('mostrarmapeo');
let searchsomething="";
window.addEventListener('load',()=>{
    input.addEventListener("input",(e)=>{
     searchsomething=e.target.value;
     if(searchsomething){
      showresults.style.visibility="visible";
        showall.style.visibility="hidden";
        mostrarmapeo.style.visibility="hidden";
        if(searchsomething!=""){
            fetch(`/searchcliente?search=${searchsomething}`).then(response=>response.text()).then(html=>{
                console.log(html)

               showresults.innerHTML=html
            })
        }

     }else{

        mostrarmapeo.style.visibility="visible";
        showresults.style.visibility="hidden";
        showall.style.visibility="visible";
     }
    })
})
