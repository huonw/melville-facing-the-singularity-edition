<?php
/**
 * Based on TwentyTen functions and definitions
 **/

//include 'plugins/drop-caps/wp_drop_caps.php';
if (!function_exists('arl_kottke_archives')) {
include 'plugins/arl_kottke_archives.php';
}
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	// This theme uses wp_nav_menu() in one locations.
	register_nav_menus( array(
		'primary' => __( 'Footer Navigation Menu', 'twentyten' )
	) );
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'continue reading', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return '&hellip; ' . twentyten_continue_reading_link() . ' &raquo;';
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= twentyten_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">said:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post--date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '%2$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '%3$s',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		)
	);
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'Posted in %1$s and tagged %2$s.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'Posted in %1$s.';
	} else {
		$posted_in = 'Posted in';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

// dropcaps
function theme_shortcode_dropcaps($atts, $content = null, $code) {
	return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'theme_shortcode_dropcaps');

if (function_exists('register_sidebar')) { register_sidebar(); }

//build out our Portfolio Theme options

add_option("melville_theme_footer", 'show');

$melville_footer = get_option('melville_theme_footer');
define('melville_footer',$melville_footer);

$max_contents_parts = 5;
add_option("next_chapter_link_text","Next Chapter");
define('max_contents_parts', $max_contents_parts);
for ($i=1; $i <= $max_contents_parts; $i++) {
  add_option("contents_part_${i}_count", '');
  add_option("contents_part_${i}_title", '');
}

// create the admin menu

// hook in the action for the admin options page


add_action('admin_menu', 'add_melville_theme_option_page');

function add_melville_theme_option_page() {
// hook in the options page function
add_theme_page('Melville (FTS Ed.) Theme Options', 'Melville (FTS Ed.) Theme Options', 'manage_options', __FILE__, 'melville_theme_options_page');
}

function melville_theme_options_page() { ?>

<form method="post" action="options.php">

<?php wp_nonce_field('update-options'); ?>
<h3>Theme options</h3>
<table class="form-table">
<tr valign="top">
<th scope="row">Show Raygun credit in the footer (we appreciate it!)</th>
<td><select name="melville_theme_footer" value="<?php $melville_footer;?>" />
	<option value="show" <?php if(melville_footer == show) echo " selected='selected'";?>>True</option>
	<option value="hide" <?php if(melville_footer == hide) echo " selected='selected'";?>>False</option>
</select>
</td>
</tr>
</table>

<h4>Next chapter link</h4>
<table style="width:100%">
  <tr>
   <td style="width:170px"><label for='next_chapter_link_text'>Text of next chapter link:<sup>[1]</sup> </label></td>
   <td><input type="text" style="width:100%" name='next_chapter_link_text' value='<?php echo get_option("next_chapter_link_text"); ?>'/></td>
  </tr>
</table>

<h4>Contents Page Parts</h4>
<table style="width:100%">
<?php
$input_style = "width:100%";
$label_style = "width:120px;text-align:right;";

for ($i=1; $i <= max_contents_parts; $i++) :?>

<tr>
   <td style="width: 50px;"><b>Part <?php echo $i;?> </b> </td>
   <td>
   <table style="width:100%">
     <tr>
       <td style="<?php echo $label_style; ?>"><label for="contents_part_<?php echo $i; ?>_count">Number of posts: </label></td>
       <td><input type="number" <?php echo "name='contents_part_${i}_count' value='".get_option("contents_part_${i}_count")."'";?> /></td>
     </tr>
     <tr>
																	 <td style="<?php echo $label_style; ?>"><label for='contents_part_<?php echo $i; ?>_title'>Title:<sup>[1]</sup> </label></td>
       <td><input type="text" style="<?php echo $input_style;?>" <?php echo "name='contents_part_${i}_title' value='".get_option("contents_part_${i}_title")."'"; ?> /></td>
     </tr>
   </table>
</td>
</tr>
<?php endfor; ?>

</table>

<br/>
<small><sup>[1]</sup> Multilingual text is supported. Prefix the text for each language by its two letter <a href="https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes">ISO 639-1</a> code, e.g. <code>[:en]English [:fr]Français [:de]Deutsch</code>
</small>

    <input type="hidden" name="page_options" value="melville_theme_footer,next_chapter_link_text,<?php for ($i=1; $i <= max_contents_parts; $i++) {echo "contents_part_${i}_count,contents_part_${i}_title"; if ($i != max_contents_parts) {echo ',';}}?>" />
<input type="hidden" name="action" value="update" />
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>

<p>Melville theme for WordPress, made by <a href="http://madebyraygun.com">Raygun</a>.
</div>
<?php } ?>