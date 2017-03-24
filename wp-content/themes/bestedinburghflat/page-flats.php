<?php get_header(); ?>
  
<div id="left">
    	
        <h1><a href="<?php echo get_option('home'); ?>">Best Edinburgh Flat</a></h1>
<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar('main') ) : ?>
<?php endif; ?>

<div style="margin-top:10px;"><a href="http://www.bestedinburghflat.co.uk/availability/"><img src="http://www.bestedinburghflat.co.uk/wp-content/uploads/2011/06/festival2011.jpg" width="240" height="275" border="0"></a></div>

</div><!--#left end -->
    
    <div id="right">
    	
       

<table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="285" align="left" valign="top">
    <div class="title">59 The Park</div>
    <a href="<?php echo get_option('url'); ?>/59-the-park"><img src="<?php bloginfo('template_directory'); ?>/images/59thumb.jpg" width="285" height="155" border="0" /></a>
    <ul class="introbullets">
    <li>Sleeps 4</li>
    <li>2 ensuite bedrooms</li>
    <li>Secure parking</li>
    <li>Broadband WiFi</li>
    <li>Lift access</li>
    <li>Modern, stylish, exclusive, new</li>
    </ul>
    <a href="<?php echo get_option('url'); ?>/59-the-park"><img src="<?php bloginfo('template_directory'); ?>/images/moreinfo.jpg" width="100" height="43" border="0" /></a>
    </td>
    <td width="30" align="left" valign="top">&nbsp;</td>
    <td width="285" align="left" valign="top">
    <div class="title">Drummond Place</div>
    <a href="<?php echo get_option('url'); ?>/drummond-place"><img src="<?php bloginfo('template_directory'); ?>/images/drumthumb.jpg" width="285" height="155" border="0" /></a>
    <ul class="introbullets">
    <li>Sleeps 6/8</li>
    <li>3 bedrooms (1 with ensuite WC)</li>
    <li>Very large communal room - perfect for larger groups</li>
    <li>Free on street parking at weekends</li>
    <li>Broadband WiFi</li>
    <li>Georgian splendour with a modern twist</li>
    </ul>
    <a href="<?php echo get_option('url'); ?>/drummond-place"><img src="<?php bloginfo('template_directory'); ?>/images/moreinfo.jpg" width="100" height="43" border="0" /></a>
    </td>
  </tr>
</table>
        
        
        
	</div><!--#right end -->
    
    
    
    
</div><!--Wrapper END-->

<?php get_footer(); ?>

