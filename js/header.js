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
window.onclick = function (event) {
    if (!(event.target.matches('.menuMobileButton'))) {
        var menusContent = menuContent;
        for (var i = 0; i < menusContent.length; i++) {
            var droppedMenu = menusContent[i];
            if (droppedMenu.classList.contains('menuMobileContentShow')) {
                droppedMenu.classList.remove('menuMobileContentShow');
                menuButton[i].innerHTML = "▼";
            }
        }
    }
    if (!event.target.matches('.menuFooterMobileButton')) {
        var menusFooterContent = menuFooterContent;
        for (var i = 0; i < menusFooterContent.length; i++) {
            var droppedMenuFooter = menusFooterContent[i];
            if (droppedMenuFooter.classList.contains('menuFooterMobileContentShow')) {
                droppedMenuFooter.classList.remove('menuFooterMobileContentShow');
                menuFooterButton[i].innerHTML = "▲";
            }
        }
    }
}