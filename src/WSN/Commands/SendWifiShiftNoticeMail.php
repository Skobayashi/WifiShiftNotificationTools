<?php

use Emerald\Command\AbstractCommand;
use Emerald\Command\CommandInterface;

use WSN\Api;
use WSN\Shift;

class SendWifiShiftNoticeMail extends AbstractCommand implements CommandInterface
{

    /**
     * コマンドの実行
     *
     * @param  array $params  パラメータ配列
     * @return void
     **/
    public function execute (Array $params)
    {
        try {
            $api = new Api();
            $api->setShift(new Shift());
            $api->sendWifiShiftNoticeMail();

        } catch (\Exception $e) {
            $this->errorLog($e->getMessage());
        }
    }


    /**
     * ヘルプメッセージの表示
     *
     * @return string
     **/
    public static function help ()
    {
        return 'wifiパスワード担当の通知メールを送付する';
    }
}
