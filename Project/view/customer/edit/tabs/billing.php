<?php $billingAddress = $this->getBillingAddress(); ?>
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
      <tr>
        <td>
          <?php if($billingAddress->addressId): ?>
            <input type="hidden" name="billingAddress[addressId]" value="<?php echo $billingAddress->addressId; ?>">
         <?php endif ?>
        </td>
        <td colspan="2">
          <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
           <button type="submit" name="submit" class="btn btn-primary my-2" name = 'save&next' value="save&next">Save & Next</button>
          <a href="<?php echo  $this->getUrl('grid',null,['id'=>null]);?>"><button type="button" class="btn btn-danger my-2">Cancel</button></a>
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
</script>