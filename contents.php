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
$NUMBERS = array("One","Two","Three","Four","Five","Six","Seven","Eight","Nine","Ten");
$total = 0;
for ($i = 1; $i <= max_contents_parts; $i++) {
  $seccount = get_option("contents_part_${i}_count");

  $isnum = (is_numeric($seccount) && ((int)$seccount) == $seccount);

  $rawsectitle = trim(get_option("contents_part_${i}_title"));

  if (strlen($rawsectitle) > 0){
    $sectitle = __($rawsectitle);
  }
  else {
    $sectitle = "Part " . $NUMBERS[$i]; # default to something sensible
    if (!$isnum) continue; # skip a completely unfilled section
  }
  $parts[$total] = $sectitle;
  if (!$isnum) break; # break after a section with a title but no length (so assume infinite)
  $total += intval($seccount);
}

global $post;
$args = array( 'numberposts' => 10000, 'order' => 'ASC', 'category_name' => 'chapter');

$posts = get_posts($args);

if (count($parts) == 0) :
?>
  <ol class="content-list content-list-no-parts">
  <?php foreach ($posts as $post)  : setup_postdata($post);
      if (!qtrans_isAvailableIn($post->id, qtrans_getLanguage())) {
	break; # stop when we get to a post not in our language
      }?>
      <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>

    <?php endforeach; // end of the loop. ?>
  </ol>
<?php
else:
  $count_parts = 0;
    foreach ($posts as $i => $post) :
       setup_postdata($post);
       if (!qtrans_isAvailableIn($post->id, qtrans_getLanguage())) {
	 break; # stop when we get to a post not in our language
       }
       if (array_key_exists($i, $parts)) {
	 if ($count_parts != 0) { echo "</ol>"; }
	  $count_parts++;
          echo "<h2 class='contents-part-title'>". $parts[$i] . "</h2>";
	  echo "<ol class='content-list content-list-part-" . $count_parts . "' >";
       }
       ?>
       <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
       <?php endforeach; ?>
     </ol>
<?php
endif;
?>
</div>
<?php get_footer(); ?>