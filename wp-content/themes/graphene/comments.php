<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to graphene_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Graphene
 * @since Graphene 1.0
 */
global $graphene_settings;
?>

<?php 
    /* Only show comments depending on the theme setting */
    if (!graphene_should_show_comments()) : 
        return;
    endif;
?>

<?php if (post_password_required() && (comments_open() || have_comments())) : ?>
			<div id="comments">
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'graphene' ); ?></p>
                
                <?php do_action('graphene_protected_comment'); ?>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php /* Lists all the comments for the current post */ ?>
<?php if ( have_comments() ) : ?>

<div id="comments" class="clearfix">
	<?php /* Get the comments and pings count */ 
		global $tabbed;
		$comment_count = graphene_comment_count('comments', __('1 comment','graphene'), __("% comments", 'graphene'));
		$ping_count = graphene_comment_count('pings', __('1 ping','graphene'), __("% pings", 'graphene'));
		$tabbed = ($comment_count && $ping_count) ? true : false;
	?>
    <?php if ($comment_count) : ?>
    	<h4 class="comments current"><?php if ($tabbed) {echo '<a href="#">'.$comment_count.'</a>';} else {echo $comment_count;}?></h4>
	<?php endif; ?>
    <?php if ($ping_count) : ?>
	    <h4 class="pings"><?php if ($tabbed) {echo '<a href="#">'.$ping_count.'</a>';} else {echo $ping_count;}?></h4>
    <?php endif; ?>

	<?php do_action('graphene_before_comments'); ?>

    <ol class="clearfix" id="comments_list">
		<?php
        /* Loop through and list the comments. Tell wp_list_comments()
         * to use graphene_comment() to format the comments.
         * If you want to overload this in a child theme then you can
         * define graphene_comment() and that will be used instead.
         * See graphene_comment() in functions.php for more.
         */
		 $args = array( 'callback' => 'graphene_comment', 'style' => 'ol', 'type' => 'comment' );
         wp_list_comments( apply_filters( 'graphene_comments_list_args', $args ) ); ?>
         
        <?php // Are there comments to navigate through? ?>
		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <div class="comment-nav clearfix">
        	<?php if(function_exists('wp_commentnavi')) : ?>
            	<?php wp_commentnavi(); ?>
                <p class="commentnavi-view-all"><?php wp_commentnavi_all_comments_link(); ?></p>
			<?php else : ?> 
            	<p><?php paginate_comments_links(); ?>&nbsp;</p>
            <?php endif; ?>
            <?php do_action('graphene_comments_pagination'); ?>
        </div>
        <?php endif; // Ends the comment navigation ?>
    </ol>
    
    <ol class="clearfix" id="pings_list">
        <?php
        /* Loop through and list the pings. Use the same callback function as
		 * listing comments above, graphene_comment() to format the pings.
         */
		 $args = array( 'callback' => 'graphene_comment', 'style' => 'ol', 'type' => 'pings', 'per_page' => 0 );
		 wp_list_comments( apply_filters( 'graphene_pings_list_args', $args ) ); ?>
    </ol>
    
    <?php do_action('graphene_after_comments'); ?>
</div>
<?php endif; // Ends the comment listing ?>


<?php /* Display comments disabled message if there's already comments, but commenting is disabled */ ?>
<?php if (!comments_open() && have_comments()) : ?>
	<div id="respond">
		<h3 id="reply-title"><?php _e('Comments have been disabled.', 'graphene'); ?></h3>
        <?php do_action('graphene_comments_disabled'); ?>
    </div>
<?php endif; ?>


<?php /* Display the comment form if comment is open */ ?>
<?php if (comments_open()) : ?>
	<?php do_action('graphene_before_commentform'); 
	
	/**
	 * Get the comment form.
	*/ 
	
	if (!$graphene_settings['hide_allowedtags'])
		$allowedtags = '<p class="form-allowed-tags">'.sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'graphene'),'<code>'.allowed_tags().'</code>').'</p>';
	else
		$allowedtags = '';
	
	$args = array(
				'comment_notes_before' => '<p class="comment-notes">'.__('Your email address will not be published.', 'graphene').'</p>',
				'comment_notes_after'  => $allowedtags,
				'id_form'              => 'commentform',
				'label_submit'         => __('Submit Comment', 'graphene'),
				 );
	comment_form(apply_filters('graphene_comment_form_args', $args)); 

	do_action('graphene_after_commentform'); 

endif; // Ends the comment status ?>