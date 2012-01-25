<?php /* The footer for our theme.*/ ?>
</div><!--//content-->



<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>

<div class="push">
</div>

</div><!--#wrapper-->
<div id="menu"><?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used.  */ ?>
<?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'primary' ) ); ?></div>
<div id="footer">

    <div id="subscribe-form">
    <form action="http://singularityinstitute.createsend.com/t/y/s/trvi/" method="post" id="subForm">
<div>
<label for="trvi-trvi">Subscribe for updates on Singularity-related research: </label><input type="text" name="cm-trvi-trvi" id="trvi-trvi" class="default" value="Email" />
<input type="submit" value="Subscribe" />
</div>
</form>
    </div>

<?php wp_footer();?>
<?php if(melville_footer == show) {echo '<p class="credits">Made by <a href="http://madebyraygun.com">Raygun</a>, powered by <a href="http://wordpress.org/" rel="generator">WordPress</a></p>';}?>
</div><!--/footer-->

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory') ?>/script.js" ></script>

</body>
</html>
