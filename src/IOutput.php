<?php

namespace App;

interface IOutput {
    public function setRows(array $url);
    public function setDomain(string $domain);
    public function output();
}
