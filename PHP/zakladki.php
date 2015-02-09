<?php
echo '<div id="menu">
	<div class="odnosniki">
        <h3>Odnosniki</h3>
            <a href="nowy.php">Zakładanie bloga</a>
            <a href="listaBlogow.php">Lista blogów</a>
            <a href="wpis.php">Szybki wpis</a>
            <a href="komunikator.php">Komunikator</a>';

if($_SESSION['login'] == "")
    echo    '<a href="logowanie.php" />Zaloguj</a>';

if($_SESSION['login'] != ""){
    echo    '<a href="blog.php?nazwa='.$_SESSION['nazwa_bloga_zalogowanego'].'" />Mój blog</a>';
    echo    '<a href="wyloguj.php" />Wyloguj</a>';
}

echo    '</div>
</div>';

?>
