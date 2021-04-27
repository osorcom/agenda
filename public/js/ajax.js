
var buts =  document.querySelectorAll("button.delete");

for(i=0; i<buts.length; i++){
  buts[i].addEventListener("click", function(obj){
    borrarContacto(obj.target.dataset.id, obj.target.parentElement.parentElement);
  });
}


function borrarContacto(id, fila){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      var estado = JSON.parse(this.responseText);
      if(estado.borrado){
        borrarFila(fila);
      }else{
        mensage("No se ha podido borrar el registro.");
      }
    }
  }
  xmlhttp.open("DELETE", "/contacto/"+id, true);
  xmlhttp.send();
}



function borrarFila(fila){
  var o = 1.0;
  function disminuir(){
    o -=0.1;
    if(o>0){
      fila.style.opacity = o;
      window.setTimeout(disminuir, 50);
    }else{
      fila.remove();
    }
  }
  window.setTimeout(disminuir, 50);
}


function mensage(msg){
  alert(msg);
}
