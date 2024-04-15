let showform=document.getElementById("showform");
const optionsearch = document.getElementById("tipoaddcliente");
let showclienteexiostente=document.getElementById("showclienteexiostente");
optionsearch.addEventListener("change", updateValueOption);
function updateValueOption(e) {
  if(e.target.value=="0"){
    showform.style.visibility="hidden"
    showclienteexiostente.style.visibility="hidden"

  }
  if(e.target.value=="2"){
    showclienteexiostente.style.visibility="hidden"
    showform.style.visibility="visible"
  }
  if(e.target.value=="1"){
    showform.style.visibility="hidden"
    showclienteexiostente.style.visibility="visible"
  }
}
