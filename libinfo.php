<?php
class LibLinks extends WP_Widget {
     function LibLinks() {
          $widget_ops = array(
          'classname' => 'LibLinks',
          'description' => 'Widget for the common information footer links as required by UT Libraries.'
          );
          $this->WP_Widget(
                    'LibLinks',
                    'Library Information Links',
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
          $default_title = "UT Library Resources";
          if (strlen($title) !== 1)
               echo $before_title . $title . $after_title;
          else 
               echo $before_title . $default_title . $after_title;;

print <<<EOM
<ul class="liblinks-list libinfo">
     <li><a href="http://www.lib.utexas.edu/comments.html?referrer=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]">Comments</a></li>
     <li><a href="http://lib.utexas.edu/website_feedback">Web Site Feedback</a></li>
     <li><a href="http://www.lib.utexas.edu/about/site.html">About This Site</a></li>
     <li><a href="http://www.utexas.edu/emergency/">Emergency Preparedness, Satefy and Security</a></li>
     <li><a href="http://www.utexas.edu/web/guidelines/accessibility.html">Accessibility</a></li>
     <li><a href="http://www.lib.utexas.edu/privacy.html">Privacy/Confidentiality</a></li>
     <li><a href="http://www.lib.utexas.edu/usage_statement.html">Material Usage Statement</a></li>
</ul>
EOM;
          echo $after_widget; // post-widget code from theme
     }
}

add_action(
          'widgets_init',
          create_function('','return register_widget("LibLinks");')
);
?>