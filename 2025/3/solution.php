<?php

   function solve($file){
      $lines = parse($file);
      // echo "part1: ". part1($lines, 2)."\n";
      echo "part2: ". part2($lines)."\n";
   }
   function part1($lines, $length){
      $result = 0;
      foreach($lines as $line){
         $joltage = buildJoltage($line, $length)."\n";
         echo $joltage."\n";
         $result += intval($joltage);
      }
      return $result;
   }
   function part2($lines){
      return part1($lines, 12);
   }
   function buildJoltage($line, $length){
      $strlen = strlen($line);
      $joltage = "";
      $start = 0;
      for($i = 0; $i < $length; $i++){
         $maxChar = 0;
         $end = $strlen - ($length - $i);
         $maxPos = $start;
         for($j = $start; $j <= $end; $j++){
            $char = intval($line[$j]);
            if($char > $maxChar){
               $maxChar = $char;
               $maxPos = $j;
               if($maxChar == 9) break;
            }
         }
         echo "selected char $maxChar at pos $maxPos\n";
         $joltage .= strval($maxChar);
         $start = $maxPos + 1;
      }
      return $joltage;
   }
   function parse($filename) {
      return explode("\n", file_get_contents($filename));
   }
?>