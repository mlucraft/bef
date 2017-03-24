<?php get_header(); ?>  

<div id="left">
    	
        <h1><a href="<?php echo get_option('home'); ?>">Best Edinburgh Flat</a></h1>
<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar('main') ) : ?>
<?php endif; ?>

<div style="margin-top:10px;"><a href="http://www.bestedinburghflat.co.uk/availability/"><img src="http://www.bestedinburghflat.co.uk/wp-content/uploads/2011/06/festival2011.jpg" width="240" height="275" border="0"></a></div>
</div>
    
    <div id="right">
    	
        <?php 
	if (is_home()) {
		include ('homepage.php');
	}
?>
        
        
        
	</div><!--#right end -->
    
    
    
    
</div><!--Wrapper END-->

<?php get_footer(); ?>