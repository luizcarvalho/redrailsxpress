<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // if there's a password
if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
?>
<h2><?php _e("This post is password protected. Enter the password to view comments."); ?></h2>
<?php
return;
}
}
$commentalt = '-alt';
$commentcount = 1; ?>

<div id="comments-template">

<?php if ('open' == $post->comment_status) : ?>
<h4><?php comments_number('No User', '1 User', '% Users' );?> Responded In This Article</h4>
<div class="rss-subscribes"><?php comments_rss_link('Subscribes'); ?> To This Post Rss Feeds Or Leave A <a href="<?php trackback_url(display); ?>">Trackback</a></div>
<div class="clear-fix"></div>
<?php else: ?>
<h2>Comments For This Post Topic Was Disable By Author</h2>
<?php endif; ?>

<?php if ( $comments ) : ?>
<? // Begin Comments ?>
<?php foreach ($comments as $comment) : ?>
<? if ($comment->comment_type != "trackback" && $comment->comment_type != "pingback" && !ereg("<pingback />", $comment->comment_content) && !ereg("<trackback />", $comment->comment_content)) { ?>

<div class="comment-list<?php echo $commentalt; ?>" id="comment-<?php comment_ID() ?>">
<div class="c-left">
<div class="comment-user"><span class="aut"><?php comment_author_link(); ?></span> Said in <?php comment_date('F jS, Y') ?> <a href="#comment-<?php comment_ID() ?>">@<?php comment_time() ?></a>&nbsp;&nbsp;<?php edit_comment_link('edit','',''); ?></div>

<?php if ($comment->comment_approved == '0') : ?>
<div class="under-mod">Your Comment Is Under Moderation </div>
<?php else: ?>

<div class="comment-text"><?php comment_text(); ?></div>
<?php endif; ?>
</div>
<div class="c-right"><?php if(function_exists("MyAvatars")) : ?> <?php MyAvatars(); ?><?php else: ?><a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/mygif.gif" alt="mygif"/></a><?php endif; ?></div>
</div>

<?php
($commentalt == "-alt")?$commentalt="":$commentalt="-alt";
$commentcount++;
?>
<? } ?>
<?php endforeach; /* end for each comment */ ?>

<? // Begin Trackbacks ?>
<?php foreach ($comments as $comment) : ?>
	<? if ($comment->comment_type == "trackback" || $comment->comment_type == "pingback" || ereg("<pingback />", $comment->comment_content) || ereg("<trackback />", $comment->comment_content)) { ?>

<? if (!$runonce) { $runonce = true; ?>

<h5>Pingback And Trackback To This Post</h5>
<div class="rss-subscribes"><a href="<?php the_permalink(); ?>">Permalink</a> To This Post</div>
<div class="clear-fix"></div>

<? } ?>

<div class="pingback<?php echo $commentalt; ?>" id="comment-<?php comment_ID() ?>">
<span class="aut"><?php comment_ID() ?>.&nbsp;</span>
<?php comment_author_link(); ?></div>


<?php
($commentalt == "-alt")?$commentalt="":$commentalt="-alt";
$commentcount++;
?>
<? } ?>
<?php endforeach; /* end for each comment */ ?>

<? if ($runonce) { ?>
<? } ?>
<? // End Trackbacks ?>

<?php endif; ?>

<? // End Comments ?>

<?php if ('open' == $post->comment_status) : ?>

<?php if (get_option('comment_registration') && !$user_ID) : ?>

<h2>Sorry the comment area are closed</h2>

<?php else : ?>


<h5>Leave Your Comment Below</h5>
<div class="user-stats"><?php if ($user_ID) : ?>Login as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?><a href="<?php echo get_option('siteurl'); ?>">Back to homepage</a><?php if ($user_ID) : ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout">logout</a><?php endif; ?></div>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment-form">

<?php if (!$user_ID) : ?>
<label>Username: <span>(*required)</span></label>
<p><input name="author" type="text" class="input-box" value="<?php echo $comment_author; ?>"/></p>
<label>Email Address: <span>(*required)</span></label>
<p><input name="email" type="text" class="input-box" value="<?php echo $comment_author_email; ?>"/></p>
<label>Website: <span>(*optional)</span></label>
<p><input name="url" type="text" class="input-box" value="<?php echo $comment_author_url; ?>"/></p>
<?php endif; ?>


<label>Leave comments here</label>
<p><textarea name="comment" cols="50%" rows="8" class="input-area" id="comments"></textarea></p>
<p><input name="submit" type="submit" class="post-the-comment" value="Post My Comment" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>
<p><strong>Please Note:</strong> moderation maybe under moderation so there is no need to resubmit your comments. Feel free to <?php comments_rss_link('subscribes'); ?> to this post comment rss feeds for future updates</p>
</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>