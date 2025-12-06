<?php
   function solve($file){
      $part1 = 0;
      $lines = explode(",", file_get_contents($file));
      foreach($lines as $line){
         list($start, $end) = array_map('intval', explode("-", $line));
         for($i = (int)$start; $i <= (int)$end; $i++){
            if(preg_match("/^(\d+)\1$/", (string)$i)){
               $part1 += $i;
            }
         }
      }        
      echo "part1: $part1\n";
   }
?>