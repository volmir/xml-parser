<?php

namespace App;

interface IParser {
    public function setXml(\SimpleXMLElement $xml);
    public function parse();
    public function getRows();
}
