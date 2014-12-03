<?php
include 'goraStrony.php';

echo "<div id='tytul'>
        	Zakładanie nowego bloga
      </div>";

include 'zakladki.php';

echo "<div id='tresc'>";

if($_GET['zapisz'] == ""){
	echo "<br/><form action='' method='get'>
		<table>
		<tr>
			<td colspan='2'>Załóż nowego bloga</td>
		</tr>
		<tr>
			<td>Nazwa bloga</td><td><input name='nazwa_bloga'/></td>
		</tr>
		<tr>
			<td>Login</td><td><input name='login'/></td>
		</tr>
		<tr>
			<td>Hasło</td><td><input type='password' name='haslo'/></td>
		</tr>
		<tr>
			<td>Opis bloga</td><td><textarea name='opis'/></textarea></td>
		</tr>
		<tr>
			<td colspan='2'><button style='float: right;' type='submit' name='zapisz' value='zapisz'>Zapisz</button></td>
		</tr>";

	echo "</table></form>"; 
}else{
        
	$nazwa = $_GET['nazwa_bloga'];
	$login = $_GET['login'];
	$haslo = $_GET['haslo'];
        $opis  = $_GET['opis'];
        
        $checkFile = file("users.txt");
        $loginIstnieje = false;
        
        foreach($checkFile as $key=>$value){
            if(trim($value) == $login)
                $loginIstnieje = true;
        }
        
        if($nazwa != "" && $login != "" && $haslo != "" && !$loginIstnieje){
            if(!is_dir("blogi/".$nazwa)){
                if(!is_dir("blogi"))
                    mkdir("blogi");
                
                    if(mkdir("blogi/$nazwa"))
                            echo "Blog o nazwie ".$nazwa." został założony pomyślnie!";
                    
                    $file = fopen("blogi/$nazwa/info.txt", "w");
                    $file2 = fopen("users.txt", "a");
                    
                    fwrite($file,$login."\r\n");
                    fwrite($file,md5($haslo)."\r\n");
                    fwrite($file,$opis);
                    
                    fwrite($file2,$login."\r\n");
            }else
                echo "Blog o nazwie ".$nazwa." już istnieje";
        }elseif($loginIstnieje){
            echo "Podany login już istnieje!";
        }else{
            echo "Wypełnij wszystkie pola!";
        }
}

echo "</div>";

include 'dolStrony.php';
?>
