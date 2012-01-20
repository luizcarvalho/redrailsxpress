<?php 
if (@$include_lock != "unlocked") {
   exit('<h2>Direct File Access Prohibited</h2>');
}
?>
<!-- CONFIG -->
<div class="wrap" id="form-config">
<h2>Form Configuration Instructions</h2>  
 <p>Configuration is pretty simple, just follow the step-by-step instructions below.</p>
<hr />
  <h3 id="sect-1">Section 1 of 7 &raquo; General Configuration - Required<span class="bump">&nbsp;</span> 
   <span class="jump"><a href="admin.php?page=Configuration#gen">Section 1</a></span>
    <script type="text/javascript">
     //<![CDATA[
       document.write("<small>or</small> <span class=\"jump\"><a href=\"javascript:history.go(-1)\">Return &raquo;</a></span>");
     //]]>
    </script></h3>
   <ol> 
    <li>Enter the <strong>Name</strong> you want to see at the top of the email sent to you, as in <em>Hello Form User,&#8230;</em>
     <dl>
      <dt>Examples:</dt>
       <dd><code>Mike</code>, <code>Sales</code> or <code>Acme Company</code></dd>
     </dl></li>
    <li>Enter the <strong>Email</strong> address(es) you want the form to submit to. Fear not, this information will remain hidden from spammers.
     <dl>
      <dt>Example:</dt>
       <dd><code>youremail@yourdomain.com</code>.</dd>
      <dt>Examples <span style="font-weight:normal">(Multiple addresses)</span>:</dt>
       <dd><code>youremail@yourdomain.com, anotheremail@yourdomain.com, someemail@anotherdomain.net</code>.</dd>
     </dl></li>
    <li>Enter the Form Page&#8217;s <strong><abbr><span class="abbr" title="Uniform Resource Locator">URL</span></abbr></strong> in this field after you create your contact page in WordPress. This address is available <em>only</em> after your contact form page is created, see <a href="#form-install">Form Installation Instructions</a> for more details.
     <dl>
      <dt>Examples:</dt>
       <dd><code>http://yourdomain.com/blog/?page_id=3</code> or <code>http://yourdomain.com/contact/</code>.</dd>
     </dl></li>
     <li>The form <strong>Possession</strong> refers to how statements and errors on the form read.
     <dl>
      <dt>Examples:</dt>
       <dd><code>Personal</code> reads as <em>me</em>, <em>my</em>, and <em>I</em> as in: <em>Contact me with my form</em>.</dd>
       <dd><code>Organization</code> reads as <em>we</em>, <em>our</em>, and <em>us</em> as in: <em>Contact us with our form</em>.</dd>
     </dl></li>
    <li>The <strong>Website</strong> name will appear on the main form heading if you enable it (see <a href="#sect-4">Section 4 of 8</a>). Please note that what you select here will also be on the Subject line of the email in brackets.
     <dl>
      <dt>Examples:</dt>
       <dd><code>My Cool Website</code>, <code>MyDomain.com</code>, or <code>Mike&#8217;s Blog</code>, etc.</dd>
     </dl></li>
    <li>The <strong>Time offset</strong> is useful if your server isn&#8217;t in your local time zone. Adjust as needed. If you don&#8217;t know what your server time is, this information can be found in the <a href="admin.php?page=wp-gbcf/wp-gbcf_form.php#over">Form Overview</a> for your convenience.
     <dl>
      <dt>Example:</dt>
       <dd><code>+1</code> adds one hour to the server time, <code>-1</code> deducts two hour, <code>+2</code> adds two hours, <code>-2</code> deducts two hours, etc.</dd>
     </dl></li>
    </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
