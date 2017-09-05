/*! http://mths.be/placeholder v2.0.7 by @mathias */
;(function(h,j,e){var a="placeholder" in j.createElement("input");var f="placeholder" in j.createElement("textarea");var k=e.fn;var d=e.valHooks;var b=e.propHooks;var m;var l;if(a&&f){l=k.placeholder=function(){return this};l.input=l.textarea=true}else{l=k.placeholder=function(){var n=this;n.filter((a?"textarea":":input")+"[placeholder]").not(".placeholder").bind({"focus.placeholder":c,"blur.placeholder":g}).data("placeholder-enabled",true).trigger("blur.placeholder");return n};l.input=a;l.textarea=f;m={get:function(o){var n=e(o);var p=n.data("placeholder-password");if(p){return p[0].value}return n.data("placeholder-enabled")&&n.hasClass("placeholder")?"":o.value},set:function(o,q){var n=e(o);var p=n.data("placeholder-password");if(p){return p[0].value=q}if(!n.data("placeholder-enabled")){return o.value=q}if(q==""){o.value=q;if(o!=j.activeElement){g.call(o)}}else{if(n.hasClass("placeholder")){c.call(o,true,q)||(o.value=q)}else{o.value=q}}return n}};if(!a){d.input=m;b.value=m}if(!f){d.textarea=m;b.value=m}e(function(){e(j).delegate("form","submit.placeholder",function(){var n=e(".placeholder",this).each(c);setTimeout(function(){n.each(g)},10)})});e(h).bind("beforeunload.placeholder",function(){e(".placeholder").each(function(){this.value=""})})}function i(o){var n={};var p=/^jQuery\d+$/;e.each(o.attributes,function(r,q){if(q.specified&&!p.test(q.name)){n[q.name]=q.value}});return n}function c(o,p){var n=this;var q=e(n);if(n.value==q.attr("placeholder")&&q.hasClass("placeholder")){if(q.data("placeholder-password")){q=q.hide().next().show().attr("id",q.removeAttr("id").data("placeholder-id"));if(o===true){return q[0].value=p}q.focus()}else{n.value="";q.removeClass("placeholder");n==j.activeElement&&n.select()}}}function g(){var r;var n=this;var q=e(n);var p=this.id;if(n.value==""){if(n.type=="password"){if(!q.data("placeholder-textinput")){try{r=q.clone().attr({type:"text"})}catch(o){r=e("<input>").attr(e.extend(i(this),{type:"text"}))}r.removeAttr("name").data({"placeholder-password":q,"placeholder-id":p}).bind("focus.placeholder",c);q.data({"placeholder-textinput":r,"placeholder-id":p}).before(r)}q=q.removeAttr("id").hide().prev().attr("id",p).show()}q.addClass("placeholder");q[0].value=q.attr("placeholder")}else{q.removeClass("placeholder")}}}(this,document,jQuery));

/*!
* screenfull
* v1.0.4 - 2013-05-26
* https://github.com/sindresorhus/screenfull.js
* (c) Sindre Sorhus; MIT License
*/
// (function(a,b){"use strict";var c="undefined"!=typeof Element&&"ALLOW_KEYBOARD_INPUT"in Element,d=function(){for(var a,c,d=[["requestFullscreen","exitFullscreen","fullscreenElement","fullscreenEnabled","fullscreenchange","fullscreenerror"],["webkitRequestFullscreen","webkitExitFullscreen","webkitFullscreenElement","webkitFullscreenEnabled","webkitfullscreenchange","webkitfullscreenerror"],["webkitRequestFullScreen","webkitCancelFullScreen","webkitCurrentFullScreenElement","webkitCancelFullScreen","webkitfullscreenchange","webkitfullscreenerror"],["mozRequestFullScreen","mozCancelFullScreen","mozFullScreenElement","mozFullScreenEnabled","mozfullscreenchange","mozfullscreenerror"]],e=0,f=d.length,g={};f>e;e++)if(a=d[e],a&&a[1]in b){for(e=0,c=a.length;c>e;e++)g[d[0][e]]=a[e];return g}return!1}(),e={request:function(a){var e=d.requestFullscreen;a=a||b.documentElement,/5\.1[\.\d]* Safari/.test(navigator.userAgent)?a[e]():a[e](c&&Element.ALLOW_KEYBOARD_INPUT)},exit:function(){b[d.exitFullscreen]()},toggle:function(a){this.isFullscreen?this.exit():this.request(a)},onchange:function(){},onerror:function(){},raw:d};return d?(Object.defineProperties(e,{isFullscreen:{get:function(){return!!b[d.fullscreenElement]}},element:{enumerable:!0,get:function(){return b[d.fullscreenElement]}},enabled:{enumerable:!0,get:function(){return!!b[d.fullscreenEnabled]}}}),b.addEventListener(d.fullscreenchange,function(a){e.onchange.call(e,a)}),b.addEventListener(d.fullscreenerror,function(a){e.onerror.call(e,a)}),a.screenfull=e,void 0):a.screenfull=!1})(window,document);


