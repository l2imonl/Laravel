var loadFile = function (event) {
    var masthead = document.getElementById('masthead');
    masthead.setAttribute('style', 'background-image: url(' + URL.createObjectURL(event.target.files[0]) + ')');
}
