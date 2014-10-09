<?php


namespace WSN\Test;

class MockTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * インターフェイス
     *
     * @var array
     **/
    private $methods = array(
        'getAccessKeyId',
        'getSecretKey',
        'getSecurityToken',
        'getExpiration',
        'setAccessKeyId',
        'setSecretKey',
        'setSecurityToken',
        'setExpiration',
        'isExpired'
    );


    /**
     * コンストラクタ引数のモックを取得する
     *
     * @return array
     **/
    public function getConstructArguments ()
    {
        $arguments = array(
            $this->getCredentialsInterfaceMock(),
            $this->getSignatureInterfaceMock(),
            $this->getCollectionMock()
        );

        return $arguments;
    }


    /**
     * @return Collection
     **/
    public function getCollectionMock ()
    {
        $mock = $this->getMock('Guzzle\Common\Collection');

        return $mock;
    }


    /**
     * @return CredentialsInterface
     **/
    public function getCredentialsInterfaceMock ()
    {
        $mock = $this->getMock('Aws\Common\Credentials\CredentialsInterface');

        return $mock;
    }


    /**
     * @return SesClient_Mock
     **/
    public function getSesMock ()
    {
        $arguments = $this->getConstructArguments();
        $methods   = array_merge($this->methods, array(
            'sendEmail'
        ));

        $mock = $this->getMock('Aws\Ses\SesClient', $methods, $arguments);

        return $mock;
    }


    /**
     * @return SignatureInterface
     **/
    public function getSignatureInterfaceMock ()
    {
        $mock = $this->getMock('Aws\Common\Signature\SignatureInterface');

        return $mock;
    }
}

