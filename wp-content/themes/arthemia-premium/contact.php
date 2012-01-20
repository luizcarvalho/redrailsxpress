<?php
/*********************************************************
		This Free Script was downloaded at			
		Free-php-Scripts.net (HelpPHP.net)			
	This script is produced under the LGPL license		
		Which is included with your download.			
	Not like you are going to read it, but it mostly	
	States that you are free to do whatever you want	
			With this script!						
		NOTE: Linkback is not required, 
	but its more of a show of appreciation to us.					
*********************************************************/

//Include configuration file and function file
//(default location is in the same directory)
include_once('config.php');
include_once('functions.php');

//If contact is being sent:
if($_POST['submit_id'] == 1){
	//Check name entered
	if($_POST['name'] == NULL){ $message = 'Please enter your name.';}
	
	//check if email is enetered
	if($message == NULL && is_valid_email($_POST['email']) == false ){ $message = 'Please enter a valid email.';}
	
	//check if message is entered
	if($_POST['message_text'] == NULL && $message == NULL){ $message = 'Please enter a comment.';}	
	
	//File Upload checks
	if($message == NULL && $FILE_UPLOAD == 1 && $_FILES['user_file']['name'] != NULL){
		if($_FILES['user_file']['size'] > (($FILE_UPLOAD_MAX*1024)*1024)){ $message = 'File is over '.$FILE_UPLOAD_MAX.' MB in size.';}
		if($message == NULL && allowed_ext($FILE_UPLOADS_EXT,$_FILES['user_file']['name']) == false){$message = 'Invalid extension.';}
		$new_filename = date("G_i_s_").$_FILES['user_file']['name'];
	}
	
	//Image verificaiton checks
	if($message == NULL && $IMAGE_VERIFICATION == 1){
		$te_co = hex2bin($_POST['hid_code']);
		$word_is = RC4($te_co,$IMAGE_VER_CODE);
		if($word_is != $_POST['confirm_image']){$message = 'Your verfication code is incorrect.';}
	}
	//End verifications, start processing
	if($message == NULL){
		//Check if file upload is needed
		if($FILE_UPLOAD == 1 && $_FILES['user_file']['name'] != NULL){
			//Store file for keep and email
			move_uploaded_file($_FILES['user_file']['tmp_name'],$FILE_UPLOADS_DIR.$new_filename);
		}
		//compose admin/user message templates replaces
		$do_search = array('$+name+$','$+email+$','$+message_text+$','$+reason+$');
		$do_replace = array($_POST['name'],$_POST['email'],$_POST['message_text'],$_POST['reason']);
				
		
		//Send user email?
		if($SEND_THANKS == 1){
			$user_message = str_replace($do_search,$do_replace,$USER_TEMPLATE);
			//Set Headers
			$user_header = "Return-Path: ".$EMAIL_OPTIONS['TITLE']." <".$EMAIL_OPTIONS['FROM'].">\r\n"; 
			$user_header .= "From: ".$EMAIL_OPTIONS['TITLE']." <".$EMAIL_OPTIONS['FROM'].">\r\n";
			$user_header .= "Content-Type: ".$EMAIL_OPTIONS['TYPE']."; charset=".$EMAIL_OPTIONS['CHARSET'].";\n\n\r\n"; 
			//Send Thank you
			mail ($_POST['email'],$EMAIL_OPTIONS['USER_SUBJECT'],$user_message,$user_header);	
		}
		
		//Send admi email?
		if(count($ADMIN_EMAILS) > 0){
			$admin_message = str_replace($do_search,$do_replace,$ADMIN_TEMPLATE);
			//Do we need to send file as attachment?
			if($FILE_DO != 1){
				//Get file attriubtes
				$fileatt_type = $_FILES['user_file']['type'];
				
				$file = fopen($FILE_UPLOADS_DIR.$new_filename,'rb');
				while($dat = fread($file,1025657)){
					$attachment_data .= $dat;
				}
				fclose($file);
				
				// Encode file content
				$attachment_data = chunk_split(base64_encode($attachment_data));
				//File upload headers
				$semi_rand = md5(time());
				$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
				
				$headers = "From: ".$EMAIL_OPTIONS['TITLE']." <".$EMAIL_OPTIONS['FROM'].">";
				
				// Add the headers for a file attachment
				$headers .= "\nMIME-Version: 1.0\n" .
					"Content-Type: multipart/mixed;\n" .
					" boundary=\"{$mime_boundary}\"";						
				
				  // Add a multipart boundary above the plain message
				$new_message = "This is a multi-part message in MIME format.\n\n" .
					"--{$mime_boundary}\n" .
					"Content-Type: ".$EMAIL_OPTIONS['TYPE']."; charset=\"".$EMAIL_OPTIONS['CHARSET']."\"\n" .
					"Content-Transfer-Encoding: 7bit\n\n" .
					$admin_message . "\n\n";
			   			
				  // Add file attachment to the message
				 $new_message .= "--{$mime_boundary}\n" .
		             "Content-Type: {$fileatt_type};\n" .
		             " name=\"{$new_filename}\"\n" .
		             "Content-Disposition: attachment;\n" .
		             " filename=\"{$new_filename}\"\n" .
		             "Content-Transfer-Encoding: base64\n\n" .
		             $attachment_data . "\n\n" .
		             "--{$mime_boundary}--\n"; 
				
				unset($attachment_data);
			} else {
				//regular headers
				$headers = "Return-Path: ".$EMAIL_OPTIONS['TITLE']." <".$EMAIL_OPTIONS['FROM'].">\r\n"; 
				$headers .= "From: ".$EMAIL_OPTIONS['TITLE']." <".$EMAIL_OPTIONS['FROM'].">\r\n";
				$headers .= "Content-Type: ".$EMAIL_OPTIONS['TYPE']."; charset=".$EMAIL_OPTIONS['CHARSET'].";\n\n\r\n"; 
				$new_message = $admin_message;
			}
			//Send admin emails
			foreach($ADMIN_EMAILS as $this_email){
				mail ($this_email,$EMAIL_OPTIONS['USER_SUBJECT'],$new_message,$headers);	
			}
		}
		
		//Remove file if not needed
		if($FILE_DO == 2){
			unlink($FILE_UPLOADS_DIR.$new_filename);
		}
		$message = 'Your contact has been sent, thank you.';
		$_POST = NULL;
	}
}
if($message != NULL){
?>
<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#FF8080">
  <tr>
    <td bgcolor="#FFD5D5"><font color="#FF0000"><?=$message;?></font></td>
  </tr>
</table>
<br/>
<?php } ?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" name="contact" id="contact" style="display:inline;">
<table width="100%"  border="0" align="left" cellpadding="5" cellspacing="0">
	<tr>
	  <td>Name:</td>
		<td><input name="name" type="text" id="name" value="<?php echo $_POST['name'];?>"></td>
	</tr>
	<tr>
	  <td>Email:</td>
		<td><input name="email" type="text" id="email" value="<?php echo $_POST['email'];?>"></td>
	</tr>
	<tr>
	  <td>Reason for contact: </td>
		<td><select name="reason" id="reason" style="width:154px;">
		<?php if($_POST['reason'] == 'Support' || $_POST['reason'] == NULL){ $sel = ' selected';} else { $sel = NULL;} ?>
		<option value="Support"<?=$sel;?>>Support</option>
		<?php if($_POST['reason'] == 'Billing'){ $sel = ' selected';} else { $sel = NULL;} ?>
		<option value="Billing"<?=$sel;?>>Billing</option>
		<?php if($_POST['reason'] == 'Complaints'){ $sel = ' selected';} else { $sel = NULL;} ?>
		<option value="Complaints"<?=$sel;?>>Complaints</option>
		<?php if($_POST['reason'] == 'Other'){ $sel = ' selected';} else { $sel = NULL;} ?>
		<option value="Other<?=$sel;?>">Other</option>
	  </select></td>
	</tr>
	<tr>	
	  <td>Message:</td>
		<td><textarea name="message_text" cols="40" rows="4" id="message_text"><?php echo $_POST['message_text'];?></textarea></td>
	</tr>
	<?php
	if($IMAGE_VERIFICATION == 1){?>
	<tr>
	  <td>Verification code:</td>
		<td>		  <table  border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><?php
				$referenceid = md5(mktime()*rand());
				//Generate the random string
				$chars = array("a","A","b","B","c","C","d","D","e","E","f","F","g","G","h","H","i","I","j","J","k",
				"K","l","L","m","M","n","N","o","O","p","P","q","Q","r","R","s","S","t","T","u","U","v",
				"V","w","W","x","X","y","Y","z","Z","1","2","3","4","5","6","7","8","9");
				$length = 8;
				$textstr = "";
				for ($i=0; $i<$length; $i++) {
				   $textstr .= $chars[rand(0, count($chars)-1)];
				}
				$new_string = RC4($textstr,$IMAGE_VER_CODE);
				$image_link = bin2hex($new_string);
				?>
				<img src="sec_image.php?code=<?=$image_link;?>">
				<input name="hid_code" type="hidden" id="hid_code" value="<?=$image_link;?>"><br/>
				<input name="confirm_image" type="text" id="confirm_image" value="<?php echo $_POST['confirm_image'];?>"></td>
			</tr>
			</table>
		</td>
	</tr>
	<?php }
	if($FILE_UPLOAD == 1){?>
	<tr>
	  <td>File Upload </td>
      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><input name="user_file" type="file" id="user_file"></td>
        </tr>
        <tr>
          <td><font color="#FF0000" size="2">Max. File Size: 
            <?=$FILE_UPLOAD_MAX;?> 
            MB, Allowed Extensions: 
            <?php 
			if($FILE_UPLOADS_EXT == 1){ echo 'All';}else{
			foreach($FILE_UPLOADS_EXT as $ext){ echo '-'.$ext;}}?>
          </font></td>
        </tr>
      </table>        </td>
	</tr>
	<tr>
		<td colspan="2"><div align="center">
		<input type="submit" name="Submit" value="Send Contact">
		<input name="submit_id" type="hidden" id="submit_id" value="1">
		</div></td>
	</tr>
	<?php } ?>
	<tr>
	  <td colspan="2"><div align="left"><a href="http://www.free-php-scripts.net" target="_blank"><font size="1">Powered by Simple Contact </font></a></div></td>
	</tr>
</table>     
</form>
<?php
/*
Copyright notice (this notice won't show to users but 
will help other coders who are interested in the
script to find us */

echo "<!--
/*********************************************************
					Contact Form
			This Free Script was downloaded at			
   			  http://www.Free-php-Scripts.net 
*********************************************************/
-->";

/* +++++++++++++++++++++++++++++++++++++
		END Contact FILE
---------------------------------------*/

/*
Partner Sites:
====================

Free File Upload: 
			http://www.HotFile.us
			
Free Image Hosting: 
			http://www.MyImage.us
			
Free Games (all type of games): 
			http://www.FunTimes.us
			
Free Templates: 
			http://www.allfreetemplates.us
			
PHP Skills and Tricks: 
			http://www.phptricks.com
*/
?>