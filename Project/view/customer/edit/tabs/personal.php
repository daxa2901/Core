<?php $customer = $this->getCustomer();?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <table class="form-group w-100" cellspacing="4">
    <tr>
      <td colspan="2"><b>Personal Information</b><hr></td>
    </tr>
    <tr>
      <td >First Name :</td>
      <td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName; ?>" class="form-control"></td>
    </tr>
    
    <tr>
      <td >Last Name :</td>
      <td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td >Email :</td>
      <td><input type="text" name="customer[email]" value="<?php echo $customer->email; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td >Mobile :</td>
      <td><input type="text" name="customer[mobile]" value="<?php echo $customer->mobile; ?>" class="form-control"></td>
    </tr>
    <tr>
      <td >Status :</td>
      <td>
        <select name="customer[status]" class="form-select">
          <?php foreach ($customer->getStatus() as $key => $val): ?>
            <option <?php if($customer->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>
        </select>
      </td>
    </tr>
    <tr>
        <td>
          <?php if($customer->customerId): ?>
            <input type="hidden" name="customer[customerId]" value="<?php echo $customer->customerId; ?>">
         <?php endif ?>
        </td>
        <td colspan="2">
          <button type="button" name="submit" class="btn btn-primary my-2" id="customerSaveBtn">Save </button>
          <button type="button" name="submit" class="btn btn-primary my-2" id = "customerSaveNext" value="saveAndNext">Save & Next</button>
          <button type="button" class="btn btn-danger my-2" id = "customerCancelBtn">Cancel</button>
        </td>
      </tr>    
  </table>  
</div>

<script type="text/javascript">
  jQuery("#customerSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#customerCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

</script>