<hr />
  <h3 id="sect-2">Section 2 of 7 &raquo; Contact Reason Menu<span class="bump">&nbsp;</span>
   <span class="jump"><a href="admin.php?page=Configuration#rsn">Section 2</a></span>
    <script type="text/javascript">
     //<![CDATA[
       document.write("<small>or</small> <span class=\"jump\"><a href=\"javascript:history.go(-1)\">Return &raquo;</a></span>");
     //]]>
    </script></h3>
   <ol> 
    <li>Enter some <strong>Reasons</strong> your visitors might want to contact you. Some basic reasons are provided with the form. 
     <dl>
      <dt>Examples:</dt>
       <dd><code>Just to say hello</code>, <code>Ask about your services</code>, <code>To find a sales outlet</code>, or <code>To have someone call</code>.<br />Enter each Contact Reason on a new line</dd>
     </dl></li>
   </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
<hr />
  <h3 id="sect-3">Section 3 of 7 &raquo; Anti-Spam Question/Answer<span class="bump">&nbsp;</span>
   <span class="jump"><a href="admin.php?page=Configuration#ats">Section 3</a></span>
    <script type="text/javascript">
     //<![CDATA[
       document.write("<small>or</small> <span class=\"jump\"><a href=\"javascript:history.go(-1)\">Return &raquo;</a></span>");
     //]]>
    </script></h3>
   <ol> 
    <li>Enter an Anti-Spam <strong>Question</strong> that has a simple and absolute answer, meaning it can only be answered one way. The idea behind this it to verify the user is human. If necessary, change this Q/A now and then to throw off would-be spammers. 
     <dl>
      <dt>Examples:</dt>
       <dd><code>Is water wet or dry?</code> or <code>Spell SPAM backwards.</code> or <code>1+1=</code>, or <code>What is the color of the sky?</code>, etc.</dd>
     </dl></li>
    <li>Enter an Anti-Spam <strong>Answer</strong> to the question you&#8217;re using. The examples are respective to the questions above.
     <dl>
      <dt>Examples:</dt>
       <dd><code>Wet</code> or <code>Maps</code> or <code>2</code> or <code>Blue</code>, etc.</dd>
     </dl></li>
   </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
<hr />
  <h3 id="sect-4">Section 4 of 7 &raquo; Heading Options<span class="bump">&nbsp;</span>
   <span class="jump"><a href="admin.php?page=Configuration#hdo">Section 4</a></span>
    <script type="text/javascript">
     //<![CDATA[
       document.write("<small>or</small> <span class=\"jump\"><a href=\"javascript:history.go(-1)\">Return &raquo;</a></span>");
     //]]>
    </script></h3>
   <ol> 
    <li>Select a heading <strong>Size</strong> to use for your error messages and, if enabled, your form heading (<a href="#no4">see below</a>). 
     <dl>
      <dt>Example:</dt>
       <dd><code>1</code> is the largest heading. <code>6</code> is the smallest heading. <code>2</code> (default) or <code>3</code> are recommended.</dd>
     </dl></li>
    <li>Enter some <strong>Error</strong>  heading text your visitors will hopefully never see. The heading can be further styled on the <a href="admin.php?page=Styling">Styling</a> page.
     <dl>
      <dt>Examples:</dt>
       <dd><code>Darn! You goofed!</code> or <code>Oops! You messed up!</code> or <code>Sorry, but something went wrong</code>.</dd>
     </dl></li>
    <li>Enter some <strong>Success</strong> heading text your visitors will see when they submit the form. The heading can be further styled on the <a href="admin.php?page=Styling">Styling</a> page.
     <dl>
      <dt>Examples:</dt>
       <dd><code>Yes, your mail has been sent!</code> or <code>Yeah, baby, you did it!</code> or <code>Woo-hoo, you sent an email!</code></dd>
     </dl></li>
    <li id="no4">Decide if you want to <strong>Show</strong>  the heading for the form. If you&#8217;ve created a &#8220;Page&#8221; it is likely you&#8217;ll choose <em>No</em> to since the page will have a heading already. The choice, however, is yours to make. This selection will not affect error headings. They will always display when needed.
     <dl>
      <dt>Example:</dt>
       <dd>Select <code>Yes</code> or <code>No</code>.</dd>
     </dl></li>
   </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
