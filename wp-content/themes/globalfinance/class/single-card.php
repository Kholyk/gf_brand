<?php
/**
 * Card column creator class
 */

class SingleCard extends Single
{
    function __construct($data, $props)
    {
        $this->data = $data;
        $this->props = $props;

        // Check for compatibility (auto)
        $this->options = ['tag', 'button', 'heading', 'class', 'desc', 'style', 'img', 'include', 'price', 'youtube'];
        array_map(
            function ($option) {
                return $this->$option = checkAndReplace($this->data, $option);
            },
            $this->options
        );

        // creating href block with other attributes
        $blockHrefPrepared = [];
        if (array_key_exists('href', $this->data)) {
            $blockHrefPrepared[] = 'href="' . $this->data['href'] . '"';
        }
        
        $blockHrefPreparedOptions = [];
        if (array_key_exists('hrefOptions', $this->data)) {
            $blockHrefPreparedOptions = array_map(
                function ($option) {
                    return $option . '="' . $this->data['hrefOptions'][$option] . '"';
                },
                array_keys($this->data['hrefOptions'])
            );
        }

        $blockHrefPrepared[] = implode(' ', $blockHrefPreparedOptions);
        $this->blockHref = count($blockHrefPrepared) != 0 ? implode(' ', $blockHrefPrepared) : null;
        

        // Image block
        $imgBlockArr = [];
        if (!empty($this->img)) {
            $imgBlockArr[] = !empty($this->blockHref) ? '<a ' . $this->blockHref . '><img src="' : '<img src="';
            $imgBlockArr[] = $this->img;
            $imgBlockArr[] = '" class="card-img-top" alt="';
            $imgBlockArr[] = $this->heading;
            $imgBlockArr[] = !empty($this->blockHref) ? '"></a>' : '">';
        }

        $this->imgBlock = implode('', $imgBlockArr);

        // youtube block
        $this->youTube = (!empty($this->youtube)) ? '<iframe width="' . $this->youtube[1] . '%" height="' . $this->youtube[2] . 'px" src="https://www.youtube.com/embed/' . $this->youtube[0] . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>' : '';

        // Heading block
        $headLineBlock = [];
        if (!empty($this->heading)) {
            $headLineBlock[] = '<h5 class="card-title orange">';
            $headLineBlock[] = !empty($this->blockHref) ? '<a ' . $this->blockHref . '>' : '';
            $headLineBlock[] = $this->heading;
            $headLineBlock[] = !empty($this->blockHref) ? '</a></h5>' : '</h5>';
        }
        $this->headingBlock = implode('', $headLineBlock);
        // Tag attributes
        $this->classAttr = !empty($this->class) ? ' class="card ' . $this->class . '"' : '';
        $this->styleAttr = !empty($this->style) ? ' style="' . $this->style . '"' : '';
        $this->idAttr = !empty($this->tag) ? ' id="' . $this->tag . '" ' : '';
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
        
        $contentBlock = ($descriptionBlock !== '' || $this->headingBlock !== '') ? '<div class="card-body" '
            . $minHeight . '>' . $this->headingBlock . $descriptionBlock . $button . '</div>' : '';

        $col = [];
        if (!empty($this->classAttr)) {
            $col[] = '<div class="card ';
            $col[] = $this->class;
            $col[] = '">';
        } else {
            $col[] = '<div class="card">';
        }
        

        // render included block here
        if (!empty($this->include)) {
            ob_start();
            include $this->include;
            $col[] = ob_get_clean();
        }
        
        $col[] = $this->imgBlock;
        $col[] = $this->youTube;
        $col[] = $contentBlock;
        $col[] = '</div>';

        return implode('', $col);
    }
}