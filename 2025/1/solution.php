<?php
   function solve($file){
    $lines = parse($file);
    $dial = 50;
    $password1 = 0;
    $password2 = 0;
    foreach($lines as $line){
        $dir = ($line[1] == "L") ? -1 : 1;
        $line[2] = $line[2];
        while ($line[2] > 0){
            $dial += $dir;
            $line[2]--;
            if($dial < 0){ $dial += 100;} else if ($dial > 99){ $dial -= 100;}
            if($dial == 0){ $password2++; }
        }
        if($dial == 0){ $password1++; }
    }
    echo "1: $password1, 2: $password2\n";
   }
   function parse($file){
    $lines = file($file);
    $output = [];
    foreach($lines as $line){
        preg_match("/(\w)(\d+)/", trim($line), $output[]);
    }
    return $output;
   }
?>