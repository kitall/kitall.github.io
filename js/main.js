$(function () {
    $('#showContato').hover(function () {
        $('#moreShowContato').css('opacity', '1');
    }, function () {
        // on mouseout, reset the background colour
        $('#moreShowContato').css('opacity', '0');
    });
});

var contatoShown = false;

function showContato() {
    if (!contatoShown) {
        $('.contato').css('display', 'block');
        document.getElementsByClassName("showContato")[0].innerHTML = "Preencher as Informações de Entrega mais tarde";
        contatoShown = true;
    } else {
        $('.contato').css('display', 'none');
        document.getElementsByClassName("showContato")[0].innerHTML = "Preencher as Informações de Entrega agora";
        contatoShown = false;
    }
}