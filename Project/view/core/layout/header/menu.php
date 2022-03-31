<div>
	<nav class="navbar navbar-expand-lg navbar-light bg-secondory" style="background-color: #e3f2fd;">
  <div class="container w-100">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','category',null,true);?>">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','product',null,true);?>">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo  $this->getUrl('grid','customer',null,true);?>">Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','admin',null,true);?>">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','salseman',null,true);?>">Salseman</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','config',null,true);?>">Config</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','vendor',null,true);?>">Vendor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','page',null,true);?>">Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','ShippingMethod',null,true);?>">Shipping Method</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','PaymentMethod',null,true);?>">Payment Method</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('grid','Order',null,true);?>">Orders</a>
        </li>
        <?php if($this->getLogin()): ?>
        	<li class="nav-item">
          		<a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('logout','Admin_Login',null,true);?>">Logout</a>
        	</li>
        <?php else: ?>
        	 
        	<li class="nav-item">
        	  <a class="nav-link active" aria-current="page" href="<?php echo $this->getUrl('login','Admin_Login',null,true);?>">Login</a>
        	 </li>
		<?php endif; ?>
      </ul>
  </div>
</nav>
</div>

