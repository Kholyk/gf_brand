<?php
/**
 * Creates navbar from BS4 set
 */
class Navbar
{
    function __construct($data)
    {
        // require getConfigPath('general');
        $this->details = $entDetails;
        $this->menuItems = $data['menuItems'];
        $this->menuTail = checkAndReplace($data, 'tail');
        $this->menuLogo = '<img src="' . $data['logo'] . '" alt="">';
        $this->menuOptions = $data['menuOptions'];
        //$this->background = array_key_exists('bg', $this->menuOptions) ? 'bg-' . $this->menuOptions['bg'] : '';
        $bg = checkAndReplace($this->menuOptions, 'bg');
        $this->background = empty($bg) ? '' : 'bg-' . $bg;
        $this->navType = array_key_exists('navType', $this->menuOptions) ? $this->menuOptions['navType'] : '';
    }

    public function getSection() {
        $block[] = $this->makeHead();
        $block[] = $this->makeItems($this->menuItems);
        $block[] = $this->makeTail();

        return $block;
    }

    private function makeHead()
    {
        return '<nav class="navbar navbar-expand-lg ' . $this->background . ' navbar-dark '. $this->navType . '">'
        . '<div class="container">'
        . '<a class="navbar-brand d-flex flex-f" href="#home">' . $this->menuLogo . '</a>' 
        //. '<span class="nav-item" style="border: var(--light-color) 1px solid; border-radius: 5px; color: #fff; margin: 0 20px 0 10px;"><b>' . createPhoneLink($this->details['phone'][0], 'nav-link text-white') . '</b></span>'
        . '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" style="padding:10px;"><span class="text-white">Меню</span></button>'
        . '<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar"><ul class="navbar-nav w-100 justify-content-end">';
    }

    private function makeLink($name, $destination)
    {
        return '<li class="nav-item"><a class="nav-link" href="' . $destination . '">' . $name . '</a></li>';
    }

    private function makeDropDown($name, $items)
    {
        $dropdown[] = '<li class="nav-item dropdown">';
        $dropdown[] = '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">' . $name .  '</a>';
        $dropdown[] = '<div class="dropdown-menu">';

        $dropBlock = array_map(
            function ($linkName, $linkDestination) {
                return '<a class="dropdown-item" href="' . $linkDestination . '">' . $linkName . '</a>';
            },
            array_keys($items),
            $items
        );

        $dropdown[] = implode('', $dropBlock);
        $dropdown[] = '</div></li>';

        return implode('', $dropdown);
    }

    private function makeItems($items)
    {
        $menuBlock = array_map(
            function($name, $dest) {
                return gettype($dest) == 'array' ? $this->makeDropDown($name, $dest) : $this->makeLink($name, $dest);
            },
            array_keys($items),
            $items
        );
        return implode('', $menuBlock);
    }

    private function makeSocialLinks()
    {
        $sociallinksBlock = array_reduce(
            $this->details['social'], function ($outString, $socialGroup) {
                $isImgIcons = (array_key_exists('icon-img', $socialGroup) || !empty($socialGroup['icon-img'])) ? true : false;
                $outString[] = $isImgIcons ? '<li class="nav-item d-none d-lg-flex"><a href="' : '<li class="nav-item"><a class="nav-link text-warning" target="_blank" href="';
                $outString[] = $socialGroup['link'];
                $outString[] = '" data-toggle="tooltip" target="_blank" data-placement="bottom" title="';
                $outString[] = $socialGroup['name'];
                $outString[] = $isImgIcons ? '"><img src="' : '"><i class="';
                $outString[] = $isImgIcons ? $socialGroup['icon-img'] : $socialGroup['icon-fa'];
                $outString[] = $isImgIcons ? '" class="social-icon" alt="' . $socialGroup['name'] . '"></a></li>' : '"></i></a></li>';
                return $outString;
            }, []
        );
        return implode('', $sociallinksBlock);
    }

    private function makeTail()
    {
        include 'main-info.php';
        $socialBlock = array_key_exists('social', $this->details) ? $this->makeSocialLinks() : '';

        $tailBlock = '';

        if (!empty($this->menuTail)) {
            ob_start();
            include $this->menuTail;
            $tailBlock = ob_get_clean();
        }

        $sentMark = array_key_exists('email', $_SESSION) ?
            '<li class="nav-item"><a class="text-warning nav-link btn btn-success" data-toggle="popover" title="'
                . $_SESSION['name']
                . '" data-content="' . $sent . ',<br>' . $wait_for_call . ':'
                . $_SESSION['tel']
                . '"><i class="fa fa-check-circle"></i> ' . $wait . '</a></li></ul></div></div></nav>'
                : '<li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-file-alt"></i> ' . $request .'</a></li>'
                . $socialBlock
                . '<li class="nav-item" style="border: var(--light-color) 1px solid; border-radius: 5px;"><b>' . createPhoneLink($this->details['phone'][0], 'nav-link') . '</b></li>'
                . $tailBlock
                .'</ul></div></div></nav>';
        return $sentMark;
    }
}
