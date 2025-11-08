<?php

//  1) Write c program to check if a number is prime in PHP.
        // A prime number is a number greater than 1 that has no divisors other than 1 and itself.
        //     Examples: 2, 3, 5, 7, 11, 13...

        function isPrime(int $num = null) : bool {
            if(!$num) return false;

            // numbers less than or equal to 1 are not prime
            if($num <= 1) return false;

            // 2 is prime (smallest prime number)
            if ($num === 2) return true;
            
            // any even number greater than 2 is not prime                                                                          
            if ($num % 2 == 0) return false;

            // Only check odd divisors up to square root of the number
            // if n is divisible by a number greater than sqrt(n), 
            // the corresponding divisor would be smaller than sqrt(n) and already checked.
            // $i=3; $i<sqrt($num); $i+=2
            for($i=3; $i <= sqrt($num); $i+=2){

                // divisible by i, so not prime
                if($num % $i == 0) return false;
            }

            return true;
        }

        // $number = 29;
        // if (isPrime($number)) {
        //     echo "$number is a Prime Number.";
        // } else {
        //     echo "$number is Not a Prime Number.";
        // }


//  2) Write a program to reverse a string without using built-in functions.

        function reverseString(string $string) : string {

            // w/o in built functions
            $reversed = '';
            $count = 0;

            // Checking/finding lenght of the string from index zero(0) 
            while(isset($string[$len])) $len++;

            // since reversing take the elements from the end and make sure edge case >=0 for the first element
            for($i= $len-1; $i>=0; $i--){
                $reversed .=$string[$i];
            }

            // $len = strlen($str);
            // for($i=0; $i < $len/2; $i++) {
            //     $temp = $str[$i];
            //     $str[$i] = $str[$len - $i -1];
            //     $str[$len - $i -1] = $temp;
            // }

            return $reversed;
        }

        // $string = "this is s string";
        // echo $reversedString = reverseString($string);
    
//  2.1) 
        function reverseStringRecursive(string $string) : string {
            // if empty or single character string then return same string
            if ($string === '' || isset($string[1]) === false) return $string;

            // Recursive call: reverse the substring from second character onward,
            //  then add first character at the end
            return reverseStringRecursive(substr($string, 1)) . $string[0];
        }

        // $string = "this is s string";
        // echo $reversedString = reverseStringRecursive($string);

//  3) How do you swap two numbers without using a third variable?

        function swap(&$a, &$b){
            $a = $a + $b;
            $b = $a - $b;
            $a = $a - $b;

            return 1;
        }

        // $a = 3;
        // $b = 2;
        // swap($a, $b);
        // echo "a: ". $a. " b : ".$b;

//  3.1) How do you swap two numbers without using a third variable?

        function swap2(&$c, &$d){
            $c = $c * $d;
            $d = $c / $d;
            $c = $c / $d;

            return 1;
        }

        // $c = 3;
        // $d = 2;
        // swap2($c, $d);
        // echo "c: ". $c. " d : ".$d;
    
// Explanation: Arithmetic addition/subtraction. Time: O(1), Space: O(1). 
// Insight: Risk of overflow for large ints; use list() for arrays or XOR for bits.

// 4) Write a program to find the factorial of a number.
        function factorial(int $n) : int {
            $fact  = 1;
            for($i=$n; $i > 1; $i--){
                $fact = $fact * $i;
            }
            return $fact;
        }

        // echo factorial(5);

// 4.1) Write a program to find the factorial of a number using recursion.
        function recursionFactorial(int $n) : int {
            if($n <= 1) return 1;

            return $n * recursionFactorial($n-1);
        }

        // echo recursionFactorial(5);
// Explanation: Recursive call until base case. Time: O(n), Space: O(n). 
// Insight: Iterative for large n to avoid stack overflow; use GMP for bigints.

// 5) Write a program to generate Fibonacci series up to n terms.
        function fibonacci($n) {
            $first  = 0;
            $second = 1;
            echo "fibonacci series : ";
            for($i=1; $i<= $n; $i++){
                echo  $first . " ";
                $third = $first + $second;
                $first = $second;
                $second = $third;
            }
        }   
        
        // $n = 10;
        // fibonacci($n);


// 6) Write a program to check if a string is a palindrome.
        function palindrome(string $string ) : bool {

            // $len = strlen($str);
            $lenght = 0;

            while(isset($string[$lenght])) $lenght++;

            // Compare characters from start and end
            for ($i=0; $i < $lenght/2 ; $i++) {

                if($string[$i] !== $string[$lenght-$i-1]) return false;
            }

            return true;
        }

        // strrev()
        // if(palindrome('dwerfewtg')) {
        //     echo "palindrome";
        // }else{
        //     echo " not a palindrome";
        // }


