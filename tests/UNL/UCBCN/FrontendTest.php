<?php
// Call UNL_UCBCN_FrontendTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'UNL_UCBCN_FrontendTest::main');
}

require_once 'PHPUnit/Framework.php';
require_once 'Testing/Selenium.php';
require_once 'UNL/UCBCN/Frontend.php';

/**
 * Test class for UNL_UCBCN_Frontend.
 * Generated by PHPUnit on 2007-09-26 at 09:17:03.
 */
class UNL_UCBCN_FrontendTest extends PHPUnit_Framework_TestCase {
    
    public $selenium;
    
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('UNL_UCBCN_FrontendTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUpSelenium() {
        $this->selenium = new Testing_Selenium("*firefox", "http://localhost/");
        $result = $this->selenium->start();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @access protected
     */
    protected function tearDownSelenium() {
        $this->selenium->stop();
    }

    /**
     * @todo Implement testShowNavigation().
     */
    public function testShowNavigation() {
        $this->setUpSelenium();
        // testing (only run this in day view)
        $this->selenium->open("/events/");
	    $this->selenium->click("link=13");
	    $this->selenium->click("link=14");
	    $this->selenium->click("link=17");
	    $this->selenium->click("link=Return to today");
	    $this->selenium->click("link=Next Day");
	    $this->selenium->click("link=Previous Day");
	    $this->selenium->click("link=Previous Day");
	    $this->selenium->click("next_month");
	    $this->selenium->click("next_month");
	    $this->selenium->click("prev_month");
	    $this->selenium->click("prev_month");
	    $this->selenium->click("link=Return to today");
	    $this->selenium->type("searchinput", "hall");
	    $this->selenium->click("submit");
	    try {
	        $this->assertTrue($this->selenium->isVisible("id=feeds"));
	    } catch (PHPUnit_Framework_AssertionFailedError $e) {
	        array_push($this->verificationErrors, $e->toString());
	    }
	    try {
	        $this->assertEquals("", $this->selenium->getText("id=maincontent"));
	    } catch (PHPUnit_Framework_AssertionFailedError $e) {
	        array_push($this->verificationErrors, $e->toString());
	    }
	    $this->tearDownSelenium();
    }

    /**
     * This tests calling the preRun function before cacheable output is sent.
     * 
     * An example of the preRun function is sending the content-type header for xml.
     */
    public function testPreRun() {
        $fp = fopen('http://localhost/events/?format=xml','r');
        $meta = stream_get_meta_data($fp);
        $headers = $meta['wrapper_data'];
        foreach ($headers as $header) {
            if (preg_match('/Content-Type:[\s]?(.*)$/',$header, $matches)) {
                $type = $matches[1];
            }
        }
        $this->assertEquals('text/xml', $type);
    }

    /**
     * @todo Implement testRun().
     */
    public function testRun() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testGetEventInstance().
     */
    public function testGetEventInstance() {
        $this->setUpSelenium();
        //check event instance. end with feed page. pass unit test if last final page is not a html page
        $this->selenium->open("/");
	    $this->selenium->click("link=Today's Events");
	    $this->selenium->waitForPageToLoad("30000");
	    $this->selenium->click("link=Experience International Culture at Home");
	    $this->selenium->click("link=Experience International Culture at Home");
	    $this->selenium->click("link=Return to today");
	    $this->selenium->click("//a[@href='http://events.unl.edu/2007/10/6/']");
	    $this->selenium->click("rssformat");
	    $this->selenium->waitForPageToLoad("30000");
	    try {
	        $this->assertNotEquals("", $this->selenium->getHtmlSource());
	    } catch (PHPUnit_Framework_AssertionFailedError $e) {
	        array_push($this->verificationErrors, $e->toString());
	    }
	    $this->tearDownSelenium();
    }

    /**
     * @todo Implement testFormatURL().
     */
    public function testFormatURL() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testReformatURL().
     */
    public function testReformatURL() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testUriFormat().
     */
    public function testUriFormat() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testDetermineView().
     */
    public function testDetermineView() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testGetCacheKey().
     */
    public function testGetCacheKey() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testGetCalendarShortname().
     */
    public function testGetCalendarShortname() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testGetCalendarID().
     */
    public function testGetCalendarID() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testDbStringToHtml().
     */
    public function testDbStringToHtml() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testDayHasEvents().
     */
    public function testDayHasEvents() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testDisplayImage().
     */
    public function testDisplayImage() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}

// Call UNL_UCBCN_FrontendTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'UNL_UCBCN_FrontendTest::main') {
    UNL_UCBCN_FrontendTest::main();
}
?>
