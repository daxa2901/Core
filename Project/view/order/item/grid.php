<?php $items = $this->getItems(); ?>
<?php $order = $this->getOrder(); ?>
<?php $comment = $this->getComments(); ?>

<div class="container w-100 ">
		<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
			<thead class="border">
				<tr>
				<th colspan="10"><h3> <b>Order Items</b></h3></th>
				</tr>
				<tr>
				<th> Image </th>
				<th> Name </th>
				<th> Quantity </th>
				<th> Price </th>
				<th> Cost </th>
				<th> Discount </th>
				<th> Row Total </th>
				</tr>
			</thead>
			<tbody>
			<?php $subtotal = 0 ?> 
			<?php $discount = 0 ?> 
		<?php foreach ($items as $key => $value): ?>
			<?php $product = $value->getProduct(); ?>
				<tr>
					<?php $subtotal = $subtotal + ($value->quantity * $value->getFinalPrice()) ?> 
					<?php if($product->discountMode == get_class($product)::DISCOUNT_PERCENTAGE): ?>
						<?php $discount = $discount + $value->price  * ($value->discount / 100) ?> 
					<?php else : ?>
						<?php $discount = $discount + $value->discount ?>
					<?php endif ?> 
					<td> <?php if($product->base): ?>
							<img src="<?php echo $product->getBase()->getImageUrl() ?>" alt =  "no Image"  height="50px" width="50px" />
						<?php else: ?>
							 No Image 
						<?php endif; ?>
					</td>
					<td> <?php echo $value->name ?></td>
					<td> <?php echo $value->quantity?></td>
					<td> <?php echo $value->price ?></td>
					<td> <?php echo $value->cost ?></td>
					<td> <?php echo $value->discount ?></td>
					<td> <?php echo $value->quantity * $value->getFinalPrice() ?></td>
				</tr>	
		<?php endforeach ?>
				<tr>
					<td colspan="7">
						<button type="button" class="btn btn-outline-default float-end my-3 mx-2 w-25 disabled"> Sub Total :- <?php echo $subtotal ?> </button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="container w-100 float-center ">
		<div class="row">
			<div class="col-sm-7 border shadow-sm mx-3">
					
					<div class="form-group">
		              <label >Status :</label>
		              <select name="comment[status]" class="form-control">
		                <?php foreach (Ccc::getModel('Order_Comment')->getStatus() as $key => $val): ?>
		                  <option value="<?php echo $key ?>"><?php echo $val ?></option>
		                <?php endforeach; ?>
		              </select>
		              <!-- <input type="text" class="form-control"  name="comment[name]" value="<?php echo 11 ; ?>"> -->
		            </div>
            
					<div class="form-group">
		              <label >Note :</label>
		              <textarea class="form-control" name="comment[note]"></textarea>
		            </div>
            		<div class="form-group">
           			  <input type="checkbox" name="comment[notify]" id="same" value="1" > Notify To Customer
           			</div>
           
            		<div class="card-footer">
             			<button type="button" name="submit" class="btn btn-primary my-2" id="orderCommentSaveBtn">Save </button>
        			</div>
        			<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
        				<thead>
        					<th>CommentId</th>
        					<th>Status</th>
        					<th>Note</th>
        					<th>Created At</th>
        				</thead>
        				<tbody>
        					<?php if($comment):?>
        						<?php foreach($comment as $key=>$value):?>
		        					<tr>
		        						<td><?php echo $value->commentId ?></td>
		        						<td><?php echo $value->getStatus($value->status) ?></td>
		        						<td><?php echo $value->note ?></td>
		        						<td><?php echo $value->createdAt ?></td>
		        					</tr>
        						<?php endforeach; ?>
        					<?php else:?>
        						<tr><td colspan="4">No record found</td></tr>
        				<?php endif ?>
        				</tbody>
        			</table>
			</div>
			<div class="col-sm-4 border shadow-sm">
				<table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
				<tbody>
					<tr>
						<td> SUB TOTAL : </td>
						<td> <?php echo $subtotal ?></td>
					</tr>
					<tr>
						<td> SHIPPING COST: </td>
						<td><?php echo $order->shippingCost ?> </td>
					</tr>
					<tr>
						<td> TAX : </td>
						<td> <?php echo $order->taxAmount ?> </td>
					</tr>
					<tr>
						<td> DISCOUNT : </td>
						<td> <?php echo $discount ?></td>
					</tr>
					<tr>
						<td> <b> GRAND TOTAL :</b> </td>
						<td> <b> <?php echo $order->grandTotal ?>
						</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div>
		
	</div>
<script type="text/javascript">
	jQuery('#orderCommentSaveBtn').click(function () {
		admin.setForm(jQuery("#indexForm"));
	  	admin.setUrl("<?php echo $this->getUrl('saveComment','order',['id'=>$order->orderId])?>");
  		admin.load();
	})
</script>