 <td  class="padd5" align="center"><select name="display_order"  style="width:80px;" onchange="return ChangeDisplayOrder(<?php echo $line->id;?>,this.value)">
							<?php for($i=0; $i<=10;$i++){ ?>
															


	<option value="<?php echo $i; ?>" <?php if($line->display_order== $i){?>selected<?php } ?>><?php echo $i; ?></option>
															<?php } ?>
														</select>