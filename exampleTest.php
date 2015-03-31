<?php 

class exampleTest extends PHPUnit_Extensions_Selenium2TestCase{

	protected $websiteUrl = 'http://dev.muzik-online.com/tw';

	public $parameters = array(
		'host'	=> 'localhost',
		'port'	=> 4444,
	);
	public static $browsers = array(

        array('browserName' => 'firefox',
        ),

        array('browserName' => 'chrome',
        ),
	);


    public function setHostOfBoot2Docker() {

    	exec("echo $HOST", $host);
    	$this->setHost($host[0]);
    }

    public function setHostOfDockerIO() {
    	exec("$(ip route | awk '/docker/ { print $NF }')", $host);
    	$this->setHost($host[0]);	
    }


    public function setUp() {

    	$this->setHostOfBoot2Docker();
    	$this->setBrowserUrl($this->websiteUrl);
    }
    public function testaa(){
    	$this->url($this->websiteUrl);
    	echo "aaa";
    }
}
?>