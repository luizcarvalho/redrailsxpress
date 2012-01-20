<div id="search" class="transbg">

<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<div>
		<input name="s" id="mod_search_searchword" maxlength="20" alt="search" class="inputbox" type="text" size="20" value="search..."  onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" />	</div>

<input type="hidden" name="option" value="com_search" />
</form>


</div>