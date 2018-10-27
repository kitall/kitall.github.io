var kitButton = document.getElementsByClassName('kitKitBtnP');
var kitContent = document.getElementsByClassName('kitKitDrop');

function kitDropdown() {
    var symbol;


    for (var i = 0; i < kitContent.length; i++) {
        kitContent[i].classList.toggle("kitKitDropShow");
        if (kitButton[i].innerHTML == "▲")
            symbol = "▼";
        else
            symbol = "▲";
        kitButton[i].innerHTML = symbol;
    }
}

$('.icon').hover(function () {
    $(this)
        .toggleClass('trash')
        .toggleClass('trash-solid');
})