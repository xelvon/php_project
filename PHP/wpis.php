<?php
include 'goraStrony.php';
echo '<body onload="zmienStyle(); formValidator();">
        <div id="main_holder">';

echo "<div id='tytul'>
            Dodawanie wpisu
      </div>";

include 'zakladki.php';

echo "<div id='tresc'>";

$login = $_POST['login'];
$podaneHaslo = md5($_POST['haslo']);
$opis = $_POST['opis'];

$lista = scandir("blogi/");
$nazwaBloga = "";

if($login != "")
for($i=2;$i<count($lista);$i++){
    $file = file("blogi/".$lista[$i]."/info");
    if(trim($file[0]) == $login){
        $nazwaBloga = $lista[$i];
        $haslo = trim($file[1]);
    }
}

if($login == "" && $opis == ""){
	echo "<br/><form action='' method='post' enctype='multipart/form-data'>
		<table id='form_table'>
                <tr>
                    <td colspan='2'>Wpis do bloga</td>
                </tr>
		<tr>
			<td>Login</td><td><input name='login'/></td>
		</tr>
		<tr>
			<td>Hasło</td><td><input type='password' name='haslo'/></td>
		</tr>
		<tr>
			<td>Data</td><td><input type='date' value=".date('Y-m-d')." name='data'/></td>
		</tr>
                <tr>
                        <td>Godzina</td><td><input type='text' name='godzina' value=".date('H:i')."></td>
                </tr>
		<tr>
			<td>Tresc wpisu</td><td><textarea name='opis'/></textarea></td>
		</tr>
		<tr>
			<td colspan='2'>Pliki</td>
		</tr>
		<tr>
			<td>1</td><td><input type='file' name='file1'/></td>
		</tr>
		<tr>
			<td>2</td><td><input type='file' name='file2'/></td>
		</tr>
		<tr>
			<td>3</td><td><input type='file' name='file3'/></td>
		</tr>
		<tr>
			<td style='text-align: center;' colspan='2'><button type='button' name='dodaj_plik'>Dodaj plik</button></td>
		</tr>
		<tr>
			<td colspan='2'><button style='float: right;' type='submit' name='zapisz' value='zapisz'>Wyślij</button><input type='reset' value='Wyczyść' style='float: right; margin-right: 1px;' /></td>
		</tr>";

	echo "</table></form>"; 
}elseif($nazwaBloga != ""){
    if($podaneHaslo == $haslo){
        if(strlen($_POST['opis']) > 10){
            $opis = $_POST['opis'];
            $data = substr($_POST['data'],0,4).substr($_POST['data'],5,2).substr($_POST['data'],8,2).substr($_POST['godzina'],0,2).substr($_POST['godzina'],3,2).date('s');
            $data = $data -1; $data = $data+1;
            
            while(file_exists($data."w")){
                $data +=1;
            }
            
            $file = fopen("blogi/".$nazwaBloga."/$data.w", "w");
            if (flock($file, LOCK_EX)){
                fwrite($file,$opis."\r\n");

                $i=1;
                $error = false;
                foreach($_FILES as $key=>$value){
                        if($value['size']>0){
                            $tmp_name = $value["tmp_name"];
                            $extension = pathinfo($value["name"]);
                            $extension = $extension['extension'];
                            $destination = "blogi/".$nazwaBloga."/".$data.$i.".".$extension;
                            if(!move_uploaded_file($tmp_name, $destination))
                                    $error = true;
                            $i++;
                        }
                }

                echo "Wpis dodano pomyślnie";
                if ($error)
                    echo "<br/>Wystąpił błąd w wczytywaniu plików!";
                elseif($i >1)
                    echo "<br/>Pomyślnie dodano ".($i-1)." plików";
                
                flock($file, LOCK_UN);
            }else{
                echo "Wystąpiły problemy z blokadą pliku...";
            }
        }else{
            echo "Podany wpis jest zbyt krótki!";
        }
    }else{
        echo "Wprowadzone hasło jest nieprawidłowe";
    }
}else{
    echo "Nie istnieje blog dla podanych danych!";
}

echo "</div>";

include 'dolStrony.php';
?>
