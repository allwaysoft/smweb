var $Hr = window.$Hr || {};
$Hr.Class = {
	create:function(){
		return function() { this.initialize.apply(this, arguments); }
	}
};
$Hr.Slide = function(configs){
	this.scrollWrap = configs.scrollWrap ? baidu.g(configs.scrollWrap) : null;
	this.scrollPic = configs.scrollPic ? baidu.g(configs.scrollPic) : null;
	this.btns = configs.btns;
	this.len = this.btns.length;
	this.defaultIndex = 0;
	this.lastIndex = 0;
	this.lastTab = this.btns[this.lastIndex];
	this.evtName = configs.evtName;
	this.auto = configs.auto || false;
	this.speed = configs.speed || 50000;
	this.isPause = false;
	this.curClass = configs.curClass || 'current';
	this.scrollWidth = configs.scrollWidth || NaN;
};
$Hr.Slide.prototype = {
	init:function(){
		var that = this,
			i;
		for(i=0;i<this.len;i++){
			this.btns[i]['on' + this.evtName] = (function(index){
			    return function(event){
					that.setCurrent(this,index);
					event = event || window.event;
					baidu.event.stop(event);
				};
			})(i);
		};
		if(this.auto){
			this.goo();
			baidu.on(this.scrollWrap,'mouseenter',function(){that.stop()});
			baidu.on(this.scrollWrap,'mouseleave',function(){that.goo()});
		};
	},
	moveElement:function(elem,finalX){
		if(elem.movement){
			clearTimeout(elem.movement);
		};
		if(!elem.style.left){
		   elem.style.left=0;
		};
		var xpos=parseInt(elem.style.left);
		if(xpos<finalX){
			var dist=Math.ceil((finalX-xpos)/10);
			xpos=xpos+dist;
		};
		if(xpos>finalX){
			var dist=Math.ceil((xpos-finalX)/10);
			xpos=xpos-dist;
		};
		elem.style.left=xpos+"px";
		var that = this;
		elem.movement=setTimeout(function(){ that.moveElement(elem,finalX);},15);
	},
	setCurrent:function(curTab,index){
		baidu.removeClass(this.lastTab,this.curClass);
		baidu.addClass(curTab,this.curClass);
		this.lastIndex = index;
		this.lastTab=curTab;
		var finalX = -this.scrollWidth*index;
		this.moveElement(this.scrollPic,finalX);
	},
	autoChange:function(){
		this.lastIndex += 1;
		if(this.lastIndex >=this.len){
			this.lastIndex = 0;
		};
		var that = this,
		    curTab = this.btns[this.lastIndex];
		this.setCurrent(curTab,this.lastIndex);
		this.timer = setTimeout(function(){that.goo()},that.speed);
	},
	stop:function(){
		clearTimeout(this.timer);
		this.timer = null;
	},
	goo:function(){
		var that = this;
		this.timer = setTimeout(function(){that.autoChange()},that.speed);
	}
};
var slide = new $Hr.Slide({
	scrollWrap:'scrollPicBor',
	scrollPic:'scrollPic',
	btns: baidu.g('scrollBtn').getElementsByTagName('a'),
	evtName:'click',
	curClass:'current',
	speed:5000,
	scrollWidth:461, 
	auto:true 
});
slide.init();


