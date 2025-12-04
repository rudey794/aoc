<?php
if(empty($argv[1])){
    echo "no day provided";
    die();
}
$day = $argv[1];
$file = (!empty($argv[2])) ? "input" : "test";
require("$day/solution.php");
solve("$day/$file.txt");
?>