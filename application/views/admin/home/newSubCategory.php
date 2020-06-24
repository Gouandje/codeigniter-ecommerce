


    <!--  page-wrapper -->
    <!-- <div id="page-wrapper">
    	<div class="row padtop">
    		<div class="col-lg-12">
    		    -->
               
<br><br><br>
                <div class="card padtop">
                	<div class="card-header">
                		<h3>Ajouter une nouvelle Sous Catégorie</h3> 
                	</div>
                	<br>
                	<div class="card-content">
                		<div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-10">
	                           <!-- <h5 style='color:red'> <?php echo validation_errors();?></h5> -->
	                           <?php if($this->session->flashdata('class')): ?>
					          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
					            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
					            <?php echo $this->session->flashdata('message'); ?>
					          </div>
					        
					         <?php endif; ?>
					         <?php echo  form_open_multipart('index.php/admin/addSubCategory',  '', ''); ?>
	                                 <?php $cat = $this->Adminmodel->getCategories();?> 
	                                 <label>Catégorie</label>
	                                 <select class="form-control" name="categoryId">
	                                        <option>Select One</option>
	                                       
	                                         <?php
	                                         foreach ($cat->result() as $category) {  ?>
	                                        <option value="<?php echo $category->cId;?>"><?php echo $category->cName?></option>
	                                        <?php } ?>
	                                </select>
	                                <br>
	                                <div class="form-group">
	                                    <label>Nom de la sous Categorie</label>
	                                    <input type="text" class="form-control" value="" name="Sub_CategorieName" required="">
	                                </div><br><br>
	                                 
	                                <button type="submit" class="btn btn-primary">Sauver</button>
	                            <?php echo form_close();?>
	                        </div>
	                    </div>
	                </div>
                	</div>
            </div><br><br><br><br><br><br><br><br><br>
           <!-- End Form Elements -->
       <!--  </div>
    </div>
</div> --> 
<!-- end page-wrapper -->