// 7) How to count the number of vowels and consonants in a string?
        function countVowelsConsonants(string $string) {
           
            $consonants = 0;
            $vowels = 0;

            // Convert string to lowercase for easy checking
            $str = strtolower($string);

            // Loop through each character
            for ($i = 0; $i < strlen($str); $i++ ) { 
                
                $ch = $str[$i];       
               
                // Check if character is a letter
                if($ch >= 'a' && $ch <= 'z'){
                    
                    if($ch === 'a' || $ch === 'e' || $ch === 'i' || $ch === 'o' || $ch === 'u') {
                        $vowels++;
                    }else{
                        $consonants++; 
                    }
                } 
            }

            echo "vowels: ".$vowels. " consonants: ".$consonants;
        }

        // countVowelsConsonants("this is a string");

// 8) Write a program to find the largest of three numbers.
        function largest($first, $second, $third) {
            
            if($first >= $second && $first >= $third){
                return $first;
            }else if($second >= $third && $second >= $first){
                return $second;
            }else{
                return $third;
            }
        }

        // max(100,30,20);
        // echo largest(100,30,20);

// 9) Write a program to calculate sum of digits of a number
        function sumOfDigits(int $digit) : int {
            
            $sum = 0; 
            
            // handle negative numbers too
            $digit = abs($digit);

            while($digit > 0){
                $sum = $sum + ($digit%10); // get last digit and add digit to sum
                $digit = (int)($digit/10); // remove last digit
            }

            return $sum;
        }

    //    echo sumOfDigits(124); 

// 10) Write a program to print multiplication table of a number.

        function multiplication(int $table) {
            for($i=1; $i<=10; $i++ ){
                echo $i * $table.' ';
            }
        }

        // multiplication(5);

// 11) Write a program to check if a number is even or odd without modulo.
        function checkEvenOdd(int $num) {

            // Divide by 2 and compare
            if((int) ($num/2) * 2 === $num) {
                echo $num ." is a even number";
            }else{
                echo $num ." is a odd number";
            }
        }
        
        // checkEvenOdd(20);

// 11.1) Write a program to check if a number is even or odd without modulo.
        function checkEvenOdd2(int $num){
            if(($num & 1) === 0){
                echo $num ." is a even number";
            }else{
                echo $num ." is a odd number";
            }
        }

        // checkEvenOdd2(35);

// 12) Write a program to find the power of a number using loops.
        function power(int $base, int $expo) : int {
            $power = 1;
           
            for($i=1; $i <= $expo; $i++){
                $power = $power * $base;
            }  

            return $power;
        }

        // echo power(2,3);

// 13) Celsius to Fahrenheit
    // F = (C * 9/5) + 32
    function celsiusToFahrenheit(float $celsius): float {
        return ($celsius * 9/5) + 32;
    }

    // echo "Fahrenheit: " . celsiusToFahrenheit(37.0) ;

// 13.1) Fahrenheit to Celsius
    // C = (F-32) * 5/9
    function fahrenheitToCelsius(float $fahrenheit): float {
        return ($fahrenheit - 32) * 5/9;
    }

    // echo "Celsius: " . fahrenheitToCelsius(98.6);

// 14) Write a program to check if a number is positive, negative, or zero.

    function checkSign(int $num): string {
        return $num > 0 ? 'positive' : ($num < 0 ? 'negative' : 'zero');
    }

    // echo checkSign(-5);

// 15) Write a program to print all even numbers between 1 and n.
    function printEvens(int $n) {
        for ($i = 2; $i <= $n; $i += 2) echo $i . ' ';
    }
    
    // printEvens(10); 


// 16) Average of n Numbers
    function average($arr) {
        $sum = 0;
        $count = 0;

        for ($i = 0; isset($arr[$i]); $i++) {
            $sum += $arr[$i];
            $count++;
        }

        return $count > 0 ? $sum / $count : 0;
    }

    // echo average([10, 20, 30, 40, 50]);

// 17) Reverse a Number

    function reverseNumber($n) {
        $rev = 0;
        while ($n > 0) {
            $digit = $n % 10;
            $rev = $rev * 10 + $digit;
            $n = (int)($n / 10);
        }
        return $rev;
    }

    // echo reverseNumber(12345);

// 18) Count Digits in a Number

    function countDigits($n) {
        $count = 0;
        if ($n == 0) return 1;
        while ($n > 0) {
            $count++;
            $n = (int)($n / 10);
        }
        return $count;
    }

    // echo countDigits(12345);

// 19) Check if String Contains Substring

// 20) Capitalize First Letter of Each Word

    function capitalizeWords($str) {
        $result = "";
        $capitalizeNext = true;
        $i = 0;

        while (isset($str[$i])) {
            $ch = $str[$i];
            if ($ch == ' ') {
                $capitalizeNext = true;
                $result .= $ch;
            } else {
                if ($capitalizeNext && $ch >= 'a' && $ch <= 'z') {
                    $ch = chr(ord($ch) - 32); // convert to uppercase manually
                }
                $result .= $ch;
                $capitalizeNext = false;
            }
            $i++;
        }

        return $result;
    }

    // echo capitalizeWords("this is a php test");



