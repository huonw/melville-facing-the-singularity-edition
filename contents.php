<?php
  /*
    Template Name: Contents
  */
?>

<?php get_header(); ?>
<div class="post contents-page">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					
						<?php the_content(); ?>
						<?php endwhile; ?>

<ol class="content-list">
  <?php 
global $post;
$args = array( 'numberposts' => 10000, 'order' => 'ASC', 'category_name' => 'chapter');
$posts = get_posts($args);
foreach ($posts as $post)  : setup_postdata($post); ?>
    <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
  <?php endforeach; // end of the loop. ?>
</ol>
</div>
<?php get_footer(); ?>