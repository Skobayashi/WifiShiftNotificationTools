<?php


use WSN\Test\MockTestCase;

use Acm\Acm;
use WSN\Api;
use WSN\Aws\Ses;

class ApiTest extends MockTestCase
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
     * @var Ses
     **/
    private $ses;


    /**
     * @return void
     **/
    public function setUp ()
    {
        $this->api = new Api();

        $methods = array('setTime', 'check');
        $this->shift = $this->getMock('WSN\Shift');
        $this->shift->expects($this->any())->method('setTime', 'getShiftUser');
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


    /**
     * @test
     * @large
     * @group api-send-shift-notice-mail
     * @group api
     */
    public function シフト事前通知メールの送信 ()
    {
        $this->shift->expects($this->any())
            ->method('check')
            ->will($this->returnValue(true));

        $this->shift->expects($this->any())
            ->method('getShiftUser')
            ->will($this->returnValue('小林'));

        $this->ses = $this->getMock('WSN\Aws\Ses', array('sendEmail'), array($this->getSesMock()));

        $this->api->setShift($this->shift);
        $this->api->setSes($this->ses);
        $result = $this->api->sendWifiShiftNoticeMail();

        $this->assertTrue($result);
    }
}
