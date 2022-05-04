<?php
/**
 * Created for checking if billing files are exist for the month and member
 */
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

class SearchInvoicePdf
{
    public static $basepath= "monthly_invoices/";

    private static $detailBillFormat= "{member_code}-{month}-{year}billdetail";

    private static $summaryBillFormat= "{member_code}-{month}-{year}bill";

    private static $months= [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
        ];

    
    public static function isBillUploaded(string $monthlyFolderPath="")
    {
        $monthlyFolderPath= strtoupper($monthlyFolderPath);
        
        return Storage::exists(self::$basepath . $monthlyFolderPath);
    }

    public static function getDetailBillLink(string $memberCode, string $monthlyFolderPath="")
    {

        //Replace three letter month
        // $m_array contains matched elements of array.
        //$m_array = preg_grep("/$monthlyFolderPath\s.*/", self::$months);
        $monthlyFolderPath= strtoupper($monthlyFolderPath);

        $extract= explode(" ", $monthlyFolderPath);

        $results = array_filter(self::$months, function ($value) use (&$extract) {
            return stripos($value, $extract[0]) !== false;
        });

        list($billmonth) = array_values($results);
         
        //Build array for string replacement
        $input= [
            '{member_code}' => $memberCode,
            '{month}'       => strtoupper($billmonth),
            '{year}'         => $extract[1]
        ];
        
        $fileName= strtr(self::$detailBillFormat, $input);

        // list all filenames in given path
        $allFiles = Storage::allFiles(self::$basepath . implode("_", $extract));

        // filter the ones that match the filename.*
        $matchingFiles = preg_grep("/^$fileName$/i", $allFiles);

        $downloadURl= route('member.download', ['month' => $extract[0], 'year'=> $extract[1], 'filename'=> "{$fileName}.PDF"]);
        
        return (!empty($matchingFiles)) ?  $downloadURl : null;
    }

    public static function getSummaryBillLink(string $memberCode, string $monthlyFolderPath="")
    {
        $monthlyFolderPath= strtoupper($monthlyFolderPath);

        $extract= explode(" ", $monthlyFolderPath);

        $results = array_filter(self::$months, function ($value) use (&$extract) {
            return stripos($value, $extract[0]) !== false;
        });

        list($billmonth) = array_values($results);
         
        //Build array for string replacement
        $input= [
            '{member_code}' => $memberCode,
            '{month}'       => strtoupper($billmonth),
            '{year}'         => $extract[1]
        ];

        $fileName= strtr(self::$summaryBillFormat, $input);

        // list all filenames in given path
        $allFiles = Storage::allFiles(self::$basepath . implode("_", $extract));

        // filter the ones that match the filename.*
        $matchingFiles = preg_grep("/$fileName/i", $allFiles);

        $downloadURl= route('member.download', ['month' => $extract[0], 'year'=> $extract[1], 'filename'=> "{$fileName}.PDF"]);

        return (!empty($matchingFiles)) ? $downloadURl : null;
    }
}
