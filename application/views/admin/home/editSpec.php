





<div class="content-wrapper">
	<div class="row padtop"> 

		<div class="col-md-6 col-md-offset-3">

			<h2>Ajouter une nouvelle spécifications</h2><br/>

		  <?php if($this->session->flashdata('class')): ?>
          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        
         <?php endif; ?>
			<?php echo  form_open_multipart('index.php/admin/updateSpec',  '', ''); ?>
				<div class="form-group">
					<label>Choisir le model</label>
					<?php 

						$modelsOptions = array();

						foreach ($models->result() as $model) {
							
							$modelsOptions[$model->mdId] = $model->mName; 
						}

						echo form_dropdown('modelId', $modelsOptions, '', 'class="form-control"');


					?>
				</div>
				<input type="hidden" value="<?php echo$spec[0]['spId']; ?>" name="specId">
				<div class="form-group">
					<?php echo form_input( 'sp_name', $spec[0]['spName'], array('placeholder' =>'Entrez le nom de la spécifications', 'class' => 'form-control')); ?>
				</div>
				<div class="form-group">
					<?php echo form_submit( 'Ajouter une spécifications', 'Ajouter une spécifications',  'class="btn btn-primary"'); ?>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
