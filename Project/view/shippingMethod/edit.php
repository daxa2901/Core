<?php $shippingMethod = $this->getShippingMethod(); ?>
<form action=<?php echo  $this->getUrl('save');?>  method='post'>
<table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%"> Name</td>
      <td><input type="text" name="shipping[name]" value="<?php echo $shippingMethod->name ?>"></td>
    </tr>
    <tr>
      <td width="10%"> Note</td>
      <td><input type="text" name="shipping[note]" value="<?php echo $shippingMethod->note ?>"></td>
    </tr>
    <tr>
      <td width="10%"> Amount</td>
      <td><input type="float" name="shipping[amount]" value="<?php echo $shippingMethod->amount ?>"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="shipping[status]">
          <?php foreach ($shippingMethod->getStatus() as $key => $val): ?>
            <option <?php if($shippingMethod->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>          
        </select>
      </td>
    
	    <?php if($shippingMethod->methodId): ?>
	    <td>  <input type="hidden" name="shipping[methodId]" value="<?php echo $shippingMethod->methodId ?>"></td>
	    <?php endif; ?>
    </tr>
	
    <tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href=<?php echo  $this->getUrl('grid',null,['id'=> null]);?>><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </div>
  </table>  
</form>
