<?php 
$collection = $this->getCollections();
$actions = $this->getActions();
$columns = $this->getColumns();
?>

<div class='container text-center'>
	<h1> <?php echo $this->getTitle(); ?> </h1> 
			<button type="button" name="Add" class="btn btn-primary" id="adminAddNewBtn"> Add New </button>
<!-- <form action="<?php echo  $this->getUrl('add');?>" method="POST">
<button type="submit" name="Add" class="btn btn-primary"> Add New </button>
</form>
 -->
	<div class="container w-100 my-3">
		<table class="table table-light shadow-sm">
			<tr>
				<?php foreach($columns as $column): ?>
					<th><?php echo $column['title'] ?></th>
				<?php endforeach; ?>
				<?php foreach($actions as $action): ?>
					<th><?php echo $action['title'] ?></th>
				<?php endforeach; ?>

			</tr>
			<?php if($collection): ?>
				<?php foreach ($collection as $row): ?>
					<tr>
						<?php foreach($columns as $key => $column):?>
							<td><?php echo $this->getColumnValue($row,$key,$column);?></td>
						<?php endforeach; ?> 
						<?php foreach($actions as $key => $action): ?>
							<?php $method = $action['method'];?>
							<td><a href="<?php echo  $this->$method($row);?>" class="<?php echo $key ?>" class = "<?php echo $key ?>"><?php echo $action['title']; ?></a></td>
						<?php endforeach; ?>
			   		</tr>
			 	<?php endforeach;?>
			<?php else:?>
				<tr><td colspan='15'>No Record Available</td></tr>			
			<?php endif; ?>
		</table>	
	</div>
</div>

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

<?php foreach($actions as $key=>$action): ?>
	jQuery('.<?php echo $key ?>').click(function (event) {
		event.preventDefault();
		admin.setUrl(jQuery(this).attr('href'));
		admin.load();
	})
<?php endforeach; ?>

</script>

