<?php

// 01)
    function isPrime($num){
        if(!$num) return false;
        if($num <=1) return false;
        if($num == 2 ) return true;
        if($num % 2 === 0) return false;

        for($i=3; $i<=sqrt($num); $i+=2){
            if($num % $i === 0) return false;
        }

        return true;
    }

    // $number = 29;
    // if (isPrime($number)) {
    //     echo "$number is a Prime Number.";
    // } else {
    //     echo "$number is Not a Prime Number.";
    // }

// 02) 
    function reverseString($str) {
        if($str === '' || $str[1] === false) return $str;

        $len = strlen($str);
        for($i = 0; $i<=($len/2); $i++){
            $temp = $str[$i];
            $str[$i] = $str[$len-$i-1];
            $str[$len-$i-1] = $temp;
        }
        return $str;
    }

    // $string = "this is s string";
    // echo $reversedString = reverseString($string);

    function reverseStringRecursive($str) {
        if ($str === '' || isset($str[1]) === false) return $str;

        return reverseStringRecursive(substr($str, 1)) . $str[0];
    }

    // $string = "this is s string";
    // echo $reversedString = reverseStringRecursive($string);

    function recursionFactorial($n) {
        if($n <=1) return 1;
        return $n*recursionFactorial($n-1);
    }
    // echo recursionFactorial(5);

    function fibonacci($n){
       $first = 0;
       $second = 1;
       echo "fibonacci series: ";
       
        for($i=1;$i<=$n; $i++ ){
            echo $third = $first + $second. " ";
            $first = $second;
            $second = $third;    
        }
    }
    // $n = 10;
    // fibonacci($n);

    function palindrome($str) {
        if(!isset($str)) return false;
        $len=strlen($str);

        for($i=0; $i<=($len/2); $i++){
            if($str[$i] !== $str[$len-$i-1]) return false;
        }
        return true;
    }

    // if(palindrome('dwerfewtg')) {
    //     echo "palindrome";
    // }else{
    //     echo " not a palindrome";
    // }

    function sumOfDigits($num){
        if(!$num) return -1;
        $sum = 0;
        $len = (string)($num);

        while($num > 0) {
            $sum+= ($num%10);
            $num = (int)($num/10);
        }

        return $sum;
    }

    // echo sumOfDigits(124); 

    function reverseNumber($num){
        if(!$num) return -1;
        $sum = 0;
        $len = (string)($num);

        while($num > 0) {
            $sum= ($sum*10) + ($num%10);
            $num = (int)($num/10);
        }

        return $sum;
    }

    // echo reverseNumber(12345);

    function removeDuplicates($duplicates) {
        $result = [];
        $len = count($duplicates);
        for($i=0; $i<$len; $i++){
           
            $is_duplicate = false;
            for($j=0; $j<count($result); $j++){
                if($duplicates[$i] ===  $result[$j]){
                    $is_duplicate =true;
                    break;
                }
            } 

            if(!$is_duplicate){
                $result[]= $duplicates[$i];
            }
        }

        return $result;
    }

    // print_r(removeDuplicates([2,2,33,3,4,5,5,7,9,10,11,11]));

    function bubbleSortDesc($arr) {
        $len = count($arr);
        for($i=0; $i<$len; $i++){

            // $arr[$j] < $arr[$j+1]  -- Desc
            // $arr[$j] > $arr[$j+1] -- ASC
            for($j=0; $j<$len-$i-1; $j++){
                if($arr[$j] < $arr[$j+1]){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j+1];
                    $arr[$j+1] = $temp;
                }
            }
        }

        return $arr;
    }

    // print_r(bubbleSortDesc([2,2,33,3,4,5,5,7,9,10,11,11]));

    function intersectionArray($arr1, $arr2) {
        $intersectedArray = [];
        $len1 = count($arr1); 
        $len2 = count($arr2); 

        for($i=0; $i<$len1; $i++){
            
            for($j=0; $j<$len2; $j++){
                $is_exists = false;
                if($arr1[$i] === $arr2[$j]){
                    for($k=0; $k<count($intersectedArray); $k++){
                        if($arr1[$i] === $intersectedArray[$k]){
                            $is_exists = true;
                            break;
                        }
                    }
                    if(!$is_exists){
                        $intersectedArray[] = $arr1[$i];
                    }
                }
                
            }
        }
        return $intersectedArray;
    }

    // print_r(intersectionArray([1,2,2,3,4,5,5,6], [1,2,3,4,5,5,6]));

    function Duplicates($arr) {
        $result = [];
        $len = count($arr);

        for($i=0; $i<$len; $i++){
            for($j=$i+1; $j<$len; $j++){
                if($arr[$i] === $arr[$j]){
                    $is_exsits = false;
                    for($k=0; $k<count($result); $k++){
                        if($arr[$i] === $result[$k]){
                            $is_exsits = true;
                            break;
                        }
                    }

                    if(!$is_exsits){
                        $result[]=$arr[$i];
                    }
                }
            } 
        }

        return $result;
    }

    // print_r(Duplicates([2,2,3,4,5,5,6]));

    function anagrams($str1, $str2) {
        $len1 = strlen($str1);
        $len2 = strlen($str2);

        if($len1 !== $len2) return false;

        $str1_freq=[];
        for($i=0; $i<$len1; $i++){
            $str1_freq[$str1[$i]] = ($str1_freq[$str1[$i]] ?? 0 ) +1; 
        }

        
        $str2_freq=[];
        for($i=0; $i<$len2; $i++){
            $str2_freq[$str2[$i]] = ($str2_freq[$str2[$i]] ?? 0 ) +1; 
        }

        $isAnagram = true;

        for($i=0; $i<count($str2_freq); $i++){
            if($str1_freq[$str1[$i]] !== $str2_freq[$str1[$i]]){
                $isAnagram = false;
                break;
            }
        }

        return $isAnagram;
    }

    // if(anagrams("listen", "silent")) {
    //     echo "anagrams";
    // }else{
    //     echo "not a anagrams";
    // }

    function flatten($arr) {
        $result = [];
        foreach($arr as $val){
            if(is_array($val)) {
                $falt = flatten($val);
                foreach($falt as $ft){
                    $result[] = $ft; 
                }
            }else{
                $result[] = $val;  
            }
        } 

        return $result;
    }    

    // print_r(flatten([1,[2,3,2],[4,[5,6]]]));

    function perfectNo($no) {
        if($no <= 1) return false;
        $sum = 0;
        for($i=1; $i<=$no/2; $i++) {
            if($no%$i === 0){
                $sum += $i;
            } 
        }

        return $sum === $no;
    }

    // if(perfectNo(6)) {
    //     echo "perfect number";
    // }else{ 
    //     echo "not a perfect number";
    // }

    function decimalToBinary($num){
        if($num === 0) return "0";
        
        $binary = '';
        while($num > 0){
            $remainder = $num%2;
            $binary = $remainder.$binary;
            $num = (int)($num/2);
        }
        return $binary;
    }

    // echo decimalToBinary(25);

    function binaryToDecimal($num){
        $len = strlen((string)($num));
        $decimal=0;

        for($i=0; $i < $len; $i++){
            $binary = $num[$len-$i-1];
            if($binary == 1){
                $decimal = $decimal + pow(2,$i);
            }
        }

        return $decimal;

    }
    
    // echo binaryToDecimal('11001');

    function isLeapYear($year) {
        if(($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0) ){
            return true;
        }
        return false;
    }

    // if(isLeapYear(2000)) {
    //     echo "leap year";
    // }else{
    //     echo " not a leap year";
    // }

    function pyramidStars($n) {
        // COntrol Loop
        for($i = 0; $i<$n; $i++) {

            for($j=$n-$i-1; $j > 0; $j--) {
                echo " ";
            }

            for($j=0; $j<=$i; $j++) {
                echo "*";
            }
            echo"\n";
        }
    }

    // pyramidStars(5);

    function pyramidReverseStars($n) {
        for($i = 0; $i<$n; $i++) {
            
            for($j=$n; $j > $n-$i; $j--) {
                echo" ";
            }

            for($j=$n-$i; $j > 0; $j--) {
                echo"*";
            }

            echo "\n";
        }
    }
    // pyramidReverseStars(5);

    function pyramidPatternStars($n){
        for($i=0; $i<$n; $i++) {

            for($j=0; $j < $n-$i; $j++){
                echo " ";
            }
            for($j=0; $j< 2*$i+1; $j++) {
                echo"*";
            }
            echo "\n";
        }
    }
    // pyramidPatternStars(5);

    function pyramidPatternReverseStars($n) {
        for($i=0; $i<$n; $i++){

            for($j=0; $j<$i; $j++ ){
                echo " ";
            }
            for($j=2*($n-$i)-1; $j>0; $j--){
                echo"*";
            }
            echo"\n";
        }
    }
    // pyramidPatternReverseStars(5);

    function floydTriangle($n){
        $count=0;
        for($i=0; $i<$n; $i++){

            for($j=0; $j<$n-$i; $j++){
                echo" ";
            }
            for($j=0; $j<=$i; $j++){
                echo ++$count.' ';
            }
            echo"\n";
        }
    }

    // floydTriangle(5);

    function pascalTriangle($n) {
        for($i=0; $i<$n; $i++){
            $no = 1;
            for($j=0; $j<$n-$i; $j++){
                echo" ";
            }
            for($j=0; $j<=$i; $j++){
                echo $no." ";
                $no = $no*($i-$j)/($j+1);
            }
            echo"\n";
        }
    }

    // pascalTriangle(5);