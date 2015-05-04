<?php

class WebTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected $total, $host, $refresh, $cookies;
    protected $account, $accountpath, $password, $passwordpath;
    protected $passwordConfirm, $btnSend, $keyword, $searchBtn;
    protected $periodicalTag, $mySelfFlag, $playerFlag, $songRepeat;
    protected $otherSongListAmount, $collectionAmount, $songListAmount;
    protected $playerMyList, $playerMyCollection, $playertemporaryList;
    protected $playerMyCollectionContent, $playerMyListContent;
    protected $songListTitle, $songListDescription;
    protected $element;

    const CONNECT_TIMEOUT_MS = 500;


/*******************************************************************************
* Setting up elements which used for functions
*/    
    public function elementSetUp() {

        $this->account = '';
        $this->password = '';
        $this->songListTitle = '';
        $this->songListDescription = '';
        $this->accountpath = 'account';
        $this->passwordpath = 'password';
        $this->passwordConfirm = 'password_confirm';
        $this->btnSend = 'button-gold';
        $this->periodicalTag = '';
        $this->keyword = 'keyword';
        $this->searchBtn = 'span.icon.icon-header-search';
        $this->songRepeat = 0;
        $this->songListAmount = 0;
        $this->collectionAmount = 0;
        $this->otherSongListAmount = 0;
        $this->mySelfFlag = false;
        $this->playerFlag = 'null';
        $this->playerMyList = 0;
        $this->playerMyCollection = 0;
        $this->playertemporaryList = 0;
        $this->element = '';
    }

 
 
/*******************************************************************************
* Waiting for timeout or you can use waitForElement()
*/
    public function wait($second) {
        $this->timeouts()->implicitWait($second * 1000);
    }

/*******************************************************************************
* Counting the float menu
*/
    public function countFloatMenu(){
        return count($this->elements($this->using('xpath')->value('//div[@class="float js-float menu"]/div/div/div/div[2]/ul/li')));
    }

/*******************************************************************************
* Counting the MyList left column content in the player
*/
    public function countPlayerMyListLeftColumnContent() {
        return count($this->elements($this->using('xpath')->value('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li'))) - 1;
    }

/*******************************************************************************
* Counting the MyCollection left column content in the player
*/
    public function countPlayerMyCollectionLeftColumnContent() {
        return count($this->elements($this->using('xpath')->value('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li')));
    }

/*******************************************************************************
* Counting the member songs in a song list
*/
    public function countMemberSong() {
        return count($this->elements($this->using('xpath')->value('//div[@class="compoTable"]/ul/li'))) - 1;
    }

/*******************************************************************************
* Counting the member song lists
*/
    public function countMemberSongList() {
        return count($this->elements($this->using('xpath')->value('//div[@class="listenContentInner clearfix"]/div')));
    }

/*******************************************************************************
* Counting the member collections of other members
*/
    public function countMemberCollection() {
        return count($this->elements($this->using('xpath')->value('//div[@class="listen-list listen-subscribe"]/ul/li')));
    }

/*******************************************************************************
* Counting the menu list at the header of the page
*/
    public function countMenuList() {

        $allMusic = count($this->elements($this->using('xpath')->value('//div[@class="container"]/nav/ul/li[1]/ul/li')));
        $article = count($this->elements($this->using('xpath')->value('//div[@class="container"]/nav/ul/li[2]/ul/li')));
        $periodical = count($this->elements($this->using('xpath')->value('//div[@class="container"]/nav/ul/li[4]/ul/li')));
        $memberCenter = count($this->elements($this->using('xpath')->value('//div[@class="container"]/nav/ul/li[5]/ul/li')));

        $this->total = array(

            'allMusic' => $allMusic,
            'article' => $article,
            'periodical' => $periodical,
            'memberCenter' => $memberCenter,
            'concert' => 1,
            'search' => 1,
            'login' => 1,
            'register' => 1,
            'homepage' => 1,
            'memberProfile' => 1,
            'logout' => 1,
            'payment' => 1,
        );

    }

/*******************************************************************************
* Scrolling down 250 pixels for chrome's view
*/
    public function scrollView() {

                $script = 'window.scrollBy(0, 250)';
                $scroll = array(
                        'script' => $script,
                        'args' => array()
                );
                
                $this->execute($scroll);

    }

