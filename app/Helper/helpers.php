<?php
namespace App\Helper;

use App\GroupMember;
use App\User;
use Illuminate\Support\Facades\Auth;


class Helper
{

    const NGAJI_BARENG = 2;
    const NGAJI_BARENG_USTADZ = 1;

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
    
    public static function getGroupType($type){
        return strlen($type) == 1 ? 'Grup Ngaji Bareng Ustadz' : 'Grup Ngaji Bareng'; 
    }

    public static function checkRoleInGrup($group_id, $user_id){
        $data = GroupMember::selectRaw('*')->where('group_ngaji_id', $group_id)->where('user_id', $user_id)->get()->first();
        return $data->role_type;
    }


    public static function getName($user_id){
        $data = User::where('id', $user_id)->get();
        return $data[0]->first_name;
    }

    public static function getTitle($gender) {
        return $gender == 'L' ? 'Ustadz' : 'Ustadzah';
    }




}
