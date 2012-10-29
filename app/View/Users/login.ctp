<div style="padding-top: 300px;">
	<div class="row">
		<div class="four columns centered">
			<?= $this->Form->create('User', array('action'=>'login', 'class'=>'nice')); ?>
			<?= $this->Form->input('email', array('class'=>'input-text')); ?>
			<?= $this->Form->input('password', array('class'=>'input-text')); ?>
			<?= $this->Form->end(array('label'=>'Login', 'class'=>'nice small radius blue button')); ?>
		</div>
	</div>
</div>