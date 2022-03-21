<div class='index'>
		<a href="<?php echo Ccc::getBlock('Category_Grid')->getUrl('grid','category',null,true);?>"><button type="button" class="cancel">Category</button></a>
		<a href="<?php echo Ccc::getBlock('Product_Grid')->getUrl('grid','product',null,true);?>"><button type="button" class="cancel">Product</button></a>
		<a href="<?php echo Ccc::getBlock('Customer_Grid')->getUrl('grid','customer',null,true);?>"><button type="button" class="cancel">Customer</button></a>
		<a href="<?php echo Ccc::getBlock('Admin_Grid')->getUrl('grid','admin',null,true);?>"><button type="button" class="cancel">Admin</button></a>
		<a href="<?php echo Ccc::getBlock('Config_Grid')->getUrl('grid','config',null,true);?>"><button type="button" class="cancel">Config</button></a>
		<a href="<?php echo Ccc::getBlock('Salseman_Grid')->getUrl('grid','salseman',null,true);?>"><button type="button" class="cancel">Salseman</button></a>
		<a href="<?php echo Ccc::getBlock('Vendor_Grid')->getUrl('grid','vendor',null,true);?>"><button type="button" class="cancel">Vendor</button></a>
		<a href="<?php echo Ccc::getBlock('Page_Grid')->getUrl('grid','page',null,true);?>"><button type="button" class="cancel">Page</button></a>
		<a href="<?php echo Ccc::getBlock('ShippingMethod_Grid')->getUrl('grid','ShippingMethod',null,true);?>"><button type="button" class="cancel">Shipping </button></a>
		<a href="<?php echo Ccc::getBlock('PaymentMethod_Grid')->getUrl('grid','PaymentMethod',null,true);?>"><button type="button" class="cancel">Payment </button></a>
		<a href="<?php echo Ccc::getBlock('Order_Grid')->getUrl('grid','Order',null,true);?>"><button type="button" class="cancel">Order</button></a>
		<?php if($this->getLogin()): ?>
			<a href="<?php echo Ccc::getBlock('Admin_Login_Grid')->getUrl('logout','Admin_Login',null,true);?>"><button type="button" class="cancel">Logout</button></a>
		<?php else: ?>
			<a href="<?php echo Ccc::getBlock('Admin_Login_Grid')->getUrl('login','Admin_Login',null,true);?>"><button type="button" class="cancel">login</button></a>

		<?php endif; ?>

</div>