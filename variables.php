<?php
require_once "/home/c/ca/cao/path_names.php";
require_once PDO_CONFIG;


//TERM ID From the database
$term_id_sql="SELECT id FROM Term WHERE NOW() BETWEEN start AND end;";
$term_id=get_sql($term_id_sql);
$TERM_ID=$term_id[0]['id'];

define('TERM_ID',$TERM_ID);
?>
