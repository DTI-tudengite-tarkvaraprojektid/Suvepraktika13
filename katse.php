<?php
  $servername = "localhost";
  $username = "id6141049_suvepraktika";
  $password = "ryhm13";
  $dbname = "id6141049_sensor";
  //mysql and db connection

  $con = new mysqli($servername, $username, $password, $dbname);

  if ($con->connect_error) {  //error check
    die("Connection failed: " . $con->connect_error);
  }
  else
  {

  }


  $DB_TBLName = "sensor"; 
  $filename = "Salvestatud andmed";  //your_file_name
  $file_ending = "xls";   //file_extention

  header("Content-Type: application/xls");    
  header("Content-Disposition: attachment; filename=$filename.xls");  
  header("Pragma: no-cache"); 
  header("Expires: 0");

  $sep = "\t";

  $sql="SELECT * FROM $DB_TBLName"; 
  $resultt = $con->query($sql);
  while ($property = mysqli_fetch_field($resultt)) { //fetch table field name
      echo $property->name."\t";
  }

  print("\n");    

  while($row = mysqli_fetch_row($resultt))  //fetch_table_data
  {
      $schema_insert = "";
      for($j=0; $j< mysqli_num_fields($resultt);$j++)
      {
          if(!isset($row[$j]))
              $schema_insert .= "NULL".$sep;
          elseif ($row[$j] != "")
              $schema_insert .= "$row[$j]".$sep;
          else
              $schema_insert .= "".$sep;
      }
      $schema_insert = str_replace($sep."$", "", $schema_insert);
      $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
      $schema_insert .= "\t";
      print(trim($schema_insert));
      print "\n";
  }
?>