<?php


namespace WSN;

class Shift
{

    /**
     * wifiパスワード更新を初めた日付のタイムスタンプ -- 2014年10月2日
     *
     * @var int
     **/
    private $base_time;


    /**
     * 指定日のタイムスタンプ
     *
     * @var int
     **/
    private $today_time;


    /**
     * @return array
     **/
    private $users = array(
        '彦坂', '小林'
    );


    /**
     * @return void
     **/
    public function __construct ()
    {
        $this->base_time = mktime(0, 0, 0, 10, 2, 2014);
    }


    /**
     * 比較する日付を指定する
     *
     * @param  int $time  タイムスタンプ
     * @return void
     **/
    public function setTime ($time)
    {
        $year  = date('Y', $time);
        $month = date('m', $time);
        $day   = date('d', $time);

        $this->today_time = mktime(0, 0, 0, $month, $day, $year);
    }


    /**
     * @return array
     **/
    public function getUsers ()
    {
        return $this->users;
    }


    /**
     * 指定日がシフトの日かどうかを判定する
     *
     * @return boolean
     **/
    public function check ()
    {
        // 隔週でシフトが回ってくるため、
        // baseとtodayの差分を(60 * 60 * 24) * 14 で割り切れればシフトの日になる
        $diff = $this->today_time - $this->base_time;
        $course = (60 * 60 * 24) * 14;

        $result = $diff % $course;
        return ($result === 0) ? true: false;
    }


    /**
     * シフト日の該当ユーザを取得する
     *
     * @return string
     **/
    public function getShiftUser ()
    {
        // ユーザ合計を今までのシフト総数で割った余りが順番になる
        $diff   = $this->today_time - $this->base_time;
        $course = (60 * 60 * 24) * 14;
        $count  = floor($diff / $course);

        $turn = $count % count($this->getUsers());
        return $this->users[$turn];
    }
}

