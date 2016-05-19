<?php
/**
 * @package my-twitter-feeds-widget-plus
*/
/*
Plugin Name: My Twitter Feeds Widget Plus
Plugin URI: http://www.socialwidgets.net
Description: Thanks for installing My Twitter Feeds Widget Plus
Version: 1.0
Author: Muhammad Riduan
Author URI: http://www.socialwidgets.net
*/

class MyTwitterFeedsWidgetPlus extends WP_Widget{
    
    public function __construct() {
        $params = array(
            'description' => 'Thanks for installing Twitter Feeds Widget Plus',
            'name' => 'Twitter Widget Plus'
        );
        parent::__construct('MyTwitterFeedsWidgetPlus','',$params);
    }
    
    public function form($instance) {
        extract($instance);
        
        ?>
        
        <!-- Color Picker Script Start -->
<script type="text/javascript">
//<![CDATA[
    jQuery(document).ready(function()
    {
	// colorpicker field
	jQuery('.cw-color-picker').each(function(){
	var $this = jQuery(this),
        id = $this.attr('rel');
 	$this.farbtastic('#' + id);
    });
});		
//]]>   
</script>
<!-- Color Picker Script End -->

<!-- here will put all widget configuration -->
		<p>
			<label for="<?php echo $this->get_field_id('title');?>">Title : </label>
			<input
			class="widefat"
			id="<?php echo $this->get_field_id('title');?>"
			name="<?php echo $this->get_field_name('title');?>"
				value="<?php echo !empty($title) ? $title : "My Twitter Feeds Widget Plus"; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter_name');?>">Your Twitter Name : </label>
			<input
			class="widefat"
			id="<?php echo $this->get_field_id('twitter_name');?>"
			name="<?php echo $this->get_field_name('twitter_name');?>"
				value="<?php echo !empty($twitter_name) ? $twitter_name : ""; ?>" />
		</p>
		<p><strong>Your Twitter Username: example: "twitter"</strong></p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter_id');?>">Your Twitter Id : </label>
			<input
			class="widefat"
			id="<?php echo $this->get_field_id('twitter_id');?>"
			name="<?php echo $this->get_field_name('twitter_id');?>"
				value="<?php echo !empty($twitter_id) ? $twitter_id : ""; ?>" />
		</p>
		<p><strong>Your Twitter Widget ID: A Numeric Number. Check instructions to know more.</strong></p>
		<p>
			<label for="<?php echo $this->get_field_id('width');?>">Width : </label>
			<input
			class="widefat"
			id="<?php echo $this->get_field_id('width');?>"
			name="<?php echo $this->get_field_name('width');?>"
				value="<?php echo !empty($width) ? $width : "300"; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('height');?>">Height : </label>
			<input
			class="widefat"
			id="<?php echo $this->get_field_id('height');?>"
			name="<?php echo $this->get_field_name('height');?>"
				value="<?php echo !empty($height) ? $height : "350"; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('limit');?>">Tweet Limit : </label>
			<input
			class="widefat"
			id="<?php echo $this->get_field_id('limit');?>"
			name="<?php echo $this->get_field_name('limit');?>"
				value="<?php echo !empty($limit) ? $limit : "0"; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'color_scheme' ); ?>">Color Scheme:</label> 
			<select id="<?php echo $this->get_field_id( 'color_scheme' ); ?>"
				name="<?php echo $this->get_field_name( 'color_scheme' ); ?>"
				class="widefat" style="width:100%;">
					<option value="0" <?php if ($color_scheme == '0') echo 'selected="0"'; ?> >Light</option>
					<option value="1" <?php if ($color_scheme == '1') echo 'selected="1"'; ?> >Dark</option>	
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('backgroundColor');?>">Link Color : </label>
			<input
			class="widefat"
			id="<?php echo $this->get_field_id('backgroundColor');?>"
			name="<?php echo $this->get_field_name('backgroundColor');?>"
				value="<?php echo !empty($backgroundColor) ? $backgroundColor : "#ffffff"; ?>" />
		</p>
		<div class="cw-color-picker backgroundColorHide" rel="<?php echo $this->get_field_id('backgroundColor'); ?>"></div>

		<p>
			<label for="<?php echo $this->get_field_id( 'header' ); ?>">Show Header:</label> 
			<select id="<?php echo $this->get_field_id( 'header' ); ?>"
				name="<?php echo $this->get_field_name( 'header' ); ?>"
				class="widefat" style="width:100%;">
					<option value="true" <?php if ($face == 'header') echo 'selected="header"'; ?> >Yes</option>
					<option value="false" <?php if ($face == 'header') echo 'selected="header"'; ?> >No</option>	
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'footer' ); ?>">Show Footer:</label> 
			<select id="<?php echo $this->get_field_id( 'footer' ); ?>"
				name="<?php echo $this->get_field_name( 'footer' ); ?>"
				class="widefat" style="width:100%;">
					<option value="true" <?php if ($footer == 'true') echo 'selected="true"'; ?> >Yes</option>
					<option value="false" <?php if ($footer == 'false') echo 'selected="false"'; ?> >No</option>	
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'scrollbar' ); ?>">Show Scrollbar:</label> 
			<select id="<?php echo $this->get_field_id( 'scrollbar' ); ?>"
				name="<?php echo $this->get_field_name( 'scrollbar' ); ?>"
				class="widefat" style="width:100%;">
					<option value="true" <?php if ($scrollbar == 'true') echo 'selected="true"'; ?> >Yes</option>
					<option value="false" <?php if ($scrollbar == 'false') echo 'selected="false"'; ?> >No</option>	
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'border' ); ?>">Show Border:</label> 
			<select id="<?php echo $this->get_field_id( 'border' ); ?>"
				name="<?php echo $this->get_field_name( 'border' ); ?>"
				class="widefat" style="width:100%;">
					<option value="true" <?php if ($border == 'true') echo 'selected="true"'; ?> >Yes</option>
					<option value="false" <?php if ($border == 'false') echo 'selected="false"'; ?> >No</option>	
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tranparent' ); ?>">Remove Backgroundcolor:</label> 
			<select id="<?php echo $this->get_field_id( 'tranparent' ); ?>"
				name="<?php echo $this->get_field_name( 'tranparent' ); ?>"
				class="widefat" style="width:100%;">
					<option value="true" <?php if ($tranparent == 'true') echo 'selected="true"'; ?> >Yes</option>
					<option value="false" <?php if ($tranparent == 'false') echo 'selected="false"'; ?> >No</option>	
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('backgroundColors');?>">Background Color : </label>
			<input
			class="widefat"
			id="<?php echo $this->get_field_id('backgroundColors');?>"
			name="<?php echo $this->get_field_name('backgroundColors');?>"
				value="<?php echo !empty($backgroundColors) ? $backgroundColors : "#e6e1e2"; ?>" />
		</p>
		<div class="cw-color-picker backgroundColorsHide" rel="<?php echo $this->get_field_id('backgroundColors'); ?>"></div>
		<p><a href="http://www.socialwidgets.net" target="_blank" title="Social Widgets">Get More Widgets Here</a></p>
