<?php $product = $this->getProducts(); ?>
<form action=<?php echo  $this->getUrl('save');?>  method='post'>
<table border="1" width="100%" cellspacing="4">
    <tr>
      <input type="hidden" name="product[productId]" value="<?php echo $product['productId'] ?>">
      <td width="10%"> Name</td>
      <td><input type="text" name="product[name]" value="<?php echo $product['name'] ?>"></td>
    </tr>
    <tr>
      <td width="10%"> Price</td>
      <td><input type="float" name="product[price]" value="<?php echo $product['price'] ?>"></td>
    </tr>
    <tr>
      <td width="10%"> Quantity</td>
      <td><input type="number" name="product[quantity]" value="<?php echo $product['quantity'] ?>"></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="product[status]">
          <?php if ($product['status' ] == 1):?>
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
      <td width="25%">&nbsp;</td>
      <td>
        <button type="submit" name="submit" class="Registerbtn">Save </button>
        <a href=<?php echo  $this->getUrl('grid',null,null,true);?>><button type="button" class="cancelbtn">Cancel</button></a>
      </td>
    </tr>    
  </div>
  </table>  
</form>
