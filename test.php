<?php 

require_once('phpunit-muzikOnline.php');

class UiTest extends WebTest {

	protected $websiteUrl = 'http://dev.muzik-online.com/tw';

	public static $browsers = array(

        
        array(
            'browserName' => 'phantomjs', 
            'host'=>'localhost', 
            'port'=>4444,
        ),

        array(
            'browserName' => 'chrome',
            'host'=>'localhost',
            'port'=>4444,
        ), 

        array(
            'browserName' => 'firefox',
            'host'=>'localhost',
            'port'=>4444,
        ),
        
        
    );       

    public static $vars = array(
        'account' => '',
        'password' => '',
    );

    protected function setUp()
    {

		parent::elementSetUp();
        $this->setHostAndPortByUser();
        $this->setBrowserUrl($this->websiteUrl);
	}

	public function setHostAndPortByUser()
	{

        global $argv, $argc;

        $count = 0;
        foreach ($argv as $value) {
            $count += 1;
            if(strcmp($value, "--host_ip_user") === 0){
                $this->setHost($argv[$count]);
            }
            if(strcmp($value, "--host_port_user") === 0){
                $this->setPort((int)$argv[$count]);
            }
        }
    }

    public function screenShot($file)
    {
    	$filedata = $this->currentScreenshot();
    	file_put_contents($file, $filedata);
    }

    public function useragent() {

        $testString = "Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_4 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B350 Safari/8536.25";
        $para = "general.useragent.override";

        shell_exec("mkdir firefox-profile");
        shell_exec("cd ./firefox-profile && echo 'user_pref(\"$para\", \"$testString\");' >> prefs.js && zip -r ../firefox-profile *");
        $data = file_get_contents('firefox-profile.zip');
        shell_exec("rm -rf firefox-profile && rm firefox-profile.zip");
        return base64_encode($data);

    }


	public function testRegisterAndClickAds()
	{
		$this->url($this->websiteUrl);

		try {

	        parent::waitForElement('byCssSelector', 'header.header', 10);
	        sleep(2);
	        parent::countMenuList();
	        parent::menu('register', $this->total['register'], 1);
	        sleep(2);  
	        parent::waitForElement('byCssSelector', 'div.primary-content.js-controller-content', 10);
	        parent::wait(1);
	        $this->password = parent::memberPasswordGenerate();
	        $this->account = parent::memberAccountGenerate();
	        self::$vars['account'] = $this->account;
	        self::$vars['password'] = $this->password;
	        parent::register($this->account, $this->password);
	        sleep(2);   
	        parent::ads();
	        sleep(2);
	        parent::menu('logout', $this->total['logout'], 1);

    	} catch (Exception $e) {

    		if($this->getBrowser() == 'phantomjs') {

    			$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

    		}

    		else if($this->getBrowser() == 'firefox') {

    			$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

    		}

    		else if($this->getBrowser() == 'chrome') {

    			$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

    		}
    		else {

    			$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');
    		}
    	}

	}

	public function testfirstSongListEnterError() {

		$this->url($this->websiteUrl);

		try {

	        parent::waitForElement('byCssSelector', 'header.header', 10);
	        parent::countMenuList();
	        parent::menu('login', $this->total['login'], 1);
	        parent::waitForElement('byCssSelector', 'div.primary-content.js-controller-content', 10);
	        parent::wait(1);
	        parent::login(self::$vars['account'], self::$vars['password']);
	        parent::wait(1);
	        parent::waitForElement('byCssSelector', 'header.header', 10);
	        parent::menu('memberProfile', $this->total['memberProfile'], 1);

	        parent::memberSongListOperation('del', 1); 
	        parent::fillSongListTitleAndDescription("test3232", "22ssdfest");
	        parent::memberSongListOperation('new list', 1);
	        parent::memberSongListOperation('enter', 1);
        
        	$this->assertNotEquals(parent::responseCode(10000, $this->url()), 404, "status code is 404");

    	} catch (Exception $e) {

    		if($this->getBrowser() == 'phantomjs') {

    			$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

    		}

    		else if($this->getBrowser() == 'firefox') {

    			$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

    		}

    		else if($this->getBrowser() == 'chrome') {

    			$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

    		}
    		else {

    			$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');
    		}
    	}
	}

	public function testRWDofUserAgentIphone() {

		$this->useragent();
        $this->url('http://study.muzik-online.com/tw');

        if($this->getBrowser() == 'phantomjs') {

        	$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        else if($this->getBrowser() == 'firefox') {
            
            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        else if($this->getBrowser() == 'chrome') {

            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        else {

            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }

	}

	public function testRWDofWidth() {

		$this->url('http://event.muzik-online.com/piano/');

        $this->prepareSession()->currentWindow()->maximize();
        sleep(5);

        if($this->getBrowser() == 'phantomjs') {
            
            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        else if($this->getBrowser() == 'chrome') {
            
            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        else if($this->getBrowser() == 'firefox') {
            
            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        else{
            
            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        sleep(5);

        $window = $this->currentWindow();
        $window->size(array('width' => 300, 'height' => 540));

        if($this->getBrowser() == 'phantomjs') {
            
            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        else if($this->getBrowser() == 'chrome') {
            
			$this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        else if($this->getBrowser() == 'firefox') {
            
            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }
        else{
            
            $this->screenShot(__DIR__.'/report'.'/'.$this->getName().'-'.$this->getBrowser().'-'.time(). '.png');

        }


     //   $window->size(array('width' => 892, 'height' => 540));
	}
}

// 註冊

// 登入

// ＲＷＤ user agent width

// player function

// equivalence search

// 404 error

// status code





?>