<hr />
  <h3 id="sect-5">Section 5 of 7 &raquo; Other Configuration Options<span class="bump">&nbsp;</span>
   <span class="jump"><a href="admin.php?page=Configuration#oth">Section 5</a></span>
    <script type="text/javascript">
     //<![CDATA[
       document.write("<small>or</small> <span class=\"jump\"><a href=\"javascript:history.go(-1)\">Return &raquo;</a></span>");
     //]]>
    </script></h3>
   <ol>
    <li>Choose <strong><abbr><span class="abbr" title="Extensible">X</span></abbr></strong> or <strong><abbr><span class="abbr" title="HyperText Markup Language">HTML</span></abbr></strong> markup needed for your blog. 99.99% of the time this will be XHTML, but in some rare cases the application may have been converted to plain HTML. If it is, this form will be ready-to-rock.
     <dl>
      <dt>Example:</dt>
       <dd>Select <code>XHTML</code> or <code>HTML</code>.</dd>
     </dl></li>
    <li>Enter some <strong>Submit</strong> button text. &#8220;Submit Form&#8221; will be suitable for most people, but if you&#8217;d like to get cleaver you can.
     <dl>
      <dt>Examples:</dt>
       <dd>Try <code>Send It</code>, <code>Send Mail</code>, <code>Email Me</code>, <code>Launch Letter</code>, or even <code>Make It So, Number One</code>.</dd>
     </dl></li>
    <li>Give <strong>Credit</strong> where credit is due, if you want to be a sport that is. 
     <dl>
      <dt>Example:</dt>
       <dd>Select <code>No</code> to hide the credit line at the form&#8217;s foot, our choose <code>Yes</code> and show your appreciation for your new spam-free life.</dd>
     </dl></li>
    <li>Everyone&#8217;s concerned about <strong>Privacy</strong> so some visitors may want to review your privacy policy before sending you their info.
     <dl>
      <dt>Example:</dt>
       <dd>Select <code>No</code> if you have no privacy policy or choose <code>Yes</code> if you do.</dd>
     </dl></li>
    <li>If you do have a privacy policy you&#8217;ll <strong>Link</strong> to it here. Just enter the relative or absolute <abbr><span class="abbr" title="Uniform Resource Locator">URL</span></abbr> in the field provided.
     <dl>
      <dt>Examples:</dt>
       <dd><code>http://www.yourdomain.com/privacy.php</code>, <code>http://yourdomain.com/privacy/</code>, <code>/privacy.php</code>, etc.</dd>
     </dl></li>
    <li>The Offer <strong>Carbon Copy</strong> option allows you to add/remove the sender&#8217;s ability to send themselves a modified carbon copy of the message sent to you.
     <dl>
      <dt>Example:</dt>
       <dd>Select <code>Yes</code> or <code>No</code>.</dd>
     </dl></li>
   </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
<hr />
  <h3 id="sect-6">Section 6 of 7 &raquo; Custom Tabindex Assignments<span class="bump">&nbsp;</span>
   <span class="jump"><a href="admin.php?page=Configuration#tab">Section 6</a></span>
    <script type="text/javascript">
     //<![CDATA[
       document.write("<small>or</small> <span class=\"jump\"><a href=\"javascript:history.go(-1)\">Return &raquo;</a></span>");
     //]]>
    </script></h3>
   <ol>
    <li>Assign <strong>Tabindex</strong> values to the form&#8217;s associated links and inputs. This helps certain users, like keyboard navigators, for example, get around the form. These values are set to zero by default, which may be beneficial to Opera users initially, but this function was added so that you can modify this assignment to suit the needs of your page.
     <dl>
      <dt>Examples:</dt>
       <dd>Privacy: <code>1</code> (or 0 if you offer no privacy link);  Name field: <code>2</code>, so on and so forth.</dd>
     </dl></li>
   </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
