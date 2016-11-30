<?php 
$hostname = "localhost";
$username = "root";
$password = "root";
$database = "my-db-snap";
$connection = mysqli_connect($hostname, $username, $password, $database);

// check connention
//	if(mysqli_connect_errno()){
//		die("Failed to connect to MySQL: (". mysqli_connect_errno().")". mysqli_connect_errno());
//	}else {
//		echo "we are connected";
//	}


/*----------------------DATABASE QUERYING FUNCTIONS-----------------------*/
//SELECT - used when expecting single OR multiple results
//returns an array that contains one or more associative arrays
function fetch_all($query)
{
  $data = array();
  global $connection;
  $result = $connection->query($query);
  while($row = mysqli_fetch_assoc($result)) 
  {
    $data[] = $row;
  }
  return $data;
}
//SELECT - used when expecting a single result
//returns an associative array
function fetch_record($query)
{
  global $connection;
  $result = $connection->query($query);
  return mysqli_fetch_assoc($result);
}
//used to run INSERT/DELETE/UPDATE, queries that don't return a value
//returns a value, the id of the most recently inserted record in your database
function run_mysql_query($query)
{
  global $connection;
  $result = $connection->query($query);
  return $connection->insert_id;
}

function escape_this_string($string)
{
  global $connection;
  return $connection->real_escape_string($string);
}

?>