<?php
$txt = "tekst.txt"; 
$fh = fopen($txt, 'w+'); 
if (isset($_POST['field1'])) { // check if both fields are set
   $txt=$_POST['formHoone'] . '-' . $_POST['field1']; 
   file_put_contents('tekst.txt',$txt."\n",FILE_APPEND); // log to data.txt 
   header('Location: https://sisekliima.000webhostapp.com/get_data.php');
   exit();

}
    fwrite($fh,$txt); // Write information to the file
    fclose($fh); // Close the file
?>