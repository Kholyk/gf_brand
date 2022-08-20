<?php


add_filter('tiny_mce_before_init', 'set_default_editor_settings');
function set_default_editor_settings($init) {
  $init['paste_remove_styles'] = true;
  $init['paste_remove_spans'] = true;
  $init['paste_strip_class_attributes'] = 'all';



  return $init;
}



add_filter('tiny_mce_before_init', 'oly_set_default_editor_settings');
function oly_set_default_editor_settings($init) {
  global $post;
    if  (in_array($post->post_type, array('faq') ) ) {
      $init['paste_remove_styles'] = true;
      $init['paste_remove_spans'] = true;
      $init['paste_strip_class_attributes'] = 'all';
      $init['body_class'] = 'entry fonts-loaded';
      //$init['plugins'] = 'table';
      //$init['menubar'] = 'table';
      //$init['wordpress_adv_hidden'] = FALSE;


      // Buttons
      $init['toolbar1'] = 'undo,redo,|,bold,italic,|,bullist,numlist,|,link,unlink,|,pastetext,removeformat,|,fullscreen ';
      $init['toolbar2'] = '';
    }


  return $init;
}

function RemoveAddMediaButtonsForNonAdmins(){
   global $post;
    if ($post->post_type == 'faq' ) {
        remove_action( 'media_buttons', 'media_buttons' );
    }
}
add_action('admin_head', 'RemoveAddMediaButtonsForNonAdmins');


?>