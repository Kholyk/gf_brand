<?php
// Put Company info into the theme
require 'general.php';

// Register Custom Navigation Walker
//require_once('wp_bootstrap_pagination.php');

include "functions/init.php";
//include "functions/editor.php";
//include "functions/helpers.php";


load_theme_textdomain( 'globalfinance', get_template_directory() . '../languages/themes' );
//print_r(get_template_directory());

function printLocale($key) {
    $text = __($key, 'diva');
    print_r(mb_strtoupper(mb_substr($text, 0, 1)).mb_strtolower(mb_substr($text, 1)));
}


add_image_size( 'post_thumb', 700, 450, true );
add_image_size( 'hr_thumb', 450, 700, true );



add_action( 'after_setup_theme', 'theme_register_nav_menu' );
function theme_register_nav_menu() {
	register_nav_menu( 'primary', 'Основное меню сайта' );
}

function modify_read_more_link() {
    return '&nbsp;<br /><a class="more-link btn btn-warning" href="' . get_permalink() . '">' . __('Читать далее', 'globalfinance') . ' &rarr;</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

add_theme_support( 'post-thumbnails' );



function print_galleries($galleryString)
{
    $galleryArray = explode(',', $galleryString);
    //$output = [];
    for ($i = 0; $i <= count($galleryArray); $i += 1) {
        if ($i ===0 || $i % 2 === 0) {
            $header = $galleryArray[$i];
        } else {
            $shortCode = '[ngg_images source="galleries" container_ids="'. $galleryArray[$i] .'" '
                . 'display_type="photocrati-nextgen_basic_thumbnails" override_thumbnail_settings="0" '
                . 'thumbnail_width="240" thumbnail_height="160" thumbnail_crop="1" images_per_page="20" '
                . 'number_of_columns="4" ajax_pagination="1" show_all_in_lightbox="0" '
                . 'use_imagebrowser_effect="0" show_slideshow_link="0" '
                . 'slideshow_link_text="Показать слайдшоу" slug="'. $header .'" '
                . 'order_by="sortorder" order_direction="ASC" returns="included" maximum_entity_count="500"]';
            print_r('<div class="container"><div class="row"><h3>' . $header . '</h3>');
            echo do_shortcode($shortCode);
            print_r('</div></div><br />');
        }
    }
}

add_action( 'pre_get_posts', 'my_post_queries' );

//  Posts, pagination,
function my_post_queries($query)
{
    // do not alter the query on wp-admin pages and only alter it if it's the main query
    if (!is_admin() && $query->is_main_query()){

      // alter the query for the home and category pages

    //   if(is_home()){
    //      // print_r('This is homepage');
    //     $query->set('posts_per_page', 10);
    //   }

      if ( $query->is_home() || $query->is_category() ) {
        $query->set( 'posts_per_page', 12 );
      }

    //   if(is_archive()){
    //     $query->set('posts_per_page', 10);
    //   }
    }
  }

add_action( 'pre_get_posts', 'my_post_queries' );
// end of posts

// удаляет H2 из шаблона пагинации

function my_navigation_template( $template, $class ){
	/*
	Вид базового шаблона:
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>
	*/

	return '
		<div class="nav-links">%3$s</div>
	';
}

add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );


function getPostsDataForSlug($taxonomy, $slug, $options = [])
{
    // KHOLYK: getPostsDataForSlug('partners', 'banks', ['img' => true, 'cols' = 6, 'ancor' => 'test', 'h4' => true, 'desc' => true]);
    $posts = new WP_Query([$taxonomy => $slug]);

    $result['anchor'] = $slug;

    if (!empty($options['h2'])) {
        $result['h2'] = $options['h2'];
    }
    if (!empty($options['cols'])) {
        $result['cols'] = $options['cols'];
    }
    if (!empty($options['h3'])) {
        $result['h3'] = $options['h3'];
    }
    while($posts->have_posts()) {
        $posts->the_post();

        if (!empty($options['h4'])) {
            $innerArray['heading'] = get_the_title($posts->ID);
        }
        if (!empty($options['desc'])) {
            $innerArray['desc'] = get_the_content($posts->ID);
        }
        if (!empty($options['img'])) {
            $innerArray['img'] = get_the_post_thumbnail_url($posts->ID, 'full');
        }
        $result[] = $innerArray;
    }
    return $result;
}

