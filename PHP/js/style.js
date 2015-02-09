function wyswietlListeStyli(){
    var kontener = document.getElementById("main_holder");
    var listaStyli = document.createElement("div");
    kontener.appendChild(listaStyli);
    listaStyli.id = "lista_styli";
    var ul = document.createElement('ul');
    var style = document.getElementsByTagName("link");
    for(var i = 0; i < style.length ; i++){
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.setAttribute("onclick","ustawStyl('"+style[i].title+"');");
        a.innerHTML = style[i].title; // wyswietli tytul w pasku
        li.appendChild(a);
        ul.appendChild(li);
    }
listaStyli.appendChild(ul);
}    

function aktywujStyl(nazwa){
    var link = document.getElementsByTagName('link');
    var tytul;
    for(var i = 0; i < link.length; i++ ){
        tytul = link[i].getAttribute('title');
    if (tytul === nazwa)
        link[i].disabled = false;
    else
        link[i].disabled = true;
    }
}

function setCookie(nazwa,wartosc){
    var aktualnaData = new Date();
    aktualnaData.setTime(aktualnaData.getTime() + 30 * 24 * 60 * 60 * 1000);
    var czasWygasniecia = aktualnaData.toGMTString();
    czasWygasniecia = '; expires=' + czasWygasniecia;
//    sciezka = '; path=' + sciezka;
    document.cookie = nazwa + '=' + encodeURI(wartosc) + czasWygasniecia; 
}

function ustawStyl(nazwa){
    setCookie('aktywnyStyl',nazwa);
    aktywujStyl(nazwa);
}

function zmienStyle(){
    wyswietlListeStyli();
    var cookie = document.cookie;
    var nazwa = 'aktywnyStyl';
    
    if(!(cookie.indexOf('aktywnyStyl' + '=') < 0)){
        var poczatek = cookie.indexOf(nazwa + '=') + nazwa.length + 1;
        var koniec = cookie.substring(poczatek, cookie.length);
        koniec = (koniec.indexOf(';') < 0) ? cookie.length : poczatek + koniec.indexOf(';');
        var aktywnyStyl = decodeURI(cookie.substring(poczatek, koniec));
        aktywujStyl(aktywnyStyl);
    }
}