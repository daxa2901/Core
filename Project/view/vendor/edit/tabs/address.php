<?php $address = $this->getAddress(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <table class = "form-group w-100" cellspacing="4">
    
    <tr>
      <td colspan="2"><b>Address Information</b><hr></td>
    </tr>
    <tr>
      <td>Address :</td>
      <td><input type="text" name="address[address]" value="<?php echo $address->address; ?>" class="form-control"></td>
    </tr>
    
    <tr>
      <td>City :</td>
      <td><input type="text" name="address[city]" value="<?php echo $address->city; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td>State :</td>
      <td><input type="text" name="address[state]" value="<?php echo $address->state; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Postal Code :</td>
      <td><input type="text" name="address[postalCode]" value="<?php echo $address->postalCode; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Country :</td>
      <td><input type="text" name="address[country]" value="<?php echo $address->country; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td></td>
      <?php if($address->addressId): ?>
        <input type="hidden" name="address[addressId]" value="<?php echo $address->addressId; ?>">
      <?php endif ?>
      <td>
        <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
        <a href="<?php echo  $this->getUrl('grid',null,['id'=>null]);?>"><button type="button" class="btn btn-danger my-2">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</div>