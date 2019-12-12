<?php

namespace App;

class AmazonParser implements IParser {

    /**
     *
     * @var \SimpleXMLElement
     */
    private $xml;

    /**
     *
     * @var array
     */
    private $rows = [];

    /**
     * 
     * @param \SimpleXMLElement $xml
     */
    public function setXml(\SimpleXMLElement $xml) {
        $this->xml = $xml;
    }

    public function parse() {
        if (!empty($this->xml->channel->item)) {
            foreach ($this->xml->channel->item as $item) {
                $amzn = $item->children('amzn', true);
                if (!empty($amzn->products)) {
                    foreach ($amzn->products as $product) {
                        if (is_array($product)) {
                            foreach ($product as $one_product) {
                                $this->addRow(
                                        $this->getASIN($one_product->product->productURL),
                                        $item->link,
                                        $one_product->product->productURL,
                                        $one_product->product->productHeadline,
                                        $amzn->introText,
                                        $one_product->product->productSummary,
                                        $one_product->product->award
                                        );
                            }
                        } else {
                            $this->addRow(
                                    $this->getASIN($product->product->productURL),
                                    $item->link,
                                    $product->product->productURL,
                                    $product->product->productHeadline,
                                    $amzn->introText,
                                    $product->product->productSummary,
                                    $product->product->award
                                    );
                        }
                    }
                }
            }
        }
    }
    
    private function addRow(
        $ASIN = '', 
        $URL = '', 
        $Amazon_Url = '', 
        $Product_Name = '',
        $Amazon_Introtext = '',   
        $Amazon_Product_Summary = '',    
        $Amazon_Award = ''
    ) {
        $Product_Name = strip_tags($Product_Name);
        $Amazon_Introtext = strip_tags($Amazon_Introtext);
        $Amazon_Product_Summary = strip_tags($Amazon_Product_Summary);
        $Amazon_Award = strip_tags($Amazon_Award);
        
        $this->rows[] = [
            "ASIN" => $ASIN,
            "URL" => $URL,
            "Amazon Url" => $Amazon_Url,
            "Product Name" => $Product_Name,
            "Amazon Introtext" => $Amazon_Introtext,
            "Amazon Introtext COUNT" => mb_strlen($Amazon_Introtext),
            "Amazon Product Summary" => $Amazon_Product_Summary,
            "Amazon Product Summary COUNT" => mb_strlen($Amazon_Product_Summary),
            "Amazon Award" => $Amazon_Award,
            "Amazon Award COUNT" => mb_strlen($Amazon_Award),
        ];
    }

    /**
     * 
     * @return array
     */
    public function getRows() {
        return $this->rows;
    }
    
    /**
     * 
     * @param string $url
     * @return string
     */
    private function getASIN(string $url) {
        $elements = explode('/', $url);

        return end($elements);
    }

}
