var active = false;

var dropdown_menu = document.getElementById('dropdown-phone-menu');

document.getElementById('nav-menu-drop-btn').onclick=function()
{
    var s_active = globalThis.active;

    if(s_active)
    {
        s_active = !active;
        dropdown_menu.style.marginTop = "-500px";
    }
    else
    {
        s_active = !active;
        dropdown_menu.style.marginTop = "66px";
    }

    globalThis.active = s_active;
}