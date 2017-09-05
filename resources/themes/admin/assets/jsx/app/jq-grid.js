$(function(){

    // jqgrid extend
    // make jqGrid
    

    $.fn.dataGrid = function(options){
        
        var $heightDiv = ($(".data-grid").height() - (56 + 28));

        var opts = {
            url: null,
            mtype: "POST",
            datatype: "json",
            viewrecords: true,
            autowidth: true,
            scrollerbar:true,
            height: $heightDiv,
            maxHeight: 300,
            rowNum: 25,
            rowList:[25,50,100,200],
            rownumbers: true,
            shrinkToFit: false,
            multiselect: true,
            pager: '#pager',
            colModel: [
                { label: 'ID', name: 'id', width: 200, searchoptions:{sopt:['eq','ne','le','lt','gt','ge']}}
            ]
        };

      $.extend(opts, options);

      var self = this,
        durl = self.attr('data-url');

      if(!durl){ return; }

      opts.url = durl;

      return self.jqGrid(opts);
    };

})