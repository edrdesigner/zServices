<?php namespace tests\Sintegra\SP;

use zServices\Sintegra\Search;

class testGetParams extends \PHPUnit_Framework_TestCase
{
    /**
     * @group sintegra-request
     */
    public function testGetParamsArray()
    {
    	$search = (new Search)->service('SP')->request();

    	$paramsRequest = $search->params();
    	
    	$this->assertTrue(
	    		is_array($paramsRequest), 
	    		'Params returned not is valid array'
	    );
    }
}