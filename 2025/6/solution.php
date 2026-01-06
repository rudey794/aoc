<?php
   function solve($file){
      $lines = parse($file);
      echo "part1: " . part1($lines) . "\n";
   }
   function part1($lines){
      [$transposed, $operators] = transpose($lines);
      $total = 0;
      foreach($operators as $key=>$operator){
         $result = 0;
         switch($operator){
            case "+":
               $result = array_sum($transposed[$key]);
               break;
            case "*":
               $result = array_product($transposed[$key]);
               break;
         }
         $total += $result;
      }
      return $total;
   }
   function transpose($lines){
      $transposed = [];
      $operators = [];
      if(empty($lines)) return [$transposed, $operators];
      // assume last line contains operators
      $last = array_pop($lines);
      $operators = $last;
      foreach($lines as $row){
         foreach($row as $i=>$val){
            $transposed[$i][] = is_numeric($val) ? (int)$val : $val;
         }
      }
      return [$transposed, $operators];
   }
   function parse($filename){
      $content = file_get_contents($filename);
      if($content === false) return [];
      $rawLines = preg_split('/\R/', trim($content));
      $lines = [];
      foreach($rawLines as $line){
         if(trim($line) === '') continue;
         preg_match_all('/\S+/', $line, $matches);
         $lines[] = $matches[0];
      }
      return $lines;
   }
?>