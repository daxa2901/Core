<?php $shippingMethod = $this->getShippingMethod(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <form action="<?php echo  $this->getUrl('save');?>"  method='post' class="p-2">
  <table class="w-100 form-group" cellspacing="4">
      <tr>
        <td> Name :</td>
        <td><input type="text" name="shipping[name]" value="<?php echo $shippingMethod->name ?>" class="form-control"></td>
      </tr>
      <tr>
        <td> Note :</td>
        <td><input type="text" name="shipping[note]" value="<?php echo $shippingMethod->note ?>" class="form-control"></td>
      </tr>
      <tr>
        <td> Amount :</td>
        <td><input type="float" name="shipping[amount]" value="<?php echo $shippingMethod->amount ?>" class="form-control"></td>
      </tr>
      <tr>
        <td>Status :</td>
        <td>
          <select name="shipping[status]" class="form-select">
            <?php foreach ($shippingMethod->getStatus() as $key => $val): ?>
              <option <?php if($shippingMethod->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
            <?php endforeach; ?>          
          </select>
        </td>
      
  	    <?php if($shippingMethod->methodId): ?>
  	    <td>  <input type="hidden" name="shipping[methodId]" value="<?php echo $shippingMethod->methodId ?>" class="form-control"></td>
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
  </form>
</div>