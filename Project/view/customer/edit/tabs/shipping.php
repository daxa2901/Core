<?php $shippingAddress = $this->getShippingAddress(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <table class="form-group w-100" cellspacing="4">
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
    <tr>
      <td>
        <?php if($shippingAddress->addressId): ?>
          <input type="hidden" name="shippingAddress[addressId]" value="<?php echo $shippingAddress->addressId; ?>">
       <?php endif ?>
      </td>
      <td colspan="2">
        <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
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