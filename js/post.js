function like(id) {

    // cambiamos de icono
    id.classList.toggle("fa-heart-o");

  }

  function estado(id) {
    window.alert("SADASDASD");
    if(id.classList.toString().indexOf("fa-heart-o") != -1){
        // reducir contador y cambiamos color
        id.nextElementSibling.innerHTML = Number(id.nextElementSibling.innerHTML) + 1;
        id.style.color="#2dbc4e";
    }
    else {
        // aumentamos contador y cambiamos color
        id.nextElementSibling.innerHTML = Number(id.nextElementSibling.innerHTML) - 1;
        id.style.color="#505250";
    }

    // cambiamos de icono
    id.classList.toggle("fa-heart-o");

  }
//   id.style.color="#2dbc4e";