// Arrays / Strings
// 21) Write a program to remove duplicate elements from an array. 
        function removeDuplicates (array $duplicates) : array {
            $len = count($duplicates);
            $new_array = [];
            
            for($i=0; $i < $len; $i++){
                $isDuplicates = false;
                $outerElement = $duplicates[$i];

                // in_array();
                for($j=0; $j < count($new_array); $j++){
                    
                    if ($outerElement === $new_array[$j]){
                        $isDuplicates = true;
                        break;
                    }
                }

                if(!$isDuplicates) $new_array[] = $outerElement;
            }

            return $new_array;
        }

    //    array_values(array_unique([2,2,33,3,4,5,5,7,9,10,11,11]))
    //    print_r(removeDuplicates([2,2,33,3,4,5,5,7,9,10,11,11])) ;
    //    var_dump(removeDuplicates([2,2,33,3,4,5,5,7,9,10,11,11]));

//  22) Write a program to find the second largest element in an array.
        function secondLargest(array $arr) {
            $n = count($arr);

            // Sort manually in descending order (bubble sort)
            for ($i = 0; $i < $n - 1; $i++) {
                for ($j = 0; $j < $n - $i - 1; $j++) {
                    if ($arr[$j] < $arr[$j + 1]) {
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                    }
                }
            }

            // First element is largest, second element is second largest
            return $arr[1];
        }

        // echo secondLargest([12, 35, 1, 10, 34, 1]); // 34


// 23) Write a program to merge two arrays and sort them.

        function mergeAndSort(array $a1, array $a2) {
            $merged = [];

            // merge manually
            for ($i = 0; $i < count($a1); $i++) {
                $merged[] = $a1[$i];
            }

            for ($i = 0; $i < count($a2); $i++) {
                $merged[] = $a2[$i];
            }

            // simple ascending bubble sort
            $n = count($merged);
            for ($i = 0; $i < $n - 1; $i++) {
                for ($j = 0; $j < $n - $i - 1; $j++) {
                    if ($merged[$j] > $merged[$j + 1]) {
                        $temp = $merged[$j];
                        $merged[$j] = $merged[$j + 1];
                        $merged[$j + 1] = $temp;
                    }
                }
            }

            return $merged;
        }

        // print_r(mergeAndSort([5, 2, 9], [8, 1, 3]));


// 24) Write a program to find intersection of two arrays.
        function intersectionArray (array $array1, array $array2) : array {
           
            $result = [];

            for($i=0; $i < count($array1); $i++){
                
                $outer = $array1[$i];
                
                for($j=0; $j < count($array2); $j++){
                    
                    $inner = $array2[$j];

                    // Intersects
                    if($outer === $inner){
                        
                        // check for duplicates in result array
                        $exists = false;

                        for($k = 0; $k < count($result); $k++) {

                            if($outer === $result[$k] ){
                                $exists = true;
                                break;
                            }
                        }

                        if(!$exists) $result[] = $outer;
                    }
                }

            }

            return $result;
        }

    //    array_intersect([2,2,3,4,5,5,6], [1,2,3,4,5,5,6])
    //    print_r(intersectionArray([2,2,3,4,5,5,6], [1,2,3,4,5,5,6])); 

// 25) Write a program to find union of two arrays. ---> same as removing duplicates
        
        function unionArray(array $a1, array $a2) {
            $result = [];

            // Add all elements of first array
            for ($i = 0; $i < count($a1); $i++) {
                $isExist = false;
                for ($k = 0; $k < count($result); $k++) {
                    if ($result[$k] === $a1[$i]) {
                        $isExist = true;
                        break;
                    }
                }
                if (!$isExist) {
                    $result[] = $a1[$i];
                }
            }

            // Add elements of second array if not already present
            for ($i = 0; $i < count($a2); $i++) {
                $isExist = false;
                for ($k = 0; $k < count($result); $k++) {
                    if ($result[$k] === $a2[$i]) {
                        $isExist = true;
                        break;
                    }
                }
                if (!$isExist) {
                    $result[] = $a2[$i];
                }
            }

            return $result;
        }

        // print_r(unionArray([1,2,3,4], [3,4,5,6]));

// 26) Write a program to reverse an array without using built-in functions.
        function reverseArray(array $array) : array {
            $len = count($array);

            for ($i=0; $i < $len/2; $i++) {
                $first = $array[$i];
                $last = $array[$len - $i -1];
                $array[$i] = $last;
                $array[$len - $i -1] = $first; 
            }

            return $array;
        }

        // print_r(reverseArray([1, 2, 3, 4]));

