<!-- start: Content -->
<div id="content" class="span10 padtop">



    <div class="row-fluid sortable">
        <div class="box span12">
            <div id="result">
                <p><?php echo $this->session->flashdata('message');?></p>
            </div>
            <div class="box-content">
                <?php echo form_open_multipart('index.php/admin/save_slider');?>
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="fileInput">Slider Title</label>
                            <div class="controls">
                                <input class="form-control" name="slider_title" type="text"/>
                            </div>
                        </div> 
                        
                         <div class="control-group">
                            <label class="control-label" for="fileInput">Slider Image</label>
                            <div class="controls">
                                <input class="form-control" name="slider_image" type="file"/>
                            </div>
                        </div>
                        
                         <div class="control-group">
                            <label class="control-label" for="fileInput">Slider Link</label>
                            <div class="controls">
                                <input class="form-control"  name="slider_link" type="url"/>
                            </div>
                        </div>
                        
                                
                        <div class="control-group">
                            <label class="control-label" for="textarea2">Publication Status</label>
                            <div class="controls">
                                <select class="form-control" name="publication_status">
                                    <option value="1">Published</option>
                                    <option value="0">UnPublished</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-actions">
                            <button type="submit" id="save_category" class="btn btn-primary">Sauvegarder les modifications</button>
                            <button type="reset" class="btn">Retour</button>
                        </div>
                    </fieldset>
                <?php echo form_close();?>   

            </div>
        </div><!--/span-->

    </div><!--/row-->

    
    
</div><!--/.fluid-container-->

<!-- end: Content -->