<?php
namespace zServices\Miscellany;

use Goutte\Client as BaseClient;

/**
*
*/
class ClientHttp extends BaseClient
{
    /**
     * [$protocol description]
     * @var [type]
     */
    protected $method;

    /**
     * [$url description]
     * @var [type]
     */
    protected $url;

    /**
     * [$cookie description]
     * @var [type]
     */
    protected $cookie;

    /**
     * [$response description]
     * @var [type]
     */
    protected $response;

    /**
     * [request description]
     * @param  string  $method        [description]
     * @param  string  $url           [description]
     * @param  array   $parameters    [description]
     * @param  array   $files         [description]
     * @param  array   $server        [description]
     * @param  [type]  $content       [description]
     * @param  boolean $changeHistory [description]
     * @return @instance
     */
    public function request($method, $url, array $parameters = array(), array $files = array(), array $server = array(), $content = null, $changeHistory = true)
    {
        $this->method = $method;
        $this->url = $url;

        return parent::request($this->method, $this->url, $parameters, $files, $server, $content, $changeHistory);
    }

    /**
     * [headers description]
     * @return [type] [description]
     */
    private function headers()
    {
        return $this->response->getHeaders();
    }

    /**
     * [cookie description]
     * @return [type] [description]
     */
    public function cookie()
    {
        return $this->headers()['Set-Cookie'][0];
    }
}