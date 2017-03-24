<?php get_header(); ?>  

<div id="left">
    	
        <h1><a href="<?php echo get_option('home'); ?>">Best Edinburgh Flat</a></h1>
<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar('newspages') ) : ?>
<?php endif; ?>
</div><!--#left end -->
    
    <div id="right">
        
        <h2 class="title">News</h2>
        <div id="clearfix10"></div>
         <?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
        
       	  
            <div id="newscontainer">
			<h4><?php the_title(); ?></h4>
            <small><?php the_time('F jS, Y') ?></small>
            <?php the_content(); ?>
            </div>
          
          <?php endwhile; ?>
          
          <?php else : ?>

		<h2>Not Found</h2>
		<p>Sorry, no results where found.</p>

	<?php endif; ?>
        
        
        
        
	</div><!--#right end -->
    
    
    
    
</div><!--Wrapper END-->

<?php get_footer(); ?>

