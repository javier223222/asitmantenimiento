import axios from "axios"
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let id=document.getElementById("idchat").value
axios.get("/allchats?id="+id).then(response => {
    console.log(response.data)
})
