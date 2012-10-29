<div class="row">
	<div class="twelve columns">
		<ul class="pagination">
			<?= $this->Paginator->counter('Page {:page} of {:pages}, showing {:current} results out of {:count} total')?>
			<br />
			<li class="arrow"><?= $this->Paginator->prev(' &laquo; ' . __('previous'), array(), null, array('class' => 'prev disabled', 'escape'=>false)) ?></li>
			<?= $this->Paginator->numbers(array('before'=>'<li>', 'after'=>'</li>')) ?>
			<li class="arrow"><?= $this->Paginator->next(__('next'). ' &raquo; ', array(), null, array('class' => 'next disabled', 'escape'=>false)) ?></li>
		</ul>
	</div>
</div>
<br /><br />