/*******************************************************************************
* Waiting for element for some seconds
*/
    public function waitForElement($selectBy, $element, $second) {

                $this->element = $element;
                switch ($selectBy) {

                        case 'byCssSelector':
                                $this->waitUntil(function () {
                                        if ($this->byCssSelector($this->element)) {
                                                return true;
                                        }
                                        return null;
                                }, $second * 1000);

                                break;
                        case 'byXPath':
                                $this->waitUntil(function () {
                                        if ($this->byXPath($this->element)) {
                                                return true;
                                        }
                                        return null;
                                }, $second * 1000);

                                break;
                        case 'byId':
                                $this->waitUntil(function () {
                                        if ($this->byId($this->element)) {
                                                return true;
                                        }
                                        return null;
                                }, $second * 1000);

                                break;
                        case 'byName':
                                $this->waitUntil(function () {
                                        if ($this->byName($this->element)) {
                                                return true;
                                        }
                                        return null;
                                }, $second * 1000);

                                break;
                        case 'byLinkText':
                                $this->waitUntil(function () {
                                        if ($this->byLinkText($this->element)) {
                                                return true;
                                        }
                                        return null;
                                }, $second * 1000);

                                break;
                        case 'byPartialLinkText':
                                $this->waitUntil(function () {
                                        if ($this->byPartialLinkText($this->element)) {
                                                return true;
                                        }
                                        return null;
                                }, $second * 1000);

                                break;
                        case 'byClassName':
                                $this->waitUntil(function () {
                                        if ($this->byClassName($this->element)) {
                                                return true;
                                        }
                                        return null;
                                }, $second * 1000);

                                break;
                        case 'byTag':
                                $this->waitUntil(function () {
                                        if ($this->byTag($this->element)) {
                                                return true;
                                        }
                                        return null;
                                }, $second * 1000);

                                break;
                        default:
                                return null;
                                break;
                }
                
        }

/*******************************************************************************
* Menu for entering other pages
*/
    public function menu($select, $total, $index) {

        switch ($select) {

            case 'allMusic':

                $this->assertFalse($index > $total || $index <= 0,"all music element does not exist");
                $allMusic = 'li.wide.js-header-listen';
                $this->moveto($this->byCssSelector($allMusic));
                $url = '//div[@class="container"]/nav/ul/li[1]/ul/li['.$index.']/a';
                if(!$this->byXPath($url)->displayed())
                    $this->waitForElement('byXPath', $url, 5);
                $this->byXPath($url)->click();
                $this->refresh();
                break;

            case 'article':

                $this->assertFalse($index > $total || $index <= 0, "article element does not exist");
                $article = 'li.js-header-article';
                $this->moveto($this->byCssSelector($article));
                $url = '//div[@class="container"]/nav/ul/li[2]/ul/li['.$index.']/a';
                if(!$this->byXPath($url)->displayed())
                    $this->waitForElement('byXPath', $url, 5);
                $this->byXPath($url)->click();
                $this->refresh();
                break;

            case 'concert':

                $this->assertEquals(1, $total, "concert element does not exist");
                $url = '//div[@class="container"]/nav/ul/li[3]/a';
                $this->byXPath($url)->click();
                $this->refresh();
                break;

            case 'periodical':

                $this->assertFalse($index > $total || $index <= 0, "periodical element does not exist");
                $periodical = 'li.js-header-periodical';
                $this->moveto($this->byCssSelector($periodical));
                $this->wait(1);
                $url = '//div[@class="container"]/nav/ul/li[4]/ul/li['.$index.']/a';
                if(!$this->byXPath($url)->displayed())
                    $this->waitForElement('byXPath', $url, 5);
                $this->byXPath($url)->click();
                $this->refresh();
                break;

            case 'memberCenter':

                $this->assertFalse($index > $total || $index <= 0, "member center element does not exist");
                $memberCenter = 'li.js-header-member';
                $this->moveto($this->byCssSelector($memberCenter));
                $this->wait(1);
                $url = '//div[@class="container"]/nav/ul/li[5]/ul/li['.$index.']/a';
                if(!$this->byXPath($url)->displayed())
                    $this->waitForElement('byXPath', $url, 5);
                $this->byXPath($url)->click();
                $this->byXPath($url)->click();
                $this->refresh();
                break;

            case 'login':

                $this->assertFalse($this->checkLogin(), "have logged in!");
                $this->cookie()->clear();
                if(!$this->byCssSelector('div.login')->displayed())
                    $this->waitForElement('byCssSelector', 'div.login', 5);
                $this->byCssSelector('div.login > a:nth-child(1)')->click();
                break;

            case 'register':

                $this->assertEquals(1, $total, "register element does not exist");
                if(!$this->byCssSelector('div.login')->displayed())
                    $this->waitForElement('byCssSelector', 'div.login', 5);
                $this->byCssSelector('div.login > a:nth-child(2)')->click();
                break;

            case 'logout':

                $this->assertTrue($this->checkLogin(), "you should login first");
                $this->refresh();
                $this->moveto($this->byClassName('name'));
                $url = '//div[@class="info js-header-info"]/div/a[3]';
                if(!$this->byXPath($url)->displayed())
                    $this->waitForElement('byXPath', $url, 5);
                $this->byXPath($url)->click();
                break;
            
            case 'homepage':

                $this->assertEquals(1, $total, "homepage element does not exist");
                $url = '//div[@class="container"]/a';
                $this->byXPath($url)->click();
                $this->refresh();
                break;

            case 'memberProfile':

                $this->assertTrue($this->checkLogin(), "you should login first");
                $this->byCssSelector('a.name')->click();
                $this->mySelfFlag = true;
                $this->refresh();
                $this->wait(1);
                $this->countMemberSongList();
                break;

            case 'logout':

                $this->assertTrue($this->checkLogin(), "you should login first");
                $this->refresh();
                $this->moveto($this->byClassName('name'));
                $this->byXPath('//div[@class="info js-header-info"]/div/a[3]')->click();
                break;

            case 'payment':

                $this->assertTrue($this->checkLogin(), "you should login first");
                $this->moveto($this->byClassName('name'));
                $this->byXPath('//div[@class="info js-header-info"]/div/a[2]')->click();
                $this->refresh();
                break;

            default:
                break;
        }
    }

