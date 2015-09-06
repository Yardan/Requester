<?php
namespace Yardan\Requester;

use Exception;

/**
 * Description of PostRequester
 *
 * @author daniar
 */
class PostRequester extends Requester {
    
    public function __construct($url = null) {
        $this->url = $url;
    }
    
    protected function getParams() {
        $params = parent::getParams();
        $paramsType = $this->getParamsType();
        switch ($paramsType) {
            case 'json':
                return json_encode($params);
            default:
                return $params;
        }
    }


    /**
     * Send request
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function request($url = null) {
        try {
            
            if(!is_null($url)){
                $this->url = $url;
            }
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getParams());
            
            if($this->returnHeaders){
                //return headers
                curl_setopt($ch, CURLOPT_HEADER, 1);
            }

            if(!empty($this->getHeaders())){
                //set headers for request
                curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeaders());
            }
            
            if(!is_null($this->auth)){
                //http auth
                curl_setopt($ch,CURLOPT_USERPWD, $this->auth);
            }

            curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);

            $output = curl_exec($ch);
            
            curl_close($ch);
            
            return $output;
        } catch (Exception $e){
            throw $e;
        }
    }
}
