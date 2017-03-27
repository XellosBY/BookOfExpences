<?php

class Helper
{
    /**
     * debugPDO
     *
     * Shows the emulated SQL query in a PDO statement. What it does is just extremely simple, but powerful:
     * It combines the raw query and the placeholders. For sure not really perfect (as PDO is more complex than just
     * combining raw query and arguments), but it does the job.
     * 
     * @author Panique
     * @param string $raw_sql
     * @param array $parameters
     * @return string
     */
    static public function debugPDO($raw_sql, $parameters) {

        $keys = array();
        $values = $parameters;

        foreach ($parameters as $key => $value) {

            // check if named parameters (':param') or anonymous parameters ('?') are used
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            // bring parameter into human-readable format
            if (is_string($value)) {
                $values[$key] = "'" . $value . "'";
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }

        /*
        echo "<br> [DEBUG] Keys:<pre>";
        print_r($keys);
        
        echo "\n[DEBUG] Values: ";
        print_r($values);
        echo "</pre>";
        */
        
        $raw_sql = preg_replace($keys, $values, $raw_sql, 1, $count);

        return $raw_sql;
    }

    static public function mapModel($model, $from, $to){
        $array = [];
        foreach ($model as $item) {
            $array[$item->$from] = $item->$to;
        }
        return $array;
    }

    static public function generateCode($length=6) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

        $code = "";

        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];
        }

        return $code;
    }

    public static function checkLogin($login){
        $error = [];
        if(!preg_match("/^[a-zA-Z0-9]+$/",$login)){
            $error[] = "Логин может состоять только из букв английского алфавита и цифр";
        }

        if(strlen($login) < 3 or strlen($login) > 30){
            $error[] = "Логин должен быть не меньше 3-х символов и не больше 30";
        }
        return $error;
    }

    public static function getFilterSortArray(){
        return
        [
            0 => '',
            'date' => 'Дата',
            'category_id' => 'Категория',
            'direct_id' => 'Направление',
            'summ' => 'Сумма'
        ];
    }

    public static function addNullRowArray($array){
        $array[0] = '';
        return $array;
    }

    public static function get_time_array(){
        return
            [
                '0'=> ' ',
                '1'=> 'сегодня',
                '2'=> 'вчера',
                '3'=> 'текущая неделя',
                '4'=> 'прошлая неделя',
                '5'=> 'текущий месяц',
                '6'=> 'прошлый месяц',
                '7'=> 'текущий год',
                '8'=> 'прошлый год',
                '9'=> 'произвольный период'
            ];
    }

    public static function set_time_array($param){
        switch($param){
            case '1':
                $s = date('d.m.Y');
                $d = date('d.m.Y');
                break;
            case '2':
                $s = date('d.m.Y', strtotime('-1 day'));
                $d = date('d.m.Y', strtotime('-1 day'));
                break;
            case '3':
                if(date('D',time()) == 'Mon'){
                    $s = date('d.m.Y');
                }else{
                    $s = date("d.m.Y", strtotime("last Monday"));
                }
                $d = date('d.m.Y');
                break;
            case '4':
                if(date('D',time()) == 'Mon'){
                    $s = date('d.m.Y', strtotime("-1 week"));
                }else{
                    $s = date('d.m.Y', strtotime("last Monday -1 week"));
                }
                $d = date('d.m.Y', strtotime('last Sunday'));
                break;
            case '5':
                $s = date('d.m.Y', strtotime('first day of this month'));
                $d = date('d.m.Y');
                break;
            case '6':
                $s = date('d.m.Y', strtotime('first day of previous month'));
                $d = date('d.m.Y', strtotime('last day of previous month'));
                break;
            case '7':
                $s = date('d.m.Y', strtotime('first day of January this year'));
                $d = date('d.m.Y');
                break;
            case '8':
                $s = date('d.m.Y', strtotime('first day of January previous year'));
                $d = date('d.m.Y', strtotime('last day of December previous year'));
                break;
        }
        return [$s,$d];
    }

}