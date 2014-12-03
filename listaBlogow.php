<?php
include 'goraStrony.php';

echo "<div id='tytul'>
        	Lista założonych blogów
      </div>";

include 'zakladki.php';

echo "<div id='tresc'>";

$lista = scandir("blogi/");
$indeks = 0;
foreach($lista as $key=>$value){
    if($key > 1){
        $file = file("blogi/$value/info.txt");
        $blog[$indeks]['nazwa'] = $value;
        $blog[$indeks++]['owner'] = trim($file[0]);
    }
}
    
echo "<table id='lista_blogow'>";
echo "<tr><td>Właściciel</td><td>Nazwa bloga</td></tr>";
foreach($blog as $key=>$value){
    echo "<tr><td>".$value['owner']."</td><td><a href='blog.php?nazwa=".$value['nazwa']."'>".$value['nazwa']."</a></td></tr>";
}
echo "</table>";

echo "</div>";

include 'dolStrony.php';
?>
