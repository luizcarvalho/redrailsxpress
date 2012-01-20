Theme Name: Arthemia Premium
Theme URI: http://colorlabsproject.com/
Description: Designed by <a href="http://michaelhutagalung.com">Michael Jubel Hutagalung</a> of <a href="http://colorlabsproject.com">Colorlabs Project</a>.
Version: 1.0
Author: Michael Jubel Hutagalung
Author URI: http://colorlabsproject.com/
Tags: thumbnails, newspaper, magazine, widgets, admin panel

Copyright 2008, Michael Jubel Hutagalung
View detailed license info in license.txt file 


-----------------------------------
Installation procedure
-----------------------------------

1. Unzip the zip folder.
2. You can see upload wp-content folder to your blog folder. All files has been placed properly within the folder structure.
3. After upload, check that the folder 'arthemia-premium' is in /wp-content/themes/ 
3. Check that the file 'popularity-contest.php' is in /wp-content/plugins/ 
4. Check that the folder 'wp-pagenavi' is in /wp-content/plugins/ 
5. Make the folder "scripts" and and "cache" in /wp-content/themes/arthemia-premium/ writable (Use FTP to do this. CHMOD 777 or 755, please try 777 first.). 
6. Upload logo (jpg or gif, 190px × 90px) to /wp-content/themes/arthemia-premium/logo 
7. Upload favicon (ico, 16px x 16px) to /wp-content/themes/arthemia-premium/icons  
8. Activate the theme. After activation, please go to "Arthemia Premium Option" in WP Admin Panel (Design >> Theme). 
9. Assign logo file, favicon file, headline and featured category, categories for category bar, categories for category spoilers, feedburner and analytics settings at the theme administration panel.
10. Activate the Popularity Contest plugin, and the WP-Pagenavi Plugin.
11. Add and configure sidebar widgets. If you do not assign any widgets, the sidebar will show some blank white lines.
12. The theme is ready for you.
13. To control total post to be shown in the front page, go to WP Admin -> Settings > Reading and find "Blog pages show at most". Enter the value you want.

Note: 
If you start from a fresh installation of Wordpress, you may import example posts and categories (Wordpress XML import file). To import the XML file, you can go to WP Admin Panel >> Manage >> Import and choose Wordpress. 
Please choose the option to download all attachments so thumbnails and meta information of the example posts will be downloaded from the demo site to your site. You can edit all of those later. It is simply a starting point to make everything easier.


-----------------------------------
Uploading Images for Thumnails
-----------------------------------

1. Be sure you have PHP 4.3 with GD-library installed on your server. PHP 5 is better.
2. Start from a fresh copy and upload the theme at wp-content/themes/arthemia-premium/. Do not change ‘arthemia-premium’ to anything because it will break everything.
3. Make the folder “scripts” and “cache” writable (777 or 755). Try 777 first. These folder are located in wp-content/themes/arthemia-premium/ and wp-content/themes/arthemia-premium/scripts/. You can do this using FTP or any online file manager from you web hosting company.
4. Add a custom field in the post. The custom field key MUST be 'Image' (letter cases are important).
5. Fill the custom field value with the path of your image. It MUST start with 'wp-content'. If you have the image located at http://www.yourblog.com/wp-content/uploads/2008/06/file_name.jpg then the key value of the custom field MUST be wp-content/uploads/2008/06/file_name.jpg (Notice there is no http://www.yourblog.com/ in the value)
6. You could skip number 4 and 5 if you choose the First-Image automatic generation. To have your thumbnail generated, simply add images in your post and the first-images will be used as thumbnails.
7. Read this: http://michaelhutagalung.com/2008/08/tutorial-timthumb-thumbnail-generation-with-arthemia-theme/ if you want to use Post Custom Field.
8. The script currently only support JPG images.

-----------------------------------
Uploading Videos
-----------------------------------

1. Add a custom field in the post. The custom field key MUST be 'Video' (letter cases are important).
2. Fill the custom field value with source of the video. This feature is new and currently tested with YouTube videos only. Add the URL of YouTube videos to the value. Eg. "http://www.youtube.com/watch?v=Z0Lfz4ysWf0"
3. You can also add static image to the video-box. This image will be displayed if visitors do not click the play button. Static images are taken from Post Custom Field, from the key "Image", the same for post thumbnails.

-----------------------------------
Forum
-----------------------------------
http://michaelhutagalung.com/forum

