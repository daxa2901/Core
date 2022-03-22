<?php $order = $this->getOrder(); ?>
<?php $items = $this->getItems(); ?>
<div class="container w-100">
<div class="card mb-2" style="max-width: 540px;">
  <div class="row g-0">
  	<?php foreach($items as $item): ?>
	    <div class="col-md-4">
	      <img src="<?php echo $item->getProduct()->getBase()->getImageUrl() ?>" class="img-fluid rounded-start" alt="...">
	    </div>
	    <div class="col-md-8">
	      <div class="card-body my-0">
	        <h5 class="card-title my-0"><?php echo $item->name ?></h5>
	        <p class="card-text my-0"><?php echo $item->sku ?></p>
	        <p class="card-text my-0"><b> Quantity :- <?php echo $item->quantity ?> </p>
	        <p class="card-text my-0"><b> Price :- <?php echo $item->price ?> </b></p>
	      </div>
	    </div>
	   <?php endforeach; ?>
  </div>
</div>
</div>