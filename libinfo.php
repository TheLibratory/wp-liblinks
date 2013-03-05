<?php

// Widget-specific variables
$ll_libinfo = array(
     "WidgetName"   => "libinfo",
     "Title"        => "Information & Resources",
     "Description"  => "A list of footer links required by UT Libraries; Library Information & Resources.",
     "DefaultHeader"=> "UT Library Resources"
);

$ll_infolinks = array(
    "Comments"                                      => "http://www.lib.utexas.edu/comments.html?referrer=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
    "Web Site Feedback"                             => "http://lib.utexas.edu/website_feedback",
    "About This Site"                               => "http://www.lib.utexas.edu/about/site.html",
    "Emergency Preparedness, Safety and Security"   => "http://www.utexas.edu/emergency/",
    "Accessibility"                                 => "http://www.utexas.edu/web/guidelines/accessibility.html",
    "Privacy/Confidentiality"                       => "http://www.lib.utexas.edu/privacy.html",
    "Material Usage Statement"                      => "http://www.lib.utexas.edu/usage_statement.html"
);


///////////////////////////////////////////////////
class LibInfo extends WP_Widget {
     function LibInfo() {
          global $ll_libinfo;
          $widget_ops = array(
          'classname' => $ll_libinfo["WidgetName"],
          'description' => $ll_libinfo["Description"]
          );
          $this->WP_Widget(
                    $ll_libinfo["WidgetName"],
                    'LibLinks: '.$ll_libinfo["Title"],
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
          global $ll_libinfo;
          global $ll_infolinks;
          $widgetname = $ll_libinfo['WidgetName'];

          extract($args, EXTR_SKIP);

          echo $before_widget; // pre-widget code from theme
          $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
          if (strlen($title) !== 1) // use the title if set in widget options
               echo $before_title . $title . $after_title;
          else 
               echo $before_title . $ll_libinfo["DefaultHeader"] . $after_title; // otherwise use default title set in variables

          ll_makelist($ll_infolinks, $widgetname); // call the function to create the list of links

          echo $after_widget; // post-widget code from theme
     }
}

liblinks_dropdown_js($ll_libinfo["WidgetName"]);

add_action(
          'widgets_init',
          create_function('','return register_widget("LibInfo");')
);

?>