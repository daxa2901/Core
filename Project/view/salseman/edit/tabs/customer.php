<?php $customers = $this->getCustomers(); ?>
<?php $salseman = $this->getSalseman(); ?>

<div class='container text-center'>
	<button type="button" class="btn btn-primary" id="salsemanCustomerSaveBtn"> Update </button>
	<button type="button" class="btn btn-danger" id="salsemanCustomerCancelBtn">Cancel</button>
	<div class="container w-100 my-2">
	<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
		<thead>
		<tr>
			<th> Select Customers </th>
			<th> Id </th>
			<th> Name </th>
			<th> Manage Customer Price </th>
			
		</tr>
		</thead>
		<tbody>
		<?php if($customers): ?>
			<?php foreach ($customers as $row): ?>		
				<tr>
		    		<td><input type="checkbox" name="customer[]"  value = "<?php echo $row->customerId ?>" <?php if($row->salsemanId): ?> checked disabled<?php endif; ?>></td>
					<td><?php echo $row->customerId ?></td>
					<td><?php echo $row->firstName .' '. $row->lastName ?></td>
					<td>
					<?php if($row->salsemanId): ?> 
	
						<a href="<?php echo $this->getUrl('grid','salseman_customer_price',['id'=>$row->salsemanId,'customerId'=>$row->customerId],true);?>" class = "customer_price">Manage Customer Price</a> 
					<?php endif; ?>
	    		</td>
		    		</tr>
		  	<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan='4'>No Customer Available</td></tr>
		<?php endif; ?>
		</tbody>
	</table>
</div>
</div>
<script type="text/javascript">
jQuery("#salsemanCustomerSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  // alert("<?php echo $this->getEdit()->getEditUrl()?>&c=sasleman_customer");
  admin.setUrl("<?php echo $this->getUrl('save','salseman_customer',['id'=>$salseman->salsemanId])?>");
  admin.load();
});

 jQuery("#salsemanCustomerCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('grid',null,['id'=>null])?>");
  admin.load();
});

jQuery('.customer_price').click(function (event) {
	event.preventDefault();
	admin.setUrl(jQuery(this).attr('href'));
	admin.load();
})
</script>