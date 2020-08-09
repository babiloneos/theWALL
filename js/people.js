function follow(boton, siguiendo){
    if (boton.classList.toString() == "followButton"){
        boton.classList.toggle("unfollowButton");
        boton.innerHTML = "Dejar de seguir";
    } else {
        boton.classList.toggle("unfollowButton");
        boton.innerHTML = "Seguir";
    }
}