<?php
/**
 * Single column creator class
 */
class SingleFlex extends Single
{
    function __construct($data, $props)
    {
        parent::__construct($data, $props);
        $this->data = $data;
        $this->props = $props;

        // Image block
        $imgBlockArr = [];
        if (!empty($this->img)) {
            $imgBlockArr[] = '<div class="flex-item-block-image">';
            $imgBlockArr[] = !empty($this->blockHref) ? '<a ' . $this->blockHref . '><img src="' : '<img src="';
            $imgBlockArr[] = $this->img;
            $imgBlockArr[] = '" class="flex-item-image-in-block" alt="';
            $imgBlockArr[] = $this->heading;
            $imgBlockArr[] = !empty($this->blockHref) ? '"></a></div>' : '"></div>';
        }

        $this->imgBlock = implode('', $imgBlockArr);

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
        
        $contentBlock = ($descriptionBlock !== '' || $this->headingBlock !== '') ? '<div class="flex-item-block-content" '
            . $minHeight . '>' . $this->headingBlock . $descriptionBlock . $button . '</div>' : '';

        $col = ['<div ', $this->idAttr, $this->props['css'], '>'];
        
        

        // render included block here
        if (!empty($this->include)) {
            ob_start();
            include $this->include;
            $col[] = ob_get_clean();
        }
        $col[] = $this->imgBlock;
        $col[] = $contentBlock;
        $col[] = '</div>';

        return implode('', $col);
    }
}