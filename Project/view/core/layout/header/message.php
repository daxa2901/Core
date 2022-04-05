<?php $messages = $this->getMessages(); ?>

<nav class="navbar navbar-white navbar-light">
    <ul class="navbar-nav ml-auto float-left">
      <li class="nav-item">
        <?php if ($messages) : ?>
            <?php foreach ($messages as $type =>$message): ?>
            <h3 id="message"><?php echo $message; ?></h3>
           <?php endforeach ?>
        <?php endif; ?>
      </li>
    </ul>
</nav>

