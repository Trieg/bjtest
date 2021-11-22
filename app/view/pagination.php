<?php
	$pagination = $this->get('pagination');
	
	if(count($pagination['pages']) > 1) {
		echo '
				<nav>
					<ul class="pagination d-flex justify-content-center">
		';
		
		if(!empty($pagination['first'])) {
			echo '<li class="page-item"><a class="page-link" href="'.$this->get('root-url').'/'.$pagination['first'].'">&LT;&LT;</a></li>';
		}
		if(!empty($pagination['back'])) {
			echo '<li class="page-item"><a class="page-link" href="'.$this->get('root-url').'/'.$pagination['back'].'">&LT;</a></li>';
		}
		
		foreach($pagination['pages'] as $page) {
			if($page['current']) {
				echo '<li class="page-item active"><a class="page-link" href="'.$this->get('root-url').'/'.$page['number'].'">'.$page['number'].'</a></li>';
			}
			else {
				echo '<li class="page-item"><a class="page-link" href="'.$this->get('root-url').'/'.$page['number'].'">'.$page['number'].'</a></li>';
			}
		}
		
		if(!empty($pagination['next'])) {
			echo '<li class="page-item"><a class="page-link" href="'.$this->get('root-url').'/'.$pagination['next'].'">&GT;</a></li>';
		}
		if(!empty($pagination['last'])) {
			echo '<li class="page-item"><a class="page-link" href="'.$this->get('root-url').'/'.$pagination['last'].'">&GT;&GT;</a></li>';
		}
		
		echo '
					</ul>
				</nav>
		';
	}
?>