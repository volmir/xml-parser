<?php

namespace App;

class AmazonLoader implements ILoader {    
    
    /**
     *
     * @var \SimpleXMLElement
     */
    private $xml;
    
    /**
     *
     * @var string
     */
    private $url;

    public function getXml() {
        $this->loadXml();
        
        return $this->xml;
    }
    
    /**
     * 
     * @throws \Exception
     */
    private function loadXml() {       
        $this->xml = simplexml_load_file($this->url);
        if ($this->xml === false) {
            throw new \Exception("Failed loading XML");
        }
    }
    
    /**
     * 
     * @param string $url
     */
    public function setUrl(string $url) {
        $this->url = $url;
    }    
}
