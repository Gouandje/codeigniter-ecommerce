$(function() {

	$(document).ready(function(){

		$('.delcat').click(function(){

			var id = $(this).data('id');
			var text = $(this).data('text');
			
			$.ajax({
				type: 'POST', 
				url: surl +'index.php/admin/deleteCategory',
				data: {
					id: id,
					text: text
				},
				success: function(data){
					var ndata = JSON.parse(data);

					if (ndata.return == true) {
						$('.error').text(noData.message);
						$('.ccat'+ id).fadeOut();


					}else if (ndata.return == false) {
						$('.error').text(noData.message);

					}else{
						$('.error').text('Quelque chose de mal s\' est produite');

					}

				},
				error: function(){
					$('.error').text('Quelque chose de mal s\' est produite');
				}
			});
		});

		$('.delsubcat').click(function(){

			var id = $(this).data('id');
			var text = $(this).data('text');
			
			$.ajax({
				type: 'POST', 
				url: surl +'index.php/admin/deleteSubCat',
				data: {
					id: id,
					text: text
				},
				success: function(data){
					var ndata = JSON.parse(data);

					if (ndata.return == true) {
						$('.error').text(noData.message);
						$('.ccat'+ id).fadeOut();


					}else if (ndata.return == false) {
						$('.error').text(noData.message);

					}else{
						$('.error').text('Quelque chose de mal s\' est produite');

					}

				},
				error: function(){
					$('.error').text('Quelque chose de mal s\' est produite');
				}
			});
		});
		$('.delprod').click(function(){

			var id = $(this).data('id');
			var text = $(this).data('text');
			
			$.ajax({
				type: 'POST', 
				url: surl +'index.php/admin/deleteProduct',
				data: {
					id: id,
					text: text
				},
				success: function(data){
					var ndata = JSON.parse(data);

					if (ndata.return == true) {
						$('.error').text(noData.message);
						$('.ccat'+ id).fadeOut();


					}else if (ndata.return == false) {
						$('.error').text(noData.message);

					}else{
						$('.error').text('Quelque chose de mal s\' est produite');

					}

				},
				error: function(){
					$('.error').text('Quelque chose de mal s\' est produite');
				}
			});
		});

		$('.delmodel').click(function(){

			var id = $(this).data('id');
			var text = $(this).data('text');
			
			$.ajax({
				type: 'POST', 
				url: surl +'index.php/admin/deleteModel',
				data: {
					id: id,
					text: text
				},
				success: function(data){
					var ndata = JSON.parse(data);

					if (ndata.return == true) {
						$('.error').text(ndata.message);
						$('.ccat'+ id).fadeOut();


					}else if (ndata.return == false) {
						$('.error').text(ndata.message);

					}else{
						$('.error').text('Quelque chose de mal s\' est produite');

					}

				},
				error: function(){
					$('.error').text('Quelque chose de mal s\' est produite');
				}
			});
		});

		$(function(){
			$('.add_spec').click(function(){
				var sp_count = $('.sp_cn').length;
				var items ="";
				items +="<div class ='form-group contspecval rmov"+sp_count+"'>";
				items +="<input type='text' name='sp_val[]' class='form-control sp_cn' placeholder='Entrez la valeur du spec'>";
				items +="<a href='javascript:void(0)' class='remov_spec' data-id="+sp_count+">-</a>";
				items +="</div>";
				console.log(sp_count);

				if (sp_count <= 5) {
					$('.htmlitems').append(items)
				}

			});

		});
		$('body').on("click", "a.remov_spec",function(){
			var curnt = $(this).data('id');
			console.log(curnt);
			$('.rmov'+curnt).remove();

		});

    
	 });

	 $('.delspec').click(function(){

			var id = $(this).data('id');
			var text = $(this).data('text');
			
			$.ajax({
				type: 'POST', 
				url: surl +'index.php/admin/deleteSpec',
				data: {
					id: id,
					text: text
				},
				success: function(data){
					var ndata = JSON.parse(data);

					if (ndata.return == true) {
						$('.error').text(nData.message);
						$('.ccat'+ id).fadeOut();


					}else if (ndata.return == false) {
						$('.error').text(nData.message);

					}else{
						$('.error').text('Quelque chose de mal s\' est produite');

					}

				},
				error: function(){
					$('.error').text('Quelque chose de mal s\' est produite');
				}
			});
		});
})