<?php
/* The Template for displaying all single posts. */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h1 class="entry-title"><?php the_title(); ?></h1>

<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>


<?php
$next = get_next_post(TRUE);
if (qtrans_isAvailableIn($next->ID,qtrans_getLanguage())):
?>
<p class="next-chapter"><?php next_post_link('%link',__(get_option("next_chapter_link_text")).' &rarr;',TRUE); ?></p>
<?php
endif;

 edit_post_link('Edit', '<p>', '</p>'); ?>
</div>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>