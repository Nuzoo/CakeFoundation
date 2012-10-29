<div class="row">
	<div class="twelve columns">
		<h4>User Listing</h4>
		<table class="twelve">
			<thead>
				<th><?=__('Email')?></th>
				<th><?=__('Full Name')?></th>
				<th><?=__('Customer')?></th>
				<th><?=__('Role')?></th>
				<th><?=__('Created')?></th>
				<th><?=__('Action')?></th>
			</thead>
			<tbody>
			<? foreach($users as $user): ?>
				<tr>
					<td><?=$this->Html->link($user['User']['email'], array('action'=>'edit', $user['User']['id']))?></td>
					<td><?=$user['User']['fullname']?></td>
					<td><?=$user['Customer']['title']?></td>
					<td><?=$user['Role']['title']?></td>
					<td><?=$this->Time->format(DATE_FORMAT, $user['User']['created'])?></td>
					<td>
						<a href="#" data-item-id="<?=$user['User']['id']?>" class="deleteButton"> <i class="icon-trash icon-large"></i></a>
						&nbsp;
						<?=$this->Html->link('<i class="icon-eye-open icon-large"></i>', array('action'=>'view', $user['User']['id']),array('escape'=>false))?>
						&nbsp;
						<?=$this->Html->link('<i class="icon-edit icon-large"></i>', array('action'=>'edit', $user['User']['id']),array('escape'=>false))?>
					</td>
				</tr>
			<? endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<?=$this->element('pagination');?>

<div class="row">
	<div class="twelve columns">
		<?= $this->Html->link('<i class="icon-plus"></i> ' . __('Add'), array('action'=>'add'), array('escape'=>false, 'class'=>'small radius blue button')) ?>
	</div>
</div>

<?=$this->element('delete_dialog') ?>
