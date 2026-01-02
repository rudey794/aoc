<?php
ini_set("memory_limit", "1024M");
   function solve($file){
      echo "part1: ". part1($file)."\n";
      echo "part2: ". part2($file)."\n";
   }
   function part1($file){
      list($fresh, $ingredients)= parse($file);
      $available = 0;
      $fresh_ranges = getFreshRanges($fresh);
      foreach($ingredients as $ingred){
         $fresh = false;
         foreach($fresh_ranges as $range){
            if($ingred >= $range[0] && $ingred  <= $range[1]){
               $fresh = true;
               break;
            }
         }
         if($fresh) $available++;
      }
      return $available;
   }
   function part2($file){
      list($fresh, $ingredients) = parse($file);
      $total = 0;
      $ranges = getFreshRanges($fresh);
      sortRanges($ranges);
      $merged = mergeRanges($ranges);
      var_dump(count($merged));
      foreach($merged as $range){
         $total += ($range[1] - $range[0] + 1);
      }
      return $total;

   }
   function parse($file){
      $data = file_get_contents($file); 
      $parts = preg_split("/\R\s*\R/", $data, 2);
      return [preg_split("/\R/", $parts[0]), preg_split("/\R/", $parts[1])];
   }
   function getFreshRanges($list){
      $fresh = [];
      foreach($list as $items){
         $fresh[] = explode("-", $items);
      }
      return $fresh;
   }
   function getHighestRange($ranges){
      $highest = 0;
      foreach($ranges as $range){
         if($range[1] > $highest) $highest = $range[1];
      }
      return $highest;
   }
   function mergeRanges($ranges){
      $merged = [];
      foreach($ranges as $range){
         [$start, $end] = $range;
         if(empty($merged)){
            $merged[] = $range;
            continue;
         }
         [$lastStart, $lastEnd] = $merged[count($merged) - 1];
         if($start <= $lastEnd+1) {
            $merged[count($merged) - 1][1] = max($lastEnd, $end);
         } else {
            $merged[] = $range;
         }
      }
      var_dump(count($merged));
      return $merged;
   }
   function sortRanges(&$ranges){
      usort($ranges, function ($a, $b){
         return $a[0] <=> $b[0];
      });
   }

?>