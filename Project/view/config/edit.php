<?php $config = $this->getConfig(); ?>
<form action=<?php echo  $this->getUrl('save');?>  method='post'>
<table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%"> Name</td>
      <td><input type="text" name="config[name]" value="<?php echo $config->name ?>"></td>
    </tr>
    <tr>
      <td width="10%"> Code</td>
      <td><input type="text" name="config[code]" value="<?php echo $config->code ?>"></td>
    </tr>
    <tr>
      <td width="10%"> Value</td>
      <td><input type="text" name="config[value]" value="<?php echo $config->value ?>"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="config[status]">
          <?php foreach ($config->getStatus() as $key => $val): ?>
            <option <?php if($config->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>          
        </select>
      </td>
    
	    <?php if($config->configId): ?>
	    <td>  <input type="hidden" name="config[configId]" value="<?php echo $config->configId ?>"></td>
	    <?php endif; ?>
    </tr>
	
    <tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href=<?php echo  $this->getUrl('grid',null,null,true);?>><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </div>
  </table>  
</form>