<!-- start: Content -->
<div id="content" class="span10 padtop">


    <div class="row-fluid sortable">		
        <div class="box span12">
            <?php if($this->session->flashdata('class')): ?>
             <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        
             <?php endif; ?>
            
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom de la Marque</th>
                            <th> Description de la Marque</th>
                            <th> Status de la Publication</th>
                            <th>Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php 
                        $i=0;
                            foreach($all_brand as $single_brand){
                                $i++;
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td class="center"><?php echo $single_brand->brand_name;?></td>
                            <td class="center"><?php echo $single_brand->brand_description;?></td>
                            <td class="center">
                                    <?php if ($single_brand->publication_status == 1) { ?>
                                        <span class="label label-success">Published</span>
                                    <?php } else {
                                        ?>
                                        <span class="label label-danger" style="background:red">Unpublished</span>
                                        <?php }
                                    ?>
                                </td>
                                <td class="center">
                                    <?php if ($single_brand->publication_status == 0) { ?>
                                        <a class="btn btn-success" href="<?php echo base_url('index.php/admin/published_brand/' . $single_brand->brand_id); ?>">
                                            <i class="halflings-icon white thumbs-up"></i>  
                                        </a>
                                    <?php } else {
                                        ?>
                                        <a class="btn btn-danger" href="<?php echo base_url('index.php/admin/unpublished_brand/' . $single_brand->brand_id); ?>">
                                            <i class="halflings-icon white thumbs-down"></i>  
                                        </a>
                                        <?php }
                                    ?>

                                    <a class="btn btn-info" href="<?php echo base_url('index.php/admin/editBrand/' . $single_brand->brand_id); ?>">
                                        <i class="halflings-icon white edit"></i>  
                                    </a>
                                    <a class="btn btn-danger" href="<?php echo base_url('index.php/admin/delete_brand/' . $single_brand->brand_id); ?>">
                                        <i class="halflings-icon white trash"></i> 
                                    </a>
                                </td>
                        </tr>
                            <?php }?>
                    </tbody>
                </table>            
            </div>
        </div><!--/span-->

    </div><!--/row-->



</div><!--/.fluid-container-->

<!-- end: Content -->