$(document).ready(function() {
	
	$('#task_create').submit(function(e) {     

		e.preventDefault();
		
		var $form    = $(this);
		var $data    = $form.serialize();
		var $action  = $form.attr('action');
		
		$.ajax({
			dataType  : "json",
			type      : 'POST',
			url       : $action,
			data      : $data,
			success   : function(response) {
				$form.find('.form-text').each(function(k, v) {
					$(this).html('');
				});
				
				if(response.status == 'error') {
					$.each(response.errors, function(k, v) {
						$('[name='+ k +']').next().html(v);
					});
				}
				else {
					$('#task_create_success').removeClass('d-none');
					$form.addClass('d-none');
					
					window.setTimeout(function(){
						window.location.href = $form.attr('data-redirect')
					}, 3000);
				}
			}
		});     

	});
	
	$('#admin_login').submit(function(e) {     

		e.preventDefault();
		
		var $form    = $(this);
		var $data    = $form.serialize();
		var $action  = $form.attr('action');
		
		$.ajax({
			dataType  : "json",
			type      : 'POST',
			url       : $action,
			data      : $data,
			success   : function(response) {
				$form.find('.form-text').each(function(k, v) {
					$(this).html('');
				});
				
				if(response.status == 'error') {
					$.each(response.errors, function(k, v) {
						$('[name='+ k +']').next().html(v);
					});
				}
				else {
					$('#admin_login_success').removeClass('d-none');
					$form.addClass('d-none');
					
					window.setTimeout(function(){
						window.location.href = $form.attr('data-redirect')
					}, 3000);
				}
			}
		});     

	});
	
	
	$('#task_edit').submit(function(e) {     

		e.preventDefault();
		
		var $form    = $(this);
		var $data    = $form.serialize();
		var $action  = $form.attr('action');
		
		$.ajax({
			dataType  : "json",
			type      : 'POST',
			url       : $action,
			data      : $data,
			success   : function(response) {
				$form.find('.form-text').each(function(k, v) {
					$(this).html('');
				});
				
				if(response.status == 'error') {
					$.each(response.errors, function(k, v) {
						$('[name='+ k +']').next().html(v);
					});
				}
				else {
					$('#task_edit_success').removeClass('d-none');
					$form.addClass('d-none');
					
					window.setTimeout(function(){
						window.location.href = $form.attr('data-redirect')
					}, 3000);
				}
			}
		});     

	});
		
});