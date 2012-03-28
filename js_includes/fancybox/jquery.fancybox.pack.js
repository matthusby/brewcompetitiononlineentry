/*! fancyBox v2.0.2 fancyapps.com | fancyapps.com/fancybox/#license */
(function(r,n,d){var i=d(r),o=d(n),a=d.fancybox=function(){a.open.apply(this,arguments)},p=!1,q=null;d.extend(a,{version:"2.0.2",defaults:{padding:15,margin:20,width:800,height:600,minWidth:200,minHeight:200,maxWidth:9999,maxHeight:9999,autoSize:!0,fitToView:!0,aspectRatio:!1,topRatio:0.5,fixed:!d.browser.msie||6<d.browser.version,scrolling:"auto",wrapCSS:"fancybox-default",arrows:!0,closeBtn:!0,closeClick:!1,nextClick:!1,mouseWheel:!0,autoPlay:!1,playSpeed:3E3,modal:!1,loop:!0,ajax:{},keys:{next:[13,
32,34,39,40],prev:[8,33,37,38],close:[27]},index:0,type:null,href:null,content:null,title:null,tpl:{wrap:'<div class="fancybox-wrap"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div>',image:'<img class="fancybox-image" src="{href}" alt="" />',iframe:'<iframe class="fancybox-iframe" name="fancybox-frame{rnd}" frameborder="0" hspace="0" '+(d.browser.msie?'allowtransparency="true""':"")+' scrolling="{scrolling}" src="{href}"></iframe>',swf:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="wmode" value="transparent" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{href}" /><embed src="{href}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="100%" height="100%" wmode="transparent"></embed></object>',
error:'<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',closeBtn:'<div title="Close" class="fancybox-item fancybox-close"></div>',next:'<a title="Next" class="fancybox-item fancybox-next"><span></span></a>',prev:'<a title="Previous" class="fancybox-item fancybox-prev"><span></span></a>'},openEffect:"fade",openSpeed:500,openEasing:"swing",openOpacity:!0,openMethod:"zoomIn",closeEffect:"fade",closeSpeed:500,closeEasing:"swing",closeOpacity:!0,closeMethod:"zoomOut",
nextEffect:"elastic",nextSpeed:300,nextEasing:"swing",nextMethod:"changeIn",prevEffect:"elastic",prevSpeed:300,prevEasing:"swing",prevMethod:"changeOut",helpers:{overlay:{speedIn:0,speedOut:0,opacity:0.85,css:{cursor:"pointer","background-color":"rgba(0, 0, 0, 0.85)"},closeClick:!0},title:{type:"float"}}},group:{},opts:{},coming:null,current:null,isOpen:!1,isOpened:!1,wrap:null,outer:null,inner:null,player:{timer:null,isActive:!1},ajaxLoad:null,imgPreload:null,transitions:{},helpers:{},open:function(b,
c){d.isArray(b)||(b=[b]);if(b.length)a.close(!0),a.opts=d.extend(!0,{},a.defaults,c),a.group=b,a._start(a.opts.index||0)},cancel:function(){if(!(a.coming&&!1===a.trigger("onCancel"))&&(a.coming=null,a.hideLoading(),a.ajaxLoad&&a.ajaxLoad.abort(),a.ajaxLoad=null,a.imgPreload))a.imgPreload.onload=a.imgPreload.onabort=a.imgPreload.onerror=null},close:function(b){a.cancel();if(a.current&&!1!==a.trigger("beforeClose"))a.unbindEvents(),!a.isOpen||b&&!0===b[0]?(d(".fancybox-wrap").stop().trigger("onReset").remove(),
a._afterZoomOut()):(a.isOpen=a.isOpened=!1,d(".fancybox-item").remove(),a.wrap.stop(!0).removeClass("fancybox-opened"),a.inner.css("overflow","hidden"),a.transitions[a.current.closeMethod]())},play:function(b){var c=function(){clearTimeout(a.player.timer)},e=function(){c();if(a.current&&a.player.isActive)a.player.timer=setTimeout(a.next,a.current.playSpeed)},f=function(){c();d("body").unbind(".player");a.player.isActive=!1;a.trigger("onPlayEnd")};if(a.player.isActive||b&&!1===b[0])f();else if(a.current&&
(a.current.loop||a.current.index<a.group.length-1))a.player.isActive=!0,e(),d("body").bind({"onCancel.player afterShow.player onUpdate.player":e,"beforeClose.player":f,"beforeLoad.player":c}),a.trigger("onPlayStart")},next:function(){a.current&&a.jumpto(a.current.index+1)},prev:function(){a.current&&a.jumpto(a.current.index-1)},jumpto:function(b){a.current&&(b=parseInt(b,10),1<a.group.length&&a.current.loop&&(b>=a.group.length?b=0:0>b&&(b=a.group.length-1)),"undefined"!==typeof a.group[b]&&(a.cancel(),
a._start(b)))},reposition:function(b){a.isOpen&&a.wrap.css(a._getPosition(b))},update:function(){a.isOpen&&(p||(q=setInterval(function(){if(p&&(p=!1,clearTimeout(q),a.current)){if(a.current.autoSize)a.inner.height("auto"),a.current.height=a.inner.height();a._setDimension();a.current.canGrow&&a.inner.height("auto");a.reposition();a.trigger("onUpdate")}},100)),p=!0)},toggle:function(){if(a.isOpen)a.current.fitToView=!a.current.fitToView,a.update()},hideLoading:function(){d("#fancybox-loading").remove()},
showLoading:function(){a.hideLoading();d('<div id="fancybox-loading"></div>').click(a.cancel).appendTo("body")},getViewport:function(){return{x:i.scrollLeft(),y:i.scrollTop(),w:i.width(),h:i.height()}},unbindEvents:function(){o.unbind(".fb");i.unbind(".fb")},bindEvents:function(){var b=a.current,c=b.keys;b&&(i.bind("resize.fb, orientationchange.fb",a.update),c&&o.bind("keydown.fb",function(b){-1<d.inArray(b.target.tagName.toLowerCase(),["input","textarea","select","button"])||(-1<d.inArray(b.keyCode,
c.close)?(a.close(),b.preventDefault()):-1<d.inArray(b.keyCode,c.next)?(a.next(),b.preventDefault()):-1<d.inArray(b.keyCode,c.prev)&&(a.prev(),b.preventDefault()))}),d.fn.mousewheel&&b.mouseWheel&&1<a.group.length&&a.wrap.bind("mousewheel.fb",function(b,c){if(0===d(b.target).get(0).clientHeight||d(b.target).get(0).scrollHeight===d(b.target).get(0).clientHeight)b.preventDefault(),a[0<c?"prev":"next"]()}))},trigger:function(b){var c,e=-1<d.inArray(b,["onCancel","beforeLoad","afterLoad"])?"coming":"current";
if(a[e]){d.isFunction(a[e][b])&&(c=a[e][b].apply(a[e],Array.prototype.slice.call(arguments,1)));if(!1===c)return!1;a[e].helpers&&d.each(a[e].helpers,function(c,e){if(e&&"undefined"!==typeof a.helpers[c]&&d.isFunction(a.helpers[c][b]))a.helpers[c][b](e)});d.event.trigger(b+".fb")}},isImage:function(a){return a&&a.match(/\.(jpg|gif|png|bmp|jpeg)(.*)?$/i)},isSWF:function(a){return a&&a.match(/\.(swf)(.*)?$/i)},_start:function(b){var c=a.group[b]||null,e,f,h,g=d.extend(!0,{},a.opts,d.isPlainObject(c)?
c:{},{index:b,element:c});if("number"===typeof g.margin)g.margin=[g.margin,g.margin,g.margin,g.margin];g.modal&&d.extend(!0,g,{closeBtn:!1,closeClick:!1,nextClick:!1,arrows:!1,mouseWheel:!1,keys:null,helpers:{overlay:{css:{cursor:"auto"},closeClick:!1}}});a.coming=g;if(!1===a.trigger("beforeLoad"))a.coming=null;else{if("object"===typeof c&&(c.nodeType||c instanceof d))e=!0,g.href=d(c).attr("href")||g.href,g.title=d(c).attr("title")||g.title,d.metadata&&d.extend(g,d(c).metadata());f=g.type;b=g.href;
if(!f)e&&(h=d(c).data("fancybox-type"),!h&&c.className&&(h=(h=c.className.match(/fancybox\.(\w+)/))?h[1]:!1)),h?f=h:b&&(a.isImage(b)?f="image":a.isSWF(b)?f="swf":b.match(/^#/)&&(f="inline")),f||(f=e?"inline":"html"),g.type=f;if("inline"===f||"html"===f){if(!g.content)g.content="inline"===f&&b?d(b):c;g.content.length||(f=null)}else g.href=b||c,g.href||(f=null);g.group=a.group;"image"===f?a._loadImage():"ajax"===f?a._loadAjax():f?a._afterLoad():a._error()}},_error:function(){a.coming.type="html";a.coming.minHeight=
0;a.coming.autoSize=!0;a.coming.content=a.coming.tpl.error;a._afterLoad()},_loadImage:function(){a.imgPreload=new Image;a.imgPreload.onload=function(){this.onload=this.onerror=null;a.coming.width=this.width;a.coming.height=this.height;a._afterLoad()};a.imgPreload.onerror=function(){this.onload=this.onerror=null;a._error()};a.imgPreload.src=a.coming.href;a.imgPreload.complete||a.showLoading()},_loadAjax:function(){a.showLoading();a.ajaxLoad=d.ajax(d.extend({},a.coming.ajax,{url:a.coming.href,error:function(b,
c,e){"abort"!==c?(a.coming.content=e,a._error()):a.hideLoading()},success:function(b,c){if("success"===c)a.coming.content=b,a._afterLoad()}}))},_afterLoad:function(){a.hideLoading();if(!a.coming||!1===a.trigger("afterLoad",a.current))a.coming=!1;else if(a.isOpened?(d(".fancybox-item").remove(),a.wrap.stop(!0).removeClass("fancybox-opened"),a.transitions[a.current.prevMethod]()):d(".fancybox-wrap").stop().trigger("onReset").remove(),a.isOpen=!1,a.current=a.coming,a.coming=!1,a.wrap=d(a.current.tpl.wrap).addClass(a.current.wrapCSS).hide().appendTo("body"),
a.outer=d(".fancybox-outer",a.wrap).css("padding",a.current.padding+"px"),a.inner=d(".fancybox-inner",a.wrap),a._setContent(),a.unbindEvents(),a.bindEvents(),a.trigger("beforeShow"),a._setDimension(),a.isOpened)a.transitions[a.current.nextMethod]();else a.transitions[a.current.openMethod]()},_setContent:function(){var b,c,e=a.current,f=e.type;switch(f){case "inline":case "ajax":case "html":"inline"===f?(b=e.content.show().detach(),b.parent().hasClass("fancybox-inner")&&b.parents(".fancybox-wrap").trigger("onReset").remove(),
d(a.wrap).bind("onReset",function(){b.appendTo("body").hide()})):b=e.content;if(e.autoSize)c=d('<div class="fancybox-tmp"></div>').appendTo(d("body")).append(b),e.width=c.outerWidth(),e.height=c.outerHeight(!0),b=c.contents().detach(),c.remove();break;case "image":b=e.tpl.image.replace("{href}",e.href);e.aspectRatio=!0;break;case "swf":b=e.tpl.swf.replace(/\{width\}/g,e.width).replace(/\{height\}/g,e.height).replace(/\{href\}/g,e.href);break;case "iframe":b=e.tpl.iframe.replace("{href}",e.href).replace("{scrolling}",
e.scrolling).replace("{rnd}",(new Date).getTime())}if(-1<d.inArray(f,["image","swf","iframe"]))e.autoSize=!1,e.scrolling=!1;a.inner.append(b)},_setDimension:function(){var b=a.current,c=a.getViewport(),e=b.margin,f=2*b.padding,h=b.width+f,g=b.height+f,m=b.width/b.height,j=b.maxWidth,k=b.maxHeight,i=b.minWidth,l=b.minHeight;c.w-=e[1]+e[3];c.h-=e[0]+e[2];-1<h.toString().indexOf("%")&&(h=c.w*parseFloat(h)/100);-1<g.toString().indexOf("%")&&(g=c.h*parseFloat(g)/100);b.fitToView&&(j=Math.min(c.w,j),k=
Math.min(c.h,k));j=Math.max(i,j);k=Math.max(l,k);b.aspectRatio?(h>j&&(h=j,g=(h-f)/m+f),g>k&&(g=k,h=(g-f)*m+f),h<i&&(h=i,g=(h-f)/m+f),g<l&&(g=l,h=(g-f)*m+f)):(h=Math.max(i,Math.min(h,j)),g=Math.max(l,Math.min(g,k)));h=Math.round(h);g=Math.round(g);d(a.wrap.add(a.outer).add(a.inner)).width("auto").height("auto");a.inner.width(h-f).height(g-f);a.wrap.width(h);e=a.wrap.height();if(h>j||e>k)for(;(h>j||e>k)&&h>i&&e>l;)g-=10,b.aspectRatio?(h=Math.round((g-f)*m+f),h<i&&(h=i,g=(h-f)/m+f)):h-=10,a.inner.width(h-
f).height(g-f),a.wrap.width(h),e=a.wrap.height();b.dim={width:h,height:e};b.canGrow=b.autoSize&&g>l&&g<k;b.canShrink=!1;b.canExpand=!1;if(h-f<b.width||g-f<b.height)b.canExpand=!0;else if((h>c.w||e>c.h)&&h>i&&g>l)b.canShrink=!0},_getPosition:function(b){var c=a.getViewport(),e=a.current.margin,d=a.wrap.width()+e[1]+e[3],h=a.wrap.height()+e[0]+e[2],g={position:"absolute",top:e[0]+c.y,left:e[3]+c.x};if(a.current.fixed&&(!b||!1===b[0])&&h<=c.h&&d<=c.w)g={position:"fixed",top:e[0],left:e[3]};g.top=Math.ceil(Math.max(g.top,
g.top+(c.h-h)*a.current.topRatio))+"px";g.left=Math.ceil(Math.max(g.left,g.left+0.5*(c.w-d)))+"px";return g},_afterZoomIn:function(){var b=a.current;a.isOpen=a.isOpened=!0;a.wrap.addClass("fancybox-opened").css("overflow","visible");a.update();a.inner.css("overflow","auto"===b.scrolling?"auto":"yes"===b.scrolling?"scroll":"hidden");if(b.closeClick||b.nextClick)a.inner.bind("click.fb",b.nextClick?a.next:a.close);b.closeBtn&&d(a.current.tpl.closeBtn).appendTo(a.wrap).bind("click.fb",a.close);b.arrows&&
1<a.group.length&&((b.loop||0<b.index)&&d(b.tpl.prev).appendTo(a.wrap).bind("click.fb",a.prev),(b.loop||b.index<a.group.length-1)&&d(b.tpl.next).appendTo(a.wrap).bind("click.fb",a.next));a.trigger("afterShow");if(a.opts.autoPlay&&!a.player.isActive)a.opts.autoPlay=!1,a.play()},_afterZoomOut:function(){a.trigger("afterClose");a.wrap.trigger("onReset").remove();d.extend(a,{group:{},opts:{},current:null,isOpened:!1,isOpen:!1,wrap:null,outer:null,inner:null})}});a.transitions={getOrigPosition:function(){var b=
a.current.element,c={},e=50,f=50,h;b&&b.nodeName&&d(b).is(":visible")?(h=d(b).find("img:first"),h.length?(c=h.offset(),e=h.outerWidth(),f=h.outerHeight()):c=d(b).offset()):(b=a.getViewport(),c.top=b.y+0.5*(b.h-f),c.left=b.x+0.5*(b.w-e));return c={top:Math.ceil(c.top)+"px",left:Math.ceil(c.left)+"px",width:Math.ceil(e)+"px",height:Math.ceil(f)+"px"}},step:function(b,c){var d,f,h;if("width"===c.prop||"height"===c.prop)f=h=Math.ceil(b-2*a.current.padding),"height"===c.prop&&(d=(b-c.start)/(c.end-c.start),
c.start>c.end&&(d=1-d),f-=a.innerSpace*d,h-=a.outerSpace*d),a.inner[c.prop](f),a.outer[c.prop](h)},zoomIn:function(){var b,c;b=a.current.dim;c=b.height-2*a.current.padding;a.innerSpace=c-a.inner.height();a.outerSpace=c-a.outer.height();if("elastic"===a.current.openEffect){c=d.extend({},b,a._getPosition(!0));delete c.position;b=this.getOrigPosition();if(a.current.openOpacity)b.opacity=0,c.opacity=1;a.wrap.css(b).show().animate(c,{duration:a.current.openSpeed,easing:a.current.openEasing,step:this.step,
complete:a._afterZoomIn})}else a.wrap.css(d.extend({},a.current.dim,a._getPosition())),"fade"===a.current.openEffect?a.wrap.fadeIn(a.current.openSpeed,a._afterZoomIn):(a.wrap.show(),a._afterZoomIn())},zoomOut:function(){var b;b=a.wrap.height()-2*a.current.padding;if("elastic"===a.current.closeEffect){"fixed"===a.wrap.css("position")&&a.wrap.css(a._getPosition(!0));a.innerSpace=b-a.inner.height();a.outerSpace=b-a.outer.height();b=this.getOrigPosition();if(a.current.closeOpacity)b.opacity=0;a.wrap.animate(b,
{duration:a.current.closeSpeed,easing:a.current.closeEasing,step:this.step,complete:a._afterZoomOut})}else a.wrap.fadeOut("fade"===a.current.closeEffect?a.current.Speed:0,a._afterZoomOut)},changeIn:function(){var b;"elastic"===a.current.nextEffect?(b=a._getPosition(!0),b.opacity=0,b.top=parseInt(b.top,10)-200+"px",a.wrap.css(b).show().animate({opacity:1,top:"+=200px"},{duration:a.current.nextSpeed,complete:a._afterZoomIn})):(a.wrap.css(a._getPosition()),"fade"===a.current.nextEffect?a.wrap.hide().fadeIn(a.current.nextSpeed,
a._afterZoomIn):(a.wrap.show(),a._afterZoomIn()))},changeOut:function(){function b(){d(this).trigger("onReset").remove()}a.wrap.removeClass("fancybox-opened");"elastic"===a.current.prevEffect?a.wrap.animate({opacity:0,top:"+=200px"},{duration:a.current.prevSpeed,complete:b}):a.wrap.fadeOut("fade"===a.current.prevEffect?a.current.prevSpeed:0,b)}};a.helpers.overlay={overlay:null,update:function(){var a,c;this.overlay.width(0).height(0);d.browser.msie?(a=Math.max(n.documentElement.scrollWidth,n.body.scrollWidth),
c=Math.max(n.documentElement.offsetWidth,n.body.offsetWidth),a=a<c?i.width():a):a=o.width();this.overlay.width(a).height(o.height())},beforeShow:function(b){if(!this.overlay)this.overlay=d('<div id="fancybox-overlay"></div>').css(b.css||{background:"black"}).appendTo("body"),this.update(),b.closeClick&&this.overlay.bind("click.fb",a.close),i.bind("resize.fb",d.proxy(this.update,this)),this.overlay.fadeTo(b.speedIn||"fast",b.opacity||1)},onUpdate:function(){this.update()},afterClose:function(a){this.overlay&&
this.overlay.fadeOut(a.speedOut||"fast",function(){d(this).remove()});this.overlay=null}};a.helpers.title={beforeShow:function(b){var c;if(c=a.current.title)c=d('<div class="fancybox-title fancybox-title-'+b.type+'-wrap">'+c+"</div>").appendTo("body"),"float"===b.type&&(c.width(c.width()),c.wrapInner('<span class="child"></span>'),a.current.margin[2]+=Math.abs(parseInt(c.css("margin-bottom"),10))),c.appendTo("over"===b.type?a.inner:"outside"===b.type?a.wrap:a.outer)}};d.fn.fancybox=function(b){function c(b){var c=
[],i=!1,j=d(this).data("fancybox-group");b.preventDefault();if("undefined"!==typeof j)i=j?"data-fancybox-group":!1;else if(this.rel&&""!==this.rel&&"nofollow"!==this.rel)j=this.rel,i="rel";i&&(c=f.length?d(f).filter("["+i+'="'+j+'"]'):d("["+i+'="'+j+'"]'));c.length?(e.index=c.index(this),a.open(c.get(),e)):a.open(this,e);return!1}var e=b||{},f=this.selector||"";f?o.undelegate(f,"click.fb-start").delegate(f,"click.fb-start",c):d(this).unbind("click.fb-start").bind("click.fb-start",c);return this}})(window,
document,jQuery);