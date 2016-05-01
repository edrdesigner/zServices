<?php

use zServices\Sintegra\Search;
use zServices\Sintegra\Services\Sintegra\SP\Crawler;

class testCrawlerHtmlData extends PHPUnit_Framework_TestCase
{   
    /**
     * @group crawler
     */
	public function testFileExist()
    {
    	$file = dirname(__FILE__) . '/data.html';
    	$this->assertFileExists($file, 'HTML Test file not present to crawler');
        $this->assertStringNotEqualsFile($file, '');

        return file_get_contents($file);
    }

    /**
     * @group crawler
     * @depends testFileExist
     */
    public function testCrawlerHtmlBody($html)
    {
        $service = new zServices\Sintegra\Services\Sintegra\SP\Service;
        $configurations = $service->configurations;

    	$crawler = new Crawler($html, array_get($configurations, 'selectors.data'));
        $scraped = $crawler->scraping();

        $this->assertTrue(
                (is_array($scraped) && count($scraped) > 0), 
                'Params returned not is valid array'
        );

        $this->assertArrayHasKey('inscricao_estadual', $scraped, 'Scraped fail');

        $this->assertEquals('647.356.837.114', array_get($scraped, 'inscricao_estadual'), 'Scraped fail');
    }
}