/*******************************************************************************
* Searching for composers or songs
*/
    public function search($string) {

        $this->wait(1);
        $this->byName($this->keyword)->value($string);
        $this->byCssSelector($this->searchBtn)->click();
    }

/*******************************************************************************
* Checking login
*/
    public function checkLogin() {

        $flag = false;

        if($this->cookies['name'] != null || $this->cookies['access'] != null) {
            $this->playerFlag = 'true';
            $flag = true;   
        }

        return $flag;
    }

/*******************************************************************************
* Randomly generating a member account
*/
    public function memberAccountGenerate() {

        $length = 10;
        $account = '';

        for($index = 1; $index <= $length; $index++) {
            $choose = rand(1, 3);
            if($choose == 1) {
                $result = chr(rand(97, 122));
            }
            if($choose == 2) {
                $result = chr(rand(65, 90));
            }
            if($choose == 3) {
                $result = rand(0, 9);
            }
            $account .= $result;
        }
        $account .= "@test.com";
        return $account;
        
    }

/*******************************************************************************
* Randomly generating a member password
*/   
    public function memberPasswordGenerate() {

        $length = 10;
        $password = '';
        $word = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';
        $len = strlen($word);

        for ($index = 0; $index < $length; $index++) {
            $password .= $word[rand() % $len];
        }

        return $password;
    }

/*******************************************************************************
* Member login
*/

    public function login($account, $password) {

        $this->byId($this->accountpath)->value($account);
        $this->byId($this->passwordpath)->value($password);
        $this->wait(1);
        $this->byClassName($this->btnSend)->click();
        sleep(1);
        $this->refresh();
        $this->wait(1);
        $this->cookies = array('name' => $this->cookie()->get('member_i18n'), 'access' => $this->cookie()->get('access_token'));
    }

/*******************************************************************************
* Registering a member
*/
    public function register($account, $password) {
                
        $this->byId($this->accountpath)->value($account);
        $this->byId($this->passwordpath)->value($password);
        $this->wait(1);
        $this->byId($this->passwordConfirm)->value($password);
        sleep(1);
        $this->byClassName($this->btnSend)->click();
        $this->wait(1);
        $this->cookies = array('name' => $this->cookie()->get('member_i18n'), 'access' => '');
    }

    public function checkAdOpen(){
        $adDivUrl = 'div.float-upgrade.js-float-upgrade.visible';
        if($this->byCssSelector($adDivUrl)->displayed()) {
            return true;
        }
        else {
            return false;
        }
    }

/*******************************************************************************
* Clicking advertisement
*/
    public function ads() {

        $adDivUrl = 'div.float-upgrade.js-float-upgrade.visible';
        $adElementUrl = '//div[@class="float-upgrade js-float-upgrade visible"]/div/iframe';
        $adDiv = $this->byCssSelector($adDivUrl);
        $adElement = $this->byXPath($adElementUrl);
        if(!$adDiv->displayed()) {
            $this->waitForElement('byCssSelector', $adDivUrl, 5);
            if(!$adElement->displayed()) {
                $this->waitForElement('byXPath', $adElementUrl, 5);
            }
            $this->frame($adElement);
            $this->byXPath('//div[@class="how-do-you-turn-this-on"]/ul/li[1]/div/div/div[1]/a')->click();
        }
        else {
            if(!$adElement->displayed()) {
                $this->waitForElement('byXPath', $adElementUrl, 5);
            }
            $this->frame($adElement);
            $this->byXPath('//div[@class="how-do-you-turn-this-on"]/ul/li[1]/div/div/div[1]/a')->click();
        }
    }

