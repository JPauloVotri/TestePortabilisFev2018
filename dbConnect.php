<?php

function getDb() {
  /*$host = "localhost";
  $port = "5432";
  $dbname = "votricrum";
  $user = "postgres";
  $password = "postgres";*/

  $host = "ec2-54-163-234-99.compute-1.amazonaws.com";
  $port = "5432";
  $dbname = "d23pmlmrk0m2v1";
  $user = "prqocqtrazgsbj";
  $password = "7d645efc88f6521a97ee905fd71d57333f91334b9687c1ded64bdf440695457e";

 $connectionString = "host=$host port=$port dbname=$dbname user=$user password=$password";

  $db = pg_connect($connectionString) or die ("Connection Failed!");

  return $db;
}

?>