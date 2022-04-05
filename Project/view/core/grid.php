<?php 
$collection = $this->getCollections();
$actions = $this->getActions();
$columns = $this->getColumns();
?>

<script type="text/javascript">
function changeURL(val) 
{
	var url = "<?php echo $this->getUrl('grid',null,['p'=>$this->getPager()->getStart(),'ppc'=>null]);?>&ppc="+val;
	admin.setUrl(url);
	admin.load();
}
jQuery("#adminAddNewBtn").click(function () {
	admin.setUrl("<?php echo $this->getUrl('add')?>");
	admin.load();
});

jQuery("#gridStart").click(function () {
	admin.setUrl("<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getStart()])?>");
	admin.load();
});

jQuery("#gridPrev").click(function () {
	admin.setUrl("<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getPrev()])?>");
	admin.load();
});

jQuery("#gridCurrent").click(function () {
	admin.setUrl("<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getCurrent()])?>");
	admin.load();
});

jQuery("#gridNext").click(function () {
	admin.setUrl("<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getNext()])?>");
	admin.load();
});

jQuery("#gridEnd").click(function () {
	admin.setUrl("<?php echo $this->getUrl(null,null,['p'=>$this->getPager()->getEnd()])?>");
	admin.load();
});

jQuery("#multipleDelete").click(function () {
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getUrl('multipleDelete')?>");
	admin.load();
});

<?php foreach($actions as $key=>$action): ?>
	jQuery('.<?php echo $key ?>').click(function (event) {
		event.preventDefault();
		admin.setUrl(jQuery(this).attr('href'));
		admin.load();
	})
<?php endforeach; ?>

function change()
{
  	let value =  document.getElementsByClassName('check');
  	for (var val of value) 
  	{
  		if(!val.checked)
  		{
			document.getElementById('all').checked = false;
  		}
	}
}

function changeAll()
{
	let allCheck = document.getElementById('all').checked;
 	let value1 =  document.getElementsByClassName('check');
	if (allCheck)
	{ 
 		for (var val1 of value1) 
 		{
  			val1.checked = true;
		}
	}
	else
	{
 		for (var val1 of value1) 
 		{
  			val1.checked = false;
		}

	}
}

</script>

<div class="content-wrapper" style="min-height: 100.4px;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $this->getTitle(); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
              	<!-- <form action="<?php echo $this->getUrl('grid','cart')?>" method="POST">
              		<button type="submit" name="Add" class="btn btn-default"> Add New </button>
              		
              	</form> -->
              	<button type="button" name="Add" class="btn btn-default" id="adminAddNewBtn"> Add New </button>
              	<button type="button" class="btn btn-default" id="multipleDelete">Multiple Delete </button>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                	<div class="row">
                		<div class="col-sm-12 col-md-6"></div>
                		<div class="col-sm-12 col-md-6"></div>
                	</div>
                	<div class="row">
                		<div class="col-sm-12">
                			<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                 			 <thead>
                  				<tr>
                  					<th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"><input type="checkbox" name = all id="all" value = '1' onchange="changeAll()" <?php if(!$collection): ?> disabled <?php endif; ?>> Select All</th>
                  					
                  					<?php foreach($columns as $column): ?>
                  						<th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"><?php echo $column['title'] ?></th>
														<?php endforeach; ?>
														<?php foreach($actions as $action): ?>
															<th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"><?php echo $action['title'] ?></th>
														<?php endforeach; ?>
													</tr>
                  			</thead>
                  			<tbody>
                  				<?php if($collection): ?>
														<?php foreach ($collection as $row): ?>
															<tr><?php $primary = $row->getResource()->getPrimaryKey();?>
																	<td><input type="checkbox" name="delete[selected][]" onchange="change()" class="check" value = "<?php echo $row->$primary ?>"></td>
																<?php foreach($columns as $key => $column):?>
																	<td><?php echo $this->getColumnValue($row,$key,$column);?></td>
																<?php endforeach; ?> 
																<?php foreach($actions as $key => $action): ?>
																	<?php $method = $action['method'];?>
																	<td><a href="<?php echo  $this->$method($row);?>" class="<?php echo $key ?>"><?php echo $action['title']; ?></a></td>
																<?php endforeach; ?>
													   		</tr>
													 	<?php endforeach;?>
													<?php else:?>
														<tr><td colspan='15'>No Record Available</td></tr>			
													<?php endif; ?>
                  			</tbody>
                		</table>
                	</div>
                </div>
                <div class="row">

								<div class="container">
									<table align="center" class="pagination w-50 border-none">
										<tr>
											<td> 
												<select name="perPageCountOption" onchange="changeURL(this.value)" id='ppc' class="form-select">
														<option value="">select Per Page Count Option</option>
													<?php foreach ($this->getPager()->getPerPageCountOption() as $key => $value) : ?>
														<option value="<?php echo $value ?>" <?php if($this->getPager()->getPerPageCount() == $value):  ?> selected <?php endif; ?>> <?php echo $value ?></option>
													<?php endforeach; ?>
												</select>
											</td>
											<td><button type="button" <?php if(!$this->getPager()->getStart()): ?> disabled <?php endif; ?> class = "btn btn-default" id = "gridStart">Start</button></td>
											<td><button type="button"<?php if(!$this->getPager()->getPrev()): ?> disabled <?php endif; ?> class = "btn btn-default" id = "gridPrev">Previous</a></td>
											<td><button type="button"<?php if(!$this->getPager()->getCurrent()): ?> disabled <?php endif; ?> class = "btn btn-default" id = "gridCurrent">Current</a></td>
											<td><button type="button"<?php if(!$this->getPager()->getNext()): ?> disabled <?php endif; ?> class = "btn btn-default" id = "gridNext">Next</a></td>
											<td><button type="button"<?php if(!$this->getPager()->getEnd()): ?> disabled <?php endif; ?> class = "btn btn-default" id = "gridEnd">End</a></td>
										</tr>
									</table>	
								</div>
				     </div>
            </div>
        </div>
    	</div>
    </div>
  </div>
 </section>
</div>