/*******************************************************************************
* Forget password 
*/
    public function forgetPassword($account, $password) {

        $this->menu('login', $this->total['login'], 1);
        sleep(1);
        $this->byXPath('//div[@class="forget"]/ul/li[1]/a')->click();
        sleep(2);
        $this->byId($this->accountpath)->value($account);
        $this->byId($this->passwordpath)->value($password);
        $this->byId($this->passwordConfirm)->value($password);
        $this->byClassName($this->btnSend)->click();
    }

/*******************************************************************************
* Selections in member profile page
*/

    public function memberProfileSelect($select) {

        switch ($select) {

            case 'collect':

                $this->assertFalse($this->mySelfFlag, "cannot collect myself");
                $this->byXPath('//div[@class="primary-content js-controller-content"]/section/div[2]/a')->click();
                break;

            case 'songList':

                $this->refresh();
                $url = '//div[@class="primary-content js-controller-content"]/div[1]/a[1]';
                $this->byXPath($url)->click();
                $this->refresh();
                sleep(2);
                $this->songListAmount = $this->countMemberSongList();
                break;
                
            case 'collection':

                $url = '//div[@class="primary-content js-controller-content"]/div[1]/a[2]';
                $this->byXPath($url)->click();
                $this->refresh();
                sleep(2);
                $this->collectionAmount = $this->countMemberCollection();
                break;
                
            case 'profile':

                $this->refresh();
                $url = '//div[@class="primary-content js-controller-content"]/div[1]/a[3]';
                $this->byXPath($url)->click();
                $this->wait(0.5);
                break;
            
            default:
                
                break;
        }
    }

/*******************************************************************************
* Filling a song list title and description
*/
    public function fillSongListTitleAndDescription($title, $description) {

        $this->songListTitle = $title;
        $this->songListDescription = $description;
    }

/*******************************************************************************
* Checking a song list title and description if updated
*/
    public function checkSongList($inputTitle, $inputDescription, $index) {

        $url = '//div[@class="listenContentInner clearfix"]/div['.$index.']/div';
        $getSonglistDiv = $this->byXPath($url);
        $this->moveto($getSonglistDiv);
        $this->waitForElement('byXPath', $url, 5);
        $this->wait(3);
        $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/div/div/a[3]')->click();
        $title = $this->byId('playlist_title')->value();
        $description = $this->byId('summary')->text();
        $this->byCssSelector('button.button.button-gold')->click();
        if((strcmp($title, $inputTitle) !== 0) && (strcmp($description, $inputDescription) !== 0)){
            return false;
        }
        else {
            return true;
        }
    }

/*******************************************************************************
* Checking a song list while deleting
*/
    public function checkDeleteSongList($index) {

        $index = $index + 1;
        $url = '//div[@class="listenContentInner clearfix"]/div['.$index.']/div';
        $getSonglistDiv = $this->byXPath($url);
        $this->moveto($getSonglistDiv);
        $this->waitForElement('byXPath', $url, 5);
        $this->wait(3);
        $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/div/div/a[3]')->click();
        $title = $this->byId('playlist_title')->value();
        $description = $this->byId('summary')->text();
        $this->byCssSelector('button.button.button-gold')->click();
        return array('title' => $title, 'description' => $description);
    }

