
function validaringreso(){ 
  var user = document.getElementById('usr');
  var pass = document.getElementById('passwd');
  var parrafo = document.getElementById("error");
  let avisos= false;  
  let errores = "";

  parrafo.innerHTML = "";
  
  if(user.value == "" || user.value == null){
    errores += "Debe ingresar un nombre de usuario <br>";
  }
    if(pass.value == "" || pass.value == null){
      errores +="Debe ingresar una contraseña válida <br>";
      avisos = true;
  } 
    if(avisos){
      parrafo.innerHTML = errores;
      return false;
    }else{
    // alert("El formulario ha sido enviado con éxito.");
    return true;
          }
        }

    
