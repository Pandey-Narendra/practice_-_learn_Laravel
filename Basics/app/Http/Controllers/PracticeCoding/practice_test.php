<?php

// 01) 

    function isPrime($num){
        if($num <= 1) {
            return false;
        }else if($num === 2){
            return 1;
        }else if($num %2 === 0){
            return false;
        }


        for($i=3; $i <= sqrt($num); $i+=2){
            
            if($num%$i === 0){
                return false;
            }
        }

        return 1;
    }

// 02)

    function reverseString($str){
        if($str === ' ' || $str[1] === false){
            return $str;
        }

        $len = strlen($str);

        for($i=0; $i<($len/2); $i++){
            $temp = $str[$i];
            $str[$i] = $str[$len-$i-1];
            $str[$len-$i-1] = $temp;
        }

        return $str;
    }

//    echo reverseString("this is s string");

// 02.1) reverseStringRecursive()
        
    function reverseStringRecursive($str){
        $len = strlen($str);

        // isset($string[1]) === false
        if($len === " " || $len === 1){
            return $str;
        }

        return reverseStringRecursive(substr($str, 1)) . $str[0];
    }

    // echo reverseStringRecursive("this is s string");

// 03)

    function recursionFactorial($n) {
        if($n <= 1) {
            return 1;
        }

        return $n*recursionFactorial($n-1);
    }

    // echo recursionFactorial(5);

// 04)   
    function palindrome($str){
        $len= strlen($str);

        for($i=0; $i<($len/2); $i++){
            if($str[$i] !== $str[$len-$i-1]){
                return false;
            }
        }

        return true;
    }

    // if(palindrome('abba')) {
    //     echo "palindrome";
    // }else{
    //     echo " not a palindrome";
    // }

// 05)

    function sumOfDigits($num) {
        $sum = 0;

        while($num > 0){
            // $sum = ($sum*10) +  ($num%10);
             $sum +=  ($num%10);
            $num = (int) ($num/10);
        }

        return $sum;
    }

    // echo sumOfDigits(123);

// 06) 

    function countDigits($num) {
        $len = 0;

        while($num > 0) {
            ++$len;
            $num = (int) ($num/10);
        }

        return $len;
    }

    // echo countDigits(123);

// 07) 
    
    function capitalizeWords($str){
        $capNext = true;
        $len  = strlen($str);

        for($i=0; $i<$len; $i++){
            if($str[$i] == ' '){
              $capNext = true;  
            }else{
                $ch = $str[$i];
                if($capNext && $ch >= 'a' && $ch <= 'z'){
                    $str[$i] = chr(ord($ch)-32);
                    $capNext = false;
                }
            }
        }

        return $str;
    }
    
    // echo capitalizeWords("this is a php test");

// 08)

    function removeDuplicates($arr) {
        $len = count($arr);
        $noDuplicates = [];
        $duplicates_freq = [];

        for($i=0; $i < $len; $i++){
             
            // For Frequency count only
            for($j=$i+1; $j < $len; $j++){     
                if($arr[$i] === $arr[$j]){
                    $duplicates_freq[$arr[$i]] = ($duplicates_freq[$arr[$i]] ?? 2) + 1;
                    break;
                }
            }
            
            // For removing duplicates only
            $isexists = false;
            for($k=0; $k < count($noDuplicates); $k++){
                if($arr[$i] === $noDuplicates[$k]){
                    $isexists = true;
                    break;
                }
            }
            if(!$isexists){
                $noDuplicates[] = $arr[$i];
                // $duplicates_freq[$arr[$i]] = ($duplicates_freq[$arr[$i]] ?? 1);
            }
        }

        // print_r($duplicates_freq);
        // print_r($noDuplicates);
    }

    // removeDuplicates([2,2,33,3,4,5,5,7,9,10,11,11]);

// 09) 

    function intersectionArray($arr1, $arr2) {
        $intersected=[];
        // Control Loop
        for($i=0; $i<count($arr1); $i++){
            
            $isIncluded = false;
            // Finding common/intersecting element
            for($j=0; $j<count($arr2); $j++){
                if($arr1[$i] === $arr2[$j]){
                    
                    // if already included
                    for($k=0; $k<count($intersected); $k++){
                        if($arr1[$i] === $intersected[$k]){
                            $isIncluded = true;
                            break;
                        }
                    }
                }
            }

            if(!$isIncluded){
                $intersected[] = $arr1[$i];
            }

        }

        return $intersected;
    }

    // print_r(intersectionArray([2,2,3,4,5,5,6], [1,2,3,4,5,5,6]));

// 10) 
        function rotateArray($arr, $int){

        }

// 11) 
       function anagrams($str1, $str2) {
            if(strlen($str1) !== strlen($str2)){
                return false;
            }

            $len_str1 = strlen($str1);
            $str1 = strtolower($str1);
            $freq_str1 = [];

            for($i=0; $i < $len_str1; $i++ ){
                $freq_str1[$str1[$i]] = ($freq_str1[$str1[$i]] ?? 0) + 1;
            }
            
            $len_str2 = strlen($str2);
            $str2 = strtolower($str2);
            $freq_str2 = [];
            
            for($i=0; $i < $len_str2; $i++ ){
                $freq_str2[$str2[$i]] = ($freq_str2[$str2[$i]] ?? 0) + 1;
            }

            for($i=0; $i < $len_str1; $i++ ){
                if($freq_str1[$str1[$i]] !== $freq_str2[$str1[$i]]){
                    return false;
                }  
            }

            return true;
        }   

        // if(anagrams("listen", "silent")) {
        //     echo "anagrams";
        // }else{
        //     echo "not a anagrams";
        // }

// 12) 

    function flatten($arr){
        $result = [];

        foreach($arr as $key => $val){
            if(is_array($val)){
                $flat = flatten($val);
                
                foreach($flat as $ft){
                    $result[] =$ft;
                }
            }
            else{
                $result[] =$val;
            }
        }

        return $result;
    }

    // print_r(flatten([1,[2,3],[4,[5,6]]]));

// 13)

    function armstrong($no){
        $num = $no;
        $sum = 0;

        $len = strlen((string) $no);
        // $sum += ($no % 10) ** $len;
        while($no > 0){
            $power = ($no%10)**$len;
            $sum += $power;
            $no = (int) ($no/10);
        }

        return $sum === $num;
    }

    if(armstrong(153)) {
        echo "armstrong number";
    }else{ 
        echo "not a armstrong number";
    }