/*******************************************************************************
* Operations of a song list
*/
    public function memberSongListOperation($select, $index) {

        sleep(3);
        $this->songListAmount = $this->countMemberSongList();

        switch ($select) {

            case 'new list':

                //--add new song list--//
                $this->assertTrue($this->mySelfFlag, "isn't myself, cannot add new lists");
                $number = $this->songListAmount + 1;
                $this->waitForElement('byCssSelector', 'div.btnAdd.add', '5');
                $this->byCssSelector('div.btnAdd.add')->click();
                $this->wait(0.5);
                $this->byId('playlist_title')->value($this->songListTitle);
                $this->byId('summary')->value($this->songListDescription);
                $this->wait(1);
                $this->byCssSelector('button.button.button-gold')->click();
                $this->songListAmount = $this->songListAmount + 1;
                $this->assertTrue($this->checkSongList($this->songListTitle, $this->songListDescription, $this->songListAmount), "add unsucessfully");
                break;

            case 'edit':

                //edit a song list
                $this->assertTrue($this->mySelfFlag, "isn't myself, cannot edit song lists");
                $this->assertNotEquals(0, $this->songListAmount, "song list is null, you cannot edit");
                $this->assertTrue($index > 0 && $index <= $this->songListAmount && $this->songListAmount > 0 && $this->mySelfFlag == true, "index is less than 0 or myself is false");
                $getSonglistDiv = $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/div');
                $this->moveto($getSonglistDiv);
                $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/div/div/a[3]')->click();
                $this->byId('playlist_title')->clear();
                $this->byId('playlist_title')->value($this->songListTitle);
                $this->byId('summary')->clear();
                $this->byId('summary')->value($this->songListDescription);
                $this->byCssSelector('button.button.button-gold')->click();
                $this->assertTrue($this->checkSongList($this->songListTitle, $this->songListDescription, $index), "edit unsucessfully");
                sleep(1);
                break;

            case 'copy':

                //copy a song list
                $this->assertNotEquals(0, $this->songListAmount, "song list is null, you cannot copy");
                $this->assertTrue($index > 0 && $index <= $this->songListAmount && $this->songListAmount > 0, "index is less than 0");
                $getSonglistDiv = $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/div');
                $this->moveto($getSonglistDiv);
                $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/div/div/a[2]')->click();
                $this->byId('playlist_title')->clear();
                $this->byId('playlist_title')->value($this->songListTitle);
                $this->byId('summary')->clear();
                $this->byId('summary')->value($this->songListDescription);
                $this->byCssSelector('button.button.button-gold')->click();
                if($this->mySelfFlag == true) {
                    $this->songListAmount = $this->songListAmount + 1;
                    $this->assertTrue($this->checkSongList($this->songListTitle, $this->songListDescription, $this->songListAmount), "copy unsucessfully");
                }
                else {
                    $this->menu('memberProfile', $this->total['memberProfile'], 1);
                    sleep(2);
                    $this->memberProfileSelect('songList');
                    sleep(2);
                    $this->assertTrue($this->checkSongList($this->songListTitle, $this->songListDescription, $this->songListAmount), "copy unsucessfully");
                }
                break;

            case 'play':

                //play the songs of the song list
                $this->playerFlag = 'temporaryList';
                $this->assertNotEquals(0, $this->songListAmount, "song list is null, you cannot play");
                $this->assertTrue($index > 0 && $index <= $this->songListAmount && $this->songListAmount > 0, "index is less than 0");
                $getSonglistDiv = $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/div');
                $this->moveto($getSonglistDiv);
                $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/div/div/a[5]')->click();
                break;

            case 'enter':

                //enter the song list
                $this->assertNotEquals(0, $this->songListAmount, "song list is null, you cannot enter");
                $this->assertTrue($index > 0 && $index <= $this->songListAmount && $this->songListAmount > 0, "index is less than 0");
                $getSonglistDiv = $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/a')->click();
                break;

            case 'del':

                //delete the song list
                $this->assertTrue($this->mySelfFlag, "isn't myself , cannot delete song lists");
                $this->assertNotEquals(0, $this->songListAmount, "song list is null, you cannot delete");
                $this->assertTrue($index > 0 && $index <= $this->songListAmount && $this->songListAmount > 0 && $this->mySelfFlag == true, "index is less than 0 or myself is false");
                
                $this->scrollView();
                $this->byCssSelector('div.btnDelete.remove')->click();
                $this->byXPath('//div[@class="listenContentInner clearfix"]/div['.$index.']/div/a')->click();
                $this->byCssSelector('button.button.button-gold')->click();
                sleep(2);
                $this->songListAmount = $this->countMemberSongList();
                if($index > $this->songListAmount) {
                    break;
                }
                break;

            default:
                
                break;
        }
    }

/*******************************************************************************
* Getting the status code
*/
    public function responseCode($timeout_in_ms, $url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, self::CONNECT_TIMEOUT_MS);
        // There is a PHP bug in some versions which didn't define the constant.
        curl_setopt(
            $ch,
            156, // CURLOPT_CONNECTTIMEOUT_MS
            self::CONNECT_TIMEOUT_MS
        );

        $code = null;

        try {
          curl_exec($ch);
          $info = curl_getinfo($ch);
          $code = $info['http_code'];
        }
        catch (Exception $e) {}

        curl_close($ch);
        return $code;
    }

