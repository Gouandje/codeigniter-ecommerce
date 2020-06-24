

<script type="text/javascript" src="<?php echo base_url();?>/assets/admin/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
	<div class="row padtop"> 

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h3 class="page-header">Ajouter une nouveau produit</h3><br/>	
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
				
			  <?php if($this->session->flashdata('class')): ?>
	          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
	            <?php echo $this->session->flashdata('message'); ?>
	          </div>
	        
	         <?php endif; ?>
				<?php echo  form_open_multipart('index.php/admin/addProduct',  '', ''); ?>
					<div class="form-group">
						<?php echo form_input( 'productName', '', array('placeholder' =>'Entrez le nom du produit', 'class' => 'form-control')); ?>
					</div>
					<div class="form-group">
						<label>Choisir la catégorie</label>
						<?php 

							$categoriesOptions = array();

							foreach ($categories->result() as $category) {
								
								$categoriesOptions[$category->cId] = $category->cName; 
							}

							echo form_dropdown('categoryId', $categoriesOptions, '', 'class="form-control"');


						?>
					</div>

					<div class="form-group">
                         <label>Ajouter une longue Description du Produit </label>
						<textarea  id="ck" class="form-control" rows="3" name="longproductDescription"></textarea>
						<script>CKEDITOR.replace('ck')</script>
						
					</div>
					
					<div class="form-group">
                         <label>Ajouter une courte Description du Produit </label>
						<textarea  class="cleditor" rows="3" name="productDescription"></textarea>
						
					</div>

					

					<div class="form-group">
						<?php echo form_input( 'productQtity', '', array('placeholder' =>'Entrez la quantié du produit', 'class' => 'form-control')); ?>
					</div>
					<div class="form-group">
						<?php echo form_input( 'productPrice', '', array('placeholder' =>'Entrez le prix du produit', 'class' => 'form-control')); ?>
					</div>
					<div class="form-group">
						<label> Status du Produit </label>
						<select class="form-control" name="pro_status">
                            <option>Select One</option>
                                <option value="1">Activé</option>
                                <option value="2">Désactivé</option>
                        </select>
                    </div>
                    <div class="form-group">
                    	<label>Disponibilité du Produit</label>
                    	<select class="form-control" name="pro_availability">
                    		<option>Select One</option>
                    		<option value="1">En Stock</option>
                    		<option value="2">Stock Epuisé</option>
                    		<option value="3">Bientôt Disponible</option>
                    	</select>
                    </div>
                    <div class="form-group">
                    	<label>Top Produit</label>
                    	<div class="checkbox">
                    		<label>
                    			<input type="checkbox" name="top_product" value="1">Selectionner top produit
                    		</label>
                    	</div>
                    </div>
					<div class="form-group">
						<input type="file" name="ProductDp[]" class="form-control" multiple>
						<!-- <?php echo form_upload( 'ProductDp',  '', 'multiple'); ?> -->
					</div>
					<div class="form-group">
						<?php echo form_submit( 'Ajouter un produit',  'Ajouter un produit',  'class="btn btn-primary"'); ?>
					</div>
	<!-- 				<div class="form-group">
						<?php //echo form_input(data: 'categoryName', value: '', extra: 'class="form-control"'); ?>
					</div> -->
				<?php echo form_close(); ?>
			    </div>
			</div>
			</div>
		</div>
		</div>
	</div>
</div>
