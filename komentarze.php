<?php
include 'goraStrony.php';
    
    $file = file("blogi/".$_SESSION['nazwa_bloga']."/info.txt");
    $owner = trim($file[0]);
    for($i=2;$i<count($file);$i++)
        if($i == 2)
            $opisBloga = $file[$i];
        else
            $opisBloga .= "<br/>".$file[$i];
    echo "<div id='tytul'>".
                    $_SESSION['nazwa_bloga']
          ."</div>";

include 'zakladki.php';

echo "<div id='tresc'>";
    
    echo "<div id='opis_bloga'>";
    echo $opisBloga;
    echo "</div>";
    
    $plikKomentowany = file("blogi/".$_SESSION['nazwa_bloga']."/".$_GET['wpis'].".OOO");
    $wpis['nazwa'] = $_GET['wpis'];
    $wpis['data'] = substr($wpis['nazwa'],0,4).".".substr($wpis['nazwa'],4,2).".".substr($wpis['nazwa'],6,2)." ".substr($wpis['nazwa'],8,2).":".substr($wpis['nazwa'],10,2).":".substr($wpis['nazwa'],12,2);
    $wpis['kto_dodal'] = $owner;
    for($i=0;$i<count($file);$i++){
        $wpis['tresc'] .= "<br/>".$plikKomentowany[$i];
    }
    echo "<div id='wpis'>";
        echo "<div id='dane_wpisu'>";
            echo $wpis['data']."   ".$wpis['kto_dodal'];
        echo "</div>";
        echo "<div id='tresc_wpisu'>";
            echo $wpis['tresc'];
        echo "</div>";
    echo "</div>";
    
    $lista = scandir("blogi/".$_SESSION['nazwa_bloga']."/".$wpis['nazwa'].".k");

    $indeks = 0;
    foreach($lista as $key=>$value){
        if($key > 1){
            $file = file("blogi/".$_SESSION['nazwa_bloga']."/".$wpis['nazwa'].".k/$value");
            $komentarz[$indeks]['rodzaj'] = trim($file[0]);
            $komentarz[$indeks]['data'] = trim($file[1]);
            $komentarz[$indeks]['autor'] = trim($file[2]);
            
            for($i=3;$i<=count($file);$i++){
                $komentarz[$indeks]['tresc'] .= "<br/>".$file[$i];
            }
            $indeks++;
        }
    }
    
    echo "<div id='komentarze'>";
    foreach($komentarz as $key=>$value){
        echo "<div id='komentarz'>";
        if($value['rodzaj'] == 'pozytywny')
            echo "<div style='color: green;' id='dane_komentarza'>";
        else
            echo "<div style='color: red;' id='dane_komentarza'>";
            echo $value['data']."   ".$value['autor'];
        echo "</div>";
        echo "<div id='tresc_komentarza'>";
            echo $value['tresc'];
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
    
echo "</div>";

include 'dolStrony.php';
?>
