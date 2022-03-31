<?php $page = $this->getPage(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <table class="w-100 form-group" cellspacing="4">
      <tr>
        <td> Name :</td>
        <td><input type="text" name="page[name]" value="<?php echo $page->name ?>" class="form-control"></td>
      </tr>
      <tr>
        <td> Code :</td>
        <td><input type="text" name="page[code]" value="<?php echo $page->code ?>" class="form-control"></td>
      </tr>
      <tr>
        <td> Content :</td>
        <td><input type="text" name="page[content]" value="<?php echo $page->content ?>" class="form-control"></td>
      </tr>
      <tr>
        <td>Status :</td>
        <td>
          <select name="page[status]" class="form-select">
            <?php foreach ($page->getStatus() as $key => $val): ?>
              <option <?php if($page->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
            <?php endforeach; ?>          
          </select>
        </td>
      
  	    <?php if($page->pageId): ?>
  	    <td>  <input type="hidden" name="page[pageId]" value="<?php echo $page->pageId ?>" class="form-control"></td>
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