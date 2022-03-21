<?php $paymentMethod = $this->getPaymentMethod(); ?>
<form action=<?php echo  $this->getUrl('save');?>  method='post'>
<table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%"> Name</td>
      <td><input type="text" name="payment[name]" value="<?php echo $paymentMethod->name ?>"></td>
    </tr>
    <tr>
      <td width="10%"> Note</td>
      <td><input type="text" name="payment[note]" value="<?php echo $paymentMethod->note ?>"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="payment[status]">
          <?php foreach ($paymentMethod->getStatus() as $key => $val): ?>
            <option <?php if($paymentMethod->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>          
        </select>
      </td>
    
	    <?php if($paymentMethod->methodId): ?>
	    <td>  <input type="hidden" name="payment[methodId]" value="<?php echo $paymentMethod->methodId ?>"></td>
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
