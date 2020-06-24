



<div class="content-wrapper">
	<div class="row padtop"> 

		<div class="col-md-6 col-md-offset-1">

			<h2>Modifier la catégorie</h2><br/>

		  <?php if($this->session->flashdata('class')): ?>
          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        
         <?php endif; ?>
			<?php echo  form_open_multipart('index.php/admin/updateCategory',  '', ''); ?>
			   <input type="hidden" name="xid" value="<?php echo $category[0]['cId']; ?>">
			   <input type="hidden" name="oldImg" value="<?php echo $category[0]['cDp']; ?>">
				<div class="form-group">
					<?php echo form_input( 'categoryName', $category[0]['cName'],  'class="form-control"'); ?>
				</div>
				<div class="form-group">
					<?php echo form_upload( 'catDp',  '',  ''); ?>
				</div>
				<div class="form-group">
					<?php echo form_submit( 'Modifier la catégorie',  'Modifier la catégorie',  'class="btn btn-primary"'); ?>
				</div>
<!-- 				<div class="form-group">
					<?php //echo form_input(data: 'categoryName', value: '', extra: 'class="form-control"'); ?>
				</div> -->
			<?php echo form_close(); ?>
		</div>
		<div class="col-md-6">
			<img src="<?php echo base_url('assets/categories/'.$category[0]['cDp']); ?>" class="img-responsive">
		</div>
	</div>
</div>