// 27) Write a program to find duplicate elements in an array.
        function Duplicates(array $array) : array {
            $result = [];

            for($i = 0; $i < count($array); $i++) {
                
                for($j = $i+1; $j < count($array); $j++) {
                    
                    
                    if($array[$i] === $array[$j]) {
                        
                        $isExists = false;

                        for($k = 0; $k < count($result); $k++) {
                            
                            if($result[$k] === $array[$i]) {
                                $isExists = true;
                                break;
                            }
                        }

                        if(!$isExists) $result[] = $array[$i];
                    }


                }
            }

            return $result;
        }
        

        // print_r(Duplicates([2,2,3,4,5,5,6]));

// 28) Write a program to rotate an array by k positions.
        function rotateArray(array $arr, int $k) {
            $n = count($arr);
            $k = $k % $n;
            $rotated = [];

            for ($i = $k; $i < $n; $i++) {
                $rotated[] = $arr[$i];
            }

            for ($i = 0; $i < $k; $i++) {
                $rotated[] = $arr[$i];
            }

            return $rotated;
        }

        // print_r(rotateArray([1,2,3,4,5], 2));


// 29) Write a program to check if two strings are anagrams.
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

// 30) Write a program to count frequency of each element in an array.

        function arrayFrequency(array $array) : array {
            
            $freq = [];
            for($i=0; $i < count($array); $i++){
                $element = $array[$i];
                $freq[$element] = ($freq[$element] ?? 0) + 1;
            } 

            return $freq;
        }

        // print_r(arrayFrequency([1,2,2,3,3,3,4,4,4,4,5]));

// 31) Write a program to find the smallest element in an array.

        function smallestElement(array $array) : int {
            
            if($array === []) return -1;
            
            $min = $array[0];
            
            for($i=1; $i < count($array); $i++) {
                if($array[$i] < $min){
                    $min = $array[$i];
                }
            }

            return $min;
        }
        
        // echo smallestElement([15,52,30,2,12,5]);

// 32) Write a program to split a string into an array of words.
        function explodeString(string $string) : array {
            $array = explode(' ', $string);

            return $array;
        }

        // print_r(explodeString("This is a string"));
// 32.1) 
        function splitWords($string) {
            $words = [];
            $current = "";

            for ($i = 0; $i < strlen($string); $i++) {
                if ($string[$i] === ' ') {
                    if ($current !== "") {
                        $words[] = $current;
                        $current = "";
                    }
                } else {
                    $current .= $string[$i];
                }
            }
            if ($current !== "") $words[] = $current;

            return $words;
        }

        // print_r(splitWords("This is a string"));

// 33) Write a program to implode an array into a string.
        function implodeString(array $array) : string {
            $string = implode(',', $array);

            return $string;
        }

        // echo implodeString(["This", "is", "a", "string"]);

// 33.1)  
        function implodeArray(array $arr, $sep = " ") {
            $result = "";
            for ($i = 0; $i < count($arr); $i++) {
                $result .= $arr[$i];
                if ($i < count($arr) - 1) {
                    $result .= $sep;
                }
            }
            return $result;
        }

        // echo implodeArray(["This", "is", "PHP"], "-");

// 34) Write a program to find the length of the longest string in an array.
        function longestStringLen(array $array) : int {

            $maxLength = 0;
            foreach ($array as $str) {
                if(strlen($str) > $maxLength) $maxLength = strlen($str);
            }

            return $maxLength;
        }

        // echo longestStringLen(["this", 'is', 'a', 'string']);

// 35) Write a program to replace all occurrences of a substring.


// 36) Write a program to sort an array in descending order.
        function sortDesc(array $array) : array {
            
            for($i=0; $i < count($array) - 1; $i++) {
                
                
                for($j=0; $j < count($array) - $i -1; $j++) {
                    
                    if($array[$j] < $array[$j+1]){
                        $temp = $array[$j];
                        $array[$j] = $array[$j+1];
                        $array[$j+1] = $temp;
                    } 
                }
            }

            return $array;
        }   

        // print_r(sortDesc([15,52,30,2,12,5]));

// 37) Write a program to check if an array is associative or indexed. 
    function isAssociative(array $arr): bool {
        
        if (empty($arr)) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }        

    // $indexedArray = [10, 20, 30];
    // $assocArray = ["a" => 10, "b" => 20];

    // echo isAssociative($indexedArray) ? "Associative" : "Indexed";
    // echo "\n";
    // echo isAssociative($assocArray) ? "Associative" : "Indexed";

// 37.1) 
    function isAssociative1(array $arr) {
        $i = 0;
        foreach ($arr as $key => $val) {
            if ($key !== $i) return true;
            $i++;
        }
        return false;
    }

        // var_dump(isAssociative1(["a"=>1,"b"=>2])); // true
        // var_dump(isAssociative1([1,2,3])); // false


// 38) Write a program to flatten a multi-dimensional array.
    function flatten(array $arr) {
        $result = [];
        foreach ($arr as $val) {
            if (is_array($val)) {
                $flat = flatten($val);
                foreach ($flat as $f) {
                    $result[] = $f;
                }
            } else {
                $result[] = $val;
            }
        }
        return $result;
    }

    // print_r(flatten([1,[2,3],[4,[5,6]]]));


