function switchFontSize (ckname,val){
	var bd = $E('BODY');
	switch (val) {
		case 'inc':
			if (CurrentFontSize+1 < 7) {
				bd.removeClass('fs'+CurrentFontSize);
				CurrentFontSize++;
				bd.addClass('fs'+CurrentFontSize);
			}		
		break;
		case 'dec':
			if (CurrentFontSize-1 > 0) {
				bd.removeClass('fs'+CurrentFontSize);
				CurrentFontSize--;
				bd.addClass('fs'+CurrentFontSize);
			}		
		break;
		default:
			bd.removeClass('fs'+CurrentFontSize);
			CurrentFontSize = val;
			bd.addClass('fs'+CurrentFontSize);		
	}
	Cookie.set(ckname, CurrentFontSize,{duration:365});
}

function switchTool (ckname, val) {
	createCookie(ckname, val, 365);
	window.location.reload();
}

function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ""); };

function changeToolHilite(oldtool, newtool) {
	if (oldtool != newtool) {
		if (oldtool) {
			oldtool.src = oldtool.src.replace(/-hilite/,'');
		}
		newtool.src = newtool.src.replace(/.gif$/,'-hilite.gif');
	}
}

//addEvent - attach a function to an event
function jaAddEvent(obj, evType, fn){ 
 if (obj.addEventListener){ 
   obj.addEventListener(evType, fn, false); 
   return true; 
 } else if (obj.attachEvent){ 
   var r = obj.attachEvent("on"+evType, fn); 
   return r; 
 } else { 
   return false; 
 } 
}

function getElem (id) {
	var obj = document.getElementById (id);
	if (!obj) return null;
	var divs = obj.getElementsByTagName ('div');
	if (divs && divs.length >= 1) return divs[divs.length - 1];
	return null;
}

function getFirstDiv (id) {
	var obj = document.getElementById (id);
	if (!obj) return null;
	var divs = obj.getElementsByTagName ('div');
	if (divs && divs.length >= 1) return divs[0];
	return obj;
}

function instr(str, item){
	var arr = str.split(" ");
	for (var i = 0; i < arr.length; i++){
		if (arr[i] == item) return true;
	}
	return false;
}

function equalHeightInit (){

	//Content and wrap col
	var ja_content = document.getElementById ('ja-container');
	var ja_colwrap = document.getElementById ('ja-colwrap');
	if (ja_content && ja_colwrap) {
		if (ja_content.scrollHeight > ja_colwrap.scrollHeight) 
		{
			var ja_inners = getElementsByClass ("innerpad", ja_colwrap, "DIV");	
			if (ja_inners && ja_inners.length)
			{
				ja_inners[0].style.height = ja_content.scrollHeight + 'px';
			}
		}else{
			document.getElementById ('ja-content').style.height = ja_content.scrollHeight + 'px';
		}
	}

	//Bottom spotlight 1
	var ja_botsl = document.getElementById ('ja-botsl1');
	if (ja_botsl)
	{
		var botsl = getElementsByClass ("ja-box.*", ja_botsl, "DIV");	
		if (botsl && botsl.length)
		{
			var maxh = 0
			for (var i=0; i<botsl.length ; ++i)
			{
				maxh = (botsl[i].scrollHeight > maxh)? botsl[i].scrollHeight:maxh;
			}
			for (var i=0; i<botsl.length ; ++i)
			{
				if (botsl[i].scrollHeight < maxh)
				{
					var ja_inners = getElementsByClass ("moduletable.*", botsl[i], "DIV");	
					if (ja_inners && ja_inners.length)
					{
						ja_inners[0].style.height = maxh - 30 + 'px';
					}
				}				
			}
		}
	}

	//Bottom spotlight 2
	var ja_botsl = document.getElementById ('ja-botsl2');
	if (ja_botsl)
	{
		var botsl = getElementsByClass ("ja-box.*", ja_botsl, "DIV");	
		if (botsl && botsl.length)
		{
			var maxh = 0
			for (var i=0; i<botsl.length ; ++i)
			{
				maxh = (botsl[i].scrollHeight > maxh)? botsl[i].scrollHeight:maxh;
			}
			for (var i=0; i<botsl.length ; ++i)
			{
				if (botsl[i].scrollHeight < maxh)
				{
					var ja_inners = getElementsByClass ("moduletable.*", botsl[i], "DIV");	
					if (ja_inners && ja_inners.length)
					{
						ja_inners[0].style.height = maxh - 30 + 'px';
					}
				}				
			}
		}
	}

}

jaAddEvent (window, 'load', equalHeightInit);

function preloadImages () {
	var imgs = new Array();
	for (var i = 0; i < arguments.length; i++) {
		var imgsrc = arguments[i];
		imgs[i] = new Image();
		imgs[i].src = imgsrc;
	}
}


function getElementsByClass(searchClass,node,tag) {
	var classElements = new Array();
	var j = 0;
	if ( node == null )
		node = document;
	if ( tag == null )
		tag = '*';
	var els = node.getElementsByTagName(tag);
	var elsLen = els.length;
	var pattern = new RegExp('(^|\\s)'+searchClass+'(\\s|$)');
	for (var i = 0; i < elsLen; i++) {
		if ( pattern.test(els[i].className) ) {
			classElements[j] = els[i];
			j++;
		}
	}
	//alert(searchClass + j);
	return classElements;
}


