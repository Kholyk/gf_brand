<?php
/**
 * Creates wrapper for guest block
 */
class Wrapper
{
    function __construct($data) {
        $this->data = $data;
        
        // Check for compatibility (auto)
        $this->options = ['anchor', 'class', 'description', 'style', 'include', 'bg'];
        array_map(
            function ($option) {
                return $this->$option = checkAndReplace($this->data, $option);
            },
            $this->options
        );
        
        // Tag attributes
        $stylesArr = [];
        
        if (!empty($this->style)) {
            $stylesArr[] = $this->style;
        }

        if (!empty($this->bg)) {
            $stylesArr[] = "background: url($this->bg) no-repeat center center; background-size: cover;";
        }

        $this->styleAttr = count($stylesArr) != 0 ?
            ' style="' . implode(' ', $stylesArr) . '"' : '';

        $this->classAttr = !empty($this->class) ? ' class="' . $this->class . '"' : '';

        $this->idAttr = !empty($this->anchor) ? ' id="' . $this->anchor . '"' : '';

        // Heading block
        $this->h2 = checkAndReplace($this->data, 'h2');
        $this->blockH2 = !empty($this->h2) ? '<h2 class="display-3">' . $this->data['h2'] . '</h2>' : '';
        
        $this->h3 = checkAndReplace($this->data, 'h3');
        $this->blockH3 = !empty($this->h3) ? '<h3><small>' . $this->data['h3'] . '</small></h3>' : '';

        $this->blockTitle = (!empty($this->h2) || !empty($this->h3)) ?
            '<div class="block-title">' . $this->blockH2 . $this->blockH3 . '</div>' : '';
        
        // Main block description    
        $this->blockDesc = !empty($this->description) ? '<p>' . $this->description . '</p>' : '';

        // Guest block
        $this->guest = checkAndReplace($this->data, 'guest', null);
        //$this->guestBlock = !empty($this->guest) ? $this->guest : null;

    }

    public function getSection()
    {
        $section = [];
        
        $section[] = '<div' . $this->idAttr . $this->classAttr . $this->styleAttr . '>' 
            . $this->blockTitle . $this->blockDesc;

        if ($this->guest !== null) {
            $section[] = file_get_contents($this->guest);
        }
        // render included block here
        if (!empty($this->include)) {
            ob_start();
            include $this->include;
            $section[] = ob_get_clean();
        }
        $section[] = '</div>';

        return $section;
    }
}

