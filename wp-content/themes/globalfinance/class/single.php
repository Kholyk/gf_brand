<?php
/**
 * Single column creator class
 */
class Single
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
            $imgBlockArr[] = '<div class="block-image">';
            $imgBlockArr[] = !empty($this->blockHref) ? '<a ' . $this->blockHref . '><img src="' : '<img src="';
            $imgBlockArr[] = $this->img;
            $imgBlockArr[] = '" class="image-in-block" alt="';
            $imgBlockArr[] = $this->heading;
            $imgBlockArr[] = !empty($this->blockHref) ? '"></a></div>' : '"></div>';
        }

        $this->imgBlock = implode('', $imgBlockArr);

        // youtube block
        $this->youTube = (!empty($this->youtube)) ? '<iframe width="' . $this->youtube[1] . '%" height="' . $this->youtube[2] . 'px" src="https://www.youtube.com/embed/' . $this->youtube[0] . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen></iframe>' : '';

        // Heading block
        $headLineBlock = [];
        if (!empty($this->heading)) {
            $headLineBlock[] = '<h4 class="orange">';
            $headLineBlock[] = !empty($this->blockHref) ? '<a ' . $this->blockHref . '>' : '';
            $headLineBlock[] = $this->heading;
            $headLineBlock[] = !empty($this->blockHref) ? '</a></h4>' : '</h4>';
        }
        $this->headingBlock = implode('', $headLineBlock);
       // $this->headingBlock = !empty($this->heading) ? '<h4 class="orange">' . $this->heading . '</h4>': '';

        // Tag attributes
        $this->classAttr = !empty($this->class) ? ' class="' . $this->class . '"' : '';
        $this->styleAttr = !empty($this->style) ? ' style="' . $this->style . '"' : '';
        $this->idAttr = !empty($this->tag) ? ' id="' . $this->tag . '" ' : '';

        // Background
        $this->bg = checkAndReplace($this->data, 'bg', 'img/bg/pattern.jpg');

        // Features block
        $this->features = checkAndReplace($this->data, 'features');

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
        
        $contentBlock = ($descriptionBlock !== '' || $this->headingBlock !== '') ? '<div class="block-content" '
            . $minHeight . '>' . $this->headingBlock . $descriptionBlock . $button . '</div>' : '';

        $col = ['<div ', $this->idAttr, $this->props['css'], '>'];
        if (!empty($this->classAttr)) {
            $col[] = '<div class="module-item-wrapper ';
            $col[] = $this->class;
            $col[] = '">';
        } else {
            $col[] = '<div class="module-item-wrapper">';
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
        $col[] = '</div></div>';

        return implode('', $col);
    }

    public static function createButton($text, $target = '#myModal', $style = 'btn btn-warning btn-lg', $href = '', $class = 'buttonblock')
    {
        $hrefLink = (!empty($href)) ? ' href="' . $href .'"' : '';
        return '<div class="'
            . $class
            . '"><button' . ' data-toggle="modal" data-target="' . $target . '"' . $hrefLink . ' class="' . $style . '">'
            . $text . '</button></div>';
    }

    protected function getminHeightStyle()
    {
        $minHeight = checkAndReplace($this->props, 'minheight');
        return !empty($minHeight) ? ' style="min-height:' . $this->props['minheight'] . 'px"' : '';
    }

    protected function buildDescription($descData)
    {
        if (gettype($descData) !== 'array') {
            return '<p>' . $descData . '</p>';
        }

        $desc = [];

        if (array_key_exists('p', $descData)) {
            $desc[] = '<p>' . $descData['p'] . '</p>';
        }

        if (array_key_exists('ul', $descData)) {
            $desc[] = '<ul>';
            
            $ulItems = array_map(
                function ($li) use ($desc) {
                    return '<li>' . $li . '</li>';                   
                }, 
                $descData['ul']
            );

            $desc[] = implode('', $ulItems);

            $desc[] = '</ul>';
        }

        if (array_key_exists('dotted', $descData)) {
            $featureList = array_map(
                function ($key, $value) {
                    return '<dl><dt>' . $key . ':</dt><dd>' . $value . '</dd></dl>';
                },
                array_keys($descData['dotted']),
                $descData['dotted']
            );

            $desc[] = implode('', $featureList);
        }

        if (array_key_exists('price', $descData)) {
            $desc[] = '<price>' . number_format($descData['price'], 0, ',', ' ') . ' &#8381;</price>';
        }

        return implode('', $desc);
    }
}