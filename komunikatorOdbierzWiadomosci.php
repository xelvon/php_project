<?php
if (isset($_POST['czas']) && $_POST['czas'] != 0)
    $czasWyslaniaZapytania = date("Y-m-d h:i:s", $_POST['czas']);
else
    $czasWyslaniaZapytania = date("Y-m-d h:i:s", 0);

    $czasModyfikacjiPlikuCzat = filemtime("czat.txt");
    $czasModyfikacjiPlikuCzat = date("Y-m-d h:i:s", $czasModyfikacjiPlikuCzat);
    
    if ($czasModyfikacjiPlikuCzat > $czasWyslaniaZapytania){
        $doWyslania = "";
        flock("czat.txt", LOCK_SH);
        $PlikOdczyt = file("czat.txt");
        
        for($i=count($PlikOdczyt);$i>0;$i--)
            $doWyslania .= $PlikOdczyt[$i];
        
        flock("czat.txt",LOCK_UN);
        
        echo $doWyslania;
        exit();
    }
?>