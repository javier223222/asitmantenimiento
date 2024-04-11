let showform=document.getElementById("showform");
const optionsearch = document.getElementById("tipoaddcliente");
optionsearch.addEventListener("change", updateValueOption);
function updateValueOption(e) {
  if(e.target.value=="2"){
    showform.style.visibility="visible"
  }
  if(e.target.value=="1"){
    showform.style.visibility="hidden"
  }
}
