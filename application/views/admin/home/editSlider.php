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
                <form class="form-horizontal" action="<?php echo base_url('index.php/admin/updateSlider/'.$slider->sliderId);?>" method="post" enctype="multipart/form-data">
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="fileInput">Slider Title</label>
                            <div class="controls">
                                <input class="span6 typeahead" value="<?php echo $slider->slider_title;?>" name="slider_title" type="text"/>
                            </div>
                        </div> 
                        
                         <div class="control-group">
                            <label class="control-label" for="fileInput">Slider Image</label>
                            <div class="controls">
                                <input class="span6 typeahead" name="slider_image" type="file"/>
                                <input class="span6 typeahead" value="<?php echo $slider->slider_image;?>" name="slider_delete_image" type="hidden"/>
                            </div>
                        </div>
                        
                        
                         <div class="control-group">
                            <label class="control-label" for="fileInput">Slider Image</label>
                            <div class="controls">
                                <img style="width:200px;height:100px" src="<?php echo base_url('assets/slider/'.$slider->slider_image);?>"/>
                            </div>
                        </div>
                        
                         <div class="control-group">
                            <label class="control-label" for="fileInput">Slider Link</label>
                            <div class="controls">
                                <input class="span6 typeahead" value="<?php echo $slider->slider_link;?>" name="slider_link" type="url"/>
                            </div>
                        </div>
                        
                                
                        <div class="control-group">
                            <label class="control-label" for="textarea2">Publication Status</label>
                            <div class="controls">
                                <select name="publication_status">
                                    <option value="1">Published</option>
                                    <option value="0">UnPublished</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" id="save_category" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div><!--/row-->

    
    
</div><!--/.fluid-container-->

<!-- end: Content -->