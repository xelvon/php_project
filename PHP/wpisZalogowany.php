<?php
include 'goraStrony.php';
echo '<body onload="zmienStyle();">
        <div id="main_holder">';

echo "<div id='tytul'>
            Dodawanie wpisu
      </div>";

include 'zakladki.php';

echo "<div id='tresc'>";

if($_SESSION['login'] != "" && $_POST['opis'] == ""){
	echo "<br/><form action='' method='post'>
		<table>
                <tr>
                    <td colspan='2'>Wpis do bloga</td>
                </tr>
		<tr>
			<td colspan='2'><textarea name='opis'/></textarea></td>
		</tr>
		<tr>
			<td colspan='2'><button style='float: right;' type='submit' name='zapisz' value='zapisz'>Wyślij</button><input type='reset' value='Wyczyść' style='float: right; margin-right: 1px;' /></td>
		</tr>";

	echo "</table></form>"; 
}elseif($_SESSION['login'] == ""){
    header("Location: listaBlogow.php");
}elseif(strlen($_POST['opis']) > 3){
    $opis = $_POST['opis'];
    $data = date('Y').date('m').date('d').date('H').date('i').date('s')."00";
    $data = $data -1; $data = $data+1;
    
    while(file_exists($data."w")){
        $data +=1;
    }
    
    $file = fopen("blogi/".$_SESSION['nazwa_bloga_zalogowanego']."/$data.w", "w");
    fwrite($file,$opis."\r\n");
    
    header("Location: blog.php?nazwa=".$_SESSION['nazwa_bloga_zalogowanego']);
}

echo "</div>";

include 'dolStrony.php';
?>
