<?php
include 'goraStrony.php';
echo '<body onload="zmienStyle();">
        <div id="main_holder">';
    
    $file = file("blogi/".$_GET['blog']."/info");
    var_dump($_SESSION['nazwa_bloga']);
    $owner = trim($file[0]);
    for($i=2;$i<count($file);$i++)
        if($i == 2)
            $opisBloga = $file[$i];
        else
            $opisBloga .= "<br/>".$file[$i];
    echo "<div id='tytul'>".
                    "Dodawanie komentarza"
          ."</div>";

include 'zakladki.php';

echo "<div id='tresc'>";
    
    echo "<div id='opis_bloga'>";
    echo $opisBloga;
    echo "</div>";
    
    $plikKomentowany = file("blogi/".$_GET['blog']."/".$_GET['wpis'].".w");
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

if($_POST['opis'] == ""){
	echo "<br/><form action='' method='post'>
                <input type='hidden' name='nazwa_bloga' value='".$_GET['blog']."'>
                <input type='hidden' name='nazwa_wpisu' value='".$_GET['wpis']."'>
		<table>
                <tr>
                    <td>Rodzaj komentarza</td><td><select name='rodzaj'><option value='pozytywny'>Pozytywny</option><option value='neutralny'>Neutralny</negatywny><option value='negatywny'>Negatywny</negatywny></select></td>
                </tr>
		<tr>";
        if(!isset($_SESSION['login']))
            echo    "<td>Autor</td><td><input name='autor'></td>";
        else
            echo    "<td>Autor</td><td><input name='autor' readonly value=".$_SESSION['login']."></td>";
	echo	"</tr>
		<tr>
			<td>Tresc komentarza</td><td><textarea name='opis'/></textarea></td>
		</tr>
		<tr>
			<td style='text-align: right;' colspan='2'><input type='reset' value='Wyczyść' style=' margin-right: 1px;' /><button type='submit' name='zapisz' value='zapisz'>Wyślij</button></td>
		</tr>";

	echo "</table></form>"; 
}elseif(strlen($_POST['opis']) > 3){
    
    $nazwa_wpisu = $_POST['nazwa_wpisu'];
    $nazwa_bloga = $_POST['nazwa_bloga'];
    $autor = $_POST['autor'];
    $rodzaj_komentarza = $_POST['rodzaj'];
    $opis = $_POST['opis'];
    
                if(!is_dir("blogi/$nazwa_bloga/$nazwa_wpisu.k"))
                    mkdir("blogi/$nazwa_bloga/$nazwa_wpisu.k");
    
    $list = scandir("blogi/$nazwa_bloga/$nazwa_wpisu.k");
    $numer = count($list) - 1;
    
    $file = fopen("blogi/$nazwa_bloga/$nazwa_wpisu.k/$numer.txt", "w");
    if (flock($file, LOCK_EX)){
        fwrite($file,$rodzaj_komentarza."\r\n");
        fwrite($file,date('Y-m-d H:i:s')."\r\n");
        fwrite($file,$autor."\r\n");
        fwrite($file,$opis);
        flock($file, LOCK_UN);
    }else{
        echo "Wystąpiły problemy z blokadą pliku...";
    }
    fclose($file);
    
    header("Location: blog.php?nazwa=".$_SESSION['nazwa_bloga']);
}

echo "</div>";

include 'dolStrony.php';
?>
