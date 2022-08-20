<?php
/**
 * Header
 */
class Header
{
    function __construct()
    {
        $this->config = getConfigPath('general');
        require $this->config;

        $this->techConfig = getConfigPath('tech');
        require $this->techConfig;

        $this->serialized = unserialize(file_get_contents(getConfigPath('s_serialized')));

        $this->generalData = $entDetails;
        $this->techData = $techData;

        $loc = (isset($_GET['p']) && $_GET['p'] == 'eng') ? 'eng' : 'rus';
        $this->loc = $loc;

        $this->entDetails = $entDetails;

        $preparedTitle = getLocaleString($entDetails['type'], $loc)
            . ' &laquo;' . getLocaleString($entDetails['name'], $loc) . '&raquo; | ' . getLocaleString($entDetails['slogan'], $loc) . ' '
            . getLocaleString($entDetails['city'], $loc);

        $this->pagetitle = '<title>' . $preparedTitle . '.</title>';

        $descriptionSection = checkAndReplace($this->generalData, 'description', $entDetails['slogan']);
        $this->description = '<meta name="description" content="' . getLocaleString($descriptionSection, $loc) . '">';

        // $this->keywords = '<meta name="keywords" content="' . getLocaleString($entDetails['keywords'], $loc) . '">';
        $this->keywords = getLocaleString($entDetails['keywords'], $loc);

        // Opengraph
        $ogLocale = $loc == 'rus' ? 'ru_RU' : 'en_EN';
        $ogType = 'article';
        $ogTitle = $preparedTitle;
        $ogDescription = getLocaleString($descriptionSection, $loc);
        $ogUrl = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $ogImage = 'img/services/1.jpg';
        $ogSitename = getLocaleString($this->entDetails['h1'], $this->loc);


        $this->opengraph = [
          'og:locale'       => $ogLocale,
          'og:type'         => $ogType,
          'og:title'        => $ogTitle,
          'og:description'  => $ogDescription,
          'og:url'          => $ogUrl,
          'og:image'        => $ogImage,
          'og:sitename'     => $ogSitename
        ];
        // Opengraph

        $this->colorScheme = checkAndReplace(
            $this->serialized, 'color', [
            // Main Colors
            'mainColor'      => '000000',
            'secColor'       => 'cccccc',
            // Light Colors
            'lightColor'     => 'fefefe',
            'lightColorSec'  => 'f3f3f3',
            // Text Colors
            'textColorDark'  => '222222',
            'textColorLight' => 'dddddd',
            ]
        );
    }

    public static function openSession()
    {
        return session_start();
    }

    public function getGeneralConfigAsVar()
    {
        return $this->generalData;
    }

    public function getTechConfigAsVar()
    {
        return $this->techData;
    }

    public function getMetrikCode($metrik)
    {
        $block[] = '<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(';
        $block[] =  $metrik;
        $block[] = ', "init", { id:';
        $block[] = $metrik ;
        $block[] = ', clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/';
        $block[] = $metrik;
        $block[] = '" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->';
        return implode('', $block);
    }

    public function putStyleLinks()
    {
        // bootstrap
        $linksBlock = ['<link rel="stylesheet" href="'];
        $linksBlock[] = $this->techData['local'] ?
            $this->techData['bsV4Local'] : $this->techData['bsV4'];
        $linksBlock[] = '">';

        $stylesBlockArr = array_map(
            function ($el) {
                return '<link rel="stylesheet" href="css/' . $el . '.css">';
            },
            $this->techData['reqStyles']
        );

        $linksBlock[] = implode('', $stylesBlockArr);

        print_r(implode('', $linksBlock));
    }

    public function putColorScheme()
    {
        $colorScheme = [];
        $colorScheme[] = '<style> :root {';
            $colorStyles[] = '--main-color: ' . $this->colorScheme['--main-color'];
            $colorStyles[] = '--sec-color: ' . $this->colorScheme['--sec-color'];
            $colorStyles[] = '--light-color: ' . $this->colorScheme['--light-color'];
            $colorStyles[] = '--light-color-sec: ' . $this->colorScheme['--light-color-sec'];
            $colorStyles[] = '--text-color-dark: ' . $this->colorScheme['--text-color-dark'];
            $colorStyles[] = '--text-color-light: ' . $this->colorScheme['--text-color-light'];
        $colorScheme[] = implode(';', $colorStyles);
        $colorScheme[] = '} </style>';
        $result = implode('', $colorScheme);
        print_r($result);
    }

    public function putFavicon()
    {
        print_r('<link rel="icon" href="img/favicons/favicon-32x32.png" sizes="32x32">');
    }


    public function putScriptsLinks($arrayOfScripts)
    {
        if (count($arrayOfScripts) == 0) {
            return;
        }

        $scriptsBlock = array_map(
            function ($scriptPath) {
                return '<script src="' . $scriptPath . '"></script>';
            },
            $arrayOfScripts
        );

        return implode('', $scriptsBlock);
    }

    public function putRequiredScripts()
    {
        $requiredScripts = $this->techData['local'] ?
        $this->techData['requiredScriptsLocal'] : $this->techData['requiredScripts'];

        print_r($this->putScriptsLinks($requiredScripts));
    }

    public function putAdditionalScripts()
    {
        print_r($this->putScriptsLinks($this->techData['additionalScripts']));
    }

    public function init()
    {
        print_r('<!doctype html><html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><meta name="format-detection" content="telephone=no">');
    }

    public function pageTitle()
    {
        print_r($this->pagetitle);
    }

    public function putDescription()
    {
        print_r($this->description);
    }

    public function keyWords($numOfKeywords = 10)
    {
        if (gettype($this->keywords) == 'array') {
            $result = array_slice($this->keywords, 0, $numOfKeywords);
            print_r('<meta name="keywords" content="' . implode(', ', $result) . '">');
        } else {
            print_r('<meta name="keywords" content="' . $this->keywords . '">');
        }
    }

    public function getOpengraph()
    {
      $prepared = array_map(
        function ($property, $content) {
          return '<meta property="' . $property . '" content="' . $content . '">';
        },
        array_keys($this->opengraph),
        $this->opengraph
      );
      print_r(implode('', $prepared));
    }

    public function beginContent($isHidden = true)
    {
        $startBlock = ['</head><body>'];

        $metrickCode = checkAndReplace($this->entDetails, 'ym');
        if (!empty($metrickCode)) {
            $startBlock[] = $this->getMetrikCode($metrickCode);
        }

        $startBlock[] = $isHidden ? '<h1 style="font-size: 0px; margin: 0px;">' . getLocaleString($this->entDetails['h1'], $this->loc) . '</h1>' : '<h1>' . getLocaleString($this->entDetails['h1'], $this->loc) . '</h1>';

        print_r(implode('', $startBlock));
    }

}
