<?php

use zServices\Sintegra\Search;
use zServices\Sintegra\Services\Sintegra\SP\Service as ServiceExpected;
use zServices\Sintegra\Services\Sintegra\Interfaces\ServiceInterface;

class testService extends PHPUnit_Framework_TestCase
{
	public function testServiceExist()
    {
    	$search = new Search;

    	$service = $search->service('SP')->request();

    	$this->assertInstanceOf(ServiceInterface::class, $service);

    	$this->assertNotTrue((!is_a($service, ServiceExpected::class)), 'Class returned invalid');

        $this->assertTrue(
                (is_array($service->configurations)
                    && array_has($service->configurations, 'base')
                    && array_has($service->configurations, 'home')
                    && array_has($service->configurations, 'captcha')
                    && array_has($service->configurations, 'data')
                    && array_has($service->configurations, 'selectors')
                    && array_has($service->configurations, 'selectors.image')
                    && array_has($service->configurations, 'selectors.data')
                    && array_has($service->configurations, 'headers')
                    && array_has($service->configurations, 'headers')
                ), 
                'Configurations on this service is invalid'
        );
    }

    /**
     * @expectedException zServices\Sintegra\Exceptions\InvalidService
     * @expectedExceptionMessageRegExp #Portal.*#
     */
    public function testServiceNotExist()
    {
    	$search = (new Search)->service('no_service');
    }
}