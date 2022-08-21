<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
    <head>
    <title>
    	<?php
          //global $page, $paged, $wp_query;
          //wp_title('—', true, 'right');
          //bloginfo('name');
          $site_description = get_bloginfo('description', 'display');
          if ($site_description && (is_home() || is_front_page())) {
             print_r(' — ' . $site_description  .  ' | ' . bloginfo('name'));
          } else {
            print_r(wp_title('—', true, 'right') . ' '.$site_description  .  ' ' . bloginfo('name'));
          }
        ?>
    </title>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed|Open+Sans+Condensed:300|Arsenal|Arsenal:200|Roboto+Condensed|Roboto:500" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Arsenal:400,700|M+PLUS+Rounded+1c:400,700|Roboto:400,500" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed|Open+Sans+Condensed:300|Oswald|Oswald:200|Roboto+Condensed|Roboto:500" rel="stylesheet">
        <link href="<?= get_template_directory_uri() ?>/assets/css/header.css" rel="stylesheet" />
        <link href="<?= get_template_directory_uri() ?>/assets/css/content.css" rel="stylesheet" />
        <link href="<?= get_template_directory_uri() ?>/assets/css/navbar.css" rel="stylesheet" />
        <link href="<?= get_template_directory_uri() ?>/assets/css/footer.css" rel="stylesheet" />
        <link href="<?= get_template_directory_uri() ?>/assets/css/mod.css" rel="stylesheet" />
        <link href="<?= get_template_directory_uri() ?>/assets/css/services.css" rel="stylesheet" />
        <link href="<?= get_template_directory_uri() ?>/assets/css/forms.css" rel="stylesheet" />
        <link href="<?= get_template_directory_uri() ?>/assets/css/slider.css" rel="stylesheet" />
        <link href="<?= get_template_directory_uri() ?>/buh_calculator/buh-calc.css" rel="stylesheet" />
		    <link href="<?= get_template_directory_uri() ?>/assets/lightbox/css/lightbox.min.css" rel="stylesheet">
        <script src="https://api-maps.yandex.ru/2.1/?apikey=b812b168-8eed-4416-9b6f-8fe7d508b677&lang=ru_RU" type="text/javascript"></script>

        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>
        <?php
        require 'general.php';
        print_r('<script> const calcPrices = [');
        $prArr = array_map(
            function ($el) {
                return $el;
            },
            $calcPrices
        );
        print_r(implode(',', $prArr));

        print_r('];');
        print_r('const homeUrlPath = \'' . get_home_url() . '\';');
        print_r('</script>');
        ?>
        <style>
        :root {
          --main-color: #003e01;
          --sec-color: #419100;
          --light-color: #ebffdb;
          --light-color-sec: #dfdfdf;
          --text-color-dark: #0a1600;
          --text-color-light: #ffffff;
        }
        </style>
    </head>
    <body>
    <!-- Yandex.Metrika counter -->
      <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(<?=$company['ym']?>, "init", {
              clickmap:true,
              trackLinks:true,
              accurateTrackBounce:true,
              trackHash:true
        });
      </script>
      <noscript><div><img src="https://mc.yandex.ru/watch/<?=$company['ym']?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <content>
