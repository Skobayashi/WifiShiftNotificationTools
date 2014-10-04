<?php


use WSN\Shift;

class ShiftTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Shift
     **/
    private $shift;


    /**
     * @return void
     **/
    public function setUp ()
    {
        $this->shift = new Shift();
    }


    /**
     * @test
     * @group shift-check-true
     * @group shift
     */
    public function 当番の日付だった場合 ()
    {
        // 2014年10月30日 3時0分
        $time = mktime(3, 0, 0, 10, 30, 2014);
        $this->shift->setTime($time);
        $this->assertTrue($this->shift->check());


        // 2015年7月9日 16時30分
        $time = mktime(16, 30, 0, 7, 9, 2015);
        $this->shift->setTime($time);
        $this->assertTrue($this->shift->check());
    }


    /**
     * @test
     * @group shift-check-false
     * @group shift
     */
    public function 当番の日付ではなかった場合 ()
    {
        // 2013年10月4日 14時26分
        $time = mktime(14, 26, 0, 10, 4, 2013);
        $this->shift->setTime($time);
        $this->assertFalse($this->shift->check());


        // 2014年10月29日 20時19分
        $time = mktime(20, 19, 0, 10, 29, 2014);
        $this->shift->setTime($time);
        $this->assertFalse($this->shift->check());
    }


    /**
     * @test
     * @group shift-get-user
     * @gorup shift
     */
    public function 当番を取得する ()
    {
        $time = mktime(0, 0, 0, 11, 13, 2014);
        $this->shift->setTime($time);
        $user = $this->shift->getShiftUser();
        $this->assertEquals('小林', $user);

        $time = mktime(0, 0, 0, 10, 2, 2014);
        $this->shift->setTime($time);
        $user = $this->shift->getShiftUser();
        $this->assertEquals('彦坂', $user);

        $time = mktime(0, 0, 0, 12, 25, 2014);
        $this->shift->setTime($time);
        $user = $this->shift->getShiftUser();
        $this->assertEquals('彦坂', $user);
    }
}

