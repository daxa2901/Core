<?php $address = $this->getAddress(); ?>
<?php $vendor = $this->getVendor(); ?>
<div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div>
            </div>
            <div class="form-group">
              <label >Address :</label>
              <input type="text" class="form-control"  name="address[address]" value="<?php echo $address->address; ?>">
            </div>
            <div class="form-group">
              <label >City :</label>
              <input type="text" class="form-control"  name="address[city]" value="<?php echo $address->city; ?>" >
            </div>
            <div class="form-group">
              <label > State :</label>
              <input type="text" class="form-control"  name="address[state]" value="<?php echo $address->state; ?>" >
            </div>
            <div class="form-group">
              <label >Country :</label>
              <input type="text" class="form-control"  name="address[country]" value="<?php echo $address->country; ?>" >
            </div>
           <div class="form-group">
              <label >Postal Code :</label>
              <input type="mobile" class="form-control"  name="address[postalCode]" value="<?php echo $address->postalCode; ?>" >
            </div>
            <?php if($address->addressId): ?>
              <input type="hidden" name="address[addressId]" value="<?php echo $address->addressId; ?>">
            <?php endif ?>
            <?php if($vendor->vendorId): ?>
              <input type="hidden" name="vendorId" value="<?php echo $vendor->vendorId; ?>">
            <?php endif ?>
      
            <div class="card-footer">
             <button type="button" name="submit" class="btn btn-primary my-2" id="vendorAddressSaveBtn">Save </button>
            <button type="button" class="btn btn-danger my-2" id="vendorAddressCancelBtn">Cancel</button>
            
          </div>
          </div>
      </div>
    </div>
</div>
<script type="text/javascript">
  jQuery("#vendorAddressSaveBtn").click(function () {
    admin.setForm(jQuery("#indexForm"));
    // alert("<?php echo $this->getEdit()->getEditUrl()?>");
    admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
    admin.load();
  });

   jQuery("#vendorAddressCancelBtn").click(function () {
    admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
    admin.load();
  });
</script>