<hr />
  <h3 id="sect-7">Section 7 of 7 &raquo; <abbr><span class="abbr" title="Internet Protocol">IP</span></abbr> Blacklist<span class="bump">&nbsp;</span>
   <span class="jump"><a href="admin.php?page=Configuration#ipb">Section 7</a></span>
    <script type="text/javascript">
     //<![CDATA[
       document.write("<small>or</small> <span class=\"jump\"><a href=\"javascript:history.go(-1)\">Return &raquo;</a></span>");
     //]]>
    </script></h3>
   <ol>
    <li>This form is meant to stop spam &#8216;bots, but a <strong>Blacklist</strong> of <abbr><span class="abbr" title="Internet Protocol">IP</span></abbr>s is a measure to use against bothersome human users. It won&#8217;t work for all as some users change IP numbers regularly, but this is another tool you can use. Be careful when using a Blacklist function as you don&#8217;t want to block the innocent, nor do you want to block IP ranges. 
     <dl>
      <dt>Examples:</dt>
       <dd>If a bad person has the IP address <code>00.00.00.00</code>, for example, enter it the textarea. Enter each IP on a new line.</dd>
     </dl></li>
   </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
</div>
<hr />

<!-- STYLING -->
<div class="wrap" id="form-style">
<h2>Form Styling Help</h2>
 <p>What follows are instructions about the various form-styling methods for making your contact form look its best.</p>
  <h3 id="themes">Form Theme Selector Help<span class="bump">&nbsp;</span>
   <span class="jump"><a href="admin.php?page=Styling#thm">Themes</a></span>
    <script type="text/javascript">
     //<![CDATA[
       document.write("<small>or</small> <span class=\"jump\"><a href=\"javascript:history.go(-1)\">Return &raquo;</a></span>");
     //]]>
    </script></h3>
   <ol>
    <li>Select one of the available pre-made themes (designed for specific <a href="http://wordpress.org/extend/themes/">popular WordPress themes</a>). Choose which ever most closely meets your needs. The pre-made themes can be edited so you may tweak them to your heart&#8217;s content.</li>
    <li>If you want to use your WordPress theme&#8217;s global style sheet to style your form, go for it. Just select <strong>none</strong> from the menu. Your style sheet will already be linked from or imported to the page so no additional steps will be required.</li>
    <li>If you feel creative, create your own custom theme for the form by selecting <strong>custom.css</strong> from the menu. You will get a style sheet that contains all of the IDs, classes, and elements you&#8217;ll need, but no properties will be defined. Have fun and feel free to share your creation with us and others. If it&#8217;s really good and flexible, we made add it to the download and give you full credit. Need a head start? Copy the contents of one of the other themes and begin with that.</li>
    <li>After choosing a theme from the menu, simply click the <strong>Select Theme</strong> to apply your selection. Your selected theme will appear in the editor.</li>
    <li>If you want to add theme files, simply upload them to the <code>/wp-gbcf_themes/</code> directory. They will automatically be added to the menu so they can be selected. Do remember to set their permissions to make them editable. See the <a href="#form-help">Helpful <abbr><span class="abbr" title="Frequently Asked Questions">FAQ</span></abbr>s</a> to learn more about this.</li>
   </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
