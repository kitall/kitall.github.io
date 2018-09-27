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
    // if (!event.target.matches('.searchButton')) {
    //     var searchBars = searchBar;
    //     for (var i = 0; i < searchBars.length; i++) {
    //         var droppedSearchBar = searchBars[i];
    //         if (droppedSearchBar.classList.contains('searchBarShow'))
    //             droppedSearchBar.classList.remove('searchBarShow');
    //     }
    // }
    // if (!event.target.matches('.footerSearchButton')) {
    //     var footerSearchBars = footerSearchBar;
    //     for (var i = 0; i < footerSearchBars.length; i++) {
    //         var droppedSearchBar = footerSearchBars[i];
    //         if (droppedSearchBar.classList.contains('footerSearchBarShow'))
    //             droppedSearchBar.classList.remove('footerSearchBarShow');
    //     }
    // }
}