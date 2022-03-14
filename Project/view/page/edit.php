<?php $page = $this->getPage(); ?>
<form action=<?php echo  $this->getUrl('save');?>  method='post'>
<table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%"> Name</td>
      <td><input type="text" name="page[name]" value="<?php echo $page->name ?>"></td>
    </tr>
    <tr>
      <td width="10%"> Code</td>
      <td><input type="text" name="page[code]" value="<?php echo $page->code ?>"></td>
    </tr>
    <tr>
      <td width="10%"> Content</td>
      <td><input type="text" name="page[content]" value="<?php echo $page->content ?>"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="page[status]">
          <?php foreach ($page->getStatus() as $key => $val): ?>
            <option <?php if($page->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
          <?php endforeach; ?>          
        </select>
      </td>
    
	    <?php if($page->pageId): ?>
	    <td>  <input type="hidden" name="page[pageId]" value="<?php echo $page->pageId ?>"></td>
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
