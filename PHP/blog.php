<?php
include 'goraStrony.php';
echo '<body onload="zmienStyle();">
        <div id="main_holder">';
$nazwaBloga = $_GET['nazwa'];

if(is_dir("blogi/".$nazwaBloga) && $nazwaBloga != NULL){
    
    $_SESSION['nazwa_bloga'] = $nazwaBloga;
    
    $file = file("blogi/$nazwaBloga/info");
    $owner = trim($file[0]);
    for($i=2;$i<count($file);$i++)
        if($i == 2)
            $opisBloga = $file[$i];
        else
            $opisBloga .= "<br/>".$file[$i];
    echo "<div id='tytul'>".
                    ucfirst($nazwaBloga)
          ."</div>";

    include 'zakladki.php';

    echo "<div id='tresc'>";
    
    echo "<div id='opis_bloga'>";
    echo $opisBloga;
    echo "</div>";
    
    echo "<div id='wpisy'>";
        $lista = scandir("blogi/".$_SESSION['nazwa_bloga']);
        $plikInfo = file("blogi/".$_SESSION['nazwa_bloga']."/info");
        $blogOwner = trim($plikInfo[0]);
        $indeks = 0;
        foreach($lista as $key=>$value){
            if($key > 1 && strpos($value,".w") > 0){
                $file = file("blogi/".$_SESSION['nazwa_bloga']."/$value");
                $iloscKomentarzy = scandir("blogi/".$_SESSION['nazwa_bloga']."/".substr($value,0,-2).".k");
                if($iloscKomentarzy != false)
                    $iloscKomentarzy = count($iloscKomentarzy) - 2;
                else
                    $iloscKomentarzy = 0;
                
                $pliki = scandir("blogi/".$_SESSION['nazwa_bloga']);
                $numerPliku = 0;
                $nr_pliku = 1;
                foreach($pliki as $nazwa){
                    $ext = pathinfo($nazwa);
                    $ext = $ext['extension'];
                    $tmp = basename($nazwa, ".".$ext);
                    
                    if(strpos($tmp, substr($value,0,-2)) !== false && $ext != "w" && $ext != "k"){
                            $wpis[$indeks]['plik'][$numerPliku++] = $nazwa;
                            $nr_pliku++;
                    }
                }
                
                $wpis[$indeks]['nazwa'] = substr($value,0,-2);
                $wpis[$indeks]['data'] = substr($value,0,4).".".substr($value,4,2).".".substr($value,6,2)." ".substr($value,8,2).":".substr($value,10,2).":".substr($value,12,2);
                $wpis[$indeks]['kto_dodal'] = $blogOwner;
                $wpis[$indeks]['ile_komentarzy'] = $iloscKomentarzy;
                for($i=0;$i<=count($file);$i++){
                    $wpis[$indeks]['tresc'] .= "<br/>".$file[$i];
                }
                $indeks++;
            }
        }
        foreach($wpis as $key=>$value){
            echo "<div id='wpis'>";
                echo "<div id='dane_wpisu'>";
                    echo $value['data']."   ".$value['kto_dodal'];
                echo "</div>";
                echo "<div id='tresc_wpisu'>";
                    echo $value['tresc'];
                echo "</div>";
                echo "<div id='dol_wpisu'>";                    
                if($value['plik'] != NULL){
                    $numerZalacznika =1;
                    echo "<br/>Pliki:";
                    foreach($value['plik'] as $nazwa)
                        echo "<br/><a href='blogi/".$_SESSION['nazwa_bloga']."/".$nazwa."'>Załącznik".$numerZalacznika++."</a>";
                }
                    echo "<br/><a style='cursor: pointer' id='wyswietl_komentarze' href='komentarze.php?blog=".$_SESSION['nazwa_bloga']."&wpis=".$value['nazwa']."'>Komentarzy(".$value['ile_komentarzy'].")</a>";
                    echo "<a id='dodaj_komentarz' href='koment.php?wpis=".$value['nazwa']."&blog=".$_SESSION['nazwa_bloga']."'>Dodaj komentarz</a>";
                echo "</div>";
            echo "</div>";
        }
    
    echo "</div>";
    
        if($_SESSION['login'] == $owner){
            echo "<a id='dodaj_wpis' href='wpisZalogowany.php'>Dodaj wpis</a>";
        }
        
    echo "</div>";
}elseif($nazwaBloga != NULL){
    
    echo "<div id='tytul'>
                    Error Code
          </div>";

    include 'zakladki.php';

    echo "<div id='tresc'>
            Blog o podanej nazwie nie istnieje!
          </div>";
}else{
    header("Location: listaBlogow.php");
}

include 'dolStrony.php';
?>
