<?php
   function solve($file){
      $parsed = parse($file);
      echo "Part1: " . getAccessibleRolls($parsed) . "\n";
      echo "Part2: " . getRemovedRolls($parsed) . "\n";
   }
   function parse($file){
      return explode("\n", file_get_contents($file));
   }
   function getAccessibleRolls(&$lines, $adjust = false){
      $accessible = 0;
      for($r = 0; $r < count($lines); $r++){
         for($c = 0; $c < strlen($lines[0]); $c++){
            if($lines[$r][$c] != "@") continue;
            $adjacent = getAdjacentStacks($lines, $r, $c);
            if($adjacent < 5){
               $accessible++;
               if($adjust) $lines[$r][$c] = "x";
            }
         }
      }
      return $accessible;
   }
   function getRemovedRolls($lines){
      $removedRolls = 0;
      $rolls = $lines;
      do{
         $removed = 0;
         $removed = getAccessibleRolls($lines, true);
         $removedRolls += $removed;
      } while($removed > 0);
      return $removedRolls;
   }
   function getAdjacentStacks($lines, $row, $col){
      $adjacent = 0;
      $maxrow = count($lines);
      $maxcol =  strlen($lines[0]);
      foreach(range(-1, 1) as $r){
         foreach(range(-1, 1) as $c){
            $rr = $row + $r;
            $cc = $col + $c;
            if($rr < 0 || $rr > $maxrow || $cc < 0 || $cc > $maxcol) continue;
            $char = $lines[$rr][$cc] ?? ".";
            if($char == "@") $adjacent++;
         }
      }
      return $adjacent;
   }
?>