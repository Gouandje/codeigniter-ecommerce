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
                <form class="form-horizontal" action="<?php echo base_url('index.php/admin/saveBrand')?>" method="post">
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="fileInput">Brand Name</label>
                            <div class="controls">
                                <input class="span6 typeahead" name="brand_name" id="fileInput" type="text"/>
                            </div>
                        </div>          
                        <div class="control-group">
                            <label class="control-label" for="textarea2">Brand Description</label>
                            <div class="controls">
                                <textarea class="cleditor" id="textarea2" name="brand_description" rows="3"></textarea>
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
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div><!--/row-->


</div><!--/.fluid-container-->

<!-- end: Content -->