<?php $customer = $this->getCustomer();?>
<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <table class="form-group w-100" cellspacing="4">
    <tr>
      <td colspan="2"><b>Billing Address</b><hr></td>
    </tr>
    <tr>
      <td >Address :</td>
      <td><input type="text" name="billingAddress[address]" value="<?php echo $billingAddress->address; ?>" class="form-control"></td>
    </tr>
    
    <tr>
      <td >City :</td>
      <td><input type="text" name="billingAddress[city]" value="<?php echo $billingAddress->city; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td >State :</td>
      <td><input type="text" name="billingAddress[state]" value="<?php echo $billingAddress->state; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td >Postal Code :</td>
      <td><input type="text" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td >Country :</td>
      <td><input type="text" name="billingAddress[country]" value="<?php echo $billingAddress->country; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td colspan="2"><input type="checkbox" name="billingAddress[same]" id="same" onclick ="hideShow()" value="1" <?php if($billingAddress->same == 1):?> checked <?php endif; ?>> Make shipping as billing</td>
    </tr>
  </table>
  <div id="shippingAddress"  <?php if($billingAddress->same != 1): ?> style="display:block;" <?php else: ?> style="display:none;" <?php endif; ?>>
    <table  class = "form-group w-100" cellspacing="4">
        <tr>
          <td colspan="2"><b>Shipping Address</b><hr></td>
      
        </tr>
        <tr>
          <td >Address :</td>
          <td><input type="text" name="shippingAddress[address]" value="<?php echo $shippingAddress->address; ?>" class="form-control"></td>
        </tr>
        
        <tr>
          <td >City :</td>
          <td><input type="text" name="shippingAddress[city]" value="<?php echo $shippingAddress->city; ?>" class="form-control"></td>
        </tr>
        <tr>
          <td >State :</td>
          <td><input type="text" name="shippingAddress[state]" value="<?php echo $shippingAddress->state; ?>" class="form-control"></td>
        </tr>
        <tr>
          <td >Postal Code :</td>
          <td><input type="text" name="shippingAddress[postalCode]" value="<?php echo $shippingAddress->postalCode; ?>" class="form-control"></td>
        </tr>
        <tr>
          <td >Country :</td>
          <td><input type="text" name="shippingAddress[country]" value="<?php echo $shippingAddress->country; ?>" class="form-control"></td>
      
        </tr>
      </table>
      </div>
      <table>
      <tr>
        <td>
          <?php if($customer->customerId): ?>
            <input type="hidden" name="customer[customerId]" value="<?php echo $customer->customerId; ?>">
            <input type="hidden" name="shippingAddress[addressId]" value="<?php echo $shippingAddress->addressId; ?>">
            <input type="hidden" name="billingAddress[addressId]" value="<?php echo $billingAddress->addressId; ?>">
         <?php endif ?>
        </td>
        <td></td>
        <td colspan="2">
          <button type="button" name="submit" class="btn btn-primary my-2" id="customerAddressSaveBtn">Save </button>
          <button type="button" class="btn btn-danger my-2" id="customerAddressCancelBtn">Cancel</button>
        </td>
      </tr>    
  </table>  
</div>
<script type="text/javascript">
    function hideShow()
    {
      let val =  document.getElementById('same').checked;
        if(val)  
            document.getElementById('shippingAddress').style.display = 'none';
        else
            document.getElementById('shippingAddress').style.display = 'block';
    }

  jQuery("#customerAddressSaveBtn").click(function () {
    admin.setForm(jQuery("#indexForm"));
    admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
    admin.load();
  });

  jQuery("#customerAddressCancelBtn").click(function () {
    admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
    admin.load();
  });

</script>