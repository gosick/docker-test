<?php 

require_once('phpunit-muzikOnline.php');

class Muzik extends WebTest
{
        protected $websiteUrl = 'http://dev.muzik-online.com/tw';
	protected function setUp() {
		parent::elementSetUp();
        $this->setBrowserUrl($this->websiteUrl);
	}

	/*public function test11() {

		$this->url('http://dev.muzik-online.com/tw');
        sleep(1);
        parent::countMenuList();
        sleep(1);
        parent::menu('login', $this->total['login'], 1);
        sleep(1);
        parent::login('gosick@test.com', 'gosick');
        sleep(1);
        parent::refresh();
        sleep(2);
        //parent::ads();
        sleep(2);
        parent::menu('memberProfile', $this->total['memberProfile'], 1);
        sleep(2);
        parent::memberProfileSelect('collection');
        sleep(2);
        parent::memberProfileSelect('songList');
        sleep(4);
        parent::fillSongListTitleAndDescription('test3232', '22ssdfest');
        parent::memberSongListOperation('new list', 1);
        sleep(2);
	}*/
        /*       
        public function testResponseCodeDj() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('allMusic', $this->total['allMusic'], 1);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");


        }

        public function testResponseCodeMember() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('allMusic', $this->total['allMusic'], 2);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");

        }

        public function testResponseCodeTheme() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('allMusic', $this->total['allMusic'], 3);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeMusic() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('allMusic', $this->total['allMusic'], 4);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");        
        }
        
        public function testResponseCodeAlbum() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('allMusic', $this->total['allMusic'], 5);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }


        public function testResponseCodeFocus() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('article', $this->total['article'], 1);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeCommodify() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('article', $this->total['artile'], 2);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeExpert() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('allMusic', $this->total['allMusic'], 8);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeConcert() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('concert', $this->total['concert'], 1);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeMuzik() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('periodical', $this->total['periodical'], 1);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeAllMusic() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('periodical', $this->total['periodical'], 2);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeService() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('memberCenter', $this->total['memberCenter'], 1);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeCashFlow() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('memberCenter', $this->total['memberCenter'], 2);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }
        
        public function testResponseCodeHomepage() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('homepage', $this->total['homepage'], 1);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeRegister() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('memberCenter', $this->total['memberCenter'], 1);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }

        public function testResponseCodeLogin() {

                $this->url($this->websiteUrl);
                sleep(1);
                parent::countMenuList();
                sleep(1);
                parent::menu('login', $this->total['login'], 1);
                $url = $this->url();
                sleep(1);
                $result = parent::getUrlList($url);
                $this->assertNull($result, "responseCode contains: 4xx, 5xx");
        }*/

        /*
        public function testWaitForAjaxAndTakeScreenshot() {

                $this->url($this->websiteUrl);
                $this->waitForAjax('byCssSelector', 'header.header', 5);
                parent::countMenuList();
                parent::menu('login', $this->total['login'], 1);
                $this->waitForAjax('byCssSelector', 'button.button-gold', 5);
                parent::login('f56112000@gmail.com', 'ss07290420');
                $this->waitForAjax('byCssSelector', 'a.name', 5);
                $this->waitForAjax('byCssSelector', 'header.header', 5);
                $this->waitForAjax('byCssSelector', 'div.player.jp-player', 5);
                parent::playerOpen();
                parent::playerheaderSelect('myList');
                $this->waitForAjax('byCssSelector', 'div.player-list.tinyscrollbar.jp-list', 5);
                $this->waitForAjax('byCssSelector', 'div.tbody', 5);
                parent::playerheaderSelect('myCollection');
                $this->waitForAjax('byCssSelector', 'div.player-list.tinyscrollbar.jp-list', 5);
                $this->waitForAjax('byCssSelector', 'ul.overview.ui-sortable', 5);
                $fp = fopen('homepage.jpg', 'wb');
                fwrite($fp, $this->currentScreenshot());
                fclose($fp);
        }
        */

        /*public function testaaaa() {

                $this->url($this->websiteUrl);
                //echo parent::$browsers[0]['browserName']."\n";
                if($this->getBrowser() == 'firefox')
                        echo "aaa";
                else
                        echo "bbb";
        }*/

      /*  public function testafaf() {

                $this->url($this->websiteUrl);

                if($this->getBrowser() == 'chrome'){
                        $this->waitForElement('byCssSelector', 'header.header', 5);
                        parent::countMenuList();
                        echo "a";
                        parent::menu('login', $this->total['login'], 1);
                        $this->waitForElement('byCssSelector', 'div.main', 10);
                        parent::login('f56112000@gmail.com', 'ss07290420');
                        $this->waitForElement('byCssSelector', 'header.header', 5);
                        //parent::menu('login', $this->total['login'], 1);
                        //$this->waitForAjax('byCssSelector', 'button.button-gold', 5);
                        //parent::login('f56112000@gmail.com', 'ss07290420');
                        //$this->waitForAjax('byCssSelector', 'a.name', 5);
                        //$this->waitForAjax('byCssSelector', 'header.header', 5);
                        //$this->waitForAjax('byCssSelector', 'div.player.jp-player', 5);
                        $this->scrollView();
                        //$this->prepareSession()->currentWindow()->maximize();
                        $fp = fopen('homepage.jpg', 'wb');
                        fwrite($fp, $this->currentScreenshot());
                        fclose($fp);

                }
        }*/

/*
        public function testLoginAndLogout() {

                parent::url($this->websiteUrl);

                parent::waitForElement('byCssSelector', 'header.header', 5);
                parent::countMenuList();
                parent::menu('login', $this->total['login'], 1);
                parent::waitForElement('byId', 'account', 10);
                parent::login('f56112000@gmail.com', 'ss07290420');
                parent::waitForElement('byCssSelector', 'header.header', 5);
                parent::menu('logout', $this->total['logout'], 1);
        }
*/
        public function testResgister() {

                parent::url($this->websiteUrl);

                parent::waitForElement('byCssSelector', 'header.header', 5);
                parent::countMenuList();
                parent::menu('register', $this->total['register'], 1);
                parent::waitForElement('byId', 'account', 10);
                $account = parent::memberAccountGenerate();
                $password = parent::memberPasswordGenerate();
                parent::register($account, $password);
                parent::ads();
                parent::waitForElement('byCssSelector', 'header.header', 5);
                parent::menu('logout', $this->total['logout'], 1);

        }
  

}       

?>