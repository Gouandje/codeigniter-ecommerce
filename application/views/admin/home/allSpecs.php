





<div class="content-wrapper">
	<div class="row padtop"> 


		<div class="col-md-6 col-md-offset-3">

			<?php if($this->session->flashdata('class')): ?>
          		<div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
	           		 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
	                <?php echo $this->session->flashdata('message'); ?>
           		 </div>
        
            <?php endif; ?>

            <h2>La liste de tous les produits</h2><br/>
			<div class="error"></div>
		  
		  <?php if($allspecs): ?>

		  	<table class="table table-striped table-bordered">
		  		<thead class="thead-dark">
	                <tr>
	                    <th>ID</th>
	                    <th>Nom Spec</th>
	                    <th>Nom du Model</th>
	                    <th>Date d'enregistrement</th>
	                    <th>Status</th> 
	                    <th>Modifier</th>
	                    <th>Spprimer</th>

	                </tr>
              </thead>
              <tbody>
		  	<?php foreach ($allspecs as $spec): ?>
		  		<tr class="ccat <?php echo $spec->spId; ?>">
		  			<td>
		  				<?php echo $spec->spId; ?>
		  		    </td>
		  		    <td>
		  				<?php echo $spec->spName; ?>
		  		    </td>
		  		    <td>
		  				<?php echo $spec->mName; ?>
		  		    </td>
		  		    <td>
		  				<?php echo $spec->spDate; ?>
		  		    </td>
		  		    <td>
		  				<?php echo $spec->spStatus; ?>
		  		    </td>


		  		    <td>
		  		        <a href="<?php echo site_url('index.php/admin/editSpec/'.$spec->spId);?>" class="btn btn-info">
		  		         Modifier</a>
		  		    </td>
		  		    <td>
		  		    	<a href="javascript: void(0)" class="btn btn-danger delspec" data-id="<?php echo  $spec->spId ?>" data-text="<?php echo $this->encryption->encrypt($spec->spId) ?>">Supprimer</a>
		  				
		  		    </td>
		  		</tr>

		  	 <?php endforeach; ?>
		  	</tbody>
		 </table>
		 <?php echo $links; ?>

			<?php else: ?>

				spécification non disponibles

		  <?php endif; ?>
			
		</div>
	</div>
</div>