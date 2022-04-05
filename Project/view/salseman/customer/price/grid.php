<?php $products = $this->getProducts();?>
<?php $salseman = $this->getSalseman();?>
<div class="content-wrapper" style="min-height: 100.4px;">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Manage Customer Price</h1>
				</div>
			</div>
		</div>
	</section>

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

										<div class='container text-center'>
											<button type="button" class="btn btn-primary" id="priceSaveBtn"> Update </button>

											<button type="button" class="btn btn-danger" id="priceCancelBtn">Cancel</button>


											<div class="container w-100 my-2">
												<table class="table table-light shadow-sm" >
													<tr>
														<th> Customers Price </th>
														<th> Product Id </th>
														<th> Product Name </th>
														<th> Product Price </th>
														<th> Product Sku </th>
														<th> Salseman Price </th>

													</tr>
													<?php if($products): ?>
														<?php foreach ($products as $row): ?>		
															<tr>
																<td>
																	<?php if($row->customerPrice):?>
																		<input type="float" name="price[exists][<?php echo $row->entityId ?>]" required step="0.01" min = "<?php echo floor($row->price - ($row->price/100) * $salseman->percentage) ?>" max = <?php echo $row->price ?> value = <?php echo floor($row->customerPrice) ?> class="form-control ">
																	<?php else: ?> 
																		<input type="float" name="price[new][<?php echo $row->productId ?>]" step="0.01" min = "<?php echo floor($row->price - ($row->price/100) * $salseman->percentage) ?>" max = <?php echo floor($row->price) ?> required value = "<?php echo $row->price ?>" class = "form-control ">
																	<?php endif; ?>
																</td>
																<td><?php echo $row->productId ?></td>
																<td><?php echo $row->name ?></td>
																<td><?php echo $row->price ?></td>
																<td><?php echo $row->sku ?></td>
																<td><?php echo floor($row->price - ($row->price/100) * $salseman->percentage) ?></td>

															</tr>
														<?php endforeach; ?>
													<?php else: ?>
														<tr><td colspan='6'>No Record Available</td></tr>
													<?php endif; ?>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<script type="text/javascript">
jQuery("#priceSaveBtn").click(function () {
  admin.setForm(jQuery("#indexForm"));
  admin.setUrl("<?php echo $this->getUrl('save','salseman_customer_price')?>");
  admin.load();
});

 jQuery("#priceCancelBtn").click(function () {
  admin.setUrl("<?php echo $this->getUrl('edit','salseman')?>");
  admin.load();
});

</script>


