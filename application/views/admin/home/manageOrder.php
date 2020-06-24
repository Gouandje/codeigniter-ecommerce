<!-- start: Content -->
<div id="content" class="span10 padtop">


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url('dashboard')?>">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="<?php echo base_url('manage/product')?>">Manage Product</a></li>
    </ul>

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
                            <th>Customer Name</th>
                            <th>Customer Number</th>
                            <th>Customer Phone</th>
                            <th>Total Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php 
                        $i=0;
                        foreach($all_manage_order_info as $single_order){
                            $i++;
                            ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $single_order->customer_name?></td>
                            <td><?php echo $single_order->customer_phone?></td>
                            <td><?php echo $single_order->customer_email?></td>
                            <td><?php echo $this->cart->format_number($single_order->order_total)?> F CFA</td>
                            <td>
                                <a class="btn btn-warning"><?php echo $single_order->actions?></a>
                                <a class="btn btn-danger" href="<?php echo base_url('index.php/admin/orderDetails/'.$single_order->order_id);?>">View</a>
                                <a class="btn btn-success" href="<?php echo base_url('index.php/admin/pdf/'.$single_order->order_id);?>">Download</a>
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