<hr />
  <h3 id="editor">Form Theme Editor Help<span class="bump">&nbsp;</span>
   <span class="jump"><a href="admin.php?page=Styling#edt">Editor</a></span>
    <script type="text/javascript">
     //<![CDATA[
       document.write("<small>or</small> <span class=\"jump\"><a href=\"javascript:history.go(-1)\">Return &raquo;</a></span>");
     //]]>
    </script></h3>
   <ol>
    <li>Once a file is selected using the Form Theme Selector, the applicable style sheet file will appear in the Form Theme Editor and if the permissions are set to make it writable it will be ready to edit. See the <a href="#form-help">Helpful <abbr><span class="abbr" title="Frequently Asked Questions">FAQ</span></abbr>s</a> to learn more about this.</li>
    <li>To edit the style sheet you <em>will</em> need to understand the manipulation of <abbr><span class="abbr" title="Cascading Style Sheets">CSS</span></abbr> to properly modify it. You can get some help on the web. One good resource is the <a href="http://www.htmlhelp.com/reference/css/" title="Web Developer Group">WDG CSS Properties Guide</a>. You can also get <a href="http://www.htmlhelp.com/cgi-bin/color.cgi" title="Web Developer Group">help with color codes</a> there.</li>
    <li>Once you have finish making edits to the selected style sheet file, you can save your changes by clicking the <strong>Save Changes</strong> button. Again, do remember to set the permissions to make the file editable. See the <a href="#form-help">Helpful <abbr><span class="abbr" title="Frequently Asked Questions">FAQ</span></abbr>s</a> to learn more about this.</li>
    <li>If you need help, custom styling is available by contacting <a href="http://green-beast.com/contact/">Mike Cherim</a> or <a href="http://www.blue-anvil.com/contact/">Mike Jolley</a> (or your developer of choice). This type of support is billable but the result will be a cross-compatible and professional solution.</li>
   </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
</div>

<!-- FAQS -->
<div class="wrap" id="form-help">
<h2>Helpful <abbr><span class="abbr" title="Frequently Asked Questions">FAQ</span></abbr>s</h2>
 <p>Below is a list of some common questions you may have followed by their respective answers. They appear in no particular order.</p>
 <dl>
  <dt>I&#8217;m getting a Configuration <span class="reg_alert">Notice!</span> &#8212; Why is that?</dt>
   <dd>In order for the contact form to function, the Form Page <abbr><span class="abbr" title="Uniform Resource Locator">URL</span></abbr> and at least one email address must be <a href="admin.php?page=Configuration#gen">Configured</a>.</dd>
  <dt>I&#8217;m getting a Malformation <span class="reg_alert">Warning!</span> &#8212; Why is that?</dt>
   <dd>The Form Page <abbr><span class="abbr" title="Uniform Resource Locator">URL</span></abbr> must contain &#8220;<code>http://</code>&#8221; and a &#8220;<code>.</code>&#8221; (dot) and at least one email address must contain &#8220;<code>@</code>&#8221; (at symbol) and a &#8220;<code>.</code>&#8221; (dot). Common mistakes are to enter a &#8220;<code>,</code>&#8221; (comma) instead of a &#8220;<code>.</code>&#8221; (dot) in either variable, or to apply a &#8220;<code>;</code>&#8221; (semi-colon) instead of a &#8220;<code>:</code>&#8221; (colon) in a URL. Please check your <a href="admin.php?page=Configuration#gen">Configuration</a>.</dd>
  <dt>Good grief, I&#8217;m getting BOTH the <span class="reg_alert">Notice!</span> <em>and</em> <span class="reg_alert">Warning!</span> &#8212; Oh my, why is that?</dt>
   <dd>Relax. the Form Page URL, the Email Address, or both fields are actually empty. You need to do some <a href="admin.php?page=Configuration#gen">Configuration</a> it seems.</dd>
  <dt id="alt1">I&#8217;m trying to configure the form but I don&#8217;t know the <abbr><span class="abbr" title="Uniform Resource Locator">URL</span></abbr> yet.</dt>
   <dd>You will have to enter that value immediately <em>after</em> creating the page. Then add the code <code>&lt;!--gb_contact_form--&gt;</code> to the content area of your designated WordPress &#8220;Page.&#8221; Also note that is has been reported that entering <code>[gb_contact_form]</code> in WordPress version 2.1 will also work. Optionally, you may also create a page <a href="#templ">template</a>.</dd>
  <dt>Can I send the submitted email to multiple addresses at the same time?</dt>
   <dd>You bet. Just enter as many email address you want, being sure to separate each one with a comma. Additionally, a version of this form is available for those who want multiple recipients. This version is not free-of-charge, though.</dd>
  <dt>What is the Carbon Copy feature exactly?</dt>
   <dd>Selecting &#8220;Yes&#8221; allows form users the option of having a modified copy (not actually a CC) of the email they&#8217;re sending to you to their submitted email address. Choosing &#8220;No&#8221; removes this option.</dd>
  <dt>My time zone and the time zone of my server are the same. What should I put in the <em>Time offset</em> field?</dt>
   <dd>If your time and your server&#8217;s time are one-and-the-same, enter or leave the default <code>0</code> in the field.</dd>
  <dt>What does it mean to Blacklist an <abbr><span class="abbr" title="Internet Protocol">IP</span></abbr>? It sounds bad.</dt>
   <dd>Basically it means blocking or barring users with an IP address matching one of those you may add to the list to prevent them from using the form. It&#8217;s not fool-proof, and should be a last resort measure.</dd>
  <dt>Some IP addresses are supplied with the form Blacklist. Are these evil users?</dt>
   <dd>No, they are just example numbers assigned to the &#8220;Internet Assigned Numbers Authority&#8221; and are reserved. Want to see who owns what? Check out the <a href="http://www.arin.net/whois/" title="External Link">Arin Whois Database</a> for more information.</dd>
  <dt>I broke the form making custom edits. Will you help me fix it?</dt>
   <dd><em>Maybe</em>, if we have time and it is an obvious error. Otherwise this will probable be a billable service.</dd>
  <dt id="alt2">Can additional text content be added after or below the form?</dt>
   <dd>Yes, but only if you edit the <code>wp-gbcf_form.php</code> file. See instructions on line 1403. Another option is to create a WordPress template, like so:
    <ol id="templ">
     <li>Copy the page template and rename it whatever you want, ie. &#8220;contact.php.&#8221;</li>
     <li>At the very top of the file add this:
