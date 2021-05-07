function loginPressed()
{
  var old_menu = document.getElementById("welcome-menu");
  var new_menu = document.getElementById("login-menu");
  old_menu.classList.add("hide");
  new_menu.classList.remove("hide")
}


function registerPressed()
{
  var old_menu = document.getElementById("welcome-menu")
  var new_menu = document.getElementById("register-menu")
  old_menu.classList.add("hide");
  new_menu.classList.remove("hide")
}
