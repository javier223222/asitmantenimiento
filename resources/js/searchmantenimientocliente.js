import axios from "axios"

console.log('search.js loaded')
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const showall = document.getElementById("showall");
    const idcliente = document.getElementById("id").value;
    const searchsection= document.getElementById("showsearch");
    const optionsearch = document.getElementById("optionsearch");
    const searchinput = document.getElementById("searchinput");
    let typeOfSearch="2"
    let searchsomething=""
    window.addEventListener("load",()=>{
        searchinput.addEventListener("input",async(e)=> {
            searchsomething= e.target.value
       if(searchsomething){
        showall.classList.add("notshow")
        searchsection.classList.remove("notshow")
        if(searchsomething!=""){
            fetch(`/searchmantenimientocliente?id=${idcliente}&search=${searchsomething}&option=${typeOfSearch}`).then(response=>response.text()).then(html=>{
                console.log(html)
                searchsection.innerHTML=html
            })
        }
      }else{
        showall.classList.remove("notshow")
        searchsection.classList.add("notshow")
      }
        });
        optionsearch.addEventListener("change", updateValueOption);
        function updateValueOption(e) {
            typeOfSearch= e.target.value
            console.log(typeOfSearch)
        }






    })
