<?php

namespace App;

class CsvOutput implements IOutput {    

    /**
     *
     * @var string
     */
    private $domain;
    
    /**
     *
     * @var array
     */
    private $rows;    
    
    /**
     * 
     * @param array $rows
     */
    public function setRows(array $rows) {
        $this->rows = $rows;
    }  
    
    public function setDomain(string $domain) {
        $this->domain = $domain;
    }     
    
    public function output() {
        $fileName = $this->domain . "_" . date('Y-m-d') . ".csv";
        
        ob_clean();
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=' . $fileName);    
        if (isset($this->rows['0'])){
            $fp = fopen('php://output', 'w');
            fputcsv($fp, array_keys($this->rows['0']));
            foreach($this->rows AS $rows) {
                fputcsv($fp, $rows);
            }
            fclose($fp);
        }
        ob_flush();
    } 
}
