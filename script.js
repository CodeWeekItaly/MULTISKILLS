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

function resetIndex() 
{
  main_menu = document.getElementById("sell-or-buy")
  main_menu.classList.remove("hide")

  other_menus = [
    document.getElementById("register-buyer"),
    document.getElementById("register-seller")
  ];

  for (var i = 0; i < other_menus.length; i++) {
    other_menus[i].classList.add("hide");
  }

}