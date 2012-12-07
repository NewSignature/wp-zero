<?php

class Template {
  public static function body_classes() {
    global $post;
    $classes = array($post->post_name.'-page');

    return implode(" ", $classes);
  }

  public static function primary_nav() {
    // The site-wide navigation
    $p = get_pages(array('parent' => 0, 'sort_column' => 'menu_order', 'hierarchical' => 0));

    $pages = array();

    global $wp_query;
    if (is_page() || is_attachment() || $wp_query->is_posts_page) {
      $current_page = $wp_query->get_queried_object_id();
    } else {
      $current_page = false;
    }

    foreach ($p as $key => $page) {
      $css_class = array('page', 'page_item', 'page-item-'.$page->ID);

      // Handle the first link in the list
      if ($key == 0)
        $css_class[] = 'first';

      // Handle the last link in the list
      if ($key == (count($p) - 1))
        $css_class[] = 'last';

      // If we're on the current page, simply make it active
      if ($page->ID == $current_page)
        $css_class[] = 'active';

      if (is_single() && $page->post_name == 'blog') {
        $css_class[] = 'active';
      }

      // If we're on a sub page, make the parent page active.
      if (!empty($current_page)) {
        $_current_page = get_page($current_page);
        if (isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors))
          $css_class[] = 'active';
        elseif ($_current_page && $page->ID == $_current_page->post_parent)
          $css_class[] = 'active';
      } elseif ($page->ID == get_option('page_for_posts')) {
        $css_class[] = 'active';
      }


      // Give pages a -1 menu order for them to not appear here
      if ($page->menu_order >= 0) {
        $pages[$key] = '<li class="'.implode(' ', $css_class).'"><a href="'.get_page_link($page->ID).'"><span>'.$page->post_title.'</span></a></li>';
      }

    }

