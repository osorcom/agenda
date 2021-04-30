
/*************************************************************/
/*            borrar contacto                                */
/*************************************************************/
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
      if(!estado.error){
        borrarFila(fila);
      }else{
        mensage(estado.message);
      }
    }
  }
  xmlhttp.open("DELETE", "/contacto/"+id, true);
  xmlhttp.send();
}


function borrarFila2(fila){
  var tds = fila.querySelectorAll("td");
  var h = tds[0].style.height;
  h = parseInt(h.substring(0,h.length-2));
  console.log(h);
  function disminuir(){
    h -=1;
    console.log(h);
    if(h>0){
      for(var i=0; i<tds.length; i++){
        tds[i].style.height = h+"px";
      }
      window.setTimeout(disminuir, 50);
    }else{
      fila.remove();
    }
  }
  disminuir();
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
  disminuir();
}


function mensage(msg){
  alert(msg);
}

/*************************************************************/
/*            Nuevo contacto                                 */
/*************************************************************/
var butNuevoContacto = document.querySelector("#but-nuevo-contacto");
butNuevoContacto.addEventListener("click", function(){
  var sec = document.querySelector("section#form-nuevo");
  sec.style.display = "block";
});

var butCancelarContacto = document.querySelector("#butCancelarContacto");
butCancelarContacto.addEventListener("click", cancelarFormNuevoContacto);


function cancelarFormNuevoContacto(){
  var form = document.querySelector("section#form-nuevo form");
  form.reset();
  var sec = document.querySelector("section#form-nuevo");
  sec.style.opacity = 1;
  desaparecerElem(sec);
}


function desaparecerElem(elem){
  var o = elem.style.opacity;
  o -=0.1;
  if(o>0){
    elem.style.opacity = o;
    window.setTimeout(function(){desaparecerElem(elem)}, 50);
  }else{
    elem.style.display = "none";
    elem.style.opacity = 1;
  }
}


var butCrearContacto = document.querySelector("#butCrearContacto");
butCrearContacto.addEventListener("click", nouContacte);

function nouContacte(){
  var n = document.querySelector("#textNom").value;
  var e = document.querySelector("#textEmail").value;
  var t = document.querySelector("#textTelf").value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
      var resp = JSON.parse(this.responseText);
      if(!resp.error){
        addFila(resp.contacto);
        cancelarFormNuevoContacto();
      }else{
        mensage(resp.message);
      }
    }
  }
  xmlhttp.open("POST", "/contactos", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("nom="+n+"&email="+e+"&telf="+t);
}


function addFila(contacto){
  var tr  = document.createElement("tr");
  var tdi = document.createElement("td");
  var tdn = document.createElement("td");
  var tde = document.createElement("td");
  var tdt = document.createElement("td");

  tr.appendChild(tdi);
  tr.appendChild(tdn);
  tr.appendChild(tde);
  tr.appendChild(tdt);

  tdi.innerText = contacto.id;
  tdn.innerText = contacto.nom;
  tde.innerText = contacto.email;
  tdt.innerText = contacto.telf;
  tr.innerHTML+= "<td><button class='delete' data-id='${contacto.id}'>X</button></td>";

  document.querySelector("#data table").appendChild(tr);
}
