<?php


namespace WSN;

use WSN\Aws\Ses;

class Api
{

    /**
     * @var Shift
     **/
    private $shift;


    /**
     * @param  $shift Shift
     * @return void
     **/
    public function setShift ($shift)
    {
        $this->shift = $shift;
    }


    /**
     * @param  $ses Ses
     * @return void
     **/
    public function setSes (\WSN\Aws\Ses $ses)
    {
        $this->ses = $ses;
    }


    /**
     * シフトの事前通知メール送付
     *
     * @return void
     **/
    public function sendWifiShiftNoticeMail ()
    {
        $this->shift->setTime(time());
        if ($this->shift->check() === false) {
            throw new \Exception('シフトの日ではありません');
        }

        $user = $this->shift->getShiftUser();
    }
}

