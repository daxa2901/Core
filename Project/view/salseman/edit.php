<?php  $row = $this->getSalseman(); ?>
<div class="container w-50 my-3 shadow-lg bg-light">
  <form action="<?php echo  $this->getUrl('save');?>" method="POST" class="p-2">
  <table class="form-group w-100" cellspacing="4">
  <tr>
    <td>First Name : </td>
    <td><input type="text" name="salseman[firstName]" value="<?php echo $row->firstName ?>" class="form-control"></td>
  </tr>
  <tr>
    <td>Last Name :</td>
    <td><input type="text" name="salseman[lastName]" value="<?php echo $row->lastName ?>" class="form-control"></td>
  </tr>
  <tr>
    <td>Email :</td>
    <td><input type="text" name="salseman[email]" value="<?php echo $row->email ?>" class="form-control"></td>
  </tr>
  <tr>
    <td>Mobile :</td>
    <td><input type="text" name="salseman[mobile]" value="<?php echo $row->mobile ?>" class="form-control"></td>
  </tr>
  <tr>
    <td>Percentage :</td>
    <td><input type="float" name="salseman[percentage]" value="<?php echo $row->percentage ?>" class="form-control"></td>
  </tr>
  <tr>
    <td>Status :</td>
    <td>
      <select name="salseman[status]" class="form-select">
        <?php foreach ($row->getStatus() as $key => $val): ?>
          <option <?php if($row->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
        <?php endforeach; ?>
      </select>
    </td>
  </tr>
  <tr>
    <td></td>
    <?php if($row->salsemanId): ?>
    <input type="hidden" name="salseman[salsemanId]" value="<?php echo $row->salsemanId ?>">
    <?php endif; ?>
    <td>
      <button type="submit" name="submit" class="btn btn-primary my-2">Save </button>
      <a href="<?php echo  $this->getUrl('grid',null,['id'=>null]);?>"><button type="button" class="btn btn-danger">Cancel</button></a>
    </td>
  </tr>    
  </table>  
  </form>
</div>