<pre>
 <code>&lt;?php 
  /* 
   Template Name: Contact
  */
 ?&gt;</code>
</pre></li>
     <li>Within the file where the page content would be, place this:
<pre>
 <code>&lt;?php </code>
  // WILL BE PAGE CONTENT
    <code>$post_data=get_post($post-&gt;ID); echo $post_data-&gt;post_content;</code>

  // FORM SHOWS NEXT
    <code>gbcf_show(); 
 ?&gt;</code>
</pre><small>(Swap the two sections if content is wanted <em>after</em> the form.)</small></li>
     <li>Add the file to the theme directory.</li>
     <li>Create a new WordPress page for the form &#8212; or use the existing page (Edit).</li>
     <li>Remove the &#8220;tag&#8221; if the page already exists, but feel free to add other text content.</li>
     <li>Select &#8220;Contact&#8221; from the pull down on the sidebar of the edit page. (Contact if that&#8217;s the name of the template you made.)</li>
     <li>Save it. That&#8217;s it. Need help? Contact <a href="http://green-beast.com/contact/">Mike Cherim</a> or <a href="http://www.blue-anvil.com/contact/">Mike Jolley</a> for professional assistance.</li>
    </ol></dd>
  <dt>The form submits fine, but I get no emails. What on earth is wrong?</dt>
   <dd>Please check with your web host and ask them if the PHP <code>mail()</code> function is enabled for your domain. If not, and if they won&#8217;t enable it, you won&#8217;t be able to use this form plugin. Sorry.</dd>
  <dt>Can I edit the form file, <code>wp-gbcf_form.php</code>, and the scripting?</dt>
   <dd>You can if you want to, but it is not recommended unless you are a <abbr><span class="abbr" title="PHP Hypertext Preprocessor">PHP</span></abbr> expert. The script is large and will be difficult to edit or modify. Maybe in the future we will add a function to modify the form further but for now what you see is what you get. We attempted to satisfy the needs of as many users as possible by creating a one-size-fits-all contact form with some really common options and fields.</dd>
  <dt>I forgot to set permissions on a file I edited. Will I lose my work?</dt>
   <dd>You don&#8217;t have to. Set the permissions on the style sheet you&#8217;re editing now, before doing anything else, then refresh the page to re-post the editor form (answer Yes if your browser asks you) and your changes will be saved. Whew, that was close, huh?</dd>
  <dt>How do I set file permissions?</dt>
   <dd>In your server or by way of an <abbr><span class="abbr" title="File Transfer Protocol">FTP</span></abbr> program locate the file you want to set and look for its properties (will vary by server or program). These properties can sometimes be found by right-clicking on the file. You want to set permissions or CHMOD to Read and Write for Owner, Group, and Everyone: <code>-rw-rw-rw-</code> or <code>666</code>. Still need help? Contact your host or <abbr><span class="abbr" title="Internet Service Provider">ISP</span></abbr>, the maker of your FTP program, or search for &#8220;<a href="http://www.google.com/search?hl=en&amp;q=setting+file+permissions&amp;btnG=Google+Search" title="Google Search">Setting File Permissions</a>&#8221; on the web.</dd>
  <dt>I get multiple emails when the form submits. Why is that?</dt>
   <dd>We&#8217;ve seen this happen with one theme and we do not know why but the theme is different than most. Another possibility is that your contact page accepts comments. To fix that disallow comments and pingbacks for your contact page.</dd>
  <dt>How do I style the form so it looks nice?</dt>
   <dd>Check the <a href="admin.php?page=Styling">Styling</a> page to modify your form&#8217;s appearance to suit your needs. Several themes are provided, you can also select none and use your own style sheet, or you can create a custom theme of your own with the editor.</dd> 
  <dt>I want to customize my form but I don&#8217;t know how. Can you help?</dt>
   <dd>Yes, if you want to change the look. First you&#8217;ll want try all the themes to see if one will work for you or get you close. If not working out as well as you like, contact <a href="http://green-beast.com/contact/">Mike Cherim</a> or <a href="http://www.blue-anvil.com/contact/">Mike Jolley</a> to request a styling quotation. We can do! If you want to make code modifications, we <em>may</em> help, depending on what you want to do. Some custom editions have been made &#8212; such as our multi-user version for WordPress &#8212; and may be available for purchase.</dd>
  <dt>My visitors seem to have difficulty answering my Anti-Spam question. What should I do?</dt>
   <dd>Ask an easier question with only one possible answer. Asking things like &#8220;<em>What is the meaning of life?</em>&#8221; or any question that can be answered subjectively simply won&#8217;t do. Even providing the actual answer within the question itself will work. Rule-of-thumb: Keep it Simple!</dd>
  <dt>Is the Anti-Spam question or its answer case-sensitive?</dt>
   <dd>No. Both question and answer are case-insensitive to admin and user. We were proactive in the creation of this form and tried to think of and correct all possibilities that might inhibit legitimate communications.</dd>
  <dt>I don&#8217;t get any more spam and now I&#8217;m lonely. What should I do?</dt>
   <dd>Sorry to hear that. Disable this plugin and put your email address on your pages. You&#8217;ll be popular again soon.</dd>
 </dl>
 <p class="submit jump"><a href="#wphead">Top</a></p>
