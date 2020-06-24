

<div id="content-wrapper">
	<div class="row padtop"> 


		<div class="col-md-12 col-md-offset-3">

		<?php if($this->session->flashdata('class')): ?>
          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        
         <?php endif; ?>

			<h2>La liste de toutes les catégories</h2><br/>
			<div class="error"></div>
		  
		  <?php if($allsubcategorie): ?>

		  	<table class="table table-dashed">
		  		<thead class="thead-dark">
	                <tr>
	                    <th>ID</th>
	                    <th>Nom de la Sous Catégorie</th>
	                    <th>Nom de la Catégorie</th>
	                    <th>Created</th>
	                    <th>Status</th>
	                    <th>Modifier</th>
	                    <th>Supprimer</th>
	                </tr>
              </thead>
              <tbody>

		  	<?php foreach ($allsubcategorie as $subcategory): ?>
		  		<tr class="ccat <?php echo $subcategory->sbCatId; ?>">
		  			<td>
		  				<?php echo $subcategory->sbCatId; ?>
		  		    </td>		  			
		  		    <td>
		  				<?php echo $subcategory->SbCatName; ?>
		  		    </td>


		  		    <td> 		  		    	 
		  		    	<?php echo $subcategory->catId;?>		  		    	
		  		    </td>
		  		    <td> 
		  		    	<?php echo $subcategory->subCatDate;?>
		  		    </td>
		  		    <td> 
		  		    	<?php echo $subcategory->subCatStatus;?>
		  		    </td>

		  		    <td>
		  		    	<a href="<?php echo site_url('index.php/admin/editSubCategory/'.$subcategory->sbCatId);?>" class="btn btn-info">Modifier</a>
		  				
		  		    </td>
		  		    <td>
		  		    	<a href="javascript: void(0)" class="btn btn-danger delsubcat" data-id="<?php echo  $subcategory->sbCatId ?>" data-text="<?php echo $this->encryption->encrypt($subcategory->sbCatId) ?>">Supprimer</a>

		  		    </td>
		  		</tr>

		  	<?php endforeach; ?>
		 </table>
		<p><?php echo $links; ?></p>
		<p>&nbsp;</p>

			<?php else: ?>

				Sous Catégories non disponible

		  <?php endif; ?>
		</div>
	</div>
</div>