/*******************************************************************************
* Getting the array of urls which have abnormal status code
*/
    public function getUrlList($url) {

        //get homepage contents
        $homepage = file_get_contents($url);
        mb_convert_encoding($homepage, 'UTF-8');
        //use regex parse http:// or https:// or ftp:// url
        mb_regex_encoding('UTF-8');
        
        preg_match_all("/(http|https|ftp):\/\/[^<>[:space:]]+[[:alnum:]#?\/&=+%_]/", $homepage, $match);
        $list = $match[0];

        $recordList = Array();

        
        foreach ($list as $value) {

            //replace '/ and ";var to null string  
            $result = preg_replace("/\'\/|\"(;var)/", "", $value);
            $result = utf8_encode($result);
            // use result as url to pass 
            $requestcode = strval($this->responseCode(10000, $result));

            if((strpos($requestcode, "4", 0) === 0) ||(strpos($requestcode, "5", 0) === 0)) {
                $temp = array("responseCode" => $requestcode, "url" => $result);
                array_push($recordList, $temp);
            }
            
        }
        
        //use regex parse href="" url
        preg_match_all("/(href=\")\/[^<>[:space:]]+[[:alnum:]#?\/&=+%_]/", $homepage, $match1);
        $list1 = $match1[0];

        foreach ($list1 as $value) {

            //replace href=" to null string
            $result = preg_replace("/(href=\")/", "", $value);
            if(preg_match("/\/(tw)\//", $result)||preg_match("/\/(ysm)/", $result)||preg_match("/\/css/", $result)) {
                // combine http://dev.muzik-online.com with \tw\ , \ysm , \css
                $string = utf8_encode('http://dev.muzik-online.com'.$result);
                // use result string as url to pass
                $requestcode = strval($this->responseCode(10000, $string));

                if((strpos($requestcode, "4", 0) === 0) ||(strpos($requestcode, "5", 0) === 0)) {
                    $temp = array("responseCode" => $requestcode, "url" => $string);
                    array_push($recordList, $temp);
                }

              
            }
            else if(preg_match("/\/(concert)/", $result)||preg_match("/\/(article)/", $result)||preg_match("/\/(listen)/", $result)||preg_match("/\/(download)/", $result)||preg_match("/\/(cashflow)/", $result)||preg_match("/\/(periodical)/", $result)) {
                //combine http://dev.muzik-online.com/tw with \concert , \article , \listen , \download, \cashflow, \periodical
                $string = utf8_encode('http://dev.muzik-online.com/tw'.$result);
                // use result string as url to pass
                $requestcode = strval($this->responseCode(10000, $string));

                if((strpos($requestcode, "4", 0) === 0) ||(strpos($requestcode, "5", 0) === 0)) {
                    $temp = array("responseCode" => $requestcode, "url" => $string);
                    array_push($recordList, $temp);
                }
             
            }
            else {
                //other website 
                $string = utf8_encode('http:'.$result);
                $requestcode = strval($this->responseCode(10000, $string));

                if((strpos($requestcode, "4") === 0) ||(strpos($requestcode, "5") === 0)) {
                    $temp = array("responseCode" => $requestcode, "url" => $string);
                    array_push($recordList, $temp);
                }
            }
        }

        return $recordList;
    }

/*******************************************************************************
* Do the hover on player
*/
    public function playerOpen() {

        $this->moveto($this->byCssSelector('div.player.jp-player'));
        $this->wait(1);
        $this->byXPath('//div[@class="player jp-player over"]/div[1]/div[1]/a')->click();
    }

/*******************************************************************************
* Close the player
*/
    public function playerClose() {

        $this->byCssSelector('a.open.icon.jp-open')->click();
    }

/*******************************************************************************
* Header selections of the player
*/
    public function playerheaderSelect($select) {

        $headerElememts = $this->elements($this->using('css selector')->value('a.item'));
        switch ($select) {

            case 'temporaryList':

                if($this->checkLogin()) {
                    $this->playerFlag = 'temporaryList';
                }
                $this->playertemporaryList = count($this->elements($this->using('xpath')->value('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li')));
                $headerElememts[0]->click();
                break;

            case 'myList':

                if($this->checkLogin()) {
                    $this->playerFlag = 'myList';
                    $this->playerMyList = $this->countPlayerMyListLeftColumnContent();
                }
                $headerElememts[1]->click();
                break;

            case 'myCollection':

                if($this->checkLogin()) {
                    $this->playerFlag = 'myCollection';
                    $this->playerMyCollection = $this->countPlayerMyCollectionLeftColumnContent();
                }
                $headerElememts[2]->click();
                break;

            case 'now playing':

                $headerElememts[3]->click();
                break;

            default:

                break;
        }
    }

