var jamootabs = new Class({
	
	initialize: function(element, options) {
		this.options = Object.extend({
			width:				'100%',
			height:				'auto',
			skipAnim:			false,
			animType:			'animFade',
			changeTransition:	Fx.Transitions.Pow.easeIn,
			duration:			1000,
			mouseOverClass:		'hover',
			activateOnLoad:		'first',
			useAjax: 			false,
			ajaxUrl: 			'',
			ajaxOptions: 		{method:'get'},
			ajaxLoadingText: 	'Loading...'
		}, options || {});

		this.el = $(element);
		this.elid = element;
		var ulnav = new Element ('UL').inject(this.el, 'top');
		this.nav = ulnav;
		this.nav.addClass('mootabs-title');
		
		this.el.setStyles({
			height: this.options.height,
			width: this.options.width
		});
		this._w = this.el.offsetWidth.toInt();
		this.el.setStyle ('width', this._w);
		
		this.panels = $$('#' + this.elid + ' .moduletable');

		if (this.panels.length <= 1)
		{
			this.panels.setStyle('display', 'block');
			this.panels.setStyle('padding', '0 20px');
			return;
		}

		this.panels.each(function(panel) {
			var h3 = $E('h3', panel);
			var item = new Element('LI');
			item.inject(this.nav);
			h3.remove().inject(item);
			item.panel = panel;
			
			panel.innerHTML = '<div class="innerpad">' + panel.innerHTML + '</div>';
			item.addEvent('click', function(){
					if (item.className.indexOf('active') != -1) return;
					item.removeClass(this.options.mouseOverClass);
					this.activate(item, this.options.skipAnim);
				}.bind(this)
			);
			
			item.addEvent('mouseover', function() {
				if(item != this.activeTitle)
				{
					item.className += this.options.mouseOverClass;
				}
			}.bind(this));
			
			item.addEvent('mouseout', function() {
				if(item != this.activeTitle)
				{
					item.className = item.className.replace(new RegExp(this.options.mouseOverClass), "");
				}
			}.bind(this));
		}.bind(this));

		
		this.titles = $$('#' + this.elid + ' ul.mootabs-title li');
		this.titles[0].className = 'first';
		this.titles[this.titles.length-1].className = 'last';

		this.panels.setStyle('width', this._w - 40);

		this.panels.setStyle('display', 'block');

		this.panelwrap = $E('.tab-panels', this.el);
		if (this.options.height=='auto')
		{
			var maxh = 0;
			this.panels.each(function(panel){
				maxh = Math.max(maxh, panel.offsetHeight);
			});
			this.el.setStyle('height', maxh + this.panelwrap.offsetTop);
		}

		this.panelwrap.setStyles ( {
			'width': this._w-40,
			'left': 20,
			'height': this.el.offsetHeight - this.panelwrap.offsetTop
		} );


		this.anim = eval ('new '+this.options.animType + '(this)');
		if (!this.anim) this.anim = new animNone(this);

		if(this.options.activateOnLoad != 'none')
		{
			if(this.options.activateOnLoad == 'first')
			{
				this.activate(this.titles[0], true);
			}
			else
			{
				this.activate(this.options.activateOnLoad, true);	
			}
		}
	},
	
	activate: function(tab, skipAnim){
		if(! $defined(skipAnim))
		{
			skipAnim = false;
		}
		if($type(tab) == 'string') 
		{
			myTab = $$('#' + this.elid + ' ul li').filterByAttribute('title', '=', tab)[0];
			tab = myTab;
		}
		
		if($type(tab) == 'element')
		{
			var newTab = tab.panel;

			var curTab = this.activePanel;
			this.activePanel = newTab;
			
			this.anim.move (curTab, newTab, skipAnim);

			if (this.activeTitle)
				this.activeTitle.className = this.activeTitle.className.replace(new RegExp("active"), "");
			tab.className = tab.className.replace(new RegExp(this.options.mouseOverClass), "");
			tab.className += 'active';
			this.activeTitle = tab;
			
			if(this.options.useAjax)
			{
				this._getContent();
			}
		}
	},
	
	_getContent: function(){
		this.activePanel.setHTML(this.options.ajaxLoadingText);
		var newOptions = {update: this.activePanel.getProperty('id')};
		this.options.ajaxOptions = Object.extend(this.options.ajaxOptions, newOptions || {});
		var tabRequest = new Ajax(this.options.ajaxUrl + '?tab=' + this.activeTitle.getProperty('title'), this.options.ajaxOptions);
		tabRequest.request();
	},
	
	addTab: function(title, label, content){
		//the new title
		var newTitle = new Element('li', {
			'title': title
		});
		newTitle.appendText(label);
		this.titles.include(newTitle);
		$$('#' + this.elid + ' ul').adopt(newTitle);
		newTitle.addEvent('click', function() {
			this.activate(newTitle);
		}.bind(this));
		
		newTitle.addEvent('mouseover', function() {
			if(newTitle != this.activeTitle)
			{
				newTitle.addClass(this.options.mouseOverClass);
			}
		}.bind(this));
		newTitle.addEvent('mouseout', function() {
			if(newTitle != this.activeTitle)
			{
				newTitle.removeClass(this.options.mouseOverClass);
			}
		}.bind(this));
		//the new panel
		var newPanel = new Element('div', {
			'style': {'height': this.options.panelHeight},
			'id': title,
			'class': 'mootabs-panel'
		});
		if(!this.options.useAjax)
		{
			newPanel.setHTML(content);
		}
		this.panels.include(newPanel);
		this.el.adopt(newPanel);
	},
	
	removeTab: function(title){
		if(this.activeTitle.title == title)
		{
			this.activate(this.titles[0]);
		}
		$$('#' + this.elid + ' ul li').filterByAttribute('title', '=', title)[0].remove();
		
		$$('#' + this.elid + ' .mootabs-panel').filterById(title)[0].remove();
	},
	
	next: function(){
		var nextTab = this.activeTitle.getNext();
		if(!nextTab) {
			nextTab = this.titles[0];
		}
		this.activate(nextTab);
	},
	
	previous: function(){
		var previousTab = this.activeTitle.getPrevious();
		if(!previousTab) {
			previousTab = this.titles[this.titles.length - 1];
		}
		this.activate(previousTab);
	}
});

