
    
    <div id="left">
    	
        <h1><a href="<?php echo get_option('home'); ?>">Best Edinburgh Flat</a></h1>
        
        
			<?php if ( function_exists ( dynamic_sidebar(2) ) ) : ?>

<?php dynamic_sidebar (2); ?>

<?php endif; ?>
        
        
    </div><!--#left end -->