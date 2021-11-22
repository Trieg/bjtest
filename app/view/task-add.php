<div class="container">
	
	<div class="row">
		<div class="col">
		
			<h1>Добавить новую задачу</h1>
			
			<div id="task_create_success" class="mt-3 d-none">
				<div class="alert alert-success" role="alert">
					Задача добавлена!
				</div>
			</div>
			
			<form id="task_create" method="post" action="<?php echo $this->get('root-url') ?>/task/add" data-redirect="<?php echo $this->get('root-url') ?>/">
			
				<div class="mb-3">
					<label for="inputName" class="form-label">Имя</label>
					<input class="form-control" id="inputName" name="task_username">
					<div id="inputNameHelp" class="form-text form-invalid"></div>
				</div>
				<div class="mb-3">
					<label for="inputEmail" class="form-label">Email</label>
					<input class="form-control" id="inputEmail" name="task_email">
					<div id="inputEmailHelp" class="form-text form-invalid"></div>
				</div>
				<div class="mb-3">
					<label for="inputText" class="form-label">Задача</label>
					<textarea class="form-control" id="inputText" rows="6"  name="task_text"></textarea>
					<div id="inputTextHelp" class="form-text form-invalid"></div>
				</div>
				<button type="submit" class="btn btn-primary">Сохранить задачу</button>
			</form>
	
		</div>
	</div>
	
</div>