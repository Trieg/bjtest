
<div class="container">
	<div class="row">
		<div class="col">
			<a class="btn btn-primary" href="<?php echo $this->get('root-url') ?>/task/add" role="button">Добавить задачу</a>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<table class="table">
				<thead>
					<tr>
					<?php
						$tableHeader = [
							'task_id'        => '#',
							'task_username'  => 'Имя',
							'task_email'     => 'Email',
							'task_text'      => 'Задача',
							'task_status'    => 'Статус',
						];
						
						$sort        = $this->get('task-list-sort');
						
						foreach($tableHeader as $k => $v) {
							if($sort[0] == $k) {
								echo '<th scope="col"><a href="'.$this->get('root-url').'/task/sort/' . $k . '/' . ($sort[1] == 'desc' ? 'asc' : 'desc') . '">' . $v . ' ' . ($sort[1] == 'desc' ? '&#8593;' : '&#8595;') . '</a></th>';
							}
							else {
								echo '<th scope="col"><a href="'.$this->get('root-url').'/task/sort/' . $k . '/desc">' . $v . '</a></th>';
							}
						}
						
						if($this->get('admin-login')) {
							echo '<th scope="col">Редактировать</th>';
						}
						
					?>
					</tr>
				</thead>
				<tbody>
				<?php
					foreach($this->get('task-list') as $task) {
						$statusClass  = $task['task_status'] == 1 ? 'text-danger' : 'text-success';
						
						$editedStatus = '';
						if($task['task_edited'] == 2) {
							$editedStatus = "<span class='text-info'>Отредактировал админ<span>";
						}
						
						echo "
						<tr>
							<td class='w-10'>{$this->sanitize($task['task_id'])}</td>
							<td class='w-20'>{$this->sanitize($task['task_username'])}</td>
							<td class='w-20'>{$this->sanitize($task['task_email'])}</td>
							<td class='w-40'>
								
								{$this->sanitize($task['task_text'])}
								
							</td>
							<td class='w-10'>
								<span class='{$statusClass}'>
									{$this->get('task-model')->convertTaskStatusIdToText($task['task_status'])}
								<span>
								{$editedStatus}
							</td>
						";
						
						if($this->get('admin-login')) {
							echo '<td><a href="'.$this->get('root-url').'/task/edit/' . $task['task_id'] . '">Редактировать</a></td>';
						}
						
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="row">
		<div class="col">
			<?php $this->show('pagination', [
				'pagination' => $this->get('task-pagination')
			]); ?>
		</div>
	</div>

</div>
