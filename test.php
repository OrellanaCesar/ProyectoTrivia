<?php
$fp = fopen("txt/PREGUNTAS.txt", "r");
while (!feof($fp)){
    $linea = fgets($fp);
    echo $linea;
}
fclose($fp);

?>