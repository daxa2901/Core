<?php $row = $this->getCategory(); ?>
<?php  $categoryPathPair = $this->getCategoryPathPair(); ?>
<?php  $categoryPath = $this->getCategoryToPath(); ?>
<form action="<?php echo  $this->getUrl('save');?>" method="POST">
  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td width="10%"> Name</td>
      <td><input type="text" name="category[name]" value="<?php echo $row['name'] ?>"></td>
    </tr>
    <input type="hidden" name="category[categoryId]" value="<?php echo $row['categoryId'] ?>">
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="category[status]">
          <?php if ($row['status' ] == 1):?>
              <option value='1'>Active</option>
              <option value='2'>InActive</option>
          <?php else: ?>
              <option value='2'>InActive</option>
              <option value='1'>Active</option>
          <?php endif;?>
        </select>
      </td>
    </tr>
    <tr>
      <td width="10%">Parent Category</td>
      <td>
        <select name="category[parentId]">
          
          <option value=<?php echo $row['parentId'] ?>><?php echo $categoryPath[$row['categoryId']]?></option>
          <option value=>Root</option>
          <?php foreach ($categoryPathPair as $key=>$value): ?>
              <?php if(strpos($value,$row['categoryPath']) !='false'):?>
                <option value=<?php echo $key ?>><?php echo $categoryPath[$key] ?></option>
              <?php endif; ?>
          <?php endforeach;?>

        </select>
      </td>
    </tr>

    <tr>
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href="<?php echo  $this->getUrl('grid',null,null,true);?>"><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </table>  
</form>
