<?php $shippingMethod = $this->getShippingMethod() ?>
<form class="mx-auto" action="<?php echo  $this->getUrl('save');?>" method="POST">
	<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info ">
		<thead>
			<th colspan="3"><h3> <b>Shipping Method</b></h3></th>
		</thead>
		<thead>  
			<tr>
				<th>Name</th>
				<th>Note</th>
				<th>Amount</th>
			</tr>          			
		</thead>
		<tbody>
    		<tr>
    			<td><?php echo $shippingMethod->name ?></td>
    			<td><?php echo $shippingMethod->note ?></td>
    			<td><?php echo $shippingMethod->amount ?></td>
    		</tr>
		</tbody>
    </table>
</form>