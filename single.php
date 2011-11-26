<?php
/* The Template for displaying all single posts. */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

						 <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					
						
						<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
				
				<p class="next-chapter"><?php next_post_link('%link','Next chapter &rarr;'); ?></p>

				<?php if (FALSE) : /* dont show any of this next stuff */ ?>
				<p class="date"><?php twentyten_posted_on(); ?></p>
				<p class="post-meta"><?php twentyten_posted_in();?>

				<?php comments_template( '', true ); ?>
				<?php endif; ?>

<?php endwhile; // end of the loop. ?>
</div>
<?php get_footer(); ?>