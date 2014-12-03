<?php
include 'goraStrony.php';

echo "<div id='tytul'>
        	Wylogowywanie
      </div>";

include 'zakladki.php';

echo "<div id='tresc'>";
if($_SESSION['login'] != ""){
    echo "Pomyślnie wylogowano użytkownika ".$_SESSION['login'];
    unset($_SESSION['login']);
    header("Location: listaBlogow.php");
}else{
    header("Location: listaBlogow.php");
}
echo "</div>";

include 'dolStrony.php';
?>
