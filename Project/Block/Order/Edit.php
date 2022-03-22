<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Order_Edit extends Block_Core_Template
{
	protected $pager = null;	

	public function __construct()
	{
		$this->setTemplate('view/order/view.php');
	}

	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager(Ccc::getModel('Core_Pager'));
		}
		return $this->pager;
	}

	public function getOrder()
	{
		return $this->order;
	}

	public function getShippingAddress()
	{
		return $this->order->getShippingAddress();
	}

	public function getBillingAddress()
	{
		return $this->order->getBillingAddress();
	}

	public function getCustomer()
	{
		return $this->order->getCustomer();
	}

	public function getItems()
	{
		return $this->order->getItems();
	}

	public function getShippingMethod()
	{
		return $this->order->getShippingMethod();
	}

	public function getPaymentMethod()
	{
		return $this->order->getPaymentMethod();
	}
}