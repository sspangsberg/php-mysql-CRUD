<?php

try
{
  $db = new PDO('mysql:host=localhost;dbname=reviewdb','root','root');

  $stmt = $db->prepare('SELECT * FROM Review');
  $stmt->execute();
  $json_final_data = array();

  foreach ($stmt as $row) 
  {
    $json_temp_array['FullName'] = $row['FullName'];
    $json_temp_array['Contents'] = $row['Contents'];
    array_push($json_final_data, $json_temp_array); //add this row ($json_temp_array) to the end of the array
  }
  echo json_encode($json_final_data);
}
catch(PDOException $ex) {
  print($ex->getMessage());
}

?>




