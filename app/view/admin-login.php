<div class="container">
	<div class="row">
		<div class="col">
		
			<h1>Авторизация администратора</h1>
			
			<div id="admin_login_success" class="mt-3 d-none">
				<div class="alert alert-success" role="alert">
					Авторизация прошла успешно!
				</div>
			</div>
			
			<form id="admin_login" method="post" action="<?php echo $this->get('root-url') ?>/admin/login" data-redirect="<?php echo $this->get('root-url') ?>/">
			
				<div class="mb-3">
					<label for="inputLogin" class="form-label">Логин</label>
					<input class="form-control" id="inputLogin" name="admin_login">
					<div id="inputLoginHelp" class="form-text form-invalid"></div>
				</div>
				<div class="mb-3">
					<label for="inputPwd" class="form-label">Пароль</label>
					<input class="form-control" type="password" id="inputPwd" name="admin_pwd">
					<div id="inputPwdHelp" class="form-text form-invalid"></div>
				</div>
				<button type="submit" class="btn btn-primary">Вход</button>
			</form>
	
		</div>
	</div>
</div>