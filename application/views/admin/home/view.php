<div class="padtop">
    <div class="container">
        <div class="row ">                        
            <article class="col-xs-12 col-sm-6 col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5><?php echo !empty($product['pName'])?$product['pName']:''; ?></h5>	

                        <?php if(!empty($product['images'])){ ?>

                            <?php foreach($product['images'] as $imgRow){ ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div id="imgb_<?php echo $imgRow['pimgId']; ?>">
                                                <img src="<?php echo base_url('assets/produits/'.$imgRow['pimgName']); ?>" width="90px">
                                                <a href="javascript:void(0);" class="badge badge-danger" onclick="deleteImage('<?php echo $imgRow['pimgId']; ?>')">supprimer</a>
                            
                                           </div>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                    <?php } ?>
                    </div>
                <?php } ?>
                     <a href="<?php echo base_url('index.php/admin/allProducts'); ?>" class="btn btn-primary">retour</a>

            </article>

        </div>

    </div>
</div>
<script>
    function deleteImage(pimgId){
        var result = confirm("Vous êtes sûr de supprimé cette image?");
        if(result){
            $.post( "<?php echo base_url('index.php/admin/deleteImage'); ?>", {pimgId:pimgId}, function(resp){
                if(resp == 'ok'){
                    $('#imgb_'+pimgId).remove();
                        alert('l\'image a été supprimé de de cet produit' );
                }else{
                     alert('Quelque chose de mal s\' est produite');
                    }
            });
        }
    }
</script>