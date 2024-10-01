<?php

// if (!function_exists('numberToWords')) {
//     function numberToWords($number)
//     {
//         $words = [
//             1 => 'satu', 2 => 'dua', 3 => 'tiga', 4 => 'empat', 5 => 'lima',
//             6 => 'enam', 7 => 'tujuh', 8 => 'delapan', 9 => 'sembilan', 10 => 'sepuluh',
//             11 => 'sebelas', 12 => 'dua belas', 13 => 'tiga belas', 14 => 'empat belas', 15 => 'lima belas',
//             16 => 'enam belas', 17 => 'tujuh belas', 18 => 'delapan belas', 19 => 'sembilan belas', 20 => 'dua puluh'
//         ];

//         if (array_key_exists($number, $words)) {
//             return $words[$number];
//         } elseif ($number < 100) {
//             return $words[floor($number / 10) * 10] . ' ' . numberToWords($number % 10);
//         } elseif ($number < 1000) {
//             return $words[floor($number / 100)] . ' ratus ' . numberToWords($number % 100);
//         }elseif ($number < 10000) {
//             return $words[floor($number / 1000)] . ' ribu ' . numberToWords($number % 1000);
//         }

//         // Sesuaikan logika jika diperlukan untuk angka yang lebih besar
//         return $number;
//     }
// }

if (!function_exists('numberToWords')) {
    if (!function_exists('numberToWords')) {

        function numberToWords($number) {
            $words = [
                1 => 'satu', 2 => 'dua', 3 => 'tiga', 4 => 'empat', 5 => 'lima',
                6 => 'enam', 7 => 'tujuh', 8 => 'delapan', 9 => 'sembilan', 10 => 'sepuluh',
                11 => 'sebelas', 12 => 'dua belas', 13 => 'tiga belas', 14 => 'empat belas', 15 => 'lima belas',
                16 => 'enam belas', 17 => 'tujuh belas', 18 => 'delapan belas', 19 => 'sembilan belas', 20 => 'dua puluh',
                30 => 'tiga puluh', 40 => 'empat puluh', 50 => 'lima puluh', 60 => 'enam puluh',
                70 => 'tujuh puluh', 80 => 'delapan puluh', 90 => 'sembilan puluh'
            ];
    
            if (array_key_exists($number, $words)) {
                return $words[$number];
            } elseif ($number < 100) {
                return $words[floor($number / 10) * 10] . ' ' . numberToWords($number % 10);
            } elseif ($number < 1000) {
                return $words[floor($number / 100)] . ' ratus ' . numberToWords($number % 100);
            } elseif ($number < 10000) {
                return $words[floor($number / 1000)] . ' ribu ' . numberToWords($number % 1000);
            }
    
            // Adjust the logic if necessary for larger numbers
            return $number;
        }
    }   
}
