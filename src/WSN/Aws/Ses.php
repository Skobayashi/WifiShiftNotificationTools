<?php


namespace WSN\Aws;

class Ses
{

    /**
     * @var SesClient
     **/
    private $client;


    /**
     * @var string
     **/
    private $from_address = 'info@gemini-project.net';


    /**
     * @param  SesClient $client
     * @return void
     **/
    public function __construct (\Aws\Ses\SesClient $client)
    {
        $this->client = $client;
    }


    /**
     * メールの送信
     *
     * @param  string $subject
     * @param  string $body
     * @param  array  $to
     * @param  array  $cc
     * @param  array  $bcc
     * @return true
     **/
    public function sendEmail ($subject, $body, $to, $cc = array(), $bcc = array())
    {
        try {
            if (! is_array($to))  $to  = array($to);
            if (! is_array($cc))  $cc  = array($cc);
            if (! is_array($bcc)) $bcc = array($bcc);

            $this->client->sendEmail(array(
                'Source' => $this->from_address,
                'Destination' => array(
                    'ToAddresses' => $to,
                    'CcAddresses' => $cc,
                    'BccAddresses' => $bcc
                ),
                'Message' => array(
                    'Subject' => array(
                        'Data' => $subject,
                        'Charset' => 'ISO-2022-JP'
                    ),
                    'Body' => array(
                        'Html' => array(
                            'Data' => $body,
                            'Charset' => 'ISO-2022-JP'
                        )
                    )
                ),
                'ReplyToAddresses' => array($this->from_address)
            ));
        
        } catch (\Exception $e) {
            throw $e;
        }

        return true;
    }
}

