<?php

// Widget-specific variables
$ll_socialinfo = array(
     "WidgetName"   => "libsocial",
     "Title"        => "Social Media Links",
     "Description"  => "A list of social media links for the UT Library.",
     "DefaultHeader"=> "Follow UT Library"
);

$ll_sociallinks = array(
     array("Google+", "http://plus.google.com/117391561174028073964/", "g"),
     array("Twitter", "http://www.twitter.com/utlibraries", "t"),
     array("Facebook", "http://www.facebook.com/utlibraries", "f"),
     array("Flickr", "http://www.flickr.com/utlibraries", "r"), 
     array("YouTube", "http://www.youtube.com/utlibraries", "y"), 
     array("Friendfeed", "http://www.friendfeed.com/utlibraries", "d"), 
     array("Pinterest", "http://pinterest.com/utlibraries/", "p")
);

///////////////////////////////////////////////////
class LibSocial extends WP_Widget {
     function LibSocial() {
          global $ll_socialinfo;
          $widget_ops = array(
          'classname' => $ll_socialinfo["WidgetName"],
          'description' => $ll_socialinfo["Description"]
          );
          $this->WP_Widget(
                    $ll_socialinfo["WidgetName"],
                    'LibLinks: '.$ll_socialinfo["Title"],
                    $widget_ops
          );
     }

     function form($instance) {
          $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
          $title = $instance['title'];
?>
          <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
     }
 
     function update($new_instance, $old_instance) {
          $instance = $old_instance;
          $instance['title'] = $new_instance['title'];
          return $instance;
     }

     function widget($args, $instance) { // widget sidebar output
          global $ll_socialinfo;
          global $ll_sociallinks;
          $widgetname = $ll_socialinfo["WidgetName"];

          extract($args, EXTR_SKIP);
          echo $before_widget; // pre-widget code from theme
          $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
          $default_title = "Follow UT Library";
          if (strlen($title) !== 1)
               echo $before_title . $title . $after_title;
          else 
               echo $before_title . $default_title . $after_title;;

         ll_makelist2($ll_sociallinks, $widgetname);
         echo $liblinks_libsocial;

         echo $after_widget; // post-widget code from theme
     }
}

liblinks_dropdown_js($ll_socialinfo["WidgetName"]);

add_action(
          'widgets_init',
          create_function('','return register_widget("LibSocial");')
);

?>