var animNone = new Class ({
	initialize: function(tabwrap) {
		this.options = tabwrap.options || {};
		this.tabwrap = tabwrap;

		this.tabwrap.panels.setStyle('position', 'absolute');
		this.tabwrap.panels.setStyle('left', 0);

		var titlewidth = Math.round((this.tabwrap._w-1)/this.tabwrap.titles.length);
		for (var i=0; i<this.tabwrap.titles.length-1; ++i)
		{
			this.tabwrap.titles[i].setStyle('width', titlewidth);
		}
		this.tabwrap.titles[this.tabwrap.titles.length-1].setStyle('width', this.tabwrap._w-(this.tabwrap.titles.length-1)*titlewidth);

	},

	move: function (curTab, newTab, skipAnim) {
		this.tabwrap.panels.setStyle('display', 'none');
		newTab.setStyle('display', 'block');
	}
});

var animFade = new Class ({
	initialize: function(tabwrap) {
		this.options = tabwrap.options || {};
		this.tabwrap = tabwrap;

		this.tabwrap.panels.setStyle('opacity', 0);
		this.tabwrap.panels.setStyle('position', 'absolute');
		this.tabwrap.panels.setStyle('left', 0);

		var titlewidth = Math.round((this.tabwrap._w-1)/this.tabwrap.titles.length);
		for (var i=0; i<this.tabwrap.titles.length-1; ++i)
		{
			this.tabwrap.titles[i].setStyle('width', titlewidth);
		}
		this.tabwrap.titles[this.tabwrap.titles.length-1].setStyle('width', this.tabwrap._w-(this.tabwrap.titles.length-1)*titlewidth);

	},

	move: function (curTab, newTab, skipAnim) {
		if(this.options.changeTransition != 'none' && skipAnim==false)
		{
			if (curTab)
			{
				curOpac = curTab.getStyle('opacity');
				var changeEffect = new Fx.Style(curTab, 'opacity', {duration: this.options.duration, transition: this.options.changeTransition});
				changeEffect.stop();
				changeEffect.start(curOpac,0);
			}
			curOpac = newTab.getStyle('opacity');
			var changeEffect = new Fx.Style(newTab, 'opacity', {duration: this.options.duration, transition: this.options.changeTransition});
			changeEffect.stop();
			changeEffect.start(curOpac,1);
		} else {
			if (curTab) curTab.setStyle('opacity', 0);
			newTab.setStyle('opacity', 1);
		}
	}
});

var animMove = new Class ({
	initialize: function(tabwrap) {
		this.options = tabwrap.options || {};
		this.tabwrap = tabwrap;
		this.changeEffect = new Fx.Elements(this.tabwrap.panels, {duration: this.options.duration});
			
		var w = this.tabwrap._w - 40;

		this.tabwrap.panels.setStyles({
			'position': 'absolute'
		});
		var pos = 0;
		this.tabwrap.panels.each(function(panel){
			panel.setStyle('left', pos);
			pos += w;
		});

		var titlewidth = Math.round((this.tabwrap._w-1)/this.tabwrap.titles.length);
		for (var i=0; i<this.tabwrap.titles.length-1; ++i)
		{
			this.tabwrap.titles[i].setStyle('width', titlewidth);
		}
		this.tabwrap.titles[this.tabwrap.titles.length-1].setStyle('width', this.tabwrap._w-(this.tabwrap.titles.length-1)*titlewidth);
	},

	move: function (curTab, newTab, skipAnim) {
		if(this.options.changeTransition != 'none' && skipAnim==false)
		{
			this.changeEffect.stop();
			var obj = {};
			var offset = newTab.offsetLeft.toInt();
			var i=0;
			this.tabwrap.panels.each(function(panel) {
				obj[i++] = {'left':[panel.offsetLeft.toInt(), panel.offsetLeft.toInt() - offset]};
			});
			this.changeEffect.start(obj);
		}
	}
});
