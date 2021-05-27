function buyerLog()
{
  var old_menu = document.getElementById("sell-or-buy");
  var new_menu = document.getElementById("register-buyer");
  old_menu.classList.add("hide");
  new_menu.classList.remove("hide")
}

function sellerLog()
{
  var old_menu = document.getElementById("sell-or-buy")
  var new_menu = document.getElementById("register-buyer")
  old_menu.classList.add("hide");
  new_menu.classList.remove("hide")
}

function userLog() {
  var old_menu = document.getElementById("sell-or-buy")
  var new_menu = document.getElementById("user-log")
  old_menu.classList.add("hide");
  new_menu.classList.remove("hide")
}

function resetIndex() 
{
  main_menu = document.getElementById("sell-or-buy")
  main_menu.classList.remove("hide")

  other_menus = [
    document.getElementById("register-buyer"),
    document.getElementById("register-seller"),
    document.getElementById("user-log")
  ];

  for (var i = 0; i < other_menus.length; i++) {
    other_menus[i].classList.add("hide");
  }

}

function redirectpls() {
  window.location.replace("home.html")
}

function goToProfile() {
  window.location.replace("userpage.html")
}