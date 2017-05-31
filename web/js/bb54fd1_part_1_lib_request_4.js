function performXhr(url, params, onSuccess, onError, onStateChange) {
	if (!onSuccess) onSuccess = function(){};
	if (!onError) onError = function(){};
	if (!onStateChange) onStateChange = function(){};
	
	var last_response_len = false;
	
	$.ajax(
		url,
		{
			data: params,
			type: 'POST',
            xhrFields: {
                onprogress: function(e)
                {
                    var this_response, response = e.currentTarget.response;
                    if(last_response_len === false)
                    {
                        this_response = response;
                        last_response_len = response.length;
                    }
                    else
                    {
                        this_response = response.substring(last_response_len);
                        last_response_len = response.length;
                    }
					onStateChange(this_response);
                }
            }
		}
	)
	.success(
		function(response) {
			onSuccess(response);
		}
	)
	.fail(
		function(response) {
			onError(response);
		}
	);
}
