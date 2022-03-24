<?php $vendor = $this->getVendor();?>
<?php $address = $this->getAddress(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <form action="<?php echo  $this->getUrl('save');?>" method="POST">
  <table class = "form-group w-100" cellspacing="4">
    <tr>
      <td colspan="2"><b>Personal Information</b><hr></td>
    </tr>
    <tr>
      <td>First Name :</td>
      <td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName; ?>" class="form-control"></td>
    </tr>
    
    <tr>
      <td>Last Name :</td>
      <td><input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Email :</td>
      <td><input type="text" name="vendor[email]" value="<?php echo $vendor->email; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Mobile :</td>
      <td><input type="text" name="vendor[mobile]" value="<?php echo $vendor->mobile; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td>Status :</td>
      <td>
        <select name="vendor[status]" class="form-select">
          <?php foreach ($vendor->getStatus() as $key => $val): ?>
            <option <?php if($vendor->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>
        </select>
      </td>
    </tr>
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
      <?php if($vendor->vendorId): ?>
        <input type="hidden" name="vendor[vendorId]" value="<?php echo $vendor->vendorId; ?>">
        <input type="hidden" name="address[addressId]" value="<?php echo $address->addressId; ?>">
      <?php endif ?>
      <td>
        <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
        <a href="<?php echo  $this->getUrl('grid',null,['id'=>null]);?>"><button type="button" class="btn btn-danger my-2">Cancel</button></a>
      </td>
    </tr>    
  </table>  
  </form>
</div>