// 39) Write a program to extract keys from an associative array.
    // Function to extract keys manually
    function extractKeysManual(array $assocArray): array {
        $keys = [];
        foreach ($assocArray as $key => $value) {
            $keys[] = $key;
        }
        return $keys;
    }

    // $assocArray = ["name" => "John", "age" => 30, "city" => "Delhi"];
    // $keys = extractKeysManual($assocArray);

    // print_r($keys);



// 40) Write a program to pad a string to a certain length

    function padString(string $str, int $length, string $padChar = ' ', string $direction = 'right'): string {
        switch($direction) {
            case 'left':
                return str_pad($str, $length, $padChar, STR_PAD_LEFT);
            case 'both':
                return str_pad($str, $length, $padChar, STR_PAD_BOTH);
            default:
                return str_pad($str, $length, $padChar, STR_PAD_RIGHT);
        }
    }

    // echo "'" . padString("Hello", 10) . "'";        // Right pad (default)
    // echo "\n";
    // echo "'" . padString("Hello", 10, "*", "left") . "'";   // Left pad
    // echo "\n";
    // echo "'" . padString("Hello", 10, "-", "both") . "'";   // Both sides pad


// 41) Write a program to check if a number is Armstrong.
// An Armstrong number (or narcissistic number) is a number that is equal to 
// the sum of its own digits raised to the power of the number of digits.

    function armstrong(int $no) : bool {
        $len = strlen((string)$no);
        $sum = 0;
        $number = $no;

        // $sum += ($no % 10) ** $len;
        while($no > 0){
            $digit = $no%10;
            $sum = $sum + power($digit, $len);
            $no = (int) $no/10;
        }

        return $number === $sum;
    }

    // if(armstrong(153)) {
    //     echo "armstrong number";
    // }else{ 
    //     echo "not a armstrong number";
    // }

// 42) Write a program to check if a number is perfect.
    // A Perfect Number is a positive integer that is equal to the sum of its proper divisors (excluding itself).
    function perfectNo(int $no) : bool { 
        
        if($no <= 1) return false;
        
        $sum  = 0;
        
        for($i = 1; $i <= $no/2; $i++) {
            
            if($no%$i === 0) {
                $sum = $sum + $i;
            }
        }

        return $no === $sum;
    }

    // if(perfectNo(6)) {
    //     echo "perfect number";
    // }else{ 
    //     echo "not a perfect number";
    // }

// 43) Write a program to convert decimal to binary.
    // Divide the number by 2 repeatedly.
    // Collect remainders (0 or 1).
    // Reverse the remainders sequence (or prepend as in code).
    // The result is the binary string.

    function decimalToBinary(int $num) {
        
        if($num === 0) return "0";
        
        $binary = '';

        while($num > 0) {
            $remainder  = $num%2; // get remainder (0 or 1)
            $binary = $remainder.$binary; // get remainder (0 or 1)
            $num = (int)($num/2); // prepend remainder
        }

        return $binary;

    }

    // decbin(25)
    // echo decimalToBinary(25);

// 44) Write a program to convert binary to decimal.
    // Traverse binary digits from right to left.
    // For each bit 1, add 2^position to decimal.
    // Sum of all values = decimal n

    function binaryToDecimal(string $num) {
        
        $decimal=0;
        $len = strlen((string) $num);
        for($i=0; $i < $len; $i++ ){
            
            $bit = $num[$len -$i -1];
            if($bit == 1){
                $decimal += power(2,$i);
            }
        }

        return $decimal;
    } 

    // bindec('11001')
    // echo binaryToDecimal('11001');

// 45) Write a program to check if a year is a leap year.

        // Div by 4, not 100 unless 400.
        function isLeapYear(int $year) : bool {
            if(($year % 4 == 0 && $year % 100 != 0) || ($year % 400 === 0)){
                return true;
            }

            return false;
        }

        // if(isLeapYear(2000)) {
        //     echo "leap year";
        // }else{
        //     echo " not a leap year";
        // }

// 46) Write a program to find GCD of two numbers
        // GCD(a,b)=GCD(b,a mod b) untill b=0;

        function gcd(int $a, int $b) : int {
            while($b !== 0){
                $temp = $b;
                $b = $a % $b;
                $a =$temp;
            }

            return $a;
        }

        // echo gcd(48,18);

// 47) Write a program to find LCM of two numbers.
        // LCM(a, b) = (a × b) / GCD(a, b)

        function lcm(int $a, int $b) : int {
            return $a*$b/gcd($a, $b);
        }

        // echo lcm(12,18);

// 48) Write a program to print all prime numbers in a given range.
        function primeNoInRange(int $start, int $end) : array {
            $primeNumbers = [];

            for ($i = $start; $i <= $end; $i++) {
                if ($i < 2) continue; // skip numbers < 2

                $isPrime = true;
                for ($j = 2; $j <= sqrt($i); $j++) {
                    if ($i % $j == 0) {
                        $isPrime = false;
                        break;
                    }
                }

                if ($isPrime) {
                    $primeNumbers[] = $i;
                }
            }

            return $primeNumbers;
        }

        // print_r(primeNoInRange(10, 30));

