var searchBtn = document.getElementsByClassName('searchButton');
var searchBar = document.getElementsByClassName('searchBar');
var pesquisa = document.getElementsByClassName('pesquisa');

function searchDropdown() {
    for (var i = 0; i < searchBar.length; i++) {
        searchBar[i].classList.toggle("searchBarShow");
    }
    for (var j = 0; j < pesquisa.length; j++) {
        pesquisa[j].classList.toggle("activeSearchBar");
    }
}

var footerSearchBtn = document.getElementsByClassName('footerSearchButton');
var footerSearchBar = document.getElementsByClassName('footerSearchBar');
var pesquisaFooter = document.getElementsByClassName('pesquisaFooter');

function footerSearchDropdown() {
    for (var i = 0; i < footerSearchBar.length; i++) {
        footerSearchBar[i].classList.toggle("searchBarShow");
    }
    for (var j = 0; j < pesquisa.length; j++) {
        pesquisaFooter[j].classList.toggle("activeSearchBar");
    }
}