<div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
  <div class="container ">
    <div class="collapse navbar-collapse text-center" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Category_Grid')->getUrl('grid','category',null,true);?>">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Product_Grid')->getUrl('grid','product',null,true);?>">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo  Ccc::getBlock('Customer_Grid')->getUrl('grid','customer',null,true);?>">Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Admin_Grid')->getUrl('grid','admin',null,true);?>">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Salseman_Grid')->getUrl('grid','salseman',null,true);?>">Salseman</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Config_Grid')->getUrl('grid','config',null,true);?>">Config</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Vendor_Grid')->getUrl('grid','vendor',null,true);?>">Vendor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Page_Grid')->getUrl('grid','page',null,true);?>">Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('ShippingMethod_Grid')->getUrl('grid','ShippingMethod',null,true);?>">Shipping Method</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('PaymentMethod_Grid')->getUrl('grid','PaymentMethod',null,true);?>">Payment Method</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Order_Grid')->getUrl('grid','Order',null,true);?>">Orders</a>
        </li>
        <?php if($this->getLogin()): ?>
        	<li class="nav-item">
          		<a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Admin_Login_Grid')->getUrl('logout','Admin_Login',null,true);?>">Logout</a>
        	</li>
        <?php else: ?>
        	 
        	<li class="nav-item">
        	  <a class="nav-link active" aria-current="page" href="<?php echo Ccc::getBlock('Admin_Login_Grid')->getUrl('login','Admin_Login',null,true);?>">Login</a>
        	 </li>
		<?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
</div>

