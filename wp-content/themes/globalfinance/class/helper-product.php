<?php

// namespace App\Section\Product;

class Product
{
    function __construct($meta)
    {
        $args = [
          'class', // adds additional classes to wrapper
          'tag', // puts id attribute to singles' wrapper
          'style', // puts styles in wrapper of single
          'img', // <img> tag in single
          'name', // creates 'heading' of single
          'price', // creates price
          'description', // creates <p> tag
          'features', // ['feat1', 'feat2'] --> <ul><li>feat1</li><li>feat2</li></ul>
          'specs', // ['key' => 'value'] --- > dotted list of key.....value
          'button', // Generates button
          'leftWidthFactor', // Left width (in 12/dev) of left block in bs-hor
          'href',  // Wraps img and heading in <a> tag with given href
          'hrefOptions', // ['optName' => 'optValue'] --- > optname="optValue"
          'minheight', // INT Block minimumhHeight in px
          'include' // Puts PHP include (filepath)
        ];
        
        $this->result = [];

        foreach ($args as $metaName) {
            if (isset($meta[$metaName]) && $meta[$metaName] != '') {
                if ($metaName === 'name') {
                    $this->result['heading'] = $meta[$metaName];
                } else if ($metaName === 'description') {
                    $this->result['desc']['p'] = $meta[$metaName];
                } else if ($metaName === 'features') {
                    foreach ($meta[$metaName] as $value) {
                        $this->result['desc']['ul'][] = $value;
                    };
                } else if ($metaName === 'specs') {
                    foreach ($meta[$metaName] as $key => $value) {
                        $this->result['desc']['dotted'][$key] = $value;
                    };
                } else if ($metaName === 'price') {
                    $this->result['desc']['price'] = $meta['price'];
                } else if ($metaName === 'button') {
                    foreach ($meta[$metaName] as $key => $value) {
                        $this->result['button'][$key] = $value; 
                    }
                    
                } else {
                    $this->result[$metaName] = $meta[$metaName];
                } 
            }
        }
    }

    public function putEmpty()
    {
      return [];
    }

    public function putHere()
    {
        return $this->result; 
    }
}