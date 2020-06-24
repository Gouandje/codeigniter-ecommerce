

<div class="content-wrapper">
	<div class="row padtop"> 

		<div class="col-md-6 col-md-offset-3">

			<h2>Ajouter une nouvelle catégorie</h2><br/>

		  <?php if($this->session->flashdata('class')): ?>
          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        
         <?php endif; ?>
			<?php echo  form_open_multipart('index.php/admin/addCategory',  '', ''); ?>
				<div class="form-group">
					<?php echo form_input( 'categoryName', '',  'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_upload( 'catDp',  '',  ''); ?>
				</div>
				<div class="form-group">
					<?php echo form_submit( 'Ajouter une catégorie',  'Ajouter une catégorie',  'class="btn btn-primary"'); ?>
				</div>
<!-- 				<div class="form-group">
					<?php //echo form_input(data: 'categoryName', value: '', extra: 'class="form-control"'); ?>
				</div> -->
			<?php echo form_close(); ?>
		</div>
	</div>
</div>