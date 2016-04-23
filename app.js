/************************************/
/*   Functile mele JS               */
/*   Dinu Lucian UTM ID Grupa:208   */
/************************************/


//Variabile globale utilizare in JS
var body_document = document.getElementsByTagName('body')[0];

//Afisare/ascundere hint pentru fiecare rand
function arataHint(element) {
    var arata = element.getElementsByClassName('info_click')[0];
    if ((arata.style.display == "") && (window.innerWidth > 740)) arata.style.display = "inline";

}
function ascundeHint(element) {
    var arata = element.getElementsByClassName('info_click')[0];
    if (arata.style.display == "inline") arata.style.display = "";
}

//Inchid popup cu detalii producator
function inchideDetaliiProducator() {
    body_document.removeChild(document.getElementById('detalii_producator'));
}

//Construiesc popup-ul cu detalii producator
function detaliiProducator(element, id, informatii) {
    //inainte de toare ascund hint-ul
    ascundeHint(element);
    //constuiesc panoul
    var panou = "<div class='panou_info'>"
                + "<h1>" + informatii.nume + "</h1>"
                + "<p class='info_data_mare'>" + informatii.data + "</p>"
                + "<p class='info_desc_mare'>" + informatii.descriere + "</p>"
                + "</div>";
    var detalii = "<div id='detalii_producator'>"
                + panou
                + "</div>";
    body_document.innerHTML += detalii;
}

//Aduc detalii producatori prin XMLHttpRequest si afisez un popup cu aceste informatii
function afiseazaDetaliiProducator(event, element, id) {
    //apelam request-ul doar daca elemen nu e buton-item
    //if (event.target == element) { //acesta e doar un test
    if (event.target.className != 'buton-item') {
        var xmlhttp = new XMLHttpRequest(); //facem un request
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                detaliiProducator(element, id, JSON.parse(xmlhttp.responseText));
                //atasez evenimentul de click pentru a inchide panoul
                document.getElementById('detalii_producator').addEventListener('click', inchideDetaliiProducator);
            }
        }
        xmlhttp.open('GET', 'api.php/?id=' + id, true);
        xmlhttp.send();
    }
}

//Directionare catre pagina de editare
function editeazaProducator(element, id) {
    window.location.href = 'editeaza.php?id=' + id;
}

//Stergere producator
function stergeProducator(element, id) {
    console.log(element);
    console.log(element.parentNode.childNodes);

  //  element.parentNode.childNodes.forEach(function(el){console.log(el);});
        var xmlhttp = new XMLHttpRequest(); //facem un request
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               console.log('stergere trimisa');
            }
        }
        xmlhttp.open('DELETE', 'api.php/?id=' + id, true);
        xmlhttp.send();

    console.log('functia de stergere');

}


//Construiesc popup-ul cu info neimplementat
function infoNeimplementat(element) {
    //constuiesc panoul
    var panou = "<div class='panou_info'>"
                + "<h1>Informatii</h1>"
                + "<p class='info_desc_mare'>Aceasta functionalitate nu este implementata momentan.</p>"
                + "</div>";
    var detalii = "<div id='detalii_producator'>"
                + panou
                + "</div>";
    body_document.innerHTML += detalii;
    document.getElementById('detalii_producator').addEventListener('click', inchideDetaliiProducator);
}
