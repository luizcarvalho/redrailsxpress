<?php

//Ajax Calls
if (isset($_POST['custom_field']))
{	
$root = $_SERVER['SCRIPT_FILENAME'];
$pos = strrpos($root, "wp-content");
	   $wp_installation = substr($root, 0 , $pos );
	
	include_once($wp_installation.'/wp-load.php' );
	$field_and_value = $_POST['custom_field'];
	$values = explode(",", $field_and_value);
	update_option($values[0],$values[1]);
	exit;
}

if (isset($_POST['count']))
{
	$root = $_SERVER['SCRIPT_FILENAME'];
	$pos = strrpos($root, "wp-content");
	$wp_installation = substr($root, 0 , $pos );
	
	
	include_once($wp_installation.'/wp-load.php' );
	
	add_post_meta($_POST['post_id'], $_POST['meta_key'], $_POST['meta_value'], true);
	
	echo "<tr>";
	
		echo "<td style='font-size: 11px;' ><input type=\"text\" name=\"". 'custom_field_'.$_POST['post_id'].'_'.$_POST['count'] ."\" id=\"". 'custom_field_'.$_POST['post_id'].'_'.$_POST['count'] ."\" value=\"\" size=\"3\"></td>";
		echo "<td valign='middle' style='font-size: 11px;'>". get_custom_label_edit('custom_field_'.$_POST['post_id'].'_'.$_POST['count'], false) ."</td>";

	echo "</tr>";
	exit;
}

if (isset($_POST['delete']))
{
	$root = $_SERVER['SCRIPT_FILENAME'];
	$pos = strrpos($root, "wp-content");
	$wp_installation = substr($root, 0 , $pos );
	
	
	include_once($wp_installation.'/wp-load.php' );
	
	delete_post_meta($_POST['post_id'], $_POST['meta_key']);
	
	echo "";
		
	exit;
}


?>