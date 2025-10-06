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
            $uniqueArr = array_unique($arr);   // remove duplicates
            rsort($uniqueArr);                // sort in descending order
            return $uniqueArr[1] ?? "No second largest element";
        }

        // $arr = [12, 35, 1, 10, 34, 1];
        // echo "Second Largest: " . secondLargest($arr);


// 23) Write a program to merge two arrays and sort them.

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

                        for($k= 0; $k < count($result); $k++) {

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
        
        function arrayUnionManual(array $arr1, array $arr2) : array {
            // start with first array
            $union = $arr1; 

            // Loop through second array
            for ($i = 0; $i < count($arr2); $i++) {
                $exists = false;

                // Check if element already exists in union
                for ($j = 0; $j < count($union); $j++) {
                    if ($arr2[$i] === $union[$j]) {
                        $exists = true;
                        break;
                    }
                }

                // If not found, add to union
                if (!$exists) {
                    $union[] = $arr2[$i];
                }
            }

            return $union;
        }

        // $arr1 = [1, 2, 3, 4];
        // $arr2 = [3, 4, 5, 6];
        // print_r(arrayUnionManual($arr1, $arr2));

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

// 29) Write a program to check if two strings are anagrams.
        function anagrams(string $str1, string $str2) : bool {
           $str1 = strtolower(str_replace(' ', '', $str1));
           $str2 = strtolower(str_replace(' ', '', $str2));

           if(strlen($str1) !== strlen($str2)) return false;

           $str1_freq = [];
            for($i=0; $i < strlen($str1); $i++) {
                $ch = $str1[$i];
                $str1_freq[$ch] = ($str1_freq[$ch] ?? 0) + 1;
            }

            // print_r($str1_freq);

            $str2_freq = [];
            for($i=0; $i < strlen($str2); $i++) {
                $ch = $str2[$i];
                $str2_freq[$ch] = ($str2_freq[$ch] ?? 0) + 1;
            }

            // print_r($str2_freq);

            ksort($str1_freq);
            ksort($str2_freq);

            return $str1_freq === $str2_freq;
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

// 33) Write a program to implode an array into a string.
        function implodeString(array $array) : string {
            $string = implode(',', $array);

            return $string;
        }

        // echo implodeString(["This", "is", "a", "string"]);

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

// 38) Write a program to flatten a multi-dimensional array.

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