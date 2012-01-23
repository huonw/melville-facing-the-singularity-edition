<?php
/* The Template for displaying all single posts. */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h1 class="entry-title"><?php the_title(); ?></h1>

<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>

<p class="next-chapter"><?php next_post_link('%link','Next chapter &rarr;',TRUE); ?></p>

<?php edit_post_link('Edit', '<p>', '</p>'); ?>
</div>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>