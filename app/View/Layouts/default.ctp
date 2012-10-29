<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?=$title_for_layout?></title>
	<?=$this->Html->meta('icon')?>
	<?=$this->Html->css('foundation.min', null, array('inline' => false))?>
	<?=$this->Html->css('app', null,  array('inline' => false))?>
	<?=$this->Html->script('modernizr.foundation', array('inline' => false))?>
	<?=$this->Html->script('jquery', array('inline' => false))?>
	<?=$this->Html->script('foundation.min', array('inline' => false))?>
	<?=$this->Html->script('app', array('inline' => false))?>
	<?=$this->fetch('meta')?>
	<?=$this->fetch('css')?>
	<?=$this->fetch('script')?>
</head>
<body>
  <div class="row">
    <div class="twelve columns">

	<? if (!empty($currentUser)): ?>
		<?=$this->element('main_nav')?>
	<? endif ?>

	<? if ($this->Session->check('Message.auth')): ?>
		<div class="row"><div class="twelve columns"><?= $this->Session->flash('auth'); ?></div></div>
	<? endif ?>

	<div class="row">
		<div class="twelve columns">
			<?= $this->Session->flash()?>
			<?= $this->fetch('content')?>
		</div>
	</div>

	<?=$this->element('footer')?>

	<div class="row">
		<div class="twelve columns">
			<?=$this->element('sql_dump')?>
		</div>
	</div>

</body>
</html>
