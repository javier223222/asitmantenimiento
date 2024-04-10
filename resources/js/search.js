import axios from "axios"

console.log('search.js loaded')
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const showall = document.getElementById("showall");
    const searchsection= document.getElementById("showsearch");
    const optionsearch = document.getElementById("optionsearch");
    const searchinput = document.getElementById("searchinput");
    const iduser= document.getElementById("iduser").value;
    console.log(iduser)
    let typeOfSearch="1"
    let searchsomething=""
    window.addEventListener("load",()=>{
        searchinput.addEventListener("input",async(e)=> {
            searchsomething= e.target.value
       if(searchsomething){
        showall.classList.add("notshow")
        searchsection.classList.remove("notshow")
        if(searchsomething!=""){
            axios.get(`/equiposearch?search=${searchsomething}&option=${typeOfSearch}&id=${iduser}`).then(response => {
               console.log(response.data.result)
               pintar(response.data.result)
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



    const pintar= (data)=>{
        data.map(element => {
           console.log(element)
           const imagen=element.product.image_prduct[0].img.url_public
           console.log(imagen)
           let compen=`<span class="material-symbols-outlined">
           hourglass_empty
           </span>`
           switch (element.status) {
            case "En fila":
                compen=`<span class="material-symbols-outlined">
           hourglass_empty
           </span>`

                break;
            case "En mantenimiento":
                compen=`<span class="material-symbols-outlined">
                construction
                </span>`
              break;
            case "Listo":
                compen=`<span class="material-symbols-outlined">
                done
                </span>`
                break;

            default:
                compen=`<span class="material-symbols-outlined">
                construction
                </span>
                `
                break;
           }


           searchsection.innerHTML+=`

           <div class="col-sm-6 mb-3 mb-sm-0">
           <div class="card" style="width: 18rem;">
               <img class="card-img-top" src='${imagen}' alt="Card image cap">
               <div class="card-body">
                 <h5 class="card-title">ID:${element.foliId}</h5>
                 <h6 class="card-subtitle mb-2 text-body-secondary">Creado:${formatDate(element.created_at)}</h6>

                 <div class="row">
                   <p class="card-text">Estatus:${element.status}</p>
                   ${compen}

                 </div>
                 <ul class="list-group list-group-flush">
                   <li class="list-group-item">Cliente:${element.cliente.name} ${element.cliente.last_name}
                       ${element.cliente.mother_last_name} </li>
                   <li class="list-group-item">Numero del cliente:${element.cliente.telefono}</li>
                   <li class="list-group-item">Tecnico:${element.admin.name}}
                       ${element.admin.last_name} ${element.admin.mother_last_name}</li>
                   </li>
                 </ul>



                 <div class="card-body">
                   <a href="#"  class="btn btn-primary">Comentar</a>
                   <a href="#"  class="btn btn-primary">Actualizar</a>
                 </div>
               </div>
             </div>

       </div>
           `
        });
    }






function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}





