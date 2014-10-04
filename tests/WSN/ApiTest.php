<?php


use WSN\Api;

class ApiTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Api
     **/
    private $api;


    /**
     * @var Shift
     **/
    private $shift;


    /**
     * @return void
     **/
    public function setUp ()
    {
        $this->api = new Api();

        $methods = array('setTime', 'check');
        $this->shift = $this->getMock('WSN\Shift');
        $this->shift->expects($this->any())->method('setTime');
    }


    /**
     * @test
     * @expectedException           Exception
     * @expectedException           シフトの日ではありません
     * @group api-not-shift-day
     * @group api
     */
    public function シフトの日ではない場合 ()
    {
        $this->shift->expects($this->any())
            ->method('check')
            ->will($this->returnValue(false));

        $this->api->setShift($this->shift);
        $this->api->sendWifiShiftNoticeMail();
    }
}
