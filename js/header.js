var menuButton = document.getElementsByClassName('menuMobileButton');
var menuContent = document.getElementsByClassName('menuMobileContent');

function menuDropdown() {
    var symbol;


    for (var i = 0; i < menuContent.length; i++) {
        menuContent[i].classList.toggle("menuMobileContentShow");
        if (menuButton[i].innerHTML == "▲")
            symbol = "▼";
        else
            symbol = "▲";
        menuButton[i].innerHTML = symbol;
    }
}