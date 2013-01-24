<div class="row">
	<div class="twelve columns">
		<div class="panel radius">
			<h4>New User Registration</h4>
			<?= $this->Form->create('User', array('class'=>'row', 'action'=>'register', 'inputDefaults'=>array('div'=>'row collapse')))?>
			<div class="six columns">
				<?=$this->Form->input('User.email') ?>
				<?=$this->Form->input('User.first_name')?>
				<?=$this->Form->input('User.last_name')?>
				<?=$this->Form->input('User.password')?>
				<?=$this->Html->link(__('Cancel'), array('action'=>'index'), array('class'=>'small radius blue button'))?>
				<?=$this->Form->end(array('label'=>__('Save'), 'class'=>'small radius blue button', 'div'=>false))?>
			</div>
		</div>
	</div>
</div>
