"use strict";
if (typeof jQuery == 'undefined') {
    throw new Error('jQuery Library Is Need for This API to Work!');
}

var Api = {
    params : {
	baseUrl : '',
	type : 'POST',
	lang : 'en',
	extra : {}
    },

    init : function(params, extra) {
	var o = this;
	$.each(params, function(key, value) {
	    o.params[key] = value;
	});
	o.params.extra = extra;
    },

    ajax : function(path, data, callback) {
	var o = this;
	data.lang = o.params.lang;
	$.ajax({
	    url : o.params.baseUrl + path + '?format=html',
	    type : o.params.type,
	    data : $.extend(true, data, o.params.extra),
	    success : function(result) {
		callback.success(result);
		
		NProgress.done(); 
		$('.fade').removeClass('out'); 
		    
	    },
	    error : function(result) {
		callback.error(result);
	    }
	});
    },

    progressBar : function() {
	$('.line-progress-delay').show();
	NProgress.inc();
    },
}