    return implode("\n", $pages);

  }

  // Handle the subnav
  public static function sidebar_nav($current_page) {
    $parent = ($current_page->post_parent) ? $current_page->post_parent : $child = $current_page->ID;
    $p = get_pages(array('title_li' => false, 'child_of' => $parent, 'sort_column' => 'menu_order', 'sort_order' => 'ASC', 'sort_column' => 'post_name'));
    $pages = array();

    foreach ($p as $key => $page) {
      $css_class = array('page', 'page_item', 'page-item-'.$page->ID);

      // Handle the first link in the list
      if ($key == 0)
        $css_class[] = 'first';

      // Handle the last link in the list
      if ($key == (count($p) - 1))
        $css_class[] = 'last';

      // Handle setting the active page
      if ($current_page->ID == $page->ID)
        $css_class[] = 'active';

      // Get the custom values, particularly the subnav_description

      $meta = Admin::get_simple_subnav_meta($page->ID);
      $description = $meta[CURRENT_LANG];

      $html = array();
      $html[] = '<li class="'.implode(' ', $css_class).'"><a href="'.get_page_link($page->ID).'">';
      $html[] = '<span class="title">'.$page->post_title.'</span>';

      if (isset($description) && ($description != '')) {
        $html[] = '<span class="description">'.stripslashes($description).'</span>';
      }

      $html[] = '</a></li>';

      $pages[$page->post_title] = implode("\n", $html);
    }

    return implode("\n", $pages);
  }

  public static function subpages($page) {
    $parent = ($page->post_parent) ? $page->post_parent : $child = $page->ID;
    $p = get_pages(array('title_li' => false, 'child_of' => $parent, 'sort_column' => 'menu_order', 'sort_order' => 'ASC', 'sort_column' => 'post_title'));
    return $p;
  }

  public static function footer_links() {
    global $wpdb;
    $exclude = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type='page'", 'home'));

    $p = get_pages(array('exclude' => $exclude, 'parent' => 0, 'sort_column' => 'menu_order', 'hierarchical' => 0));
    $pages = array();

    foreach ($p as $key => $page) {
      if ($page->menu_order >= 0)
        $pages[$key] = '<li><a href="'.get_page_link($page->ID).'"><span>'.$page->post_title.'</span></a></li>';
    }

    return implode("\n", $pages);
  }

  // Create a dynamic page title if this is a childz
  public static function page_title($page) {
    global $wp_query;
    $title = apply_filters('the_title', $page->post_title);

    if (count($page->ancestors)) {
      $ancestors = array();

      foreach ($page->ancestors as $a) {
        $ancestor = get_page($a);
        $ancestors[] = '<a href="'.get_page_link($ancestor->ID).'">'.apply_filters('the_title', $ancestor->post_title).'</a>';
      }

      $ancestors = array_reverse($ancestors);

      $title = '<span class="ancestors">'.implode(' <span class="separator">&rsaquo;</span> ', $ancestors).'<span class="separator"> &rsaquo; </span></span>'.$title;
    }

    return $title;
  }

  public static function content($content) {
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
  }

  public static function title($title) {
    return apply_filters('the_title', $title);
  }

  public static function excerpt($post) {
    return apply_filters('the_excerpt', $post->post_excerpt);
  }

  // Handy little media function
  public static function media($rsrc) {
    return get_stylesheet_directory_uri().'/'.$rsrc;
  }

  // Helper function, accepts a string or an array of strings. Will spit out some css includes
  public static function media_css($rsrc) {
    if (is_array($rsrc)) {
      $media = array();
      foreach ($rsrc as $key => $resource) {
        $media[] = Template::media_css($resource);
      }
      return implode("", $media);
    } else {
      return sprintf('<link rel="stylesheet" type="text/css" href="%s.css" />'."\n", Template::media($rsrc));
    }
  }

  // Helper function, accepts a string or an array of strings. Will spit out some script includes
  public static function media_js($rsrc) {
    if (is_array($rsrc)) {
      $media = array();
      foreach ($rsrc as $key => $resource) {
        $media[] = Template::media_js($resource);
      }
      return implode("", $media);
    } else {
      return sprintf('<script type="text/javascript" src="%s.js"></script>'."\n", Template::media($rsrc));
    }
  }

  public static function bold($str) {
    return sprintf('<strong>%s</strong>', $str);
  }

  public static function share_facebook($title, $url = false) {
    if (!$url) $url = get_bloginfo('url').str_replace('q=', '', $_SERVER['QUERY_STRING']);
    if (!$title) $title = 'Blank Title';
    return sprintf('http://www.facebook.com/sharer.php?t=%s&u=%s', urlencode($title), urlencode($url));
  }

  // Pass this any number of args and it will get printed in a pre block
  public static function debug() {
    $args = func_get_args();

    echo "<pre>";
    print_r($args);
    echo "</pre>";
  }

  public static function date($format, $time) {
    return date($format, strtotime($time.' +0000'));
  }

  public static function comment_string($postid) {
    $count = get_comments_number($postid);

    if ($count > 1)
      $output = str_replace('%', number_format_i18n($number), __('% Comments'));
    elseif ($count == 0)
      $output = __('No Comments');
    else
      $output = __('1 Comment');

    return apply_filters('comments_number', $output, $count);
  }

  public static function cycle($count, $odd = 'odd', $even = 'even') {
    return ($count % 2) ? $even : $odd;
  }

  public static function cycle_x($count, $a) {
    return $a[$count % count($a)];
  }

  public static function str_cycle($count, $per_row) {
    $map = array('first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth', 'ninth', 'tenth');
    return $map[$count % $per_row];
  }

  public static function load($template, $c = null) {
    global $context;

    if ($c)
      $context = new Context($c);

    include ICB_TEMPLATES.$template.'.php';
  }

  public static function load_as_string($template, $context) {
    if ($context)
      $context = new Context($context);

    ob_start();
    include ICB_TEMPLATES.$template.'.php';
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }

  public static function get($var) {
    return (isset($_GET[$var]) and !empty($_GET[$var])) ? $_GET[$var] : false;
  }

  public static function lang_link($link) {
    return qtrans_convertURL($link, CURRENT_LANG);
  }

  public static function rounded_filler() {
    return '<div class="nw"></div><div class="ne"></div><div class="sw"></div><div class="se"></div>';
  }

  public static function global_js() {
    $global_js = array(
      'media_url' => get_stylesheet_directory_uri().'/',
      'ajax_url' => admin_url('admin-ajax.php')
    );

    return json_encode($global_js);
  }

  public static function current_url() {
    $path = substr($_SERVER['argv'][0], 2);
    return get_bloginfo('url').$path;
  }

  public static function pluralize($num, $singular = false, $plural = false) {
    $a = ($singular) ? $singular : '';
    $b = ($plural) ? $plural : 's';
    return ($num == 1) ? $a : $b;
  }

  public static function base_url() {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  }

  public static function yesno($value, $yes = 'Yes', $no = 'No') {
    return ((bool) $value) ? $yes : $no;
  }

  public static function admin_row_yesno($value) {
    // This will return an image icon rather than a text value
    $skel = 'img/admin/boolean_%s.png';
    $path = Template::media(sprintf($skel, (bool) $value ? 'enabled' : 'disabled'));;
    return sprintf('<img src="%s" alt="Status" />', $path);
  }

  public static function fancyjoin($arr) {
    // Takes an array, and will join it intelligently
    $return_string = array();

    foreach ($arr as $key => $value) {
      if (count($arr) == 1) {
        break;
      } elseif ($key == (count($arr) - 1) and count($arr) == 2) {
        $return_string[] = ' and ';
      } elseif ($key == (count($arr) - 1)) {
        $return_string[] = ', and ';
      } elseif ($key != 0) {
        $return_string[] = ', ';
      }

      $return_string[] = $value;
    }

    return implode("", $return_string);

  }

  function shorten($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
      $input = strip_tags($input);
    }

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
      return $input;
    }

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);

    //add ellipses (...)
    if ($ellipses) {
      $trimmed_text .= '...';
    }

    return $trimmed_text;
  }

  public static function sentence_join($a, $s) {
    $return = array();

    foreach ($a as $key => $value) {
      if (count($a) == 1) {
        return sprintf($s, $a[0]);
      } else if (($key+1 == count($a)) and count($a) > 1) {
        $return[] = sprintf(' and %s', $value);
      } else if (count($a) == 2) {
        $return[] = $value.' ';
      } else {
        $return[] = $value.', ';
      }
    }

    return sprintf($s, implode('', $return));
  }

  public static function email_encode($email) {
    $hexed = array();
    for ($i=0; $i < strlen($email); $i++) {
      $hexed[] = sprintf("&#x%s;", dechex(ord($email[$i])));
    }
    return implode("", $hexed);
  }

}