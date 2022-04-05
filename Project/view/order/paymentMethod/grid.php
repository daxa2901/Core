<?php $paymentMethod  = $this->getPaymentMethod()?>

<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
	<thead >
		<th colspan="2"><h3> <b>Payment Method</b></h3></th>
	</thead>
	<thead >            			
		<th>Name</th>
		<th>Note </th>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $paymentMethod->name ?></td>
			<td><?php echo $paymentMethod->note ?></td>
		</tr>
	</tbody>
</table>
