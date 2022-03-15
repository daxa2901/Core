<?php $customer = $this->getCustomer();?>
<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<form action="<?php echo  $this->getUrl('save');?>" method="POST">
<table border="1" width="100%" cellspacing="4">
  <tr>
    <td colspan="2"><b>Personal Information</b></td>
  </tr>
  <tr>
    <td width="10%">First Name</td>
    <td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName; ?>"></td>
  </tr>
  
  <tr>
    <td width="10%">Last Name</td>
    <td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName; ?>"></td>
  </tr>
  <tr>
    <td width="10%">Email</td>
    <td><input type="text" name="customer[email]" value="<?php echo $customer->email; ?>"></td>
  </tr>
  <tr>
    <td width="10%">Mobile</td>
    <td><input type="text" name="customer[mobile]" value="<?php echo $customer->mobile; ?>"></td>
  </tr>
  <tr>
    <td width="10%">Status</td>
    <td>
      <select name="customer[status]">
        <?php foreach ($customer->getStatus() as $key => $val): ?>
          <option <?php if($customer->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
        <?php endforeach; ?>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="2"><b>Billing Address
    </b></td>
  </tr>
  <tr>
    <td width="10%">Address</td>
    <td><input type="text" name="billingAddress[address]" value="<?php echo $billingAddress->address; ?>"></td>
  </tr>
  
  <tr>
    <td width="10%">City</td>
    <td><input type="text" name="billingAddress[city]" value="<?php echo $billingAddress->city; ?>"></td>
  </tr>
  <tr>
    <td width="10%">State</td>
    <td><input type="text" name="billingAddress[state]" value="<?php echo $billingAddress->state; ?>"></td>
  </tr>
  <tr>
    <td width="10%">Postal Code</td>
    <td><input type="text" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode; ?>"></td>
  </tr>
  <tr>
    <td width="10%">Country</td>
    <td><input type="text" name="billingAddress[country]" value="<?php echo $billingAddress->country; ?>"></td>
  </tr>
  <tr>
    <td colspan="2"><input type="checkbox" name="billingAddress[same]" id="same" onclick ="hideShow()" value="1" <?php if($billingAddress->same == 1):?> checked <?php endif; ?>> Make shipping as billing</td>
  </tr>
</table>
<div id="shippingAddress"  <?php if($billingAddress->same != 1): ?> style="display:block;" <?php else: ?> style="display:none;" <?php endif; ?>>
<table border="1" width="100%" cellspacing="4">
    <tr>
      <td colspan="2"><b>Shipping Address</b></td>
  
    </tr>
    <tr>
      <td width="10%">Address</td>
      <td><input type="text" name="shippingAddress[address]" value="<?php echo $shippingAddress->address; ?>"></td>
    </tr>
    
    <tr>
      <td width="10%">City</td>
      <td><input type="text" name="shippingAddress[city]" value="<?php echo $shippingAddress->city; ?>"></td>
    </tr>
    <tr>
      <td width="10%">State</td>
      <td><input type="text" name="shippingAddress[state]" value="<?php echo $shippingAddress->state; ?>"></td>
    </tr>
    <tr>
      <td width="10%">Postal Code</td>
      <td><input type="text" name="shippingAddress[postalCode]" value="<?php echo $shippingAddress->postalCode; ?>"></td>
    </tr>
    <tr>
      <td width="10%">Country</td>
      <td><input type="text" name="shippingAddress[country]" value="<?php echo $shippingAddress->country; ?>"></td>
  
    </tr>
  </table border="1" width="100%" cellspacing="4">
    </div>
    <table>
  <tr>
    <td width="25%">&nbsp;
      <?php if($customer->customerId): ?>
        <input type="hidden" name="customer[customerId]" value="<?php echo $customer->customerId; ?>">
        <input type="hidden" name="shippingAddress[addressId]" value="<?php echo $shippingAddress->addressId; ?>">
        <input type="hidden" name="billingAddress[addressId]" value="<?php echo $billingAddress->addressId; ?>">
     <?php endif ?>
    </td>
    <td>
      <button type="submit" name="submit" class="Registerbtn">Save </button>
      <a href="<?php echo  $this->getUrl('grid',null,['id'=>null]);?>"><button type="button" class="cancelbtn">Cancel</button></a>
    </td>
  </tr>    
</table>  
</form>

<script type="text/javascript">
    function hideShow()
    {
      let val =  document.getElementById('same').checked;
        if(val)  
            document.getElementById('shippingAddress').style.display = 'none';
        else
            document.getElementById('shippingAddress').style.display = 'block';
    }
</script>