function aktywujKomunikator(){
    var komunikator = document.getElementById("komunikator");
    var formularz = document.getElementById("wiadomosc");
    var checkbox = document.getElementsByName('aktywator')[0];
    
    if(komunikator.disabled == true){
        komunikator.disabled = false;
        komunikator.style.backgroundColor = "white";
        formularz.style.display = "block";
        checkbox.value = 1;
    }else{
        komunikator.disabled = true;
        komunikator.style.backgroundColor = "lightgrey";
        formularz.style.display = "none";
        checkbox.value = 0;
    }
}

function wyslijWiadomosc(xmlhttp){
    var wiadomosc =  encodeURIComponent(document.getElementsByName('tresc')[0].value);
    var nick = document.getElementsByName('nick')[0].value;
    if (nick != "" && wiadomosc != ""){
        xmlhttp.open("POST","komunikatorWyslijWiadomosc.php",true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlhttp.send("tresc=" + wiadomosc + "&nick=" + nick);
        document.getElementsByName('nick')[0].value = "NoName";
        document.getElementsByName('tresc')[0].value = "";
    }else{
        alert("Pole nick i wiadomość nie mogą być puste!");
    }
}

function sluchacz(xmlhttp){
        xmlhttp.open("POST","komunikatorOdbierzWiadomosci.php",true);
        xmlhttp.onreadystatechange =   function(){
            if (xmlhttp.readyState == 4){
                if(xmlhttp.status == 200){
                    document.getElementById("komunikator").value = xmlhttp.responseText;
                }
            }
        };
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlhttp.send("czas=0");
}

function getXMLObject(){
    var xmlHttp = false;
    try{
        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP")
    }
    catch (e){
        try{
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP")
        }
        catch (e2){
            xmlHttp = false
        }
    }
    if (!xmlHttp && typeof XMLHttpRequest != 'undefined'){
        xmlHttp = new XMLHttpRequest();
    }
    return xmlHttp;
}

function komunikator(){
    var przerwa = 1000;
    var checkbox = document.getElementsByName('aktywator')[0];
    var przycisk = document.getElementsByName('wyslij')[0];
    var xmlhttp = new getXMLObject(); 
    
        setInterval(function() {
            if(checkbox.value == 1)
                sluchacz(xmlhttp); 
        }, przerwa);
    
    przycisk.onclick = function(){
        wyslijWiadomosc(xmlhttp);
    }
    checkbox.onclick = function(){
        aktywujKomunikator();
    }
    
}