<?php

namespace App;

use App\ILoader;
use App\IOutput;
use App\IParser;

class XmlParser {
    
    /**
     *
     * @var string
     */
    protected $url;

    /**
     *
     * @var ILoader 
     */
    protected $loader;
    
    /**
     *
     * @var IParser 
     */
    protected $parser; 
    
    /**
     *
     * @var IOutput 
     */
    protected $output;    
    
    /**
     * 
     * @param string $url
     * @param ILoader $loader
     * @param IOutput $output
     * @param IParser $parser
     */
    public function __construct(string $url, ILoader $loader, IParser $parser, IOutput $output) {
        $this->url = $url;
        $this->loader = $loader;
        $this->parser = $parser;
        $this->output = $output;
    }

    public function run() {
        $this->loader->setUrl($this->url);
        $this->parser->setXml($this->loader->getXml());
        $this->parser->parse();
        $this->output->setDomain(parse_url($this->url)['host']);
        $this->output->setRows($this->parser->getRows());
        $this->output->output();
    }   
    
}
