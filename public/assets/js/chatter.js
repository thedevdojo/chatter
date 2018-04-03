$('document').ready(function(){
	$('.chatter-alert .chatter-close').click(function(){
		$(this).parents('.chatter-alert').slideUp();
	});

    //***** Only if email notify is enabled
    $('#notify_email').change(function() {
        var chatter_email_loader = $(this).find('.chatter_email_loader');
        chatter_email_loader.addClass('loading');
        // Call ajax post
        // Then hide loader....
        $.post('/' + $('#current_path').val() + '/email', { '_token' : $('#csrf_token_field').val(), }, function(data){
            chatter_email_loader.removeClass('loading');
            if(data){
                $('#email_notification').prop( "checked", true );
            } else {
                $('#email_notification').prop( "checked", false );
            }
        });

        // if($(this).is(":checked")) {
        //     var returnVal = confirm("Are you sure?");
        //     $(this).attr("checked", returnVal);
        // }
        // $('#textbox1').val($(this).is(':checked'));        
    });

    // Enable a function $.form to submit a dynamic form
    jQuery(function($) {
        $.extend({
            form: function(url, data, method) {
                if (method == null) method = 'POST';
                if (data == null) data = {};

                var form = $('<form>').attr({
                    method: method,
                    action: url
                }).css({
                    display: 'none'
                });
    
                var addData = function(name, data) {
                    if ($.isArray(data)) {
                        for (var i = 0; i < data.length; i++) {
                            var value = data[i];
                            addData(name + '[]', value);
                        }
                    } else if (typeof data === 'object') {
                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                addData(name + '[' + key + ']', data[key]);
                            }
                        }
                    } else if (data != null) {
                        form.append($('<input>').attr({
                            type: 'hidden',
                            name: String(name),
                            value: String(data)
                        }));
                    }
                };

                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        addData(key, data[key]);
                    }
                }

                return form.appendTo('body');
            }
        });
    });
});