// data-shift api 
+function ($) { "use strict";

 /* SHIFT CLASS DEFINITION
  * ====================== */

  var Shift = function (element) {
    this.$element = $(element)
    this.$prev = this.$element.prev()
    !this.$prev.length && (this.$parent = this.$element.parent())
  }

  Shift.prototype = {
  	constructor: Shift

    , init:function(){
    	var $el = this.$element
    	, method = $el.data()['toggle'].split(':')[1]    	
    	, $target = $el.data('target')
    	$el.hasClass('in') || $el[method]($target).addClass('in')
    }
    , reset :function(){
    	this.$parent && this.$parent['prepend'](this.$element)
    	!this.$parent && this.$element['insertAfter'](this.$prev)
    	this.$element.removeClass('in')
    }
  }

 /* SHIFT PLUGIN DEFINITION
  * ======================= */

  $.fn.shift = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('shift')
      if (!data) $this.data('shift', (data = new Shift(this)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.shift.Constructor = Shift
}(jQuery);

Date.now = Date.now || function() { return +new Date; };

+function ($) {

  $(function(){

    // toogle fullscreen
    $(document).on('click', "[data-toggle=fullscreen]", function(e){
      e.preventDefault();
      if (screenfull.enabled) {
        screenfull.request();
      }
    });

  	// placeholder
  	$('input[placeholder], textarea[placeholder]').placeholder();

    // popover
    $("[data-toggle=popover]").popover();
    $(document).on('click', '.popover-title .close', function(e){
    	var $target = $(e.target), $popover = $target.closest('.popover').prev();
    	$popover && $popover.popover('hide');
    });

    // ajax modal
    $(document).on('click', '[data-toggle="ajaxModal"]',
      function(e) {
        $('#ajaxModal').remove();
        e.preventDefault();
        var $this = $(this)
          , $remote = $this.data('remote') || $this.attr('href')
          , $modal = $('<div class="modal fade" id="ajaxModal"><div class="modal-body"></div></div>');
        $('body').append($modal);
        $modal.modal({backdrop: 'static', keyboard: false});
        $modal.load($remote);
      }
    );
    
    // dropdown menu
    $.fn.dropdown.Constructor.prototype.change = function(e){
      e.preventDefault();
      var $item = $(e.target), $select, $checked = false, $menu, $label;
      !$item.is('a') && ($item = $item.closest('a'));
      $menu = $item.closest('.dropdown-menu');
      $label = $menu.parent().find('.dropdown-label');
      $labelHolder = $label.text();
      $select = $item.parent().find('input');
      $checked = $select.is(':checked');
      if($select.is(':disabled')) return;
      if($select.attr('type') == 'radio' && $checked) return;
      if($select.attr('type') == 'radio') $menu.find('li').removeClass('active');
      $item.parent().removeClass('active');
      !$checked && $item.parent().addClass('active');
      $select.prop("checked", !$select.prop("checked"));

      $items = $menu.find('li > input:checked');
      if ($items.length) {
          $text = [];
          $items.each(function () {
              var $str = $(this).parent().text();
              $str && $text.push($.trim($str));
          });

          $text = $text.length < 4 ? $text.join(', ') : $text.length + ' selected';
          $label.html($text);
      }else{
        $label.html($label.data('placeholder'));
      }
    }
    $(document).on('click.dropdown-menu', '.dropdown-select > li > a', $.fn.dropdown.Constructor.prototype.change);

  	// tooltip
    $("[data-toggle=tooltip]").tooltip();

    // class
  	$(document).on('click', '[data-toggle^="class"]', function(e){
  		e && e.preventDefault();
  		var $this = $(e.target), $class , $target, $tmp, $classes, $targets;
  		!$this.data('toggle') && ($this = $this.closest('[data-toggle^="class"]'));
    	$class = $this.data()['toggle'];
    	$target = $this.data('target') || $this.attr('href');
      $class && ($tmp = $class.split(':')[1]) && ($classes = $tmp.split(','));
      $target && ($targets = $target.split(','));
      $classes && $classes.length && $.each($targets, function( index, value ) {
        if ( $classes[index].indexOf( '*' ) !== -1 ) {
          var patt = new RegExp( '\\s' + 
              $classes[index].
                replace( /\*/g, '[A-Za-z0-9-_]+' ).
                split( ' ' ).
                join( '\\s|\\s' ) + 
              '\\s', 'g' );
          $($this).each( function ( i, it ) {
            var cn = ' ' + it.className + ' ';
            while ( patt.test( cn ) ) {
              cn = cn.replace( patt, ' ' );
            }
            it.className = $.trim( cn );
          });
        }
        ($targets[index] !='#') && $($targets[index]).toggleClass($classes[index]) || $this.toggleClass($classes[index]);
      });
    	$this.toggleClass('active');
  	});

    // panel toggle
    $(document).on('click', '.panel-toggle', function(e){
      e && e.preventDefault();
      var $this = $(e.target), $class = 'collapse' , $target;
      if (!$this.is('a')) $this = $this.closest('a');
      $target = $this.closest('.panel');
        $target.find('.panel-body').toggleClass($class);
        $this.toggleClass('active');
    });
  	
  	// carousel
  	$('.carousel.auto').carousel();
  	
  	// button loading
  	$(document).on('click.button.data-api', '[data-loading-text]', function (e) {
  	    var $this = $(e.target);
  	    $this.is('i') && ($this = $this.parent());
  	    $this.button('loading');
  	});
 	
    var $window = $(window);
    // mobile
  	var mobile = function(option){
  		if(option == 'reset'){
  			$('[data-toggle^="shift"]').shift('reset');
  			return true;
  		}
  		$('[data-toggle^="shift"]').shift('init');
      return true;
  	};
  	// unmobile
  	$window.width() < 768 && mobile();

    // resize
    var $resize, $width = $window.width();
  	$window.resize(function() {
      if($width !== $window.width()){
        clearTimeout($resize);
        $resize = setTimeout(function(){
          setHeight();
          $window.width() < 768 && mobile();
          $window.width() >= 768 && mobile('reset') && fixVbox();
          $width = $window.width();
        }, 500);
      }
  	});

    var setMinNav = function(){
      $('aside[id="nav"]').addClass('nav-xs');
    }

    if($window.width() > 768 && $window.width() < 1024){
      setMinNav();  
    }
    
    // fluid layout
    var setHeight = function(){
      $('.app-fluid #nav > *').css('min-height', $(window).height()-60);
      return true;
    }
    setHeight();

    
    // fix vbox
    var fixVbox = function(){
      $('.ie11 .vbox').each(function(){
        $(this).height($(this).parent().height());
      });
      return true;
    }
    fixVbox();

    // collapse nav
    $(document).on('click', '[data-ride="collapse"] a', function (e) {
      var $this = $(e.target), $active;      
      $this.is('a') || ($this = $this.closest('a'));
      
      $active = $this.parent().siblings( ".active" );
      $active && $active.toggleClass('active').find('> ul:visible').slideUp(200);
      
      ($this.parent().hasClass('active') && $this.next().slideUp(200)) || $this.next().slideDown(200);
      $this.parent().toggleClass('active');
      
      $this.next().is('ul') && e.preventDefault();

      setTimeout(function(){ $(document).trigger('updateNav'); }, 300);      
    });

    // dropdown still
    $(document).on('click.bs.dropdown.data-api', '.dropdown .on, .dropup .on, .open .on', function (e) { e.stopPropagation() });

  });
}(jQuery);