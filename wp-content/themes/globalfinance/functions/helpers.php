<?php


add_theme_support('post-thumbnails');

function get_franchize_for_search() {
	$posts = get_posts(array('post_type' => 'kitlot', 'posts_per_page' => -1, 'post_status' => 'publish'));
	foreach ($posts as $k => $item) {
		$return.= '<a href="' . get_permalink($item) . '" class="search__item">'. get_post_meta($item->ID, 'shortName', true) .'</a>';
    $count[$k] = intval(get_post_meta($item->ID, '_alternatives__count',true));

    if ($count[$k] > 0) {
      for ($i=1;$i<=$count[$k];$i++) {
        $return.= '<a href="' . get_permalink($item) . '" class="search__item">'. get_post_meta($item->ID, '_alternatives__text' . $i, true) .'</a>';
      }
    }
	}

  return $return;
}


function get_file_ver($filename) {
 $file = WP_CONTENT_DIR . "/themes/" . get_template() . "/" . $filename;
 return (file_exists($file) ? date('ymdHis', filemtime($file)) : '0');
}

function get_thumb_url($size = false, $post = false) {
  if (!$post) global $post;
  if (has_post_thumbnail($post)) {
    $thumb_id = get_post_thumbnail_id($post);
    $thumb_url = wp_get_attachment_image_src($thumb_id, $size, true);
    return $thumb_url[0];
  }

  else return;
}


function get_one_cat() {
  global $post;
  $cats = get_the_terms($post->ID, 'group');
  if ($cats) {
    return '<a href="' . get_category_link($cats[0]->term_id) . '" class="single__bread single__bread--active">'.$cats[0]->name.'</a>'; 
  }
}

function hide_editbox() {
	global $post;
	if (in_array($post->post_type, array('faq', 'review'))) {
		echo "<style>#edit-slug-box {display:none} </style>";
	}
}

add_action('admin_head', 'hide_editbox');


function set_posts_per_page_for_towns_cpt( $query ) {
  if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'faq' ) ) {
    $query->set( 'posts_per_page', '-1' );
  }
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_towns_cpt' );

?>