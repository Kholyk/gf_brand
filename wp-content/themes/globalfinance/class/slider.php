<?php
/**
 * Creates slider of given content
 */
class Slider
{

    function __construct($data) {
        // require 'req/class/main-info.php';
        $this->theme = 'light';

        $this->data = $data;
        $this->class = array_key_exists('class', $this->data) ? $this->data['class'] : '';
        //$this->class = checkAndReplace($this->data, 'class');

        $this->slides = array_filter($this->data, function ($arr) {
            return gettype($arr) === 'array';
        });

        $this->duration = $data['duration'];
        $this->anchor = $data['anchor'];
        
        $buttonClass = checkAndReplace($this->data, 'button_class');
        $this->buttonClass = (!empty($buttonClass)) ? ' ' . $buttonClass : '';
    }
    
    public function getSection() {
        // carousel-fade:: -> remove it to get normal carousel sliding between...
        $block[] = '<div id="';
        $block[] =  $this->getAnchor();
        $block[] =  '" class="carousel slide ' . $this->class . '" data-ride="carousel" data-interval="';
        $block[] =  $this->getDuration();
        $block[] =  '">';
        $block[] =  $this->makeIndicators();
        $block[] =  $this->makeSlides();
        // $block[] =  $this->makeControls();
        $block[] =  '</div>';

        return $block;
    }

    private function getDuration() {
        return $this->duration;
    }

    private function getAnchor() {
        return $this->anchor;
    }

    private function createButton($text, $target = '#myModal', $class = 'buttonblock') {

        return '<div class="'
                . $class
                . '" data-toggle="modal" data-target="'
                . $target
                . '"><a class="' . $this->buttonClass . '">'
                . $text
                . '</a></div>';
    }

    private function makeSlide($slideData) {

        $active = $slideData['tag'] == 'active' ? ' active' : '';

        // Check for compatibility
        $logo = checkAndReplace($slideData, 'logo');
        $slideLogo = (!empty($logo)) ? '<img src="' . $logo . '" class="slider-logo" alt="' . $slideData['heading'] . '">' : '';

        $desc = array_key_exists('desc', $slideData) ? '<p class=' . $this->theme . '>' . $slideData['desc'] . '</p>' : '';



        $currentSlide = '<div class="carousel-item' . $active . '">'
                . '<img src="' . $slideData['img'] . '" alt="' . $slideData['heading'] . '" style="width:100%;">'
                . '<div class="carousel-caption">'
                . '<div class="d-flex flex-row">'
                . $slideLogo
                // . '<div class="logo-town ' . $this->theme . '">г. ' . $this->city . '</div>' 
                . '</div>'
                . '<h3 class=' . $this->theme . '>' .$slideData['heading'] . '</h3>'
                . $desc
                . $this->createButton($slideData['button']['text'], $slideData['button']['target'])
                . '</div></div>';

        return $currentSlide;
    }

    private function makeSlides() {
        $first = array_reduce($this->slides, function ($acc, $slide) {
            $acc .= $this->makeSlide($slide);
            return $acc;
        }, '<div class="carousel-inner">');
        $rest = '</div>';
        return $first . $rest;
    }

    private function makeControls() {
        return '<a class="carousel-control-prev" href="#'
                . $this->getAnchor()
                . '" data-slide="prev">'
                . '<span class="carousel-control-prev-icon"></span>'
                . '</a>'
                . '<a class="carousel-control-next" href="#'
                . $this->getAnchor()
                . '" data-slide="next">'
                . '<span class="carousel-control-next-icon"></span>'
                . '</a>';
    }

    private function makeIndicators() {
        $acc = '<ol class="carousel-indicators">';

        for ($i = 0; $i < count($this->slides); $i += 1) {

            $active = $i == 0 ? ' class="active ' . $this->theme . '"' : ' class="' . $this->theme . '"' ;
            $acc .= '<li data-target="#'
                    . $this->getAnchor()
                    . '" data-slide-to="'
                    . $i
                    . '"'
                    . $active
                    . '></li>';
        }

        return $acc . '</ol>';
    }
}