function getPostsDataForSlugTab($taxonomy, $slug, $options = [])
{
    // KHOLYK: getPostsDataForSlug('partners', 'banks', ['img' => true, 'cols' = 6, 'ancor' => 'test', 'h4' => true, 'desc' => true]);
    $posts = new WP_Query([$taxonomy => $slug]);
    
    $result = [];
    
    while($posts->have_posts()) {
        $posts->the_post();
        $innerArray = [];
        if (!empty($options['heading'])) {
            $innerArray['heading'] = get_the_title($posts->ID);
        }
        if (!empty($options['desc'])) {
            $innerArray['desc'] = get_the_content($posts->ID);
        }
        if (!empty($options['img'])) {
            $innerArray['img'] = get_the_post_thumbnail_url($posts->ID, 'full');
        }
        $result[] = $innerArray;
    }

    return $result;
}


require get_template_directory() . '/class/controller.php';


class Navbar {
  function __construct($data)
  {
      $this->data = $data;
      $this->menuItems = $data['menuItems'];
      $this->menuLogo = '<img src="' . $data['logo'] . '">';
      $this->menuOptions = $data['menuOptions'];
          $this->background = array_key_exists('bg', $this->menuOptions) ? 'bg-' . $this->menuOptions['bg'] : '';
          $this->navType = array_key_exists('navType', $this->menuOptions) ? $this->menuOptions['navType'] : '';
      
      // Put Company info into the theme
      include 'general.php';
      $this->company = $company;
  }

  function makeHead() {
          $sentMark = array_key_exists('email', []) ?
              '<li class="nav-item"><a class="text-warning nav-link btn btn-success" data-toggle="popover" title="'
              . $_SESSION['name']
              . '" data-content="Заявка отправлена,<br>ожидайте звонка по номеру:'
              . $_SESSION['tel']
              . '"><i class="fa fa-check-circle"></i> Ждите звонка</a></li></ul></div></div></nav>'
              : '<li class="nav-item"><a id="callback_phone" class="nav-link btn btn-outline-warning btn-sm" href="/buhservices/buh/#formblock">Перезвоните нам!</a></li>';

      return '<nav class="navbar sticky-top st-top-1"><div class="container justify-content-sm-center justify-content-lg-end">'
      .'<li class="nav-item"><a class="d-none d-lg-block nav-link  text-light">' 
      . $this->company['worktime'][0] . ' ' . $this->company['worktime'][1] . '</a></li>'
      .'<li class="nav-item d-none d-md-block">' . createPhoneLink($this->company['phones'][0], 'nav-link text-light') . '</li>'
      .'<a class="nav-link btn btn-warning btn-sm" href="https://wa.me/' . $this->company['whatsapp'][0] . '">' . $this->company['whatsapp'][1] . ' <i class="fab fa-whatsapp"></i></a>'
      .''
      .$sentMark
      .'</nav>'
      .''
      .'<nav class="navbar navbar-expand-md ' . $this->background . ' navbar-dark ' . $this->navType . ' st-top-2">'

      .'<div class="container">'
      . '<a class="navbar-brand" href="' . get_home_url() . '" style="width:200px;">' . $this->menuLogo . '</a>'
      .'<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"><span class="navbar-toggler-icon"></span></button>'
      . '<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar"><ul class="navbar-nav w-100 justify-content-end">';
  }

  function makeSocialLinks()
  {
      $sociallinksBlock = array_reduce($this->data['social'], function ($outString, $socialGroup) {
              $outString[] = '<li class="nav-item social"><a class="nav-link bigger" href="';
              $outString[] = $socialGroup['link'];
              $outString[] = '" data-toggle="tooltip" data-placement="bottom" title="';
              $outString[] = $socialGroup['name'];
              $outString[] = '"><img class="socsign" src="';
              $outString[] = $socialGroup['icon-fa'];
              $outString[] = '"></a></li>';
              return $outString;
          }, []
      );
      return implode('', $sociallinksBlock);
  }

  function makeItems($items) {
      $first = '';
      $itemsBlock = [];
      foreach ($items as $linkName => $locator) {
          $itemsBlock[] = '<li class="nav-item"><a class="nav-link" href="' . $locator . '">'.$linkName.'</a></li>';
      }
      $rest = '';
      return $first . implode('',$itemsBlock) . $rest;
  }

  // SESSION HANDLING IS OFF -->>
  function makeTail() {
      $socialBlock = array_key_exists('social', $this->data) ? $this->makeSocialLinks() : '';

      return $socialBlock . '</ul></div></div></nav>';
  }

  function makeSection() {
      $block = $this->makeHead() . $this->makeItems($this->menuItems) . $this->makeTail();
      print_r($block);
  }

}



// Plug classes here

require get_template_directory() . '/class/wrapper.php';
require get_template_directory() . '/class/single.php';
require get_template_directory() . '/class/section-bs.php';
require get_template_directory() . '/class/tabs.php';
// require get_template_directory() . '/class/navbar.php';
require get_template_directory() . '/class/slider.php';
