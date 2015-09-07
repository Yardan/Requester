<?php
namespace Yardan\Requester;

/**
 * Description of Requester
 * Class for sending HTTP REQUEST
 * @author daniar
 */
abstract class Requester {
    
    protected $headers = array();
    protected $returnHeaders = false;
    protected $auth = null;
    protected $url = null;
    protected $params = array();
    protected $paramsType = null;


    /**
     * Initialize exact class
     * @param string $method
     * @param string $url
     * @return \Yardan\Requester\PutRequester|\Yardan\Requester\PostRequester|\Yardan\Requester\GetRequester|\Yardan\Requester\DeleteRequester
     */
    public static function init($method, $url = null) {
        switch ($method) {
            case 'POST':
                return new PostRequester($url);
                
            case 'PUT':
                return new PutRequester($url);
            
            case 'DELETE':
                return new DeleteRequester($url);
            
            case 'GET':
            default:
               return new GetRequester($url);
        }
    }
    
    /**
     * Set header
     * @param string $header
     * @return \Yardan\Requester\Requester
     */
    public function setHeader($header){
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Set headers
     * @param array $headers
     * @return \Yardan\Requester\Requester
     */
    public function setHeaders(array $headers){
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * Get headers.
     * @return array
     */
    protected function getHeaders(){
        return $this->headers;
    }
    
    /**
     * Return headers?
     * @param boolean $status
     * @return \Yardan\Requester\Requester
     */
    public function returnHeaders($status = false){
        $this->returnHeaders = $status;
        return $this;
    }

    /**
     * HTTP Auth
     * @param string $login
     * @param string $pass
     * @return \Yardan\Requester\Requester
     */
    public function setAuth($login, $pass){
        $this->auth = $login.':'.$pass;
        return $this;
    }
    
    /**
     * Set params
     * @param array $params
     * @return \Yardan\Requester\Requester
     */
    public function setParams(array $params){
        $this->params = $params;
        return $this;
    }
    
    /**
     * Get params
     * @return array
     */
    protected function getParams(){
        return $this->params;
    }
    
    /**
     * Set params type
     * @param string $type
     * @return \Yardan\Requester\Requester
     */
    public function setParamsType($type){
        $this->paramsType = $type;
        return $this;
    }
    
    /**
     * Get params type
     * @return string
     */
    protected function getParamsType(){
        return $this->paramsType;
    }
    
    /**
     * Main request
     */
    abstract public function request($url = null);
}