<?php
// 01

    function isPrime($num) {
        if($num <= 1) return false;

        if($num === 2) return true;

        if($num % 2 === 0 ) return false;

        for($i = 3; $i <= sqrt($num); $i+=2 ) {
            if($num % $i === 0) return false;
        }

        return true;
    }

    // if(isPrime(13)){
    //     echo "Prime Number";
    // }else{
    //     echo " Not a Prime Number";
    // }

    // function reverseString($str) {
    //     $len = strlen($str);
    //     for($i=0; $i < $len/2; $i++) {
    //         $temp = $str[$i];
    //         $str[$i] = $str[$len - $i -1];
    //         $str[$len - $i -1] = $temp;
    //     }

    //     return $str;
    // }

    // echo reverseString("this is s string");


    // function fibonacci($n){
    //     $first =  0;
    //     $second = 1; 
    //     // $third = $first;

    //     for($i = 1; $i<= $n; $i++ ) {
    //         echo $first." ";
    //         $third = $first + $second;
    //         $first = $second;
    //         $second = $third;
    //     }
    // }

    // fibonacci(10);

        // function palindrome(string $string ) : bool {
        //     $len = strlen($string);

        //     for($i = 0; $i <= $len/2; $i++ ){
        //         if($string[$i] !== $string[$len-$i-1]) return false;
        //     }

        //     return true;
        // }

        // if(palindrome('dwerfewtg')) {
        //     echo "palindrome";
        // }else{
        //     echo " not a palindrome";
        // }


        // function sumOfDigits(int $digit) : int {
        //     $sum = 0;
        //     while ($digit > 0) {
        //         $sum += ($digit% 10);
        //         $digit = (int) ($digit / 10);
        //     }

        //     return $sum;
        // }

        // echo sumOfDigits(124); 

        // ($num/2) * 2 === 0;
        // ($num & 1) === 0;
        //  f = (c*9/5) + 32;

        // function removeDuplicates (array $duplicates)  {
            
        //     $no_duplicates = [];
        //     $count_duplicates = [];

        //     for($i=0; $i < count($duplicates); $i++) {
                
        //         for($j = $i + 1; $j < count($duplicates); $j++) {
                   
        //            $isDuplicate =  false;

        //             if($duplicates[$i] === $duplicates[$j]){
                        
        //                 $count_duplicates[$i] = ($count_duplicates[$i] ?? 0) + 1;

        //                 for($k=0; $k < count($no_duplicates); $k++) {

        //                     if ($no_duplicates[$k] === $duplicates[$i]) {
        //                         $isDuplicate = true;
        //                         break;
        //                     }
        //                 }
        //             }

        //             if($isDuplicate) $isDuplicate[] = $duplicates[$i];
        //         }
        //     }

        //     print_r($no_duplicates);
        //     print_r($count_duplicates);
        // }

        // removeDuplicates([2,2,33,3,4,5,5,7,9,10,11,11]);