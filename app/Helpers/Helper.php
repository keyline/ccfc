<?php
namespace App\Helpers;
use Session;
use DateInterval;
use DateTime;
use DatePeriod;

class Helper{
 
    public static function pr($data, $action = TRUE){
        print "<pre>";
        print_r($data);
        if($action):
            die;
        endif;
    }
    public static function formatDateTime($object, $format = ''){
        return date_format(date_create($object), $format);
    }
    public static function returnJson($returnData = array(), $mode = TRUE){
        print json_encode($returnData);
        if ($mode) :
            die;
        endif;
    }
    public static function encoded($param){
        return urlencode(base64_encode($param));
    }
    public static function decoded($param){
        return base64_decode(urldecode($param));
    }
    public static function extractJson($string){
        $valid = is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string))) ? true : false;
        if (!$valid) :
            responseToJson(FALSE, "Not JSON");
        else:
            return json_decode($string, TRUE);
        endif;
    }
    public static function checkApiKey($postData){
        if (!array_key_exists("key", $postData)) :
            responseToJson(FALSE, "Api key missing");
        elseif ($postData['key'] == "") :
            responseToJson(FALSE, "Key field empty");
        elseif ($postData['key'] != getenv('API_KEY')) :
            responseToJson(FALSE, "Wrong Api Key");
        endif;
    }
    public static function validateArray($keys, $arr){
        return !array_diff_key(array_flip($keys), $arr);
    }
    public static function responseToJson($success = TRUE, $message = "success", $data = NULL, $extraField = array()){
        $response = ["success" => $success, "message" => $message, "data" => $data];
        if (!empty($extraField)) :
            foreach ($extraField as $k => $v) :
                $response[$k] = $v;
            endforeach;
        endif;
        returnJson($response);
    }
    public static function uptoTwoDecimal($number){
        return number_format((float)$number, 2, '.', '');
    }
    public static function clean($string) 
    {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
       $string2 = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
       $string3 = preg_replace('/-+/', '-', $string2);
       return strtolower($string3);
    }
    /////////////////////////////////////new fn for time ago/////////////////////////////////////
    public static function time_ago($timestamp)
    {       
        $time_ago        = strtotime($timestamp);
        $current_time    = time();
        $time_difference = $current_time - $time_ago;
        $seconds         = $time_difference;
        
        $minutes = round($seconds / 60); // value 60 is seconds  
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
        $weeks   = round($seconds / 604800); // 7*24*60*60;  
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
                      
        if ($seconds <= 60){    
          return "Just Now";    
        } else if ($minutes <= 60){    
          if ($minutes == 1){    
            return "1 minute ago";    
          } else {    
            return "$minutes minutes ago";    
          }    
        } else if ($hours <= 24){    
          if ($hours == 1){    
            return "an hour ago";    
          } else {    
            return "$hours hrs ago";    
          }    
        } else if ($days <= 7){    
          if ($days == 1){    
            return "yesterday";    
          } else {    
            return "$days days ago";    
          }    
        } else if ($weeks <= 4.3){    
          if ($weeks == 1){    
            return "a week ago";    
          } else {    
            return "$weeks weeks ago";    
          }    
        } else if ($months <= 12){    
          if ($months == 1){    
            return "a month ago";    
          } else {    
            return "$months months ago";    
          }    
        } else {          
          if ($years == 1){    
            return "one year ago";    
          } else {    
            return "$years years ago";    
          }
        }
    }
    // Create a formatting function
    public static function formatting($phone){
        
        // Pass phone number in preg_match function
        if(preg_match(
            '/^\+[0-9]([0-9]{3})([0-9]{3})([0-9]{4})$/', 
        $phone, $value)) {
          
            // Store value in format variable
            // $format = $value[1] . '-' . $value[2] . '-' . $value[3];
            $format = $value[1] . '-' . $value[2] . '-' . '****';
        }
        else {             
            // If given number is invalid
            $format = "Invalid phone number";
        }
        return $format;
    }
    public static function get_starred($str) {
        $str_array =str_split($str);
        foreach($str_array as $key => $char) {
            if($key == 0 || $key == count($str_array)-1) continue;
            if($char != '-') $str[$key] = '*';
        }
        return $str;
    }
    // number convert to words
    public static function getIndianCurrency($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
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
        $paise = ($decimal) ? "and " . ($words[$decimal - ($decimal % 10)] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? 'Rupees '.$Rupees . '' : '') . $paise;
    }
    // specific word search check in a string
    public static function searchWordInString($sentence, $word){
        if (str_contains($sentence, $word)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    // get short day name
    public static function getShortDayName($dayNo){
        $day_name = '';
        if($dayNo == 1){
            $day_name = 'Sunday';
        } elseif($dayNo == 2){
            $day_name = 'Monday';
        } elseif($dayNo == 3){
            $day_name = 'Tuesday';
        } elseif($dayNo == 4){
            $day_name = 'Wednesday';
        } elseif($dayNo == 5){
            $day_name = 'Thursday';
        } elseif($dayNo == 6){
            $day_name = 'Friday';
        } elseif($dayNo == 7){
            $day_name = 'Saturday';
        }
        return $day_name;
    }
    // get short day name
    public static function getDayNo($dayName){
        $day_no = '';
        if($dayName == 'Sun'){
            $day_no = 1;
        } elseif($dayName == 'Mon'){
            $day_no = 2;
        } elseif($dayName == 'Tue'){
            $day_no = 3;
        } elseif($dayName == 'Wed'){
            $day_no = 4;
        } elseif($dayName == 'Thu'){
            $day_no = 5;
        } elseif($dayName == 'Fri'){
            $day_no = 6;
        } elseif($dayName == 'Sat'){
            $day_no = 7;
        }
        return $day_no;
    }
    // get time slots between two times
    public static function SplitTime($StartTime, $EndTime, $Duration="60"){
        $ReturnArray = array ();// Define output
        $StartTime    = strtotime ($StartTime); //Get Timestamp
        $EndTime      = strtotime ($EndTime); //Get Timestamp

        $AddMins  = $Duration * 60;

        while ($StartTime <= $EndTime) //Run loop
        {
            $ReturnArray[]  = date ("G:i:s", $StartTime);
            $StartTime += $AddMins; //Endtime check
        }
        return $ReturnArray;
    }
    // get date list between two dates
    public static function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        $array = array();
        $interval = new DateInterval('P1D');
    
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
    
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
    
        foreach($period as $date) { 
            $array[] = $date->format($format); 
        }
    
        return $array;
    }
}
?>