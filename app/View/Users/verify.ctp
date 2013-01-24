<div class="row">
	<div class="twelve columns">
		<div class="panel radius">
			<h4>New User Verification</h4>
			<?= $this->Form->create('User', array('class'=>'row', 'action'=>'verify', 'inputDefaults'=>array('div'=>'row collapse')))?>
			<div class="six columns">
				<?=$this->Form->input('User.email') ?>
				<?=$this->Form->input('User.perishable_token') ?>
				<?=$this->Form->end(array('label'=>__('Verify'), 'class'=>'small radius blue button', 'div'=>false))?>
			</div>
		</div>
	</div>
</div>
