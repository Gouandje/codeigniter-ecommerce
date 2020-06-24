

<script type="text/javascript" src="<?php echo base_url();?>/assets/admin/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
	<div class="row padtop"> 

		<div class="col-md-12 col-md-offset-1">

			<h2>Modifier le produit: <strong><?php echo $product['pName']; ?></strong> </h2><br/>

		  <?php if($this->session->flashdata('class')): ?>
          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        
         <?php endif; ?>
			<?php echo  form_open_multipart('index.php/admin/updateProduct',  '', ''); ?>
			   <input type="hidden" name="xid" value="<?php echo $product['pId']; ?>">
               <!-- <input type="hidden" name="oldImg" value="<?php echo $product[0]['ProductDp']; ?>"> -->
               
				<div class="form-group">
					<label>Nom du Produit</label>
					<?php echo form_input( 'productName', $product['pName'],  'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<label>La Quantité de Produit</label>
					<?php echo form_input( 'productQtity', $product['pQuantity'],  'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<label>Prix du Produit</label>
					<?php echo form_input( 'productPrice', $product['pPrice'],  'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<label>Add Product Description</label>
					<textarea  id="ck" class="form-control" rows="3" name="productDescription">
						<?php echo $product['pDescription']?>
					</textarea>
					<script>CKEDITOR.replace('ck')</script>
				</div>
				<div class="form-group">
					<label>Choisir la catégorie</label>
					<?php 

						$categoriesOptions = array();

						foreach ($categories->result() as $category) {
							
							$categoriesOptions[$category->cId] = $category->cName; 
						}

						echo form_dropdown('categoryId', $categoriesOptions, $product['categoryId'], 'class="form-control"');


					?>
				</div>

				<div class="form-group">
                    <label> Status du Produit </label>
                    <select class="form-control" name="pro_status">
                    	<?php if($product['pStatus']==1){?>
                    		<option selected="" value="1">Activé</option>
                    		<option  value="2">Désactivé</option>
                    	<?php }elseif($product['pStatus']==2){ ?>
                    		<option  value="1">Activé</option>
                    		<option selected="" value="2">Désactivé</option>
                    	<?php } ?> 
                    </select>
                </div>
                <div class="form-group">
                	<label>Disponibilité du Produit</label>
                	<select class="form-control" name="pro_availability">
                		<?php if($product['pro_availability']==1){?>
                			<option selected="" value="1">En Stock</option>
                			<option value="2"> Stock Epuisé</option>
                			<option value="3">Bientôt Disponible</option>
                		<?php }elseif($product['pro_availability']==2){?>
                			<option value="1">En Stock</option>
                			<option selected="" value="2">Stock Epuisé</option>
                			<option value="3">Bientôt Disponible</option>
                		<?php }elseif($product['pro_availability']==3){?>
                			<option value="1">En Stock</option>
                			<option value="2">Stock Epuisé</option>
                			<option selected="" value="3">Bientôt Disponible</option>
                		<?php }?>
                	</select>
                </div>
				<div class="form-group">
					<input type="file" name="ProductDp[]" class="form-control" multiple>
					 <?php if(!empty($product['ProductDp'])){ ?>
                        <div class="gallery-img">
                        <?php foreach($product['ProductDp'] as $imgRow){ ?>
                            <div class="img-box" id="imgb_<?php echo $imgRow['pimgId']; ?>">
                                <img src="<?php echo base_url('assets/produits/'.$imgRow['pimgName']); ?>" width="180px">
                                <a href="javascript:void(0);" class="badge badge-danger" onclick="deleteImage('<?php echo $imgRow['pimgId']; ?>')">supprimer</a>
                            </div>
                        <?php } ?>
                        </div>
                    <?php } ?>
				</div>
				<div class="form-group">
                    <label>Top Product</label>
                        <div class="checkbox">
                        	<label>
                        		<?php if($product['top_product']==1){?>
                        			<input type="checkbox" name="top_product" value="1" checked="">Selectionner top produitt
                        		<?php } else{?>
                        			<input type="checkbox" name="top_product" value="1">Selectionner top produit
                        		<?php } ?>
                        	</label>
                        </div>
                    </div>
				<div class="form-group">
					<?php echo form_submit( 'Modifier le produit',  'Modifier le produit',  'class="btn btn-primary"'); ?>
				</div>

			<?php echo form_close(); ?>
		</div>
 
	</div> 
</div>