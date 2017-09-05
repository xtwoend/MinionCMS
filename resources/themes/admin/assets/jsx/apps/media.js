Swag.registerHelpers(Handlebars);
var mediaModal = $('[data-remodal-id=media]').remodal();
var pageLoad = 1;
var query = {
    'page': pageLoad,
    'order': 'DESC',
    'ordered': 'created_at',
};

$(document).on('click', 'button[data-item="media-manager"]', function(e) {
    e && e.preventDefault();
    mediaModal.open();
    $('.attachments').iscroll({
        optionsData: query,
        url: '/admin/media/items'
    });
});

$(document).on('change', 'select[data-item="media-type"]', function(e){
    var type = $(this).val();
    query.type = type;
    query.page = 1;
    $('#media-items').html('');
    loadItems(query);
});

$(document).on('change', 'select[data-item="media-time"]', function(e){
    var time = $(this).val();
    query.time = time;
    query.page = 1;
    $('#media-items').html('');
    loadItems(query);
});

var timer;
$(document).on('keyup', 'input[data-item="search"]', function(e){
    var q = $(this).val();
    query.search = q;
    query.page = 1;
    $('#media-items').html('');
    clearTimeout(timer);  //clear any running timeout on key up
    timer = setTimeout(function() { //then give it a second to see if the user is finished
        loadItems(query);
    }, 300);
});

function renderItems(data){
    var source = $('#media-thumb').html();
    var template = Handlebars.compile(source);
    let html = template(data);
    $('#media-items').append(html);
}

var $lastSelected = [],
    collection    = $('.item-list');

$(document).on('click', '.item-list', function(e) {
    var that = $(this),
        $selected,
        direction;

    if (e.shiftKey){
        if ($lastSelected.length > 0) {
            if(that[0] == $lastSelected[0]) {
                if(that.hasClass('selected')) that.removeClass('selected');
                countSelected();
                return false;
            }           
            if(that.hasClass('selected')){
                that.removeClass('selected');
            } else {
                that.addClass('selected'); 
            }    
            $lastSelected = that;
        } else {            
            $lastSelected = that;           
            that.addClass('selected');
        }

    } else {
        // Not a shift select, so we'll just mark the target item
        $lastSelected = that;
        $('.item-list').removeClass('selected');
        that.addClass('selected');
   }
   countSelected();
   loadDetail(that);
});

function loadDetail(obj){
    let Id = obj.data('id');
    $.get('/media/'+Id+'/detail', {}, function(res){
        if(res.success){
            $('#media-info').html(res.html);
        }
    })
}

$(document).on('click', 'button[data-item="insert-media"]', function(e){
    e && e.preventDefault();
    var ids = [],
        items = $('.item-list.selected'),
        dimension = $('input[name="width"]').val() + 'x' + $('input[name="height"]').val();

    $.each(items, function(index, el) {
        ids.push($(this).data('id'));
    });

    if(ids.length === 0){
        alert('select fisrt');
    }
    $.post('/getmedia', {ids: ids, dimension: dimension }, function(res){
        if(res.success){
            tinyMCE.execCommand('mceInsertContent', false, res.response);
            mediaModal.close();
        }
    })
});


$(document).on('click', 'a[data-action="edit-img"]', function(e){
    e && e.preventDefault();
    let url = $(this).attr('href') || $(this).data('url');
    $.get(url, {}, function(res){
        $('#library').html(res);
    });
});

function countSelected(){
    let count = $('.item-list.selected').length;
    $('.item-selected').text(count + ' Selected');
}

// dropzone upload
Dropzone.options.fileUpload = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 3, // MB
    accept: function(file, done) {
        console.log(file);
        done();
    },
    success: function(file, res){
        var source = $('#render-item').html();
        console.log(res);
        var template = Handlebars.compile(source);
        let html = template(res.data);
        $('#media-items').prepend(html);
    },
    queuecomplete: function(){
        $('.nav-tabs a[href="#library"]').tab('show');
    }
};

