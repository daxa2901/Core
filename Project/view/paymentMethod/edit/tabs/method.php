<?php $paymentMethod = $this->getPaymentMethod(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <table class= "form-group w-100" cellspacing="4">
      <tr>
        <td> Name :</td>
        <td><input type="text" name="payment[name]" value="<?php echo $paymentMethod->name ?>" class="form-control"></td>
      </tr>
      <tr>
        <td> Note :</td>
        <td><input type="text" name="payment[note]" value="<?php echo $paymentMethod->note ?>" class="form-control"></td>
      </tr>
      <tr>
        <td>Status :</td>
        <td>
          <select name="payment[status]" class="form-select">
            <?php foreach ($paymentMethod->getStatus() as $key => $val): ?>
              <option <?php if($paymentMethod->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
            <?php endforeach; ?>          
          </select>
        </td>
      
  	    <?php if($paymentMethod->methodId): ?>
  	    <td>  <input type="hidden" name="payment[methodId]" value="<?php echo $paymentMethod->methodId ?>" class="form-control"></td>
  	    <?php endif; ?>
      </tr>
  	
      <tr>
        <td width="25%">&nbsp;</td>
        <td>
          <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
          <a href=<?php echo  $this->getUrl('grid',null,['id'=> null]);?>><button type="button" class="btn btn-danger my-2">Cancel</button></a>
        </td>
      </tr>    
    </div>
    </table>  
</div>