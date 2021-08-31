<?php

//
/*
connection to data base 
*/
//

$sql = new mysqli("localhost", "root", "", "");
if($sql->connect_error) {
die("connetion failed: " . $sql->connect_error);
}
