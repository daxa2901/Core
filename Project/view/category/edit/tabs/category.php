<?php $row = $this->getCategory();?>
<?php  $categoryPathPair = $this->getCategoryPathPair(); ?>
<?php  $categoryPath = $this->getCategoryToPath(); ?>

  <div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div class="form-group">
              <label >Name :</label>
              <input type="text"  class="form-control " name="category[name]" value="<?php echo $row->name ?>">
            </div> 
            <div class="form-group">
              <label >Parent Category :</label>
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
            </div>
            <div class="form-group">
              <label >Status :</label>
              <select name="category[status]" class="form-control ">
                <?php foreach ($row->getStatus() as $key => $val): ?>
                  <option <?php if($row->status == $key): ?> selected <?php endif ?> value="<?php echo $key ?>"><?php echo $val ?></option>
                <?php endforeach; ?>          
              </select>
            </div>
            <div class="card-footer">
               <?php if($row->categoryId) : ?>
                  <input type="hidden" name="category[categoryId]" value="<?php echo $row->categoryId ?>" class="form-control">
                <?php endif; ?>
              <button type="button" name="submit" class="btn btn-primary my-2" id="categorySaveBtn">Save </button>
              <button type="button" name="submit" class="btn btn-primary my-2" id="categorySaveNext" >Save And Next </button>
              <button type="button" class="btn btn-danger my-2" id="categoryCancelBtn">Cancel</button>
            </div>
          </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
jQuery("#categorySaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#categoryCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

jQuery("#categorySaveNext").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('save',null,['tab'=>'media'])?>");
  admin.load();
});

</script>