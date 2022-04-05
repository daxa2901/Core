<?php $page = $this->getPage(); ?>

  <div class="row">
    <div class="col-md-11">
      <div class="card card-primary">
        <div class="card-header">
        </div>
          <div class="card-body">
            <div>
            </div>
            <div class="form-group">
              <label > Name :</label>
              <input type="text" class="form-control"  name="page[name]" value="<?php echo $page->name; ?>">
            </div>
            <div class="form-group">
              <label> Code</label>
              <input type="text" name="page[code]" value="<?php echo $page->code ?>" class="form-control">
            </div>
            <div class="form-group">
              <label> Content</label>
              <input type="text" name="page[content]" value="<?php echo $page->content ?>" class="form-control">
            </div>
            <div class="form-group">
              <label> Status</label>
              <select name="page[status]" class="form-control">
                <?php foreach ($page->getStatus() as $key => $val): ?>
                    <option <?php if($page->status == $key): ?> selected <?php endif ?>value="<?php echo $key ?>"><?php echo $val ?></option>
                <?php endforeach; ?>          
              </select>
            </div>
            <div class="card-footer">
                <button type="button" name="submit" class="btn btn-primary my-2" id="pageSaveBtn">Save </button>
                <button type="button" name="submit" class="btn btn-danger my-2" id="pageCancelBtn">cancel </button>
            </div>
            <?php if($page->pageId): ?>
              <input type="hidden" name="page[pageId]" value="<?php echo $page->pageId ?>" class="form-control">
            <?php endif; ?>
            </div>
          </div>
      </div>
  </div>

<script type="text/javascript">
jQuery("#pageSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  // alert("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.setUrl("<?php echo $this->getEdit()->getEditUrl()?>");
  admin.load();
});

 jQuery("#pageCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

</script>