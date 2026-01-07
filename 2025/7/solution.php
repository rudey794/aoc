<?php
   function solve($file){
      $lines = parse($file);
      echo "part1: " . part1($lines) . "\n";
   }
   function part1($lines){
      $total = 0;
      echo $lines[0]."\n";
      for($i = 1; $i < count($lines); $i++){
            $beams = getBeamPositions($lines[$i - 1]);
            $splits = splitBeams($lines, $i, $beams);
            $total += $splits;
            echo $lines[$i].": $splits (total: $total)\n";
      }
      return $total;
   }
   function getBeamPositions($line){
      $positions = [];
      $length = strlen($line);
      for($i=0; $i<$length; $i++){
         if(in_array($line[$i], ["|", "S"])){
            $positions[] = $i;
         }
      }
      return $positions;
   }
   function splitBeams(&$lines, $i, $beams){
      $splits = 0;
      foreach($beams as $beam){
         $char = $lines[$i][$beam];
         if($char === "."){
            $lines[$i][$beam] = "|";
         } elseif($char === "^"){
            $split = false;
            foreach([-1, 1] as $mod){
               if($lines[$i][$beam + $mod] == "."){
                  $split = true;
                  $lines[$i][$beam + $mod] = "|";
               }
            }
            if($split) $splits++;
         }
      }
      return $splits;
   }
   function parse($filename){
      $content = file_get_contents($filename);
      $lines = preg_split('/\R/', trim($content));
      return $lines;
   }
?>