// 49) Write a program to find missing number in an array.
        // $n * ($n + 1) / 2
        function findMissingNumber(array $arr) : int {
            $n = count($arr) + 1; 
            $expectedSum = $n * ($n + 1) / 2;
            $actualSum = array_sum($arr);

            return $expectedSum - $actualSum;
        }

        // Example
        // $arr = [1, 2, 4, 5, 6]; 
        // echo "Missing Number: " . findMissingNumber($arr);

// 51) Write a program to find pair of numbers with given sum in an array.
        function findPairs(array $arr, int $target) : array {
            $pairs = [];
            $n = count($arr);

            for ($i = 0; $i < $n; $i++) {
                for ($j = $i + 1; $j < $n; $j++) {
                    if ($arr[$i] + $arr[$j] == $target) {
                        $pairs[] = [$arr[$i], $arr[$j]];
                    }
                }
            }

            return $pairs;
        }

        // $arr = [2, 4, 3, 5, 7, 8, -1];
        // $target = 7;
        // print_r(findPairs($arr, $target));

// 52) Write a program to check if a number is a palindrome.
        function isPalindromeNumber(int $num) : bool {
            $original = $num;
            $reverse = 0;

            while ($num > 0) {
                $digit = $num % 10;           // get last digit
                $reverse = ($reverse * 10) + $digit; // build reverse number
                $num = intdiv($num, 10);      // remove last digit
            }

            return $original === $reverse;
        }

        // $number = 121;
        // if (isPalindromeNumber($number)) {
        //     echo "$number is a Palindrome";
        // } else {
        //     echo "$number is NOT a Palindrome";
        // }

// 53) Write a program to find the square root of a number without built-in functions.
// 54) Write a program to solve quadratic equation.
        // (-b +- (b^2 - sqrt(4ac)))/ 2a 
        function quadraticRoots(float $a, float $b, float $c): array {
            
            $disc = $b*$b - 4*$a*$c;
            
            if ($disc < 0) return [];
            
            $root1 = (-$b + sqrt($disc)) / (2*$a);
            $root2 = (-$b - sqrt($disc)) / (2*$a);
            
            return [$root1, $root2];
        }

        // print_r(quadraticRoots(1,2,1));


// 55) Find the nth term of an arithmetic sequence
        // function nthTermAP(int $firstTerm, int $commonDiff, int $n) : int {
        //     return $firstTerm + ($n - 1) * $commonDiff;
        // }

        // // Example usage
        // $a = 5;   // first term
        // $d = 3;   // common difference
        // $n = 10;  // nth term

        // echo "The $n-th term of the AP is " . nthTermAP($a, $d, $n);

// 56) Write a program to print a pyramid pattern of stars.

        function pyramidStars(int $n) {
            for ($i = 1; $i <= $n; $i++) {

                // Print spaces
                for ($j = 0; $j < $n - $i; $j++) {
                    echo " ";
                }
                
                // Print stars
                for ($k = 1; $k <= $i; $k++) {
                    echo "*";
                }
                echo "\n"; // Move to next row
            }
        }

        // pyramidStars(5);

// 56.1) Write a program to print a inverse pyramid pattern of stars.
        function pyramidReverseStars(int $n) {
            for($i=0; $i < $n; $i++) {

                for($k=$n; $k > $n - $i -1; $k--) {
                    echo " ";
                }

                for($j=$n-$i; $j > 0; $j--) {
                    echo '*';
                }

                echo "\n";
            }
        }

        // pyramidReverseStars(5);

// 57) Write a program to print a pyramid pattern of stars 2.

        function pyramidPatternStars(int $n) {
            for ($i = 1; $i <= $n; $i++) {
                // Print spaces
                for ($j = 1; $j <= $n - $i; $j++) {
                    echo " ";
                }
                // Print stars
                for ($k = 1; $k <= 2 * $i - 1; $k++) {
                    echo "*";
                }
                echo "\n"; // Move to next row
            }
        }

        // pyramidPatternStars(5);

// 57.1)  Write a program to print a pyramid reverse pattern of stars 2

        function pyramidPatternReverseStars(int $n) {
            
            for($i = 0; $i < $n; $i++){
                
                for($j = $n; $j <= $n-$i-1; $j--){
                    echo " ";
                }

                for($k = $n-$i; $k > 0; $k--) {
                    echo "*";
                }

                echo "\n";
            }
        }

        // pyramidPatternReverseStars(5);

// 58) Write a program to print Floyd’s triangle.

        function floydTriangle($n) {
            
            $count=0;
            
            for($i=1; $i<=$n; $i++){

                for($k = 0; $k < $n-$i; $k++) {
                    echo " ";
                }

                for($j=0; $j<$i; $j++){
                    echo ++$count ." ";
                }

                echo "\n";

            }
        }

        // floydTriangle(5);

