<?php $billingAddress = $this->getBillingAddress()  ?>
<?php $shippingAddress = $this->getShippingAddress()  ?>
<div class="row mx-auto">
        <div class="<?php if($billingAddress->same == 1):?> col-sm-12 <?php else: ?> col-sm-6 <?php endif; ?>" id="billingAddress">
            <form class="mx-auto" action="<?php echo  $this->getUrl('save');?>" method="POST">
            	<table class="w-100 border text-center">
            	<thead >
        			<th colspan="2"><h3> <b>Billing Address</b></h3></th>
        		</thead>
    			<?php if ($billingAddress):?>
    				 <tr>
					    <td>First Name :</td>
					    <td><input type="text" name="cart[billingAddress][firstName]" value="<?php echo $billingAddress->firstName; ?>"></td>
					  </tr>
					  
					 <tr>
					    <td>Last Name :</td>
					    <td><input type="text" name="cart[billingAddress][lastName]" value="<?php echo $billingAddress->lastName; ?>"></td>
					  </tr>
					  
					 <tr>
					    <td>Mobile :</td>
					    <td><input type="tel" name="cart[billingAddress][mobile]" value="<?php echo $billingAddress->mobile; ?>"></td>
					  </tr>
					
					 <tr>
					    <td>Email :</td>
					    <td><input type="email" name="cart[billingAddress][email]" value="<?php echo $billingAddress->email; ?>"></td>
					  </tr>
					  
					 <tr>
					    <td>Address</td>
					    <td><input type="text" name="cart[billingAddress][address]" value="<?php echo $billingAddress->address; ?>"></td>
					  </tr>
					  
					  <tr>
					    <td>City</td>
					    <td><input type="text" name="cart[billingAddress][city]" value="<?php echo $billingAddress->city; ?>"></td>
					  </tr>
					  <tr>
					    <td>State</td>
					    <td><input type="text" name="cart[billingAddress][state]" value="<?php echo $billingAddress->state; ?>"></td>
					  </tr>
					  <tr>
					    <td>Postal Code</td>
					    <td><input type="text" name="cart[billingAddress][postalCode]" value="<?php echo $billingAddress->postalCode; ?>"></td>
					  </tr>
					  <tr>
					    <td>Country</td>
					    <td><input type="text" name="cart[billingAddress][country]" value="<?php echo $billingAddress->country; ?>"></td>
					  </tr>
					 
		            	<tr>
							<td colspan="2"><input type="checkbox" name="cart[billingAddress][same]" id="same" onclick ="hideShipping()" value="1" <?php if($billingAddress->same == 1):?> checked <?php endif; ?>> Make shipping as billing</td>
							 </tr>
		            	<tr>
							<td colspan="2"><input type="checkbox" name="cart[billingAddress][saveToAddress]" id="save" onclick ="hideShow()" value="1" > Save to address book.</td>
							 </tr>
		            	<tr>
							<td colspan="2"><button type="submit" class="btn btn-primary my-3 w-25"> Update </button></td>
		            	</tr>
		        <?php else: ?>
		        	<tr>
		        		<td colspan="2"> <h5>No Billing Address available</h5></td>
		        	</tr>
		        <?php endif; ?>
            	</table>
            </form>
        </div>
        <div class="col-sm-6" <?php if($billingAddress->same == 1):?> style="display: none;"<?php endif; ?> id="shippingAddress">
            <form class="mx-auto" action="<?php echo  $this->getUrl('save');?>" method="POST">
            	<table class="w-100 border text-center">
            		<thead>
            			<th colspan="3"><h3> <b>Shipping Address</b></h3></th>
            		</thead>
            		<?php if ($shippingAddress):?>

		            	<tr>
						    <td>First Name :</td>
						    <td><input type="text" name="cart[shippingAddress][firstName]" value="<?php echo $shippingAddress->firstName; ?>"></td>
						  </tr>
						  
						 <tr>
						    <td>Last Name :</td>
						    <td><input type="text" name="cart[shippingAddress][lastName]" value="<?php echo $shippingAddress->lastName; ?>"></td>
						  </tr>
						  
						 <tr>
						    <td>Mobile :</td>
						    <td><input type="tel" name="cart[shippingAddress][mobile]" value="<?php echo $shippingAddress->mobile; ?>"></td>
						  </tr>
						
						 <tr>
						    <td>Email :</td>
						    <td><input type="email" name="cart[shippingAddress][email]" value="<?php echo $shippingAddress->email; ?>"></td>
						  </tr>
						  
						 <tr>
						    <td>Address</td>
						    <td><input type="text" name="cart[shippingAddress][address]" value="<?php echo $shippingAddress->address; ?>"></td>
						  </tr>
						  
						  <tr>
						    <td>City</td>
						    <td><input type="text" name="cart[shippingAddress][city]" value="<?php echo $shippingAddress->city; ?>"></td>
						  </tr>
						  <tr>
						    <td>State</td>
						    <td><input type="text" name="cart[shippingAddress][state]" value="<?php echo $shippingAddress->state; ?>"></td>
						  </tr>
						  <tr>
						    <td>Postal Code</td>
						    <td><input type="text" name="cart[shippingAddress][postalCode]" value="<?php echo $shippingAddress->postalCode; ?>"></td>
						  </tr>
						  <tr>
						    <td>Country</td>
						    <td><input type="text" name="cart[shippingAddress][country]" value="<?php echo $shippingAddress->country; ?>"></td>
						  </tr>
						 
			            	<tr>
    							<td colspan="2"><input type="checkbox" name="cart[shippingAddress][saveToAddress]" id="saveToAddress" onclick ="hideShow()" value="1"> Save to address book.</td>
 							 </tr>
			            	<tr>
								<td colspan="2"><button type="submit" class="btn btn-primary my-3 w-25"> Update </button></td>
			            	</tr>
			    	<?php else: ?>
			    		<tr><td colspan="2" class="text-center"> <h5>No Shipping Method available</h5></td></tr>
			        <?php endif; ?>
	            </table>
            </form>
        </div>
    </div>