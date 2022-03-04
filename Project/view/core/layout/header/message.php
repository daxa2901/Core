<?php $messages = $this->getMessages(); ?>
<?php if ($messages) : ?>
    <?php foreach ($messages as $type =>$message): ?>
 	<h2><?php echo $message; ?></h2>
 <?php endforeach ?>
 <?php endif; ?>
 