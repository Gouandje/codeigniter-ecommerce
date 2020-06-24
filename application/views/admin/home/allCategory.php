

<div class="content-wrapper">
	<div class="row padtop"> 


		<div class="col-md-6 col-md-offset-3">

		<?php if($this->session->flashdata('class')): ?>
          <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        
         <?php endif; ?>

			<h2>La liste de toutes les catégories</h2><br/>
			<div class="error"></div>
		  
		  <?php if($allcategories): ?>

		  	<table class="table table-dashed">
		  		<thead class="thead-dark">
	                <tr>
	                    <th width="5%" align="center">ID</th>
	                    <th width="10%" align="center">image de la Catégorie</th>
	                    <th width="40%" align="center">Nom de la Catégorie</th>
	                    <!-- <th width="19%">Created</th>
	                    <th width="8%">Status</th> -->
	                    <th width="18%" align="center">Modifier</th>
	                    <th width="18%" align="center">Supprimer</th>
	                </tr>
              </thead>
              <tbody>

		  	<?php foreach ($allcategories as $category): 
		  		$defaultImage = !empty($category->cDp)?'<img src="'.base_url().'assets/categories/'.$category->cDp.'" alt="" style="width: 100px;" />':'';
		  		?>
		  		<tr class="ccat <?php echo $category->cId; ?>">
		  			<td>
		  				<?php echo $category->cId; ?>
		  		    </td>		  			
		  		    <td>
		  				<?php echo $defaultImage; ?>
		  		    </td>


		  		    <td>
		  				<?php echo $category->cName; ?>
		  		    </td>

		  		    <td>
		  		    	<a href="<?php echo site_url('index.php/admin/editCategorie/'.$category->cId);?>" class="btn btn-info">Modifier</a>
		  				
		  		    </td>
		  		    <td>
		  		    	<a href="javascript: void(0)" class="btn btn-danger delcat" data-id="<?php echo  $category->cId ?>" data-text="<?php echo $this->encryption->encrypt($category->cId) ?>">Supprimer</a>

		  		    </td>
		  		</tr>

		  	<?php endforeach; ?>
		 </table>
		<p><?php echo $links; ?></p>
		<p>&nbsp;</p>

			<?php else: ?>

				Catégories non disponible

		  <?php endif; ?>
		</div>
	</div>
</div>