/*******************************************************************************
* Footer selections of the player
*/
    public function playerfooterSelect($select) {

        $footerLeftElements = $this->elements($this->using('xpath')->value('//div[@class="player jp-player open"]/div[3]/div[1]/ul/li'));

        switch ($select) {

            case 'prev':

                $footerLeftElements[0]->click();
                break;

            case 'play':

                $footerLeftElements[1]->click();
                break;

            case 'pause':

                $footerLeftElements[2]->click();
                break;

            case 'next':

                $footerLeftElements[3]->click();
                break;

            case 'info':
                
                $this->byXPath('//div[@class="player jp-player open"]/div[3]/div[2]/div[3]/ul/li[2]/a')->click();
                break;

            case 'download':

                $this->byXPath('//div[@class="player jp-player open"]/div[3]/div[2]/div[3]/ul/li[3]/a')->click();
                break;

            case 'mute':

                $this->byXPath('//div[@class="player jp-player open"]/div[3]/div[3]/ul/li[1]/a')->click();
                break;

            case 'unmute':

                $this->byXPath('//div[@class="player jp-player open"]/div[3]/div[3]/ul/li[2]/a')->click();
                break;

            case 'repeat':

                $this->songRepeat += 1;
                $this->byXPath('//div[@class="player jp-player open"]/div[3]/div[3]/ul/li[4]/a')->click();
                if($this->songRepeat >= 3) {
                    $this->songRepeat = 0;
                }
                break;

            case 'shuffle':

                $this->byXPath('//div[@class="player jp-player open"]/div[3]/div[3]/ul/li[5]/a')->click();
                break;

            case 'language':

                $this->byXPath('//div[@class="player jp-player open"]/div[3]/div[3]/ul/li[6]/a')->click();
                break;

            case 'unpin':

                $this->byXPath('//div[@class="player jp-player open"]/div[1]/div[1]/a')->click();
                break;

            default:
                
                break;
        }
    }

/*******************************************************************************
* Choosing the language at the bottom of the player, needed to first select language 
*/
    public function chooseLanguage($select) {

        switch ($select) {

            case 'chinese':

                $this->byXPath('//div[@class="float js-float global"]/div[2]/a[1]')->click();
                break;
            
            case 'english':

                $this->byXPath('//div[@class="float js-float global"]/div[2]/a[3]')->click();
                break;

            case 'japanese':

                $this->byXPath('//div[@class="float js-float global"]/div[2]/a[2]')->click();
                break;

            default:
                
                break;
        }
    }

/*******************************************************************************
* Checking a album or a track
*/
    public function playerCheckAlbum() {

        if($this->byCssSelector('a.close.jp-delete')->displayed() == 1) {
            sleep(1);
            $this->byCssSelector('a.close.jp-delete')->click();
        }
    }

/*******************************************************************************
* Selections of player's MyCollection left content 
*/
    public function playerLeftContentMyCollectionSongListSelect($parentIndex, $index) {

        $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$parentIndex.']/ul/li['.$index.']/div/a')->click();
        $songAmount = count($this->elements($this->using('xpath')->value('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li')));
    }

/*******************************************************************************
* Selections of the player's left content
*/
    public function playerLeftContentSelect($select, $index) {

        $this->assertNotEquals($this->playerFlag, 'null', "user does not log in , player flag is null");
        $this->assertNotEquals($this->playerFlag, 'temporaryList', "temporary list does not have left content");

        if($this->playerFlag == 'myList') {
            $this->assertFalse($index > 0 && $this->playerMyList >= $index, "index exceeds the amount");
        }

        else if($this->playerFlag == 'myCollection') {
            $this->assertFalse($index > 0 && $this->playerMyCollection >= $index, "index exceeds the amount");
        }

        switch ($select) {

            case 'choose':

                if($this->playerFlag == 'myList' || $this->playerFlag == 'myCollection') {
                    $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']/div[1]/a')->click();
                }
                break;

            case 'del':

                if($this->playerFlag == 'myCollection') {

                    $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']/a')->click();
                    sleep(1);
                    $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']/div[2]/a')->click();
                }
                else if($this->playerFlag == 'myList') {

                    $this->moveto($this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']'));
                    $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']/div[2]/a[2]')->click();
                    sleep(1);
                    $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']/div[3]/a')->click();
                }
                
                break;

            case 'edit':

                $this->assertEquals('myList', $this->playerFlag, "player flag isn't myList");
                $this->moveto($this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']'));      
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']/div[2]/a[1]')->click();
                sleep(1);
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']/form/input')->clear();
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']/form/input')->value($this->songListTitle);
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$index.']/form/button')->click();
                break;

            case 'new list':


                $myList = count($this->elements($this->using('xpath')->value('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li')));
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$myList.']/div/a')->click();
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$myList.']/li/form/input')->clear();
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$myList.']/li/form/input')->value($this->songListTitle);
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[1]/div[2]/ul/li['.$myList.']/li/form/button')->click();
                
                break;

            default:
                
                break;
        }
    }

