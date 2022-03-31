<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content'); ?>

<?php 
class Block_Customer_Edit_Tabs_Address extends Block_Core_Edit_Tabs_Content
{
  public function __construct()
  {
    $this->setTemplate('view/customer/edit/tabs/address.php');
  }

  public function getBillingAddress()
  {
    $customer =  Ccc::getRegistry('customer');
    return $customer->getBillingAddress();
  }
  
   public function getShippingAddress()
  {
    $customer =  Ccc::getRegistry('customer');
    return $customer->getShippingAddress();
  }

  public function getCustomer()
  {
    return Ccc::getRegistry('customer');
  }
}