// infnityscroll
function iscroll($e, options) {

    var _isWindow = ($e.css('overflow-y') === 'visible'),
        $scroll = _isWindow? $(document) : $e,
        stopReqs = false,
        reqUrl = '',
        isLoading = false,
        loader = null,
        ctr= 0,
        O = this;



    O.S = {
        Loadingoffset: 30,
        optionsData: {},
        loadingHtml: '<small>Loading...</small>', // null
        sendReqonInit:true,
        autoTrigger: true, //must be true for autoTriggerUntil
        autoTriggerUntil: false,
        next:'a:last',
        onBeginRequest: null,
        ondataArrival: null,
        url: '',
    };


    O.RequestItems = function () {

        if (stopReqs || isLoading) return;
        isLoading = true;
        // console.log('load');
        if(O.S.loadingHtml)
            loader = $(O.S.loadingHtml);
            $e.append(loader);

        if (O.S.onBeginRequest != null) O.S.onBeginRequest();
        ctr++;

        $.post(O.S.url, O.S.optionsData, function (d) {

            loader.remove();
            if (O.S.ondataArrival != null) O.S.ondataArrival(d);

            // $e.append(d);
            renderItems(d);
            pageLoad = parseInt(d.meta.page) + 1;
            O.S.optionsData['page'] = pageLoad;
            
            if (d.meta.url === undefined || d.meta.url === null) {
                stopReqs = true;
            }

            if(O.S.autoTriggerUntil && ctr >= O.S.autoTriggerUntil){
               O.S.autoTriggerUntil = O.S.autoTrigger = false;
               $scroll.off('scroll.sq');
            }
            O.setNext();

            isLoading = false;
        });
    };

    O.setNext = function(){
        // var _n = $e.find(O.S.next);
        // reqUrl = _n.attr('href');
       
        // if (!reqUrl)
        //     stopReqs = true;

        // if(O.S.autoTrigger) {
        //     _n.remove();
        // }
        // else{
        //     _n.removeAttr('href').on('click',function(){
        //         O.RequestItems();
        //         _n.remove();
        //     });
        // }
    };


    O.ConnectScrollLoad = function () {
        $scroll.on('scroll.iscroll', function () {
                var iHeight = _isWindow ? $scroll.height() : $scroll.prop('scrollHeight');
                var tHeight = _isWindow ? $(window).height() : $scroll.height();
                //$('.testing').scrollTop() >= $('.testing').prop('scrollHeight') - $('.testing').height() - O.S.Loadingoffset
                //$(document).scrollTop() >= $(document).height() - $(window).height() - O.S.Loadingoffset
               
                if ($scroll.scrollTop() >= iHeight - tHeight - O.S.Loadingoffset) {
                    O.RequestItems();
                    // loadItems({page: pageLoad});
                }
        });
    };

    O.reset = function(){
        $scroll.off('scroll.iscroll');
        O.init();
    }

    /** destroy the current instance  **/
    O.destroy = function(){
        $scroll.off('scroll.iscroll');
        delete $e[0].iscroll;
        return $e;
        //TODO: restore the link
    };

    O.init = function () {
        $.extend(O.S, options);
        if(O.S.autoTrigger) O.ConnectScrollLoad();
        O.setNext();
        if (O.S.sendReqonInit) O.RequestItems();
    }

    O.init();

    return O;
}

$.fn.iscroll = function(m) {
    return this.each(function() {
        var $this = $(this);
            if(this.iscroll)return;
        this.iscroll = new iscroll($this, m)
    });
};

function loadItems(query)
{   
    var url = '/admin/media/items';
    var page = query.page;
    $.post(url, query, function(res){
        renderItems(res);
        page = parseInt(res.meta.page) + 1;
        if (res.meta.url === undefined || res.meta.url === null) {
            page = false;
        }
    });

    return page; 
}
