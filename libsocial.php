<?php 
class LibSocial extends WP_Widget {
     function LibSocial() {
          $widget_ops = array(
          'classname' => 'LibSocial',
          'description' => 'Widget for the common social media links as required by UT Libraries.'
          );
          $this->WP_Widget(
                    'LibSocial',
                    'Library Social Media Links Widget',
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
          extract($args, EXTR_SKIP);
          echo $before_widget; // pre-widget code from theme
          $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
          $default_title = "Follow UT Library";
          if (strlen($title) !== 1)
               echo $before_title . $title . $after_title;
          else 
               echo $before_title . $default_title . $after_title;;

print <<<EOM
<ul class="liblinks-list libsocial">
     <li><a href="http://plus.google.com/117391561174028073964/" data-icon="g">Google+</a></li>
     <li><a href="http://www.twitter.com/utlibraries" data-icon="t">Twitter</a></li>
     <li><a href="http://www.facebook.com/utlibraries" data-icon="t">Facebook</a></li>
     <li><a href="http://www.flickr.com/utlibraries" data-icon="r">Flickr</a></li>
     <li><a href="http://www.youtube.com/utlibraries" data-icon="y">YouTube</a></li>
     <li><a href="http://www.friendfeed.com/utlibraries" data-icon="d">FriendFeed</a></li>
     <li><a href="http://pinterest.com/utlibraries/" data-icon="p">Pinterest</a></li>

</ul>
EOM;
          echo $after_widget; // post-widget code from theme
     }
}

add_action(
          'widgets_init',
          create_function('','return register_widget("LibSocial");')
);

?>