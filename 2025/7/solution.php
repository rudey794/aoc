<?php
   function solve($file){
      $lines = parse($file);
      echo "part1: " . part1($lines) . "\n";
      echo "part2: " . part2($lines) . "\n";
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
   function part2($lines){
      $total = getPaths($lines, 1, strpos($lines[0], "S"));
      return $total;
   }
   function getPaths($lines, $row, $column){
      $paths = 0;
      $char = $lines[$row][$column] ?? "END";
      if($char == "."){
         $paths += getPaths($lines, $row + 1, $column);
      } else if ($char == "^") {
         $paths += getPaths($lines, $row, $column - 1);
         $paths += getPaths($lines, $row, $column + 1);
      } else {
         return 1;
      }
      
      return $paths;
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