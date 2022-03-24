<?php $paymentMethod  = $this->getPaymentMethod()?>

<table class="w-100 border text-center shadow-sm table">
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
