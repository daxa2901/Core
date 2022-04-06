<?php $order = $this->getOrder(); ?>

<div class="content-wrapper" style="min-height: 100.4px;">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>View Details</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
								<button type="button" name="Add" class="btn btn-default" id="goBack"> Go Back </button>
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
											<table  id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
												<thead >
													<th colspan="4"><h3> <b>Customer Details</b></h3></th>
												</thead>
												<thead >            			
													<th>First Name</th>
													<th>Last Name </th>
													<th>Mobile </th>
													<th>Email </th>
												</thead>
												<?php if ($order):?>
													<tr>
														<td><?php echo $order->firstName ?></td>
														<td><?php echo $order->lastName ?></td>
														<td><?php echo $order->mobile ?></td>
														<td><?php echo $order->email ?></td>
													</tr>
												<?php else: ?>
													<tr>
														<td colspan="2"> <h5>No Customer available</h5></td>
													</tr>
												<?php endif; ?>
											</table>
										</div>

										<br>
										<div class="container w-100 mx-auto">
											<?php echo $this->getAddress()->toHtml(); ?>
										</div>

										<br>
										<div class="container w-100 " id='paymentMethod'>
											<div class="row ">
												<div class="col-sm-6 ">
													<?php echo $this->getPaymentMethod()->toHtml(); ?>
												</div>
												<div class="col-sm-6">
													<?php echo $this->getShippingMethod()->toHtml(); ?>
												</div>
											</div>
										</div>
										<br>
										<div class="container w-100 border p-2 shadow-sm">
											<?php echo $this->getItems()->toHtml(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

<script type="text/javascript">
	jQuery('#goBack').click(function () {
		admin.setUrl("<?php echo $this->getUrl('grid','order')?>");
		admin.load();
	})
</script>