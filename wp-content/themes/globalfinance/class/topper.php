<?php
/**
 * Generates topper
 */
class Topper
{
    /**
     * Constructor
     * 
     * @return object
     */
    function __construct($data)
    {
        // use default values from general config if $data is empty
        include getConfigPath('general');
        $this->details = $entDetails;
        $this->data = $data;

        // Important check for compatibility (manual)
        $this->h2 = checkAndReplace($this->data, 'h2', $this->details['h1']);
        $this->h3 = checkAndReplace($this->data, 'h3', $this->details['slogan']);
        $this->bg = checkAndReplace($this->data, 'bg', 'img/bg/pattern.jpg');
        
        // Check for compatibility (auto)
        $this->options = ['anchor', 'class', 'descr', 'style', 'bg'];
        array_map(
            function ($option) {
                return $this->$option = checkAndReplace($this->data, $option);
            },
            $this->options
        );

        // Tag attributes
        $this->classAttr = !empty($this->class) ? ' class="row ' . $this->class . '"' : '';
        $this->styleAttr = !empty($this->style) ? ' style="' . $this->style . '"' : '';
        

        $this->topper = '<div class="container-fluid" style="background: url('.$this->bg.'); background-size:cover;">'
                      . '<div id="home"' . $this->classAttr . $this->styleAttr . '>'
                      . '<div class="container"><div class="row">'
                      . '<div class="col-md-12 justify-content-center">'
                         . '<h2 class="animated fadeInUp">' . $this->h2 .'</h2>'
                         . '<h3 class="animated fadeInUp">' . $this->h3 . '</h3>'
                         . '<p class="animated fadeInUp">' . $this->descr . '</p>'
                      . '</div></div></div><div class="container"><div class="row"><div class="col-md-12 d-flex justify-content-center">'
                . '<div class="animated fadeInUp"><div id="btn-topper" class="btn-group">'
                    . '<a class="btn btn-warning btn-lg" href="#actions">Акции</a>'
                    . '<a class="btn btn-success btn-lg" href="#prices">Цены на бухучет</a>'
                . '</div></div>'
                
                . '</div></div></div></div></div>';
    }
    /**
     * Render block
     * 
     * @return string rendered content
     */
    public function getSection()
    {
        return $this->topper;
    }

}