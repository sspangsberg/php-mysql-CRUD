<?php

try
{
  $db = new PDO('mysql:host=localhost;dbname=reviewdb','root','root');

  $json_data = file_get_contents('data.json');
  $data = json_decode($json_data,true); //decode the json file and return as array

  $stmt = $db->prepare('INSERT INTO Review (FullName, Contents) VALUES (:fullname, :contents)');

  foreach ($data as $row) //iterate through each row/object in the json file
  {
    $stmt->bindParam(':fullname', $row['FullName']);
    $stmt->bindParam(':contents', $row['Contents']);
    $stmt->execute();  
  }
}
catch(PDOException $ex)
{
  print($ex->getMessage());
}

?>