<?php $customer = $this->getCustomer();?>
<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div>
              <h5>Billing Address</h5>
            </div>
            <div class="form-group">
              <label >Address :</label>
              <input type="text" class="form-control"  name="billingAddress[address]" value="<?php echo $billingAddress->address; ?>">
            </div>
            <div class="form-group">
              <label >City :</label>
              <input type="text" class="form-control"  name="billingAddress[city]" value="<?php echo $billingAddress->city; ?>" >
            </div>
            <div class="form-group">
              <label > State :</label>
              <input type="text" class="form-control"  name="billingAddress[state]" value="<?php echo $billingAddress->state; ?>" >
            </div>
            <div class="form-group">
              <label >Country :</label>
              <input type="text" class="form-control"  name="billingAddress[country]" value="<?php echo $billingAddress->country; ?>" >
            </div>
           <div class="form-group">
              <label >Postal Code :</label>
              <input type="mobile" class="form-control"  name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode; ?>" >
            </div>
           <div class="form-group">
             <input type="checkbox" name="billingAddress[same]" id="same" onclick ="hideShow()" value="1" <?php if($billingAddress->same == 1):?> checked <?php endif; ?>> Make shipping as billing
           </div>
            <div id="shippingAddress"  <?php if($billingAddress->same != 1): ?> style="display:block;" <?php else: ?> style="display:none;" <?php endif; ?>>
             <div>
                <h5>Shipping Address</h5>
            </div>
              <div class="form-group">
                <label >Address :</label>
                <input type="text" class="form-control"  name="shippingAddress[address]" value="<?php echo $shippingAddress->address; ?>">
              </div>
              <div class="form-group">
                <label >City :</label>
                <input type="text" class="form-control"  name="shippingAddress[city]" value="<?php echo $shippingAddress->city; ?>" >
              </div>
              <div class="form-group">
                <label > State :</label>
                <input type="text" class="form-control"  name="shippingAddress[state]" value="<?php echo $shippingAddress->state; ?>" >
              </div>
              <div class="form-group">
                <label >Country :</label>
                <input type="text" class="form-control"  name="shippingAddress[country]" value="<?php echo $shippingAddress->country; ?>" >
              </div>
             <div class="form-group">
                <label >Postal Code :</label>
                <input type="mobile" class="form-control"  name="shippingAddress[postalCode]" value="<?php echo $shippingAddress->postalCode; ?>" >
              </div>
             
           </div>
           <?php if($customer->customerId): ?>
            <input type="hidden" name="customerId" value="<?php echo $customer->customerId; ?>">
            <input type="hidden" name="shippingAddress[addressId]" value="<?php echo $shippingAddress->addressId; ?>">
            <input type="hidden" name="billingAddress[addressId]" value="<?php echo $billingAddress->addressId; ?>">
          <?php endif ?>
        
          <div class="card-footer">
             <button type="button" name="submit" class="btn btn-primary my-2" id="customerAddressSaveBtn">Save </button>
            <button type="button" class="btn btn-danger my-2" id="customerAddressCancelBtn">Cancel</button>
            
          </div>
      </div>
    </div>
  </div>
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