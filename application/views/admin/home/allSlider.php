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
                            <th> Titre Slider</th>
                            <th>Lien Slider</th>
                            <th> Image Slider</th>
                            <th>Status de Publication</th>
                            <th>Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($all_slider as $single_slider) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="center"><?php echo $single_slider->slider_title; ?></td>
                                <td class="center"><a target="_blank" href="<?php echo base_url($single_slider->slider_title);?>">Go To Link</a></td>
                                <td class="center"><img src="<?php echo base_url('assets/slider/'.$single_slider->slider_image);?>" style="width:300px;height:100px"/></td>
                                <td class="center">
                                    <?php if ($single_slider->publication_status == 1) { ?>
                                        <span class="label label-success">Published</span>
                                    <?php } else {
                                        ?>
                                        <span class="label label-danger" style="background:red">Unpublished</span>
                                    <?php }
                                    ?>
                                </td>
                                <td class="center">
                                    <?php if ($single_slider->publication_status == 0) { ?>
                                        <a class="btn btn-success" href="<?php echo base_url('index.php/admin/published_slider/' . $single_slider->sliderId); ?>">
                                            <i class="halflings-icon white thumbs-up"></i>  
                                        </a>
                                    <?php } else {
                                        ?>
                                        <a class="btn btn-danger" href="<?php echo base_url('index.php/admin/unpublished_slider/' . $single_slider->sliderId); ?>">
                                            <i class="halflings-icon white thumbs-down"></i>  
                                        </a>
                                    <?php }
                                    ?>

                                    <a class="btn btn-info" href="<?php echo base_url('index.php/admin/editSlider/' . $single_slider->sliderId); ?>">
                                        <i class="halflings-icon white edit"></i>  
                                    </a>
                                    <a class="btn btn-danger" href="<?php echo base_url('index.php/admin/delete_slider/' . $single_slider->sliderId); ?>">
                                        <i class="halflings-icon white trash"></i> 
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>            
            </div>
        </div><!--/span-->

    </div><!--/row-->



</div><!--/.fluid-container-->

<!-- end: Content -->