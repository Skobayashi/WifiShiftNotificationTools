<?php


use Acm\Acm;
use WSN\Aws\Ses;

class SesTest extends PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @group ses-instance
     * @group ses
     **/
    public function インスタンスの生成 ()
    {
        $ses = new Ses(Acm::getSes());
        $this->assertInstanceOf('WSN\Aws\Ses', $ses);
    }
}

