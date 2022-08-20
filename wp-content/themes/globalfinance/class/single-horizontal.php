<?php
/**
 * Single column creator class
 */
class SingleHorizontal extends Single
{
    function __construct($data, $props)
    {
        // Apply parent constructor from Wrapper
        parent::__construct($data, $props);

        $this->leftFactor = array_key_exists('leftWidthFactor', $this->data) ? $data['leftWidthFactor'] : 5;
        $this->rightFactor = 12 - $this->leftFactor;

        // $blockHref = array_key_exists('href', $this->data) ? 'href="' . $this->data['href'] . '"' : '';
                // Image block
                $imgBlockArr = [];
                if (!empty($this->img)) {
                    $imgBlockArr[] = '<div class="block-image col-xl-' . $this->leftFactor . ' col-lg-' . $this->leftFactor . ' col-md-' . $this->leftFactor . ' col-sm-' . $this->leftFactor . ' col-' . $this->leftFactor . '">';
                    $imgBlockArr[] = !empty($this->blockHref) ? '<a ' . $this->blockHref . '><img src="' : '<img src="';
                    $imgBlockArr[] = $this->img;
                    $imgBlockArr[] = '" class="image-in-block" alt="';
                    $imgBlockArr[] = $this->heading;
                    $imgBlockArr[] = !empty($this->blockHref) ? '"></a></div>' : '"></div>';
                }
        
                $this->imgBlock = implode('', $imgBlockArr);

                // Heading block
                $headLineBlock = [];
                if (!empty($this->heading)) {
                    $headLineBlock[] = '<h4 class="orange">';
                    $headLineBlock[] = !empty($this->blockHref) ? '<a ' . $this->blockHref . '>' : '';
                    $headLineBlock[] = $this->heading;
                    $headLineBlock[] = !empty($this->blockHref) ? '</a></h4>' : '</h4>';
                }
    }
    public function buildCol()
    {
        if (!empty($this->button)) {
            if (gettype($this->button) === 'array') {
                $btn_txt = checkAndReplace($this->button, 'text', 'Button text is empty...');
                $btn_target = checkAndReplace($this->button, 'target', '#NO_TARGET');
                $btn_style = checkAndReplace($this->button, 'style', 'btn btn-warning btn-lg');
                $btn_href = checkAndReplace($this->button, 'href');

                $button = $this->createButton($btn_txt, $btn_target, $btn_style, $btn_href);
            } else {
                $button = $this->createButton($this->button);
            }
        } else {
            $button = '';
        }

        $descriptionBlock = !empty($this->desc) ? $this->buildDescription($this->desc) : '';
        $minHeight = $this->getminHeightStyle();
        
        $contentBlock = ($descriptionBlock !== '' || $this->headingBlock !== '') ?
            '<div class="block-content col-xl-' . $this->rightFactor . ' col-lg-' . $this->rightFactor . ' col-md-' . $this->rightFactor . ' col-sm-' . $this->rightFactor . ' col-' . $this->rightFactor . '" '
            . $minHeight . '>' . $this->headingBlock . $descriptionBlock . $button . '</div>' : '';

        $col = ['<div ', $this->idAttr, $this->props['css'], '>'];
        if (!empty($this->classAttr)) {
            $col[] = '<div class="module-item-wrapper row no-gutters ';
            $col[] = $this->class;
            $col[] = '">';
        } else {
            $col[] = '<div class="module-item-wrapper row no-gutters">';
        }
        

        // render included block here
        if (!empty($this->include)) {
            ob_start();
            include $this->include;
            $col[] = ob_get_clean();
        }
        $col[] = $this->imgBlock;
        $col[] = $contentBlock;
        $col[] = '</div></div>';

        return implode('', $col);
    }
}