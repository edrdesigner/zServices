<?php namespace tests\Sintegra\SP;

use zServices\Sintegra\Search;

class testGetCookie extends \PHPUnit_Framework_TestCase
{
	/**
     * @group sintegra-request
     */
    public function testGetCookieString()
    {
    	$search = (new Search)->service('SP')->request();

    	$cookieRequest = $search->cookie();

    	$this->assertTrue(
	    		is_string($cookieRequest), 
	    		'Cookie returned not is valid string'
	    );
    }
}