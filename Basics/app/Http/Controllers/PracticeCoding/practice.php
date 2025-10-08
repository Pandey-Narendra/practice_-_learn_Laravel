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

    function reverseString($str) {
        $len = strlen($str);
        for($i=0; $i < $len/2; $i++) {
            $temp = $str[$i];
            $str[$i] = $str[$len - $i -1];
            $str[$len - $i -1] = $temp;
        }

        return $str;
    }

    // echo reverseString("this is s string");


    function fibonacci($n){
        $first =  0;
        $second = 1; 
        // $third = $first;

        for($i = 1; $i<= $n; $i++ ) {
            echo $first." ";
            $third = $first + $second;
            $first = $second;
            $second = $third;
        }
    }

    // fibonacci(10);

        function palindrome(string $string ) : bool {
            $len = strlen($string);

            for($i = 0; $i <= $len/2; $i++ ){
                if($string[$i] !== $string[$len-$i-1]) return false;
            }

            return true;
        }

        // if(palindrome('dwerfewtg')) {
        //     echo "palindrome";
        // }else{
        //     echo " not a palindrome";
        // }


        function sumOfDigits(int $digit) : int {
            $sum = 0;
            while ($digit > 0) {
                $sum += ($digit% 10);
                $digit = (int) ($digit / 10);
            }

            return $sum;
        }

        // echo sumOfDigits(124); 

        // ($num/2) * 2 === 0;
        // ($num & 1) === 0;
        //  f = (c*9/5) + 32;

        function removeDuplicates (array $duplicates)  {
            
            $noDuplicates = [];
            $duplicates_count = [];

            for ($i = 0; $i < count($duplicates); $i++) {
                
                // Count how many times each value occurs
                $duplicates_count[$duplicates[$i]] =  ($duplicates_count[$duplicates[$i]] ?? 0) + 1;
                
                // Check if this value is already in noDuplicates
                $isduplicates = false;
                for ($j = 0; $j < count($noDuplicates); $j++) {

                    if($duplicates[$i] === $noDuplicates[$j]){
                        $isduplicates = true;
                        break;
                    }
                }

                // If not duplicate, add to noDuplicates array
                if(!$isduplicates) $noDuplicates[] = $duplicates[$i];

            }

            print_r($noDuplicates);
            print_r($duplicates_count);
            
        }

        // removeDuplicates([2,2,33,3,4,5,5,7,9,10,11,11]);

        
        // function secondLargest(array $arr){
            
        //     for ($i = 0; $i < count($arr); $i++) {
                
        //         $min = $arr[$i];
        //         $outerElement = $arr[$i];
                
        //         for ($j = 0; $j < count($arr) - $i; $j++) {
                    
        //             $innerElement = $arr[$j];

        //             if($outerElement < $innerElement) {
                        
        //                 $min = $innerElement;
        //             }

        //         }

        //         $arr[count($arr) - $i - 1] = $min;

        //     }
            
        //     print_r($arr);
        // }

        // secondLargest([12, 35, 1, 10, 34, 1]);

        function intersectionArray (array $array1, array $array2) {
            
            $intersectArray = [];

            for($i = 0; $i < count($array1); $i++) {
                
                $isIntersect = false;

                for($j = 0; $j < count($array2); $j++) {

                    if($array1[$i] === $array2[$j]){
                        $isIntersect = true;
                        break;
                    }

                }

                if($isIntersect) {
                    
                    $isIntersectUnique = true;
                    
                    for($j = 0; $j < count($intersectArray); $j++) {
                    
                        if($array1[$i] === $intersectArray[$j]){
                            $isIntersectUnique = false;
                            break;
                        }
                    }

                    if($isIntersectUnique) {
                        $intersectArray[] = $array1[$i];
                    }
                }

            }

            print_r($intersectArray); 
        }

        // print_r(intersectionArray([2,2,3,4,5,5,6], [1,2,3,4,5,5,6]));


        function arrayUnionManual(array $array1, array $array2){
            
            $unionArray = [];

            for($i = 0; $i < count($array1); $i++) {
                
                $isExists = false;
                
                for($j = 0; $j < count($unionArray); $j++){
                    
                    if($array1[$i] === $unionArray[$j]){
                        $isExists = true;
                        break;
                    }

                }

                if(!$isExists) {

                    $unionArray[] = $array1[$i];
                }
            }

            for($i = 0; $i < count($array2); $i++) {
                
                $isExists = false;
                
                for($j = 0; $j < count($unionArray); $j++){
                    
                    if($array2[$i] === $unionArray[$j]){
                        $isExists = true;
                        break;
                    }

                }

                if(!$isExists) {

                    $unionArray[] = $array2[$i];
                }
            }

            print_r($unionArray);
        }

        // print_r(arrayUnionManual([1, 2, 3, 4],[3, 4, 5, 6]));

        function anagrams(string $str1, string $str2){
            $len1 = strlen($str1);
            $len2 = strlen($str2);

            if($len1 !== $len2) return false;

            $freq_str1 = [];
            for($i=0; $i < $len1; $i++) {
                $freq_str1[$str1[$i]] =  ($freq_str1[$str1[$i]] ?? 0) + 1;
            }

            $freq_str2 = [];
            for($i=0; $i < $len2; $i++) {
                $freq_str2[$str2[$i]] =  ($freq_str2[$str2[$i]] ?? 0) + 1;
            }

            $isAnagram = true;

            for($i=0; $i < $len1; $i++) {
                if($freq_str1[$str1[$i]] !== $freq_str2[$str1[$i]]){
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