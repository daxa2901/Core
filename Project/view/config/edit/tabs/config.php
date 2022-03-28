<?php $config = $this->getConfig(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <table class="form-group w-100" cellspacing="4">
      <tr>
        <td> Name :</td>
        <td><input type="text" name="config[name]" value="<?php echo $config->name ?>" class="form-control"></td>
      </tr>
      <tr>
        <td> Code :</td>
        <td><input type="text" name="config[code]" value="<?php echo $config->code ?>" class="form-control"></td>
      </tr>
      <tr>
        <td> Value :</td>
        <td><input type="text" name="config[value]" value="<?php echo $config->value ?>" class="form-control"></td>
      </tr>
      <tr>
        <td>Status :</td>
        <td>
          <select name="config[status]" class="form-select">
            <?php foreach ($config->getStatus() as $key => $val): ?>
              <option <?php if($config->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
            <?php endforeach; ?>          
          </select>
        </td>
      </tr>
  	
      <tr>
        <td >
    	    <?php if($config->configId): ?>
    	      <input type="hidden" name="config[configId]" value="<?php echo $config->configId ?>">
    	    <?php endif; ?>
        </td>
        <td>
          <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
          <a href=<?php echo  $this->getUrl('grid',null,['id'=>null]);?>><button type="button" class="btn btn-danger my-2">Cancel</button></a>
        </td>
      </tr>    
    </div>
    </table>  
</div>