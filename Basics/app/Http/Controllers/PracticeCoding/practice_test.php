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

    // if(armstrong(153)) {
    //     echo "armstrong number";
    // }else{ 
    //     echo "not a armstrong number";
    // }

// 14)

    function perfectNo($no) {
        if($no <= 1) return false;
        
        $sum=1;
        for($i = 2; $i<=($no/2); $i++){
            if($no%2 === 0){
                $sum += $i;
            }
        }

        return $sum===$no;
    }
    
    // if(perfectNo(6)) {
    //     echo "perfect number";
    // }else{ 
    //     echo "not a perfect number";
    // }

// 15)

    function decimalToBinary($num) {
        
        if($num === 0) return "0";

        $binary = '';
        while($num > 0){
            $remainder = $num%2;
            $binary = $remainder.$binary;
            $num = (int) $num/2;
        }

        return $binary;
    }

    // echo decimalToBinary(25);

// 16) 

    function binaryToDecimal(string $num) {
        $len = strlen((string) $num);
        $decimal = 0;
        for($i=0; $i<$len; $i++){
            
            $binary = $num[$len-1-$i];
            
            if($binary == 1){
                $decimal += pow(2,$i);
            }
        }

        return $decimal;
    }    

    // echo binaryToDecimal('11001');

// 17) gcd(a,b) = gcd(b, a%b)

    function gcd($a, $b){
        while($b > 0){
            $temp = $b;
            $b = $a%$b;
            $a = $temp;
        }

        return $a;
    }    

    // echo gcd(48,18);
 
// 18) lcm(a,b) = (a*b)/gcd(a,b)

    function lcm($a, $b){
        return ($a*$b)/gcd($a,$b);
    }

    // echo lcm(12,18);

// 19)

    function primeNoInRange($start, $end) {
        $prime_no = [];
        // control loop
        for($i= $start; $i<=$end; $i++) {
            if($i<=1) continue;

            // check from 2 sqrt($i)
            $is_prime = true;
            for($j=2; $j<=sqrt($i);$j++){
                if($i%$j === 0 ){
                    $is_prime= false;
                    break;
                }
            }

            if($is_prime){
                $prime_no[]= $i;
            }
        }

        return $prime_no;
    }    

    // print_r(primeNoInRange(10, 30));

// 20)     

     function isPalindromeNumber(int $num) : bool {
            $original = $num;
            $reverse = 0;

            while ($num > 0) {
                $digit = $num % 10;   
                $reverse = ($reverse * 10) + $digit;
                $num = intdiv($num, 10); 
            }

            return $original === $reverse;
        }

        // $number = 121;
        // if (isPalindromeNumber($number)) {
        //     echo "$number is a Palindrome";
        // } else {
        //     echo "$number is NOT a Palindrome";
        // }

// 21)
    function pyramidStars(int $n){
        
        // controll loop 
        for($i=0; $i<$n; $i++){

            for($j=0; $j < $n-1-$i; $j++){
                echo' ';
            }

            for($j=0; $j<=$i;$j++){
                echo "*";
            }
            echo"\n";
        }
    }

    // pyramidStars(5);

// 22) 
    
    function pyramidReverseStars($n){
        // controll loop
        for($i=0; $i<$n; $i++){

            for($j=$n; $j>$n-$i; $j--){
                echo" ";
            }

            for($j=$n-$i; $j>0; $j--){
                echo"*";
            }
            echo"\n";
        }
    }

    // pyramidReverseStars(5);

// 23) 
    function pyramidPatternStars($n){
        // controll loop
        for($i=0; $i<$n; $i++){

            for($j=0; $j < $n-$i-1; $j++){
                echo " ";
            }

            for($j=0; $j < 2*$i +1; $j++ ){
                echo "*";
            }
            echo"\n";
        }
    }  
    
    // pyramidPatternStars(5);

//   24)
    function pyramidPatternReverseStars($n){
        // controll loop
        for($i=0; $i<$n; $i++){

            
        }
    }