/*******************************************************************************
* Operations of the player song content
*/
    public function playerSongContentfunc($select, $index) {

        if($this->playerFlag == 'temporaryList') {
            $this->assertFalse($index > 0 && $this->playertemporaryList >= $index, "index exceeds the amount");
        }
        else if($this->playerFlag == 'myList') {
            $this->assertFalse($index > 0 && $this->playerMyListContent >= $index, "index exceeds the amount");
        }
        else if($this->playerFlag == 'myCollection') {
            $this->assertFalse($index > 0 && $this->playerMyCollectionContent >= $index, "index exceeds the amount");
        }

        switch ($select) {
            case 'play':
                
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[1]/a')->click();
                break;

            case 'choose':

                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[2]/a')->click();
                break;

            case 'info':

                $this->moveto($this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[3]/div'));
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[3]/div/div/a[2]')->click();
                break;

            case 'download':

                $this->moveto($this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[3]/div'));
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[3]/div/div/a[3]')->click();
                break;

            case 'add to list':

                $this->moveto($this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[3]/div'));
                $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[3]/div/div/a[4]')->click();
                break;

            case 'del':

                if($this->playerFlag == 'myCollection') {
                    break;
                }
                else {
                    $this->moveto($this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[3]/div'));
                    $this->byXPath('//div[@class="player jp-player open"]/div[2]/div[2]/div[2]/div[2]/ul/li['.$index.']/div[3]/div/div/a[5]')->click();
                }
                break;

            default:
                
                break;
        }
    }

/*******************************************************************************
* Selections in a song list page
*/
    public function memberSongListSongSelect($selectFunc, $index) {

        $number = $index + 1;

        $this->refresh();
        //for first li is head title, second li is the first song
        $amount = $this->countMemberSong();
        if($amount == -1) {
            $this->refresh();
            $this->wait(0.5);
            $amount = $this->countMemberSong();
        }

        switch ($selectFunc) {

            case 'play all':

                $this->assertNotEquals(-1, $amount, "have no songs");
                $this->byCssSelector('a.playAll.noSelect.play-all')->click();
                break;

            case 'play':

                $this->assertTrue($number > 1 && $index <= $amount && $amount > 0, "have no songs or index exceeds the amount");
                $this->byXPath('//div[@class="compoTable"]/ul/li['.$number.']/div[4]/a[1]')->click();           
                break;

            case 'del':

                $this->assertTrue($number > 1 && $index <= $amount && $amount > 0 && $this->mySelfFlag == true ,"have no songs or index exceeds the amount or myself is false");
                $this->byXPath('//div[@class="compoTable"]/ul/li['.$number.']/div[4]/a[3]')->click();
                break;

            case 'add to list':

                $this->assertTrue($number > 1 && $index <= $amount && $amount > 0, "have no songs or index exceeds the amount");
                $this->byXPath('//div[@class="compoTable"]/ul/li['.$number.']/div[4]/a[2]')->click();
                break;

            case 'info':

                $this->assertTrue($number > 1 && $index <= $amount && $amount > 0, "have no songs or index exceeds the amount");
                $this->byXPath('//div[@class="compoTable"]/ul/li['.$number.']/div[4]/a[4]')->click();
                break;

            case 'download':

                $this->assertTrue($number > 1 && $index <= $amount && $amount > 0, "have no songs or index exceeds the amount");
                $this->byXPath('//div[@class="compoTable"]/ul/li['.$number.']/div[4]/a[5]')->click();
                break;

            default:
                            
                break;
        }
    }

/*******************************************************************************
* Selections of adding to a song list
*/
    public function addToListSelect($listSelect, $index) {
        //three selection : new list, temporary, existed
        switch ($listSelect) {

            case 'new list':

                $number = $this->songListAmount + 1;
                $this->byXPath('//div[@class="float js-float menu"]/div/a[1]')->click();
                $this->wait(0.5);
                $this->byId('playlist_title')->value($this->songListTitle);
                $this->byId('summary')->value($this->songListDescription);
                $this->byCssSelector('button.button.button-gold')->click();
                break;

            case 'temporary list':

                $this->byXPath('//div[@class="float js-float menu"]/div/a[2]')->click();
                break;

            case 'my list':
                
                $this->assertTrue($index > 0 && $index <= $this->countFloatMenu() && $this->countFloatMenu() > 0,  "have no song lists or index exceeds the amount");
                $this->wait(3);
                $this->byXPath('//div[@class="float js-float menu"]/div/div/div/div[2]/ul/li['.$index.']/a')->click();
                break;

            default:
                                    
                break;

        }   
    }

/*******************************************************************************
* Selections in member profile of member collection
*/
    public function memberCollection($select, $index) {

        switch ($select) {

            case 'collect'://collect or cancel collect

                $this->assertTrue($index != 0 && $index <= $this->collectionAmount && $this->collectionAmount > 0,  "have no collection or index exceeds the amount");
                $this->byXPath('//div[@class="listen-list listen-subscribe"]/ul/li['.$index.']/a[3]')->click();
                break;

            case 'enter':

                $this->assertTrue($index != 0 && $index <= $this->collectionAmount && $this->collectionAmount > 0,  "have no collection or index exceeds the amount");
                $this->byXPath('//div[@class="listen-list listen-subscribe"]/ul/li['.$index.']/a[1]')->click();
                $this->mySelfFlag = false;
                break;

            default:
                
                break;
        }
    }
}

?>