function fixIE() {
	var objs = getElementsByClass ("createdate", null, "TD");
	if (objs) {
		for (var i=0; i<objs.length; i++){
			objs[i].innerHTML = "<span>" + objs[i].innerHTML + "</span>";
		}
	}

	var obj = $E('h1.logo a');
	obj.onmouseover = function () {
		this.setStyle('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=templates/ja_genista/images/logo2.png, sizingMethod='crop')");
	}
	obj.onmouseout = function () {
		this.setStyle('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=templates/ja_genista/images/logo1.png, sizingMethod='crop')");
	}
	
/*
	//var objs = getElementsByClass('.*-transbg');
	var objs = $ES('#ja-cssmenu li ul');
	if (!objs) return;
	for(var i=0; i<objs.length;i++){
		makeTransBg(objs[i]);
	}
*/
	var objs = getElementsByClass('.*-transbg');
	if (objs) {
		for(var i=0; i<objs.length;i++){
			makeTransBg(objs[i]);
		}
	}
}

if(isIE6()) jaAddEvent (window, 'load', fixIE);

function makeTransBg(el, bgimg){
	var obj = $(el);
	if(!obj) return;
	if (obj.tagName == 'IMG') {
		//This is an image
		if (!bgimg) bgimg = obj.src;
		obj.setStyle('height',obj.offsetHeight);
		obj.setStyle('width',obj.offsetWidth);
		obj.src = 'images/blank.png';
		obj.setStyle ('visibility', 'visible');
		obj.setStyle('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src="+bgimg+", sizingMethod='crop')");
	}else{
		//Background
		if (!bgimg) bgimg = obj.getStyle('backgroundImage');
		var pattern = new RegExp('url\s*[\(]+(.*)[\)]+');
		if ((m = pattern.exec(bgimg))) bgimg = m[1];
		obj.setStyle('background', 'none');
		//if(!obj.getStyle('position'))
		if(obj.getStyle('position')!='absolute' && obj.getStyle('position')!='relative') {
			obj.setStyle('position', 'relative');
		}

		//Get all child
		var childnodes = obj.childNodes;
		for(var j=0;j<childnodes.length;j++){
			if((child = $(childnodes[j]))) {
				if(child.getStyle('position')!='absolute' && child.getStyle('position')!='relative') {
					child.setStyle('position', 'relative');
				}
				child.setStyle('z-index',2);
			}
		}
		//Create background layer:
		var bgdiv = new Element('DIV');
		bgdiv.setStyle('position', 'absolute');
		bgdiv.setStyle('top', 0);
		bgdiv.setStyle('left', 0);
		bgdiv.setStyle('width', obj.offsetWidth - 4);
		bgdiv.setStyle('height', obj.offsetHeight - 4);
		bgdiv.setStyle('z-index', '1');
		bgdiv.setStyle('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src="+bgimg+", sizingMethod='image')");
		bgdiv.inject(obj, 'top');
	}
}

function isIE6() {
	version=0
	if (navigator.appVersion.indexOf("MSIE")!=-1){
		temp=navigator.appVersion.split("MSIE")
		version=parseFloat(temp[1])
	}
	return (version && (version < 7));
}

//Menu image hover effect
function setOpacity(obj, opacity) {
  opacity = (opacity == 100)?99.999:opacity;
  
  // IE/Win
  obj.style.filter = "alpha(opacity:"+opacity+")";
  
  // Safari<1.2, Konqueror
  obj.style.KHTMLOpacity = opacity/100;
  
  // Older Mozilla and Firefox
  obj.style.MozOpacity = opacity/100;
  
  // Safari 1.2, newer Firefox and Mozilla, CSS3
  obj.style.opacity = opacity/100;
}

function menuImageHover () {
	var mainnav = document.getElementById('ja-mainnav');
	if (!mainnav) return;
	var imgs = mainnav.getElementsByTagName ('IMG');
	if (!imgs || !imgs.length) return;
	for (var i=0; i<imgs.length; i++)
	{
		if (!imgs[i].parentNode.className.test(/active/))
		{
			setOpacity(imgs[i], 50);
			imgs[i].display = 'block';
			imgs[i].parentNode.img = imgs[i];
			imgs[i].parentNode.onmouseover = function () {
				if(typeof(setOpacity)=='function') setOpacity(this.img, 100);
			}
			imgs[i].parentNode.onmouseout = function () {
				if(typeof(setOpacity)=='function') setOpacity(this.img, 50);
			}
		}
	}
}

jaAddEvent (window, 'load', menuImageHover);
//Add span to module title
function addSpanToTitle () {
  var colobj = document.getElementById ('colwrap');
  if (!colobj) return;
  var modules = getElementsByClass ('module.*', colobj, "DIV");
 if (!modules) return;
  for (var i=0; i<modules.length; i++) {
    var module = modules[i];
    var title = module.getElementsByTagName ("h3")[0];  
    if (title) {
      title.innerHTML = "<span>"+title.innerHTML+"</span>";
      //module.className = module.className;
    }
  }
}

jaAddEvent (window, 'load', addSpanToTitle);
