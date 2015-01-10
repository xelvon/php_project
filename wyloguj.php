<?php
include 'goraStrony.php';
echo '<body onload="zmienStyle();">
        <div id="main_holder">';

echo "<div id='tytul'>
        	Wylogowywanie
      </div>";

include 'zakladki.php';

echo "<div id='tresc'>";
if($_SESSION['login'] != ""){
    echo "Pomyślnie wylogowano użytkownika ".$_SESSION['login'];
    session_destroy();
    header("Location: listaBlogow.php");
}else{
    header("Location: listaBlogow.php");
}
echo "</div>";

include 'dolStrony.php';
?>
