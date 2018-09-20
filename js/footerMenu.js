var menuFooterButton = document.getElementsByClassName('menuFooterMobileButton');
var menuFooterContent = document.getElementsByClassName('menuFooterMobileContent');

function menuFooterDropdown() {
    var symbol;


    for (var i = 0; i < menuFooterContent.length; i++) {
        menuFooterContent[i].classList.toggle("menuFooterMobileContentShow");
        if (menuFooterButton[i].innerHTML == "▼")
            symbol = "▲";
        else
            symbol = "▼";
        menuFooterButton[i].innerHTML = symbol;
    }
}
// window.onclick = function (event) {
//     if (!event.target.matches('.menuFooterMobileButton')) {

//         var menusFooterContent = menuFooterContent;
//         for (var i = 0; i < menusFooterContent.length; i++) {
//             var droppedMenuFooter = menusFooterContent[i];
//             if (droppedMenuFooter.classList.contains('menuFooterMobileContentShow')) {
//                 droppedMenuFooter.classList.remove('menuFooterMobileContentShow');
//                 menuFooterButton[i].innerHTML = "▲";
//             }
//         }
//     }
// }