<?php
namespace Yardan\Requester;

abstract class Requester {
    
    protected $headers = array();
    protected $returnHeaders = false;
    protected $auth = null;
    protected $url = null;
    protected $params = array();
    protected $paramsType = null;


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
     * @return \Requester
     */
    public function setHeader($header){
        $this->headers[] = $header;
        return $this;
    }
    
    /**
     * Set headers
     * @param array $headers
     * @return \Requester
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
     * @return \Requester
     */
    public function returnHeaders($status = false){
        $this->returnHeaders = $status;
        return $this;
    }
    
    /**
     * HTTP Auth
     * @param string $login
     * @param string $pass
     * @return \Requester
     */
    public function setAuth($login, $pass){
        $this->auth = $login.':'.$pass;
        return $this;
    }
    
    public function setParams(array $params){
        $this->params = $params;
        return $this;
    }
    
    protected function getParams(){
        return $this->params;
    }
    
    public function setParamsType($type){
        $this->paramsType = $type;
        return $this;
    }
    
    protected function getParamsType(){
        return $this->paramsType;
    }
    
    abstract public function request($url = null);
}