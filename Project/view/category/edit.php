<?php $row = $this->getCategory();?>
<?php  $categoryPathPair = $this->getCategoryPathPair(); ?>
<?php  $categoryPath = $this->getCategoryToPath(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <form action="<?php echo  $this->getUrl('save');?>" method="POST" class="p-2">
    <table class="form-group w-100" cellspacing="4">
      <tr>
        <td> Name :</td>
        <td><input type="text" name="category[name]" value="<?php echo $row->name ?>" class = "form-control"></td>
        <?php if($row->categoryId) : ?>
        <input type="hidden" name="category[categoryId]" value="<?php echo $row->categoryId ?>" class="form-control">
      <?php endif; ?>
      </tr>

      <tr>
        <td>Status :</td>
        <td>
          <select name="category[status]" class="form-select">
           <?php foreach ($row->getStatus() as $key => $val): ?>
              <option <?php if($row->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
            <?php endforeach;?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Parent Category :</td>
        <td>
          <select name="category[parentId]" class="form-select">
            
              <?php if($row->categoryId) : ?>
            <option value=<?php echo $row->parentId ?>><?php echo $categoryPath[$row->categoryId]?></option>
              <?php endif; ?>
            <option value=>Root</option>
            <?php foreach ($categoryPathPair as $key=>$value): ?>
                <?php if(strpos($value,$row->categoryPath) !='false'):?>
                  <option value=<?php echo $key ?>><?php echo $categoryPath[$key] ?></option>
                <?php endif; ?>
            <?php endforeach;?>

          </select>
        </td>
      </tr>
      <tr>
        <td width="25%">&nbsp;</td>
        <td>
          <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
          <a href="<?php echo  $this->getUrl('grid',null,['id'=>null]);?>"><button type="button" class="btn btn-danger my-2">Cancel</button></a>
        </td>
      </tr>    
    </table>  
  </form>
</div>
