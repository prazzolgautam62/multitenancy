<?php
use  \Carbon\Carbon;


define('MAX_PER_PAGE', 99999999);

function indianFormat($amount) {
    setlocale(LC_MONETARY, 'en_IN');
    if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') {
        $amount = money_format('%!i', $amount);
    }
    $amount = str_replace('.00', '', $amount);
    return $amount;
}

function getIndianCurrencyToWords(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = [];
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? ". " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'rupees' : '') . $paise ;
}


function nepaliMonthsList () : array {
    return ['Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'];

}

function dayslist() : array {
    return ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

}

function roundLastTwo($amount) {
    $result = number_format((float)$amount, 2, '.', '');
    return (float) $result;
}


function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
        switch ($num % 10) {
            // Handle 1st, 2nd, 3rd
            case 1:  return $num.'st';
            case 2:  return $num.'nd';
            case 3:  return $num.'rd';
        }
    }
    return $num.'<sup>th</sup>';
}


/*
   start date conversion helpers
*/
function getNepaliDate ($year, $month, $date, $format="ymd") {
    $dt = new \App\Packages\DateConverter();
    $np_date = $dt->eng_to_nep($year, $month, $date);
    if ($format=='dmy')
        $final_date = $np_date['date'].'-'.$np_date['month'].'-'.$np_date['year'];
    else if ($format=='ymd')
        $final_date = $np_date['year'].'-'.$np_date['month'].'-'.$np_date['date'];
    return $final_date;
}
/*
//argument date only
function nepaliToEnglishDate($_date, $format="Y-m-d") {
    // try {
        $dt = new \App\Packages\DateConverter();
        $explodeDate = explode('-', $_date);
        $year =  $explodeDate[0];//\Carbon\Carbon::parse($_date)->format('Y');
        $month = $explodeDate[1];//\Carbon\Carbon::parse($_date)->format('m');
        $date = $explodeDate[2];//\Carbon\Carbon::parse($_date)->format('d');

        $np_date = $dt->nep_to_eng($year, $month, $date);

        $final_date = $np_date['year'].'-'.$np_date['month'].'-'.$np_date['date'];
        return Carbon::parse($final_date)->format($format);
    // }catch(\Exception $e) {
    //     dd($e);
    // }
}



function englishToNepaliDate($_date, $format="Y-m-d") {
    $dt = new \App\Packages\DateConverter();
    $year = \Carbon\Carbon::parse($_date)->format('Y');
    $month = \Carbon\Carbon::parse($_date)->format('m');
    $date = \Carbon\Carbon::parse($_date)->format('d');

    $np_date = $dt->eng_to_nep($year, $month, $date);
    $final_date = $np_date['year'].'-'.sprintf("%02d", $np_date['month']).'-' . sprintf("%02d", $np_date['date']);
//    $final_date = $np_date['year'].'-'.$np_date['month'].'-' . $np_date['date'];
    return $final_date;
}
///////////argument date only
*/

////date time as argument
function nepaliToEnglishDate($_date, $format="Y-m-d") {
    // try {

    $explodeDateTime = explode(' ', $_date);
    $_date = $explodeDateTime[0]; $_time = $explodeDateTime[1] ?? null;

    $explodeDate = explode('-', $_date);
    $year =  $explodeDate[0];//\Carbon\Carbon::parse($_date)->format('Y');
    $month = $explodeDate[1];//\Carbon\Carbon::parse($_date)->format('m');
    $date = $explodeDate[2];//\Carbon\Carbon::parse($_date)->format('d');

    $dt = new \App\Packages\DateConverter();
    $np_date = $dt->nep_to_eng($year, $month, $date);

    $final_date = $np_date['year'].'-'.$np_date['month'].'-'.$np_date['date'];

    return $_time ?  Carbon::parse($final_date)->format($format).' '.$_time
        :  Carbon::parse($final_date)->format($format);

    // }catch(\Exception $e) {
    //     dd($e);
    // }
}

function englishToNepaliDate($_date, $format="Y-m-d") {


    $explodeDateTime = explode(' ', $_date);
    $_date = $explodeDateTime[0];
    $_time = $explodeDateTime[1] ?? null;

    $dt = new \App\Packages\DateConverter();
    $year = \Carbon\Carbon::parse($_date)->format('Y');
    $month = \Carbon\Carbon::parse($_date)->format('m');
    $date = \Carbon\Carbon::parse($_date)->format('d');

    $np_date = $dt->eng_to_nep($year, $month, $date);
    $final_date = $np_date['year'].'-'.sprintf("%02d", $np_date['month']).'-' . sprintf("%02d", $np_date['date']);
//    $final_date = $np_date['year'].'-'.$np_date['month'].'-' . $np_date['date'];
    return  $_time ? $final_date.' '.$_time : $final_date;
}
////date time as argument

// function convertDateAsConfigured ($date) {
//     $configuration = App\Models\Main\TenantConfiguration::where('tenant_id', auth()->user()->tenant->id)
//         ->value('configuration');
//     return $configuration['date_type'] == 'bs' ? englishToNepaliDate($date) : $date;
// }

// function convertDateForValidation($date)
// {
//     $configuration = App\Models\Main\TenantConfiguration::where('tenant_id', auth()->user()->tenant->id)
//         ->value('configuration');
//     return $configuration['date_type'] == 'bs' ? nepaliToEnglishDate($date) : $date;

// }

function isYearLeapYear($yearInAD)
{
    return (new \App\Packages\DateConverter())->is_leap_year($yearInAD);
}

function getOpeningDrCrFromAmount(float $amount) : array
{
    return $amount >= 0 ? ['dr' => $amount, 'cr' => 0]
        : ['dr' => 0, 'cr' => abs($amount)];
}

function getNepaliDateInWords () {
    $dt = new \App\Packages\DateConverter();
    $np_date = $dt->eng_to_nep(date('Y'),date('m'),date('d'));
    $final_date = addOrdinalNumberSuffix($np_date['date']) . ' ' . getNepaliMonths()[$np_date['month']-1] . ', ' . $np_date['year'] ;
    return $final_date;
}
/*
   end date conversion helpers
*/

   if(!function_exists('maindDatabaseNameFromAppName'))
   {
        function maindDatabaseNameFromAppName()
        {
//           return \Illuminate\Support\Str::slug(\Illuminate\Support\Env::get('APP_NAME', 'billing_ird'), '_').'_main';
            return config("database.connections.main.database");
        }
   }

   if(!function_exists('successResponse'))
   {
        function successResponse($message = 'successful!', $data = null)
        {
            $response = ['status' => true, 'message' => $message];
            if(isset($data)) $response['data'] = $data;

           return response()->json($response);
        }
   }

   if(!function_exists('failResponse'))
   {
        function failResponse($message = 'failed !', $errors = null, $statusCode = 200)
        {
            $response = ['status' => false, 'message' => $message];
            if(isset($errors)) $response['errors'] = $errors;

           return response()->json($response, $statusCode);
        }
   }

    if (!function_exists('stitchNames')) {
        function stitchNames(iterable $collection, iterable $ids = []) : string
        {
            return count($ids) ? $collection->whereIn('id', $ids)->implode('name' , ', ')
                : $collection->implode('name' , ', ');
        }
    }

    if (!function_exists('veda_api_key')) {
        function veda_api_key(): string
        {
            return "ZkhiNi9LWkFyR0Z1WitmMktIS0I1QT09";
        }
    }










