<?php
include 'goraStrony.php';

echo "<div id='tytul'>
        	Lista założonych blogów
      </div>";

include 'zakladki.php';

echo "<div id='tresc'>";
if($_POST['login'] == "" && $_POST['haslo'] == ""){

	echo "<br/><form action='' method='post'>
		<table>
		<tr>
			<td colspan='2'>Logowanie do bloga</td>
		</tr>
		<tr>
			<td>Login</td><td><input name='login'/></td>
		</tr>
		<tr>
			<td>Hasło</td><td><input type='password' name='haslo'/></td>
		</tr>
		<tr>
			<td colspan='2'><button type='submit' name='loguj' value='loguj'>Zaloguj</buton></td>
		</tr>";

	echo "</table></form>"; 
}else{
    
    $login = $_POST['login'];
    $haslo = md5($_POST['haslo']);
    
    $lista = scandir("blogi/");
    foreach($lista as $key=>$value){
        if($key > 1){
            $file = file("blogi/$value/info.txt");
            if(trim($file[0]) == $login){
                $nazwaBloga = $value;
                $wlascicielBloga = trim($file[0]);
                $hasloBloga = trim($file[1]);
                break;
            }
        }
    }
    
    $file = file("blogi/$nazwaBloga/info.txt");
    
    if($wlascicielBloga == $login && $hasloBloga == $haslo){
        echo "Zalogowano się pomyślnie do systemu!";
        $_SESSION['login'] = $login;
        $_SESSION['nazwa_bloga_zalogowanego'] = $nazwaBloga;
        header("Location: blog.php?nazwa=".$nazwaBloga);
    }else{
        echo "Podano błędne dane logowania!";
    }
}


echo "</div>";

include 'dolStrony.php';
?>
