<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'readyand_tee');    // DB username
define('DB_PASSWORD', 'uv7O$_pJh5.k');    // DB password
define('DB_DATABASE', 'readyand_db');      // DB name
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");
?>
