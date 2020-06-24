





<div class="content-wrapper">
	<div class="row padtop"> 

		<div class="col-md-6 col-md-offset-1">

			<h2>Modifier la sous catégorie</h2><br/>

		  <?php if($this->session->flashdata('class')): ?>
          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        
         <?php endif; ?>
			<?php echo  form_open_multipart('index.php/admin/updateSubCategory',  '', ''); ?>
			   <input type="hidden" name="xid" value="<?php echo $subcategorie[0]['sbCatId']; ?>">
			   	<div class="form-group">
					<label>Choisir la sous catégorie</label>
					<?php 

						$categoriesOptions = array();

						foreach ($categories->result() as $category) {
							
							$categoriesOptions[$category->cId] = $category->cName; 
						}

						echo form_dropdown('categoryId', $categoriesOptions, $subcategorie[0]['catId'], 'class="form-control"');


					?>
				</div>
				<div class="form-group">
					<label>Nom de la sous catégorie</label>
					<?php echo form_input( 'Sub_CategorieName', $subcategorie[0]['SbCatName'],  'class="form-control"'); ?> 
				</div>

				<div class="form-group">
					<?php echo form_submit( 'Modifier la sous catégorie',  'Modifier la sous catégorie',  'class="btn btn-primary"'); ?>
				</div>
			<?php echo form_close(); ?>
		</div>

	</div>
</div>