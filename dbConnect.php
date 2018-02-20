<?php

function getDb() {
  $host = "localhost";
  $port = "5432";
  $dbname = "votricrum";
  $user = "postgres";
  $password = "postgres";

 $connectionString = "host=$host port=$port dbname=$dbname user=$user password=$password";

  $db = pg_connect($connectionString) or die ("Connection Failed!");

  return $db;
}

?>