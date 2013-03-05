<?php

// Generate list items for array of links - 1-dimensional array (title, href)
function ll_makelist($ll_infolinks, $widgetname){
	echo '<nav class="' . $widgetname .'"><ul class="liblinks-list ' . $widgetname .'">';
	foreach ($ll_infolinks as $linktitle => $linkhref) {
		echo '<li><a href="' . $linkhref . '">' . $linktitle . '</a></li>';
    }
  echo '</ul></nav>';
}

// Generate list items for array of links - 2-dimensional array (title, href, & data-icon)
function ll_makelist2($ll_sociallinks, $widgetname){
	echo '<nav class="' . $widgetname .'"><ul class="liblinks-list ' . $widgetname .'">';
	foreach ($ll_sociallinks as $ll_link) {
		echo '<li><a href="' . $ll_link[1] . '" data-icon="' . $ll_link[2] . '">' . $ll_link[0] . '</a></li>';
	}
	echo '</ul></nav>';
	unset($ll_links);
}

// This will handle the responsive conversion from unordered list to dropdown menu. 
function liblinks_dropdown_js($w) {
print <<<EOM
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
     <script>
      // DOM ready
      $(function() {
        
      // Create the dropdown base
      $("<select class='liblinks-dropdown' />").appendTo("nav.$w");
      
      // Create default option "Go to..."
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Go to..."
      }).appendTo("nav.$w select");
      
      // Populate dropdown with menu items
      $("nav.$w a").each(function() {
       var el = $(this);
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("nav.$w select");
      });
      
        // To make dropdown actually work
        // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
      $("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
      
      });
     </script>  
EOM;
}

add_action('wp_head', 'liblinks_dropdown_js');


?>