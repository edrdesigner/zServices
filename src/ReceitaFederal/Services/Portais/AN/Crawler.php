<?php namespace zServices\ReceitaFederal\Services\Portais\AN;

use zServices\Miscellany\Interfaces\CrawlerInterface;
use Symfony\Component\DomCrawler\Crawler as BaseCrawler;
use zServices\Miscellany\Exceptions\NoSelectorsConfigured;
use zServices\Miscellany\Exceptions\ErrorFoundData;

/**
* 
*/
class Crawler extends BaseCrawler implements CrawlerInterface
{

    /**
     * [$selectors description]
     * @var [type]
     */
    private $selectors = [];

    /**
     * [__construct description]
     * @param [type] $html      [description]
     * @param array  $selectors [description]
     */
    public function __construct($html, $selectors)
    {
        $this->selectors = $selectors;

        parent::__construct($html);
    }

    /**
     * Verifica antes de fazer o crawler se possui erros
     * na requisição
     * @return boolean 
     */
    public function hasError()
    {
        // verifica se a página seguida na requisição 
        // é página de erro da receita federal
        $node = $this->filter($this->selectors['error']);

        if($node->count()){
             throw new ErrorFoundData( $this->clearString($node->text()), 1);
        }

        // CNPJ informado é válido?
        if($this->filter('#imgCaptcha')->count()){
            throw new InvalidCaptcha('Captcha inválido', 99);
        }
    }

    /**
     * Extrai informações do HTML através do DOM
     *
     * @return array
     */
    public function scraping()
    {
        $scrapped = [];

        $this->hasError();

        if(!count($this->selectors)) {
            throw new NoSelectorsConfigured("NoSelectorsConfigured", 1);
        }

        foreach ($this->selectors as $name => $selector) {
            if(is_string($selector)){
                $node = $this->scrap($selector);

                if($node->count()){
                    $scrapped[$name] = $this->clearString($node->text());
                }
            }elseif(is_array($selector)){
                foreach ($selector as $selector => $repeat) {
                    $node = $this->scrap($selector);
                    if($node->count()){
                        foreach ($node->filter($repeat) as $loop)
                        {
                            $scrapped[$name][] = $this->clearString($loop->nodeValue);
                        }
                    }
                }
            }
        }

        return $scrapped;
    }

    /**
     * Limpa o valor repassado
     * @param  string $string
     * @return string
     */
    public function clearString($string)
    {
        return trim(preg_replace(['/[\s]+/mu'], ' ', $string));
    }

    /**
     * Filtra selector no crawler
     */
    public function scrap($selector)
    {
        $node = $this->filter($selector);
        return $node;
    }
}