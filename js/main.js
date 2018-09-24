$(function () {
    $('#showContato').hover(function () {
        $('#moreShowContato').css('opacity', '1');
    }, function () {
        // on mouseout, reset the background colour
        $('#moreShowContato').css('opacity', '0');
    });
});

var contatoShown = false;
document.getElementById('isContatoShown').value = contatoShown;

function showContato() {
    if (!contatoShown) {
        $('.contato').css('display', 'block');
        document.getElementsByClassName("showContato")[0].innerHTML = "Preencher as Informações de Entrega mais tarde";
        contatoShown = true;
        document.getElementsByName('endereco')[0].setAttribute('required', contatoShown);
        document.getElementsByName('numero')[0].setAttribute('required', contatoShown);
        document.getElementsByName('bairro')[0].setAttribute('required', contatoShown);
        document.getElementsByName('cidade')[0].setAttribute('required', contatoShown);
        document.getElementsByName('cep')[0].setAttribute('required', contatoShown);
        document.getElementsByName('estado')[0].setAttribute('required', contatoShown);
        document.getElementsByName('pais')[0].setAttribute('required', contatoShown);
    } else {
        $('.contato').css('display', 'none');
        document.getElementsByClassName("showContato")[0].innerHTML = "Preencher as Informações de Entrega agora";
        document.getElementsByName('endereco')[0].removeAttribute('required');
        contatoShown = false;
        document.getElementsByName('endereco')[0].setAttribute('required', contatoShown);
        document.getElementsByName('numero')[0].setAttribute('required', contatoShown);
        document.getElementsByName('bairro')[0].setAttribute('required', contatoShown);
        document.getElementsByName('cidade')[0].setAttribute('required', contatoShown);
        document.getElementsByName('cep')[0].setAttribute('required', contatoShown);
        document.getElementsByName('estado')[0].setAttribute('required', contatoShown);
        document.getElementsByName('pais')[0].setAttribute('required', contatoShown);
    }

    document.getElementById('isContatoShown').value = contatoShown;
}