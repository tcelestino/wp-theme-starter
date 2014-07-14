<?php 
  
  // enable menu
  add_action('admin_init', 'setMenu');
  function setMenu() {
    if (function_exists('add_theme_support')) {
      add_theme_support('menus');
    }
  }

  // enable posts thumbnail
  add_action('admin_init', 'setThumb');
  function setThumb() {
    if (function_exists('add_theme_support')) {
      add_theme_support('post-thumbnails');
      set_post_thumbnail_size(640, 420);
      add_image_size('img_default', 200, 200, true);
    }
  }

// disbale admin bar front-end
add_filter('show_admin_bar' , 'removeAdminBar');
function removeAdminBar(){
    return false;
}

// disable menu items admin
add_action('admin_menu', 'removeAdminMenu');
function removeAdminMenu() {
  global $menu;
  $restricted = array(__('Posts'), __('Links'), __('Comments'));
  end ($menu);

  while (prev($menu)) {
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
    unset($menu[key($menu)]);
    }
  }
}

// set truncate text
function setTruncateText($str_text, $max_char, $etc) {
  if(strlen($str_text)>$max_char){
    return substr($str_text, 0, $max_char) . $etc;
  } else {
    return $str_text;
  }
}

// get truncate text
function getTruncateText($post, $max_text=140, $etc='...') {
  $text = ($post->post_excerpt == '') ? $post->post_content : $post->post_excerpt;
  echo truncateText($text, $max_text, $etc);
}

// show values array
function printArrayField($field, $print=true) {
  global $post;
  $val = get_post_meta($post->ID, $field, true);
  if($print){
    echo $val;
  } else {
    return $val;
  }
}

// parser URL youtube
function parseYouTubeURL($url) {
  $id = parse_url($url);
  $id = $id['query'];
  $id = parse_str($id, $out);
  $id = $out['v'];

  return $id;
}

// show youtube iframe
function getYouTubeEmbed($url, $width=308, $height=245, $autoplay=0) {
  $id = parseYouTubeURL($url);  

  echo '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$id.'?rel=0&hd=1&autoplay='.$autoplay.'" frameborder="0" allowfullscreen></iframe>';
}

// show youtube thumbnail
function getYoutubeImage($url, $size='small') {
  $id = parseYouTubeURL($url);

  if($size=='small'){
    $size = '3';
  } else if($size=='full'){
    $size = '0';
  }
  
  return 'http://img.youtube.com/vi/'.$id.'/'.$size.'.jpg';
}

// add css class on first and last item menu
add_filter('wp_nav_menu_objects', 'addLastClass');
function addLastClass($items) {
    $items[1]->classes[] = 'is-first';
    $items[count($items)]->classes[] = 'is-last';
    return $items;
}

// add files to wp_head on the file (ex: index.php)
function addHead($function_to_add, $priority = 10, $accepted_args = 1) {
  add_action("wp_head", $function_to_add, $priority, $accepted_args);
}
// add files to wp_footer on the file (ex: index.php)
function addFooter($function_to_add, $priority = 10, $accepted_args = 1) {
  add_action("wp_footer", $function_to_add, $priority, $accepted_args);
}
// add customs field
add_action('add_meta_boxes', 'customBoxes');
function customBoxes() {
  add_meta_box('wordpress_url', 'WordPress Started URL', 'showFieldsWordPress', 'example_post_type', 'side', 'low');
};

// include files custom fields
function showFieldsWordPress($post, $metabox) {
  include('admin/custom_field.php');
}

// save data customs field
add_action('save_post', 'saveCustomFields');
function saveCustomFields($postID) {
  update_post_meta($postID, '_wordpress_url', $_POST['_wordpress_url'], false);
};

// custom post type
include('custom-posts-type/example_post_type.php');