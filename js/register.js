function validar(){
  var nombre = document.getElementById('name');
  var ape = document.getElementById('apellido');
  var usr = document.getElementById('user');
  var email = document.getElementById('email');
  var pass = document.getElementById('passwd');
  var confirmpass = document.getElementById('repeatpass');
  var parrafo = document.getElementById('error');
  var imagen = document.getElementById('circulo');

  let avisos = false;
  let errores = "";
  let userRegex= /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
  let nombreRegex = /^[A-Za-z]+(?:[ _-][A-Za-z]+)*$/;
  let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  let passRegex= /^((?=.*[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~])|(?=.*\d))(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
  parrafo.innerHTML = "";

  // Hay que validar si es null antes de hacer el test, o conseguir otra forma de hacer el test

  if(usr.value){
    if (!userRegex.exec(usr.value)){
      errores += "El nombre de usuario solo acepta letras y números.<br>";
      avisos = true;
    }
  } else {
    errores += "Debes ingresar un nombre de usuario. <br>";
    avisos = true;
  }

  if(nombre.value){
    if (!nombreRegex.exec(nombre.value)){
      errores += "El nombre solo acepta letras.<br>";
      avisos = true;
    }
  } else {
    errores += "Debe ingresar un nombre. <br>";
    avisos = true;
  }

  if(ape.value){
    if (!nombreRegex.exec(ape.value)){
      errores += "El apellido solo acepta letras.<br>";
      avisos = true;
    }
  } else {
    errores += "Debe ingresar un apellido. <br>";
    avisos = true;
  }

  if(email.value){
    if(!emailRegex.exec(email.value)){
    errores +="Debe ingresar un email válido.<br>";
    avisos = true;
    }
  } else {
    errores +="Debe ingresar un email<br>";
    avisos = true;
  }

  if(pass.value){
    if(!passRegex.test(pass.value)){
      errores +="La contraseña debe tener por lo menos una mayuscula y un número o caracter especial.<br>";
      avisos = true;
    }
  } else {
    errores +="Debes ingresar una contraseña.<br>";
    avisos = true;
  }
  if (confirmpass.value != pass.value){
    errores +="Debe ingresar la misma contraseña nuevamente <br>";
    avisos = true;
  } 

  if (!imagen.value){
    errores +="Por favor elige una foto de perfil<br>";
    avisos = true;
  }

  if(avisos){
    parrafo.innerHTML = errores;
    return false;
  }else{
  parrafo.innerHTML = "El formulario ha sido enviado con éxito.";
  return true;
  }
}
