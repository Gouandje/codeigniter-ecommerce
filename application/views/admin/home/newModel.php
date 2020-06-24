



<div class="content-wrapper">
	<div class="row padtop"> 

		<div class="col-md-6 col-md-offset-3">

			<h2>Ajouter une nouveau models</h2><br/>

		  <?php if($this->session->flashdata('class')): ?>
          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        
         <?php endif; ?>
			<?php echo  form_open_multipart('index.php/admin/addModel',  '', ''); ?>
				<div class="form-group">
					<?php echo form_input( 'modelName', '', array('placeholder' =>'Entrez le nom du model', 'class' => 'form-control')); ?>
				</div>
				<div class="form-group">
					<label>Choisir le produit</label>
					<?php 

						$productsOptions = array();

						foreach ($products->result() as $product) {
							
							$productsOptions[$product->pId] = $product->pName; 
						}

						echo form_dropdown('productId', $productsOptions, '', 'class="form-control"');


					?>
				</div>
				<div class="form-group">
					<?php echo form_textarea( 'modelDescription', '', array('placeholder' =>'Entrez la description du model', 'class' => 'form-control')); ?>
				</div>
				<div class="form-group">
					<input type="file" name="mDp" class="form-control">
				</div>
				<div class="form-group">
					<?php echo form_submit( 'Ajouter un model',  'Ajouter un model',  'class="btn btn-primary"'); ?>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
