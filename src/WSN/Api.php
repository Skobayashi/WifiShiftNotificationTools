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
     * @return boolean
     **/
    public function sendWifiShiftNoticeMail ()
    {
        $this->shift->setTime(time());

        if ($this->shift->check() === false) {
            throw new \Exception('シフトの日ではありません');
        }

        $user = $this->shift->getShiftUser();

        $subject = 'Wifiパスワード定期変更シフト通知';
        $body = '<p>今晩、Wifiパスワードを変更しましょう。<br />'.
            '今回の担当は <b>'.$user.'</b> です。</p>'.
            '<p><a href="http://192.168.1.240/" target="_blank">パスワード設定画面</a></p>'.
            '<p><a href="https://docs.google.com/a/iii-planning.com/document/d/1qf9Cw7xdykw_kWalbighMVbXp6LnCD2XlC1uSq5HDJw/edit" target="_blank">パスワード変更手順</a></p>'.
            '<p><a href="https://docs.google.com/a/iii-planning.com/viewer?a=v&pid=sites&srcid=aWlpLXBsYW5uaW5nLmNvbXxzcGVjaWZpY2F0aW9uc3xneDo3NGMyYzdlOGU5OTAwMDJj" target="_blank">パスワード貼付け用紙</a></p>';

        $to = array('suguru@iii-planning.com');

        $this->ses->sendEmail($subject, $body, $to);

        return true;
    }
}

