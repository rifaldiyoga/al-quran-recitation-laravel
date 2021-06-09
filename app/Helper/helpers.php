<?php
namespace App\Helper;

use App\GroupMember;

class Helper
{

    public function __construct()
    {

    }


    public static function arabic_w2e($str)
    {
        $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($arabic_western, $arabic_eastern, $str);
    }


    public static function arabic_e2w($str)
    {
        $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($arabic_eastern, $arabic_western, $str);
    }

    public static function countMember($group_id){
        $data = GroupMember::selectRaw('count(*) as count')->where('group_ngaji_id', $group_id)->groupBy('group_ngaji_id')->get();
        return !$data->isEmpty() ? $data[0]->count : 0 ;
    }

    public static function limitChar($string, $limit){
        return strlen($string) > $limit ? substr($string, 0, $limit - 3).'...' : $string; 
    }    

}
