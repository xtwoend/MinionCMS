// data-bjax api 
(function ($) { 
  "use strict";
  
  var Bjax = function (element, options) {    
    this.options   = options;
    this.$element  = $( this.options.target || 'html' );
    this.start();
  }

  Bjax.DEFAULTS = {
    backdrop: false,
    url: ''
  }

  Bjax.prototype.start = function () {
    var that = this;
    this.backdrop();
    $.ajax({
      url: this.options.url,
      type: 'GET',
      beforeSend: function(){
      },
    }).done(function(r){
      that.$content = r;
      that.complete();
    });
  }

  Bjax.prototype.complete = function (){
    var that = this;
    if( this.$element.is('html') || (this.options.replace) ){
      try{
        window.history.pushState({}, '', this.options.url);
      }catch(e){
        window.location.replace(this.options.url)
      }
    }
    this.updateBar(100);
  }

  Bjax.prototype.backdrop = function(){
    this.$element.css('position','relative')
    this.$backdrop = $('<div class="backdrop fade bg-white"></div>')
      .appendTo(this.$element);
    if(!this.options.backdrop) this.$backdrop.css('height', '2');
    this.$backdrop[0].offsetWidth; // force reflow
    this.$backdrop.addClass('in');

    this.$bar = $('<div class="bar b-t b-2x b-info"></div>')
      .width(0)
      .appendTo(this.$backdrop);
  }

  Bjax.prototype.update = function (){
    var that = this;
    this.$element.css('position','');
    if( !this.$element.is('html') ){
      if(this.options.el){
        this.$content = $(this.$content).find(this.options.el);
      }
      this.$element.html(this.$content).promise().done(function(){
        if($.isFunction(that.options.callback)) { 
          that.options.callback.call(that);
        }; 
      });
    }
    if( this.$element.is('html') ) {
      if( $('.ie').length ){
        location.reload();
        return;
      }
      document.open();
      document.write(this.$content);
      document.close();
    }
  }

  Bjax.prototype.updateBar = function (per){
    var that = this;
    this.$bar.stop().animate({
        width: per + '%'
    }, 100, 'linear', function(){
      if(per == 100) that.update();
    });
  }

  Bjax.prototype.enable = function (e){
    var link = e.currentTarget;
    if ( location.protocol !== link.protocol || location.hostname !== link.hostname )
      return false
    if (link.hash && link.href.replace(link.hash, '') ===
         location.href.replace(location.hash, ''))
      return false
    if (link.href === location.href + '#' || link.href === location.href)
      return false
    if(link.protocol.indexOf('http') == -1)
      return false
    return true;
  }

  $.fn.bjax = function (option) {
    return this.each(function () {
      var $this   = $(this);
      var data    = $this.data('app.bjax');
      var options = $.extend({}, Bjax.DEFAULTS, $this.data(), typeof option == 'function', typeof option == 'object' && option) 
      if (data) { data['start'](); }
      if (!data) { $this.data('app.bjax', (data = new Bjax(this, options))); }
      if (typeof option == 'string') { data[option](); }     
    });
  }

  $.fn.bjax.Constructor = Bjax

  $(window).off('popstate').on('popstate', function(e) {
    if (e.originalEvent.state !== null) {
      window.location.reload(true);
    }
    e.preventDefault();
  });
  
  $(document).off('click.app.bjax.data-api').on('click.app.bjax.data-api', '[data-bjax], .nav-primary a', function (e) {
    if(!Bjax.prototype.enable(e)) return;    
    $(this).bjax({url: $(this).attr('href') || $(this).attr('data-url') });
    e.preventDefault();
  });
    
})(jQuery);