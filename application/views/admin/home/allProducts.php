

<div id="page-wrapper">

		<div class="row">
         <!--  page header -->
	        <div class="col-lg-12">
	            <h1 class="page-header">&nbspProduits</h1>
	        </div>
         <!-- end  page header -->
        </div>

       <div class="row padtop">
		  <div class="col-md-12">
		  	<div class="panel panel-default">
		  		<div class="panel-heading"><h2>La liste de tous les produits</h2>
		  		</div>

			<?php if($this->session->flashdata('class')): ?>
          		<div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
	           		 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
	                <?php echo $this->session->flashdata('message'); ?>
           		 </div>
        
            <?php endif; ?>


            
			<div class="error"></div>
		  
		  <?php if($allproducts): $i=0; ?>

		  	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		  		<thead class="thead-dark">
	                <tr>
	                    <th width="5%" align="center">ID</th>
	                    <th width="10%" align="center">image du Produit</th>
	                    <th width="18%" align="center">Nom du Produit</th>
	                    <th width="19%" align="center">Prix</th>
	                    <th width="8%" align="center">Status</th>
	                    <th width="8%" align="center">Disponibilité</th>
	                    <th width="18%" align="center" >Voir +</th>
	                    <th width="18%" align="center">Modifier</th>
	                    <th width="18%" align="center">Supprimer</th>
	                </tr>
              </thead>
              <tbody>
		  	<?php foreach ($allproducts as $product): 
		  		 
		  		$i++; 
		  		$defaultImage = !empty($product['default_image'])?'<img src="'.base_url().'assets/produits/'.$product['default_image'].'" alt="" style="width: 80px; height: 80px;" />':'';  
            ?>
		  		<tr class="ccat <?php echo $product['pId']; ?>">
		  			<td>
		  				<?php echo $product['pId']; ?>
		  		    </td>
		  		    <td class="image">
                         <?php echo $defaultImage; ?> 
		  		    	
		  		    </td>

		  		    <td>
		  				<?php echo $product['pName']; ?>
		  		    </td> 
		  		    <td>
		  				<?php echo $product['pPrice']; echo " FCFA"; ?>
		  		    </td> 
		  		     <td>
		  				<?php if ($product['pStatus'] == 1) {
		  					echo "Activé";
		  				}else{
		  					echo "Désactivé";
		  				} ; ?>
		  		    </td>
		  		    <td>
		  				<?php if ($product['pro_availability'] == 1) {
		  					echo "Disponible";
		  				}elseif ($product['pro_availability'] == 2) {
		  					echo "Pas disponible";
		  				}else{
		  					echo "Bientôt Disponible";
		  				} ; ?>
		  		    </td>

		  		    <td>
		  		    	<a href="<?php echo site_url('index.php/admin/view/'.$product['pId']);?>" style="margin-top: 22px;" class="btn btn-warning">Voir+</a>
		  		    </td>


		  		    <td>
		  		    	<a href="<?php echo site_url('index.php/admin/editProducts/'.$product['pId']);?>" style="margin-top: 22px;" class="btn btn-info">Modifier</a>
		  		    </td>
		  		    <td>
		  		    	<a href="<?php echo ('deleteProduct/'.$product['pId']);?>" class="btn btn-danger"    onclick="return confirm('Are you sure to delete data?')?true?false;" style="margin-top: 22px;">Supprimer</a>
		  				
		  		    </td>

		  		</tr>

		  	 <?php endforeach; ?>
		  	</tbody>
		 </table>
		 <p><?php echo $links; ?></p>
		 <p>&nbsp;</p>

			<?php else: ?>

				produits non disponibles

		  <?php endif; ?>
			
		</div>
	</div>
	</div>
</div>