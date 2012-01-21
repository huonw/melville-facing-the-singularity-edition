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


  <?php 
$parts = array();
for ($i = 1; $i <= max_contents_parts; $i++) {
  
  $secstart = get_option("contents_part_${i}_start");
  if (! (is_numeric($secstart) && ((int)$secstart) == $secstart)) {
    continue;
  }
  $rawsectitle = trim(get_option("contents_part_${i}_title"));
  $sectitle = "Part " . $NUMBERS[$i];
  if (strlen($rawsectitle) > 0){
    $sectitle .= ": $rawsectitle";
  }
  $parts[intval($secstart) - 1] = $sectitle;
}

global $post;
$args = array( 'numberposts' => 10000, 'order' => 'ASC', 'category_name' => 'chapter');
$posts = get_posts($args);

if (count($parts) == 0) : 
?>
  <ol class="content-list content-list-no-parts">
  <?php foreach ($posts as $post)  : setup_postdata($post); ?>
      <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
    <?php endforeach; // end of the loop. ?>
  </ol>
<?php 
else: 
  $count_parts = 0;
    foreach ($posts as $i => $post) : 
       setup_postdata($post);
       if (array_key_exists($i, $parts)) {
	 if ($count_parts != 0) { echo "</ol>"; }
	 $count_parts++;
          echo "<h2 class='contents-part-title'>". $parts[$i] . "</h2>";
	  echo "<ol class='content-list content-list-part-" . $count_parts . "' >";
       }?>

       <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
       <?php endforeach; ?>
       </ol>
<?php 
endif; 
?>
</div>
<?php get_footer(); ?>