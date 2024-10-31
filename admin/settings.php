<?php
function wpacp_admin_settings() {
global $wpacp_options;
?>
<div class="wrap">
	<h2><?php _e('Add Color Polls Settings','wpacp'); ?></h2>
	
	<div id="poststuff" class="metabox-holder has-right-sidebar" style="float:right;width:28%;"> 
	
			<div class="postbox"> 
			  <h3 class="hndle"><span><?php _e('About this Plugin:','wpacp'); ?></span></h3> 
			  <div class="inside">
                <ul>      
			  			  
	</div>

<div style="float:left;width:70%;">	
	<form id="poll-settings" method="post" action="options.php">
	<?php settings_fields('wpacp-group'); ?>
	<table class="form-table">
		<tr valign="top"> 
			<th scope="row" style="width:130px;"><label for="wpacp_options[permission]"><?php _e('Who can vote?','wpacp'); ?></label></th> 
			<td><input id="permission0" name="wpacp_options[permission]" type="radio" value="0" <?php checked('0', $wpacp_options['permission']); ?>  /> <label for="permission0"><?php _e('Everybody','wpacp'); ?></label><br />
			<input id="permission1" name="wpacp_options[permission]" type="radio" value="1" <?php checked('1', $wpacp_options['permission']); ?>  /> <label for="permission1"><?php _e('Registered users','wpacp'); ?></label>
			</td> 
		</tr>
		
		<tr valign="top"> 
			<th scope="row" style="width:130px;"><label for="wpacp_options[track]"><?php _e('Track voters by...','wpacp'); ?></label></th> 
			<td><input id="track0" name="wpacp_options[track]" type="radio" value="0" <?php checked('0', $wpacp_options['permission']); ?>  /> <label for="track0"><?php _e('User login, Cookies & IP','wpacp'); ?></label><br />
			<input id="track1" name="wpacp_options[track]" type="radio" value="1" <?php checked('1', $wpacp_options['permission']); ?>  /> <label for="track1"><?php _e('Cookies only','wpacp'); ?></label><br />
			<input id="track2" name="wpacp_options[track]" type="radio" value="2" <?php checked('2', $wpacp_options['permission']); ?>  /> <label for="track2"><?php _e('IP only (not recommended)','wpacp'); ?></label>
			</td> 
		</tr>
		
		<tr valign="top"> 
			<th scope="row" style="width:130px;"><label for="wpacp_options[colors]"><?php _e('Default colors','wpacp'); ?></label></th> 
			<td>
			
			<!-- Default Colors-->
			<?php for($i=0;$i<5;$i++) { ?>
			<input type="button" class="colorbox color_bg<?php echo $i;?> colorbox_bg<?php echo $i;?>" id="colorbox_bg<?php echo $i;?>" style="background-color:<?php echo $wpacp_options['colors'][$i]['bg'];?>;width:20px;height:20px;" /> <input name="wpacp_options[colors][<?php echo $i;?>][bg]" type="hidden" id="bg<?php echo $i;?>" value="<?php echo $wpacp_options['colors'][$i]['bg'];?>" /> &nbsp;
			
			<input type="button" class="colorbox color_fg<?php echo $i;?> colorbox_fg<?php echo $i;?>" id="colorbox_fg<?php echo $i;?>" style="background-color:<?php echo $wpacp_options['colors'][$i]['fg'];?>;width:20px;height:20px;" /> <input name="wpacp_options[colors][<?php echo $i;?>][fg]" type="hidden" id="fg<?php echo $i;?>" value="<?php echo $wpacp_options['colors'][$i]['fg'];?>" /> &nbsp;
			
			<input name="wpacp_options[colors][<?php echo $i;?>][text]" size="25" type="text" class="color_bg<?php echo $i;?> color_t<?php echo $i;?> atext" style="background-color:<?php echo $wpacp_options['colors'][$i]['bg'];?>;color:<?php echo $wpacp_options['colors'][$i]['fg'];?>;" value="<?php echo $wpacp_options['colors'][$i]['text'];?>" />
			<div class="color-picker-wrap" id="picker_bg<?php echo $i;?>"><input type="text" size=7 name="bgcval<?php echo $i;?>" id="bgcval<?php echo $i;?>" value="<?php echo $wpacp_options['colors'][$i]['bg'];?>" /></div>
			<div class="color-picker-wrap" id="picker_fg<?php echo $i;?>"><input type="text" size=7 name="fgcval<?php echo $i;?>" id="fgcval<?php echo $i;?>" value="<?php echo $wpacp_options['colors'][$i]['fg'];?>" /></div>
			
			<script type="text/javascript">
				//bg
				jQuery('#picker_bg<?php echo $i;?>').farbtastic(function(color) { jQuery('.color_bg<?php echo $i;?>').css('backgroundColor',color); jQuery('#bg<?php echo $i;?>').val(color);jQuery("#bgcval<?php echo $i;?>").val(color);});
				jQuery.farbtastic("#picker_bg<?php echo $i;?>").setColor('<?php echo $wpacp_options['colors'][$i]['bg'];?>');
				jQuery('#bgcval<?php echo $i;?>').keyup(function() {jQuery.farbtastic("#picker_bg<?php echo $i;?>").setColor( jQuery('#bgcval<?php echo $i;?>').val() );});
				jQuery('#colorbox_bg<?php echo $i;?>').click(function () {if (jQuery('#picker_bg<?php echo $i;?>').css('display') == "block") {jQuery('#picker_bg<?php echo $i;?>').fadeOut("slow"); } else { jQuery('#picker_bg<?php echo $i;?>').fadeIn("slow"); }});				
				var bg<?php echo $i;?> = false;
				jQuery(document).mousedown(function(){ jQuery('#bgcval<?php echo $i;?>').mousedown(function() {	bg<?php echo $i;?>=true;});if (bg<?php echo $i;?> == true) {return; }	jQuery('#picker_bg<?php echo $i;?>').fadeOut("slow");});
				jQuery(document).mouseup(function(){bg<?php echo $i;?> = false;});
				//fg
				jQuery('#picker_fg<?php echo $i;?>').farbtastic(function(color) { jQuery('.color_fg<?php echo $i;?>').css('backgroundColor',color); jQuery('.color_t<?php echo $i;?>').css('color',color);jQuery('#fg<?php echo $i;?>').val(color);jQuery("#fgcval<?php echo $i;?>").val(color);});
				jQuery.farbtastic("#picker_fg<?php echo $i;?>").setColor('<?php echo $wpacp_options['colors'][$i]['fg'];?>');
				jQuery('#colorbox_fg<?php echo $i;?>').click(function () { if (jQuery('#picker_fg<?php echo $i;?>').css('display') == "block") { jQuery('#picker_fg<?php echo $i;?>').fadeOut("slow"); }else {jQuery('#picker_fg<?php echo $i;?>').fadeIn("slow"); }});				
				var fg<?php echo $i;?> = false;
				jQuery(document).mousedown(function(){jQuery('#fgcval<?php echo $i;?>').mousedown(function() {fg<?php echo $i;?>=true;});if (fg<?php echo $i;?> == true) {return; }jQuery('#picker_fg<?php echo $i;?>').fadeOut("slow");});
				jQuery(document).mouseup(function(){fg<?php echo $i;?> = false;});
			</script>
			<br />
			<?php } ?>
			</td> 
		</tr>
		
	</table>
	<table class="form-table">	
		<tr valign="top"> 
			<th scope="row" style="width:200px;"><label for="maxchar"><?php _e('Add "read more" if a question\'s description is more than','wpacp'); ?></label></th> 
			<td><input id="maxchar" name="wpacp_options[maxchar]" type="text" class="small-text" value="<?php echo $wpacp_options['maxchar']; ?>" /> <?php _e('characters','wpacp'); ?>
			</td> 
		</tr>
		
		<tr valign="top"> 
			<th scope="row" style="width:200px;"><label for="wpacp_options[notify]"><?php _e('Send email notification when new question is added to a poll','wpacp'); ?></label></th> 
			<td><input id="notify" name="wpacp_options[notify]" type="checkbox" value="1" <?php checked('1', $wpacp_options['notify']); ?> /> <label for="notify"><?php _e('Yes, send to site admin','wpacp'); ?></label>
			</td> 
		</tr>
		
	</table>
	
	<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save') ?>" />
	</p>
	
	</form>
	<div id="saveResult"></div>
	</div>
</div>
<?php 
}

function register_wpacp_settings() { // whitelist options
  register_setting( 'wpacp-group', 'wpacp_options' );
}

?>