// 59) Write a program to print Pascal’s triangle.
    //  $number =  $number * ($i-$j) / ($j+1);
        function pascalTriangle(int $n) {
            
            for($i=0; $i< $n; $i++) {

                for($k = 0; $k < $n-$i; $k++) {
                    echo " ";
                }

                $number = 1;    // first element will always be 1
                for($j=0; $j<=$i; $j++) {
                    echo $number." ";
                    $number = $number * ($i-$j) / ($j+1);   // Compute next number in row using combinatorial formula
                }

                echo "\n";

            }
        }

        // pascalTriangle(5);

// 60) Write a program to print a diamond pattern.

// 61) Write a program to print numeric pyramid

        function pyramidNumericpyramid(int $n) {
            for ($i = 1; $i <= $n; $i++) {
                // Print spaces
                for ($j = 0; $j < $n - $i; $j++) {
                    echo " ";
                }
                // Print stars
                for ($k = 1; $k <= $i; $k++) {
                    // echo "*";
                    echo $k.' ';
                }

                echo "\n"; // Move to next row
            }
        }

        // pyramidNumericpyramid(5);

// 62) Write a program to print alphabet pyramid.

    function alphabetPyramid(int $rows) {
        for ($i = 1; $i <= $rows; $i++) {
            // Print spaces for alignment
            for ($j = 1; $j <= $rows - $i; $j++) {
                echo " ";
            }
            // Print letters
            for ($k = 0; $k < $i; $k++) {
                echo chr(65 + $k) . " "; // 65 is ASCII for 'A'
            }
            echo "\n"; // Move to next row
        }
    }

    // alphabetPyramid(5);

// 63) Write a program to print hollow square pattern.

// 64) Write a program to print right-angled triangle of numbers.

    function rightAngledNumberTriangle(int $rows) {
        for ($i = 1; $i <= $rows; $i++) {
            for ($j = 1; $j <= $i; $j++) {
                echo $j . " ";
            }
            echo "\n"; // Move to next row
        }
    }

    // rightAngledNumberTriangle(5);

// 65) Implement Bubble Sort in PHP.
    // It repeatedly steps through the list, compares adjacent elements, and swaps them if they are in the wrong order.
    // The largest element “bubbles up” to the end of the array in each pass — hence the name Bubble Sort.  

    // Ascending Order
    function bubbleSort(array $arr): array {
        $n = count($arr);

        // Outer loop for passes
        for ($i = 0; $i < $n - 1; $i++) {

            $swapped = false;

            // Inner loop for comparison
            for ($j = 0; $j < $n - $i - 1; $j++) {
                // Swap if elements are in wrong order
                if ($arr[$j] > $arr[$j + 1]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;

                    $swapped = true;
                }
            }

            // If no swaps occurred → already sorted
            if (!$swapped) break;
        }

        return $arr;
    }

    // Example usage:
    // $numbers = [5, 1, 4, 2, 8];
    // $sorted = bubbleSort($numbers);

    // print_r($sorted);

// 65.1) Descending Order

    function bubbleSortDescending(array $arr): array {
        $n = count($arr);

        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($arr[$j] < $arr[$j + 1]) { // flip sign for descending
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                }
            }
        }

        return $arr;
    }

    // $numbers = [5, 1, 4, 2, 8];
    // print_r(bubbleSortDescending($numbers));

// 66) Implement Insertion Sort in PHP.
    // Start from the second element (index 1), assuming the first element is already sorted.
    // Compare the picked element (called key) with the elements before it.
    // Shift all elements greater than the key one position ahead.
    // Insert the key into the correct position.
    // Continue until the entire array is sorted.

    function insertionSort(array $array) : array {
        $len =  count($array);
        
        for($i = 1; $i < $len; $i++){

            // element to be inserted
            $key = $array[$i];
            $j = $i-1;

            // Move elements greater than key to one position ahead
            // $array[$j] > $key  --- ascending order
            // $array[$j] < $key  --- desending order

            while($j >=0 && $array[$j] > $key){
                $array[$j+1] = $array[$j];
                $j--;
            }

            // Insert the key in its correct position
            $array[$j+1] = $key;
        }
        
        return $array;
    }

    // print_r(insertionSort([2,4,1,9,5,18,12,5]));

// 67) Implement Selection Sort in PHP.
    // Start from the first element (i = 0).
    // Assume it is the smallest element.
    // Compare it with all elements after it (j = i+1 to n-1).
    // If a smaller element is found, remember its index.
    // After the inner loop, swap the smallest element with the element at position i.
    // Repeat until the array is sorted.

    function selectionSort(array $arr) : array {
        $len = count($arr);

        for($i = 0; $i < $len -1; $i++ ) {
            
            // Find the smallest element in the unsorted part
            $minIndex = $i;

            // Find the smallest element in the unsorted part
            // $array[$j] < $arr[$i]  --- ascending order
            // $array[$j] > $arr[$i]  --- desending order
            for($j = $i + 1; $j < $len; $j++){
                if($arr[$j] < $arr[$i]){
                    $minIndex = $j;
                }
            }

            //  Swap the found minimum element with the first unsorted element
            if($minIndex != $i) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$minIndex];
                $arr[$minIndex] = $temp;
            }
        }
        
        return $arr;
    } 

    // print_r(selectionSort([2,4,1,9,5,18,12,5]));