</div>

<!-- INSTALL -->
<div class="wrap" id="form-install">
<h2>Form Installation Instructions</h2>
 <p>Installation is fast and easy. The following steps will guide you through the process:</p>
  <ol>
   <li>Unpack the *.zip file and extract the <code>/wp-gbcf/</code> folder and <code>wp-gbcf_readme.txt</code> file.</li>
   <li>Using an <abbr><span class="abbr" title="File Transfer Protocol">FTP</span></abbr> program, upload the <code>/wp-gbcf/</code> folder to your WordPress plugins directory (Example: <code>/wp-content/plugins/</code>).</li>
   <li>In the sub-directory, <code>/wp-gbcf_themes/</code>, using FTP or your server admin panel, change the permission of the <abbr><span class="abbr" title="Cascading Style Sheet">CSS</span></abbr> theme <strong>files</strong> to 666, but you&#8217;ll only do this if you&#8217;ll want to edit them.</li>
   <li>Open your WordPress Admin panel and go to the <a href="plugins.php">Plugins</a> page. Locate the &#8220;Secure and Accessible PHP Contact Form&#8221; plugin and click on the &#8220;Activate&#8221; link.</li>
   <li>Once activated, go to the <a href="admin.php?page=wp-gbcf/wp-gbcf_form.php">Contact Form</a> page and select the <a href="admin.php?page=Configuration">Configuration</a> link on the sub-menu. If you need help, review the <a href="#form-config">Form Configuration Instructions</a>. You won&#8217;t be able to enter the <abbr><span class="abbr" title="Uniform Resource Locator">URL</span></abbr> yet, though.</li>
   <li>Once configured as much as you can, go to the <a href="post.php">Write</a> page and click the <a href="page-new.php">Write Page</a> link. If using a default page template give it a name like &#8220;Contact Page,&#8221; for example.</li>
   <li>Now go back to the <a href="admin.php?page=Configuration">Configuration</a> page and add the URL of your newly-created form page. &#8220;Save&#8221; your changes.</li> 
   <li>Now go to <a href="edit.php">Manage</a> and click on <a href="edit-pages.php">Edit Pages</a> link on the sub-menu. Then locate your contact page an click on the &#8220;Edit&#8221; link to the right of it.</li>
   <li>With the page file open, add this code <code>&lt;!--gb_contact_form--&gt;</code> to the text area and &#8220;Save&#8221; the page. For alternatives, please check out <a href="#alt1">this <abbr><span class="abbr" title="Frequently Asked Questions">FAQ</span></abbr></a> and <a href="#alt2">this other <abbr><span class="abbr" title="Frequently Asked Questions">FAQ</span></abbr></a> above.</li>
   <li>That&#8217;s it, you&#8217;re about done. The form will be on the new page you created and should be ready for use and a link to the page will be on your Web Log&#8217;s Pages&#8217; navigation menu.</li>
   <li>Test your new form. If you encounter problems, review the <a href="#form-config">Form Configuration Instructions</a> and <a href="#form-help">Helpful <abbr><span class="abbr" title="Frequently Asked Questions">FAQ</span></abbr>s</a> on this page.</li>
   <li>To style your form, select the <a href="admin.php?page=Styling">Styling</a> link. There you may select one of the ready-made themes (designed for specific popular WordPress themes), use no theme, or create your own.</li>
  </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
