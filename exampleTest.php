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

    public function aaa(){

    }

    public function setHostOfBoot2Docker() {

        global $argv, $argc;

        $this->setHost('localhost');

        $count = 0;
        foreach ($argv as $value) {
            $count += 1;
            if(strcmp($value, "--host_ip_docker") == 0){
                $this->setHost($argv[$count]);
                break;
            }
        }
        
        
    }

    public function setHostOfOther() {

    	global $argv, $argc;

        $this->setHost('localhost');

        $count = 0;
        foreach ($argv as $value) {
            $count += 1;
            if(strcmp($value, "--host_ip_user") == 0){
                $this->setHost($argv[$count]);
                break;
            }
        }
    }


    public function setUp() {

    	//$this->setHostOfBoot2Docker();
        $this->setHostOfOther();
    	$this->setBrowserUrl($this->websiteUrl);
    }
    public function testexample(){
    	$this->url($this->websiteUrl);
    }
}
?>