<?php
	$cTask = $this->get('task-current');
?>

<div class="container">
	
	<div class="row">
		<div class="col">
		
			<h1>Редактировать задачу [id:<?php echo $cTask['task_id'] ?>]</h1>
			
			<div id="task_edit_success" class="mt-3 d-none">
				<div class="alert alert-success" role="alert">
					Задача сохранена!
				</div>
			</div>
			
			<form id="task_edit" method="post" action="<?php echo $this->get('root-url') ?>/task/edit/<?php echo $cTask['task_id'] ?>" data-redirect="<?php echo $this->get('root-url') ?>/">
			
				<div class="mb-3">
					<label for="inputName" class="form-label">Имя</label>
					<p><b><?php echo $this->sanitize($cTask['task_username']) ?></b></p>
				</div>
				<div class="mb-3">
					<label for="inputEmail" class="form-label">Email</label>
					<p><b><?php echo $this->sanitize($cTask['task_email']) ?></b></p>
				</div>
				<div class="mb-3">
					<label for="inputText" class="form-label">Задача</label>
					<textarea class="form-control" id="inputText" rows="6"  name="task_text"><?php echo $this->sanitize($cTask['task_text']) ?></textarea>
					<div id="inputTextHelp" class="form-text form-invalid"></div>
				</div>
				
				<div class="mb-3">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="status_done" value="1" id="flexCheckDefault" <?php echo ($cTask['task_status'] == 2 ? ' checked' : '') ?>>
						<label class="form-check-label" for="flexCheckDefault">Выполнено</label>
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary">Редактировать задачу</button>
			</form>
	
		</div>
	</div>

	<div class="row">
		<div class="col">
			
		</div>
	</div>
</div>