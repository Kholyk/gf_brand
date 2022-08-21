<?php
/**
 * Creates tabs // not ready for production //
 */
class Tabs extends Wrapper
{
    function __construct($data)
    {
        // $this->data = $data;
        parent::__construct($data);
        // $this->class = array_key_exists('class', $this->data) ? $this->data['class'] : '';
        $this->tabs = array_filter(
            $this->data,
            function ($element) {
                return gettype($element) === 'array';
            }
        );

        $this->activeTabNum = $this->data['active'] ?? 0;
    }

    function createTabs()
    {
        $result[] = '<div class="container"><ul class="nav nav-tabs justify-content-center">';

        $result[] = array_reduce(
            $this->tabs,
            function ($tabs, $tab) {
                $active = $this->activeTabNum == $tabs[1] ? ' active' : '';
                $tabHeading = $tab['h2'] ?? $tab['tabheading'] ?? 'tabheading or h2 not found';
                $tabs[0] .= '<li class="nav-item"><a class="nav-link' . $active . '" data-toggle="tab" id="'.$tab['tabswitch'].'" data-target="#' . $tab['anchor'] . '">' . $tabHeading . '</a></li>';
                $tabs[1] += 1;
                return $tabs;
            },
            // Special accumulator with counter
            ['', 1]
        )[0];

        $result[] = '</ul></div>';

        return $result;
    }

    function createBlocks()
    {
        $result[] = '<div class="tab-content ' . $this->class . '">';

        $result[] = array_reduce(
            $this->tabs,
            function ($tabs, $tab) {
                $tabType = $this->activeTabNum == $tabs[1] ? 'show active' : 'fade';
                $content = dispatch($tab);

                $tabs[0] .= '<div class="tab-pane ' . $tabType . '"id="' . $tab['anchor'] . '"> ' . implode('', $content->getSection()) . '</div>';
                $tabs[1] += 1;
                return $tabs;
            },
            // Special accumulator with counter
            ['', 1]
        )[0];
        
        $result[] = '</div>';

        return $result;
    }

    function getSection()
    {
        $section[] = '<div' . $this->idAttr . $this->classAttr . $this->styleAttr . '>' 
            . $this->blockTitle . $this->blockDesc;

        $section[] = implode('', array_merge($this->createTabs(), $this->createBlocks()));

        $section[] = '</div>';
        return $section;
    }
}