<div id="deleteItem" class="reveal-modal">
	<h3><?= (!empty($options['title'])) ? __($options['title']) : __('Delete ' . Inflector::humanize(Inflector::underscore(Inflector::singularize($this->name)))) ?></h3>
	<h4><?=__('Are you sure?')?></h4>
	<? if (!empty($options['controller'])): ?>
		<?=$this->Form->postLink(__('Yes'), array('controller'=>$options['controller'], 'action' => 'delete'), array('id'=>'okDelete', 'class'=>'small radius success button')); ?>
	<? else: ?>
		<?=$this->Form->postLink(__('Yes'), array('action' => 'delete'), array('id'=>'okDelete', 'class'=>'small radius success button')); ?>
	<? endif; ?>
	<a href="#" class="noDelete small radius alert button"><?=__('No')?></a>
</div>
