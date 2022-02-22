<?php
class Product{
	protected $price = 0.00;
	public function setPrice($price)
	{		
		$this->price = $price;
		return $this;
	}
	public static function getPrice()
	{
		return $this->price;
	}
}
class Transfer{
	protected $product = null;
	public function setProduct($product)
	{
		$this->product = $product;
		return $this;
	}
	public function getProduct()
	{
		return $this->product;
	}
	public function sendMoney()
	{
		$finalAmount = $this->getProduct()->getPrice();
		echo $finalAmount;
	}
}

$product = new Product();
$product->setPrice(100.00);
$transfer1 = new Transfer();
$transfer1->setProduct($product);

$product->setPrice(200.00);
$transfer2 = new Transfer();
$transfer2->setProduct($product);

echo $transfer1->sendMoney();
echo $transfer2->sendMoney();
?>