<hr />
 <h3>Download File/Folder List Overview:</h3>
  <ol>
   <li>Path/File: <code>/wp-gbcf_readme.txt</code><span class="lbump bump">&nbsp;</span><em>Instructions</em></li>
   <li>Path/File: <code>/wp-gbcf/index.php</code><span class="lbump bump">&nbsp;</span><em>Keep snoops bored</em></li>
   <li>Path/File: <code>/wp-gbcf/wp-gbcf_focus.js</code><span class="lbump bump">&nbsp;</span><em>Form field focus for Internet Explorer</em></li>
   <li>Path/File: <code>/wp-gbcf/wp-gbcf_form.php</code><span class="lbump bump">&nbsp;</span><em>Forms, script, pages</em></li>
   <li>Path/File: <code>/wp-gbcf/wp-gbcf_help.php</code><span class="lbump bump">&nbsp;</span><em>Documentation library (this file)</em></li>
   <li>Path/Folder: <code>/wp-gbcf/wp-gbcf_themes/</code><span class="lbump bump">&nbsp;</span><em>Folder contains various theme files</em></li>
   <li>Path/Folder: <code>/wp-gbcf/wp-gbcf_themes/wp-gbcf_images/</code><span class="lbump bump">&nbsp;</span><em>A place for style images if wanted</em></li>
  </ol>
 <p class="submit jump"><a href="#wphead">Top</a></p>
</div>
