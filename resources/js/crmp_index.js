const searchBar = document.getElementById('platinumSearch');

if (searchBar.value !== '') {
    searchBar.focus();
    const valueLength = searchBar.value.length;
    searchBar.setSelectionRange(valueLength, valueLength);
}