// 68) Implement Quick Sort in PHP.    
    // Choose a pivot element (commonly the last element).
    // Partition the array:
    // Move all elements smaller than pivot to the left.
    // Move all elements greater than pivot to the right.
    // Recursively apply Quick Sort to left and right subarrays.
    // Combine (merge) the results.

    function quickSort(array $arr) : array {
        $len = count($arr);

        if($len <= 1) {
            return $arr;
        }

        $pivot = $arr[$len-1];
        $left = [];
        $right = [];

        // $arr[$i] > $pivot  --- ascending order
        // $arr[$i] < $pivot  --- desending order
        for($i=0; $i < $len-1; $i++) {
            if($arr[$i] >= $pivot){
                $right[] = $arr[$i];
            }else{
                $left[] = $arr[$i];
            }
        }   
        
        $leftArraySorted = quickSort($left);
        $rightArraySorted = quickSort($right);

        return array_merge($leftArraySorted, [$pivot], $rightArraySorted);
    }

    // print_r(quickSort([2,4,1,9,5,18,12,5]));

// 69)Implement Merge Sort in PHP.

// 70) Implement Linear Search in PHP.

    // Start from the first element of the array.
    // Compare each element with the target value.
    // If a match is found → return its index (position).
    // If the loop ends without a match → return “not found”.

    function linearSearch($arr, $target) {
        
        // Loop through each element
        for ($i = 0; $i < count($arr); $i++) {
            
            if ($arr[$i] == $target) {
                return $i; 
            }
        }
        // If not found
        return -1;
    }

    // Example 
    // $numbers = [12, 35, 1, 10, 34, 1];
    // $target = 10;

    // $result = linearSearch($numbers, $target);

    // if ($result != -1) {
    //     echo "Element $target found at index $result";
    // } else {
    //     echo "Element $target not found in the array.";
    // }

// 71)  Implement Binary Search in PHP.
    // Start with two pointers:
    // low = 0, high = n - 1
    // Find the middle index:
    // mid = (low + high) / 2

    // Compare:
    // If arr[mid] == target → element found
    // If arr[mid] > target → search left half
    // If arr[mid] < target → search right half
    // Repeat steps until low > high.

    function binarySearch(array $arr, int $target) : int{
        $len = count($arr);
        if($len < 1){
            return -1;
        }

        $low = 0;
        $high = $len -1;

        while($low <= $high){
            $mid = (int)(($low + $high)/2);

            if($arr[$mid] === $target){
                return $mid;
            }else if($target < $arr[$mid]){
                $high = $mid -1;
            }else{
                $low = $mid+1;
            }
        }

        return -1;
    }

    // $numbers = [1, 5, 8, 12, 20, 35, 50]; // Must be sorted
    // $target = 20;

    // $result = binarySearch($numbers, $target);

    // if ($result != -1) {
    //     echo "Element $target found at index $result";
    // } else {
    //     echo "Element $target not found.";
    // }

// 72) Write a program to find the kth largest element in an array.

    function kthLargestElement(array $arr, int $k) {

        $len = count($arr);
        
        // bubble sort DESC
        for($i=0; $i< $len -1; $i++){

            for($j=0; $j< $len - $i -1; $j++){
                if($arr[$j] < $arr[$j+1]){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j+1];
                    $arr[$j+1] = $temp;
                }
            }
        }

        return $arr[$k-1];
    }

    // echo kthLargestElement([1, 5, 8, 12, 20, 35, 50], 4);

// 73) Write a program to sort a string alphabetically.

    function sortStringCaseInsensitive($str) {
        // Convert string to array manually
        $arr = [];
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++) {
            $arr[$i] = $str[$i];
        }

        // Bubble sort (case-insensitive)
        for ($i = 0; $i < $len - 1; $i++) {
            for ($j = 0; $j < $len - $i - 1; $j++) {
                // Compare lowercase ASCII values
                if (ord(strtolower($arr[$j])) > ord(strtolower($arr[$j + 1]))) {
                    // Swap
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                }
            }
        }

        // Convert array back to string manually
        $sortedStr = "";
        for ($i = 0; $i < $len; $i++) {
            $sortedStr .= $arr[$i];
        }

        return $sortedStr;
    }

    // Example usage
    // $string = "PhpCodeABC";
    // echo "Original string: $string\n";
    // echo "Sorted (case-insensitive): " . sortStringCaseInsensitive($string);