<?php
    }
    
    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        $title = apply_filters('widget_title', $title);
        $description = apply_filters('widget_description', $description);
	    if(empty($title)) $title = "My Twitter Feeds Widget Plus";
        if(empty($twitter_name)) $twitter_name = "";
		if(empty($twitter_id)) $twitter_id = "";
        if(empty($width)) $width = "300";
        if(empty($height)) $height = "350";
		if(empty($limit)) $limit = "0";
        if(empty($backgroundColor)) $backgroundColor = "#ffffff";
        if(empty($color_scheme)) $color_scheme = "0";
        if(empty($scrollbar)) $scrollbar = "true";
        if(empty($header)) $header = "true";
        if(empty($border)) $border = "true";
        if(empty($tranparent)) $tranparent = "true";
		if(empty($backgroundColors)) $backgroundColors = "true";
		
        echo $before_widget;
            echo $before_title . $title . $after_title;
            
            ?>

   <style>
    .twitter-timeline {
					background:<?php echo $backgroundColor;?>;
					border-color:none;
               }
   </style>
   
  <div class="mod_twitter_widget_plus" style="width: <?php echo $width; ?>px;">
        <a class="twitter-timeline" <?php if($color_scheme =='0') {?>
                data-theme="light"  <?php } else {?>  data-theme="dark"<?php };?> 
                 data-link-color="<?php echo $backgroundColor;?>" width="<?php echo $width;?>" height="<?php echo $height;?>" href="https://twitter.com/<?php echo $twitter_name;?>" data-widget-id="<?php echo $twitter_id;?>" data-tweet-limit="<?php echo $limit;?>"
                
		 <?php
			  $blank='';  
			  $headers="noheader"; 
			  $footers="nofooter"; 
			  $scrollbars="noscrollbar";
			  $borders="noborders";
			  $bg="transparent";	
		 ?>
                
         <?php if($header=='false') { $head=$headers; } else{ $head=$blank;}  ?>
         <?php if($footer=='false') {$foot=$footers;  } else{ $foot=$blank; } ?>   
         <?php if($scrollbar=='false')  {$scroll=$scrollbars;  } else{ $scroll=$blank; }?>  
         <?php if($border=='false')  { $bord=$borders;  } else{ $bord=$blank; } ?>   
         <?php if($tranparent=='true') { $trans=$bg;  }else{ $trans=$blank;  }?>            
              data-chrome="<?php echo $head;?> <?php echo $foot;?> <?php echo $scroll;?> <?php echo $bord;?> <?php echo $trans;?>">Tweets by <?php echo $twitter_name;?> </a>
    
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		</script>
		<div class="link-item" style="font-size: 9px; color: #ccc; text-align: right; position: relative; top: -15px;"><a href="http://reputationisimportant.com/blog/" target="_blank" style="color: #808080;" title="Click here">Reference Site</a></div>
 
 </div>
   
<?php
        echo $after_widget;
    }
}
//registering the color picker
function twitter_widget_plus_color_picker_script() {
	wp_enqueue_script('farbtastic');
}
function twitter_widget_plus_color_picker_style() {
	wp_enqueue_style('farbtastic');
}
add_action('admin_print_scripts-widgets.php', 'twitter_widget_plus_color_picker_script');
add_action('admin_print_styles-widgets.php', 'twitter_widget_plus_color_picker_style');
add_action('widgets_init','register_MyTwitterFeedsWidgetPlus');
function register_MyTwitterFeedsWidgetPlus(){
    register_widget('MyTwitterFeedsWidgetPlus');
}