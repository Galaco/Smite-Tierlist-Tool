$(document).ready(function(){
	hookPageNavbar();
	
	$('#recache_gods').click(function() {
			performXhr(
				'/admin/recache/gods', 
				'',
				function(data) {
					$('#console_log').append(data);
				},
				function(data) {
					$('#console_log').html(data);
				},
				function(data) {
					$('#console_log').append(data);
				}
			)	
		}	
	);

	$('#recache_items').click(function() {
			performXhr(
				'/admin/recache/items', 
				'',
				function(data) {
					$('#console_log').append(data);
				},
				function(data) {
					$('#console_log').html(data);
				},
				function(data) {
					$('#console_log').append(data);
				}
			)	
		}	
	);
	
	$('#console_clear').click(function() {
		$('#console_log').empty();
	});
	
	hookAPIButtons();
});

function hookAPIButtons() {
	$('#api_tests > button').each(function() {
		name = $(this).attr('id');
		item = $('#' + name);
		name = name.replace('api_' , '');
		
		item.click({name: name},function(event) {
			performXhr(
				'/admin/api/test/' + event.data.name, 
				'',
				function(data) {
					console.log('Test Complete. See logs for details');
					$('#console_log').append(syntaxHighlightJson(JSON.stringify(data, null, 2)));
				},
				function(data) {
					$('#console_log').append(data);
				},
				function(data) {
					$('#console_log').append(data);
				}
			);
		});
	});
}