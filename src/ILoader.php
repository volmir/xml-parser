<?php

namespace App;

interface ILoader {
    public function setUrl(string $url);
    public function getXml();
}
