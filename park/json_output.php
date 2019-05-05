
<?php 
  $host = "localhost";
  $user = "root";
  $pass = "";

  $databaseName = "theme_parks";
  $tableName = "tbl_parks";

  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);
  $query = mysql_query("SELECT * FROM tbl_parks");         
  $rows = array();

  while ($row = mysql_fetch_array($query)) {
      $rows[] = $row;
  }
  
  echo json_encode($rows);

?>
