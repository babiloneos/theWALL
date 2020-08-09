function validarPerfil(){
    var nombre = document.getElementById('name');
    var ape = document.getElementById('apellido');
    var usr = document.getElementById('usr_name');
  
    let avisos = false;
    let errores = "";
    let userRegex= /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/
    let nombreRegex = /^[A-Za-z]+(?:[ _-][A-Za-z]+)*$/
    
    if(!userRegex.test(usr.value)){
      errores += "Debe ingresar un nombre de usuario válido\n";
      avisos = true;
    }
      if(!nombreRegex.test(nombre.value)){
        errores +="Debe ingresar un nombre válido\n";
        avisos = true;
    }
    if(!nombreRegex.test(ape.value)){
      errores +="Debe ingresar un apellido válido\n";
      avisos = true;
    }
      if(avisos){
        alert(errores);
        return false;
      }else{
      return true;
            }
          }
  
function validarCuenta(){
    var email = document.getElementById('email');
    var pass = document.getElementById('passwd');
    var confirmpass = document.getElementById('confirmpasswd');
    let avisos = false;
    let errores = "";
    let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
    let passRegex= /^((?=.*[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~])|(?=.*\d))(?=.*[a-z])(?=.*[A-Z]).{6,}$/

    if(!emailRegex.test(email.value)){
      errores +="Debe ingresar un email válido\n";
      avisos = true;
    }
    if(!passRegex.test(pass.value)){
        errores +="Debe ingresar una contraseña válida";
        avisos = true;
    } 
    if (confirmpass.value != pass.value){
      errores +="Debe ingresar la misma contraseña nuevamente\n"
      avisos = true;
    }
    if(avisos){
      alert(errores);
      return false;
    }else{
        return true;
        }
    }
