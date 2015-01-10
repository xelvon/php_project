<?php
$wiadomosc = trim(preg_replace('/\s+/', ' ', $_POST['tresc']));
$uzytkownik = $_POST['nick'];
$doWyslania = "";

$czatPlik = file("czat.txt");
$czatPlik[count($czatPlik)]=$uzytkownik.": ".$wiadomosc."\n";

$PlikZapis = fopen("czat.txt","w+");

flock($PlikZapis, LOCK_EX);
if(count($czatPlik) > 25)
    $start = count($czatPlik) - 25;
else 
    $start = 0;

for($linijka = $start; $linijka < count($czatPlik); $linijka++){
    $doWyslania = $doWyslania.$czatPlik[$linijka];
    fputs($PlikZapis,$czatPlik[$linijka]);
};

flock($PlikZapis, LOCK_UN);
fclose($PlikZapis);


exit();
?>