<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller
{
	
	public function index(){
		if ($this->session->userdata('aId')) {
			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/index');
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('error', 'Connectez-vous d\'abord pour accéder au panneau d\'administration','index.php/admin/login');
		}
		
	}

	public function login(){
		$this->load->view('admin/login');

	}

	public function checkAdmin(){
		$data['aEmail'] = $this->input->post('email', true);
		$data['aPassword'] = $this->input->post('passorwd', true);

		if (!empty($data['aEmail']) && !empty($data['aPassword'])){ 

			$admindata = $this->Adminmodel->checkAdmin($data);
			if (count($admindata) == 1){
				$forSession = array(
					'aId'=>$admindata[0]['aId'],
					'aName'=>$admindata[0]['aName'],
					'aEmail'=>$admindata[0]['aEmail'],
					'aImage'=>$admindata[0]['aImage'],

				);
				$this->session->set_userdata($forSession);

				if ($this->session->userdata('aId')) {
					echo "connecté avec succès";
					var_dump($admindata);
					redirect('index.php/admin');
				}
				else{
					echo "session utlisateur pas encore créée";
				}
				
				
			}else{ 

				setFlashData('error', 'Email ou mot de passe incorrect');
				redirect('index.php/admin/login');

			}

		}
		else{

			$this->session->set_flashdata('error', 'Tous les champs sont obligatoire');
			redirect('index.php/admin/login');
		}

	}

	public function logOut(){

		if ($this->session->userdata('aId')) {
			$this->session->set_userdata('aId');
			$this->session->set_flashdata('error', 'Déconnecté avec succès');
			redirect('index.php/admin/login');
		}else{

			$this->session->setFlashData('error', 's\'il vous plait connectez-vous maintenant');
			redirect('index.php/admin/login');

		}

	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////// Catégories traitement ///////////////////////////////////////////////////////////////	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	public function newCategory(){

		if (adminLoggedIn()){
			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/newCategory');
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}     

	}

	public function addCategory(){

		if (adminLoggedIn()) {

			$data['cName'] = $this->input->post('categoryName', true);

			if (!empty($data['cName'])) {
				$path = realpath(APPPATH.'../assets/categories/');
				$config['upload_path'] = $path;
				$config['max_size'] = 200;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('catDp')) {

					$error = $this->upload->display_errors();
				setFlashData('alert-danger',$error, 'index.php/admin/newCategory');
					
				}else{
					$fileName = $this->upload->data();
					$data['cDp'] = $fileName['file_name'];
					// $data['cDate'] = date('dd-MM-YY h:s:sa');
					$data['adminId'] = getAdminId('aId');
				}
				
				$checkData = $this->Adminmodel->checkcategorie($data);
				
				if ($checkData->num_rows() > 0)
				{
					setFlashData('alert-danger','Cette catégorie existe pas encore déjà!', 'index.php/admin/newCategory');
					
				}else
				{
					$addData = $this->Adminmodel->addcategorie($data);
					if ($addData)
					{
						setFlashData('alert-success','catégorie a été ajouté avec succès!!', 'index.php/admin/newCategory');

				    }else
				    {
					 	setFlashData('alert-danger','Desolé la catégorie n\' a pas été sauvée ', 'index.php/admin/newCategory');
					}
				}

			}
			else{
				setFlashData('alert-danger','le nom de la catégorie est obligatoire', 'index.php/admin/newCategory');

			}
			
		}

		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration pour ajouter une catégorie', 'index.php/admin/login');
		}
	}

	public function allCategories(){
		if (adminLoggedIn()) 
		{
			$config['base_url'] = site_url('index.php/admin/allCategories');
			$totalRows = $this->Adminmodel->getAllcategories();
			$config['total_rows'] = $totalRows;
			$config['per_page'] = 10;
			$config['uri_segment'] = 4;
			$config['full_tag_open'] = '<div id="pagination">';
            $config['full_tag_close'] = '</div>';
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3))? $this->uri->segment(3): 0;
			$data['allcategories'] = $this->Adminmodel->fechAllcategories($config['per_page'], $page);
			$data['links'] = $this->pagination->create_links();
			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/allCategory', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
			
		}else{

			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration pour ajouter une catégorie', 'index.php/admin/login');

		}
	}

	public function editCategorie($cId){
		if (adminLoggedIn()) 
		{
			if (!empty($cId) && isset($cId)) {
				$data['category'] = $this->Adminmodel->checkCategoryById($cId);

				if(count($data['category']) == 1) 
				{		
					$this->load->view('admin/entete/header');
					$this->load->view('admin/entete/css');
					$this->load->view('admin/entete/navtop');
					$this->load->view('admin/entete/navleft');
					$this->load->view('admin/home/editCategory', $data);
					$this->load->view('admin/entete/footer');
					$this->load->view('admin/entete/htmlclose');

				}else{

					setFlashData('alert-danger','catégorie non trouvé', 'index.php/admin/allCategories');

				}
			}else{

					setFlashData('alert-danger','catégorie non trouvé', 'index.php/admin/allCategories');
			}


		}else{

			setFlashData('alert-danger','La catégorie n\'a pas été modifiée!!', 'index.php/admin/allCategories');
		}
	}

	public function updateCategory(){

		if (adminLoggedIn()) {
			
			$data['cName'] = $this->input->post('categoryName', true);

			$cId = $this->input->post('xid', true);
			$oldImg = $this->input->post('oldImg', true);

			if (!empty($data['cName']) && isset($data['cName'])) {

				if (isset($_FILES['catDp']) && is_uploaded_file($_FILES['catDp']['tmp_name'])){
					$path = realpath(APPPATH.'../assets/categories/');
					$config['upload_path'] = $path;
					$config['max_size'] = 200;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('catDp')) {

						$error = $this->upload->display_errors();
					    setFlashData('alert-danger',$error, 'index.php/admin/allCategories');
						
					}else{
						$fileName = $this->upload->data();
						$data['cDp'] = $fileName['file_name'];
				    }
				}

				$reply = $this->Adminmodel->updateCategory($data, $cId);

				if ($reply) {

					if (!empty($data['cDp']) && isset($data['cDp'])) {
						if (file_exists($path.'/'.$oldImg)) {
							unlink($path.'/'.$oldImg);						}
					}

					setFlashData('alert-success','la catégorie modifiée avec succès !!', 'index.php/admin/allCategories');

				}else{

					setFlashData('alert-danger','la modification de la catégorie c\'est mal passée !!', 'index.php/admin/allCategories');
				}

			}else{
			setFlashData('alert-danger','le nom de la catégorie est obligatoire !!', 'index.php/admin/allCategories');

			}

		}else{
			setFlashData('alert-danger','La catégorie n\'a pas été modifiée!!', 'index.php/admin/login');
		}
	}

	public function deleteCategory(){
		if (adminLoggedIn()) {
			if ($this->input->is_ajax_request()) {

				$this->input->post('id', true);
				 $cId = $this->input->post('text', true);

				if (!empty($cId) && isset($cId)) {
					
					$cId = $this->encryption->decrypt($cId);

					$oldImage = $this->Adminmodel->getCategoryImage($cId);

					if (!empty($oldImage) && count($oldImage) == 1) {
						$realImage = $oldImage[0]['cDp'];
			    	}

			    

			    	$checkMD = $this->Adminmodel->deletecategory($cId);
			    	if ($checkMD) {

			    		if (!empty($realImage) && isset($realImage)) {
							$path = realpath(APPPATH.'../assets/categories/');
							if (file_exists($path.'/'.$realImage)) {
								unlink($path.'/'.$realImage);						
							}
					    }
					    
					    $data['return'] = true;
					    $data['message'] = 'La catégorie supprimée avec succès';

					    echo json_encode($data);

					}else{

						$data['return'] = false;
					    $data['message'] = 'La catégorie n\'a pas été supprimée';

					    echo json_encode($data);

						
					}
					
				}else{

					$data['return'] = false;
					    $data['message'] = 'Cette valeur n\'existe pas!!';

					    echo json_encode($data);

				}
			}else{
			setFlashData('alert-danger','La catégorie n\'a pas été modifiée!!', 'index.php/admin');

			}
			
		}else{
			setFlashData('alert-danger','Désolé connectez-vous d\'abbord!', 'index.php/admin/login');

		}
	}
											///////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////	Sous Catégories			//////////////////////////////////
	////////////////////////////////////////						    ////////////////////////////////
										/////////////////////////////////	

    public function newSubCategory(){


    	if (adminLoggedIn()){
			 $data['categories'] = $this->Adminmodel->getCategories();

			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/newSubCategory', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}


    }

    public function addSubCategory(){

    	if (adminLoggedIn()){

    		$data['SbCatName'] = $this->input->post('Sub_CategorieName', true);

    		$data['catId'] = $this->input->post('categoryId', true);
		    $data['adminId'] = getAdminId('aId');


		    if (!empty($data['SbCatName']) && !empty($data['catId'])) {

		    	$checkData = $this->Adminmodel->checksubcategorie($data);

		    	if ($checkData->num_rows()> 0)
				{
					setFlashData('alert-danger','Cette sous catégorie existe déjà!', 'index.php/admin/newSubCategory');
					
				}else{

					$insertSubCat = $this->Adminmodel->addSubCategorie($data);
					
					if ($insertSubCat){

						setFlashData('alert-success','la sous catégorie a été ajoutée avec succès', 'index.php/admin/newSubCategory');
					}else{
						setFlashData('alert-danger','la sous catégorie n\'a pas été ajoutée avec succès', 'index.php/admin/newSubCategory');
					}

				}

		    }else{
				setFlashData('alert-danger','le nom de la sous catégorie est obligatoire', 'index.php/admin/newSubCategory');
		    }
    	}else{
    		setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');
    	}	
    }

    public function allSubCategories(){

		if (adminLoggedIn()){

			$config['base_url'] = site_url('index.php/admin/allSubCategories');
			$totalRows = $this->Adminmodel->getAllSubCategories();
			$config['total_rows'] = $totalRows;
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3))? $this->uri->segment(3): 0;
			$data['allsubcategorie'] = $this->Adminmodel->fechAllSubcategories($config['per_page'], $page);
			$data['links'] = $this->pagination->create_links();
			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/allSubCategory', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}
	}
	public function editSubCategory($sbCatId){

		if (adminLoggedIn()){

			$data['categories'] = $this->Adminmodel->getCategories();
			$data['subcategorie'] = $this->Adminmodel->checksubCategoryById($sbCatId);

			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/editSubCategory', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}
	}
	public function deleteSubCat(){
		if (adminLoggedIn()) {
			if ($this->input->is_ajax_request()) {

				$this->input->post('Id', true);
				$sbCatId = $this->input->post('text', true);

				if (!empty($sbCatId) && isset($sbCatId)) {
					
					$sbCatId = $this->encryption->decrypt($sbCatId);
			    	$checkMD = $this->Adminmodel->deletesubCategory($sbCatId);
			    	if ($checkMD) {
					    $data['return'] = true;
					    $data['message'] = 'La Sous catégorie supprimé avec succès';

					    echo json_encode($data);

					}else{

						$data['return'] = false;
					    $data['message'] = 'L\'élément n\'a pas été supprimé';

					    echo json_decode($data);

						
					}
					
				}else{

					$data['return'] = false;
					$data['message'] = 'Cette valeur n\'existe pas!!';

					    echo json_encode($data);

				}
			}else{
			setFlashData('alert-danger','La sous catégorie n\'a pas été supprimé!!', 'index.php/admin');

			}
			
		}else{
			setFlashData('alert-danger','Désolé connectez-vous d\'abbord!', 'index.php/admin/login');

		}
	}

	public function updateSubCategory(){

		if (adminLoggedIn()) {
			
			$data['catId'] = $this->input->post('categoryId', true);
			$data['SbCatName'] = $this->input->post('Sub_CategorieName', true);

			$sbCatId = $this->input->post('xid', true);

			if (!empty($data['SbCatName']) && isset($data['SbCatName'])) {

				$reply = $this->Adminmodel->updateSubCategory($data, $sbCatId);

				if ($reply) {

					setFlashData('alert-success','la sous catégorie modifiée avec succès !!', 'index.php/admin/allSubCategories');

				}else{

					setFlashData('alert-danger','la modification de la sous catégorie c\'est mal passée !!', 'index.php/admin/allSubCategories');
				}

			}else{
			setFlashData('alert-danger','le nom de la sous catégorie est obligatoire !!', 'index.php/admin/allSubCategories');

			}

		}else{
			setFlashData('alert-danger','La sous catégorie n\'a pas été modifiée!!', 'index.php/admin/login');
		}

	}		
								///////////////////////////////
	////////////////////////////                           ///////////////////////////////////////////////////
	///////////////////////////   traitement de produit   //////////////////////////////////////////////////
	///////////////////////////                          ////////////////////////////////////////////////////
								//////////////////////////////
	public function newProduct(){

		if (adminLoggedIn()){
			 $data['categories'] = $this->Adminmodel->getCategories();

			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/newProduct', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}

	}

	public function addProduct(){

		if (adminLoggedIn()) {
			$errorUpload = '';

			$data['pName'] = $this->input->post('productName', true);
			$data['pDescription'] = $this->input->post('productDescription', true);
			// $data['longproductDescription'] = $this->input->post('longproductDescription', true);&& !empty($data['longproductDescription']) 
			$data['pPrice'] = $this->input->post('productPrice', true);
			$data['pQuantity'] = $this->input->post('productQtity', true);
			$data['pro_availability'] = $this->input->post('pro_availability',true);
			$data['pStatus'] = $this->input->post('pro_status',true);
			$data['top_product'] = $this->input->post('top_product',true);
			$data['categoryId'] = $this->input->post('categoryId', true);
			$data['brandId'] = $this->input->post('brandId', true);
			$data['adminId'] = getAdminId('aId');


			if (!empty($data['pName']) && !empty($data['pDescription']) && !empty($data['pQuantity']) && !empty($data['pro_availability']) && !empty($data['pPrice']) && !empty($data['brandId']) && !empty($data['categoryId'])) {

				$insert = $this->Adminmodel->addproduct($data); 
                $productID = $insert;

                if($insert){

                	if (!empty($_FILES['ProductDp']['name'])) {

                		$filesCount = count($_FILES['ProductDp']['name']);
                		for($i = 0; $i <$filesCount; $i++){

                			$_FILES['file']['name'] = $_FILES['ProductDp']['name'][$i]; 
	                        $_FILES['file']['type'] = $_FILES['ProductDp']['type'][$i]; 
	                        $_FILES['file']['tmp_name'] = $_FILES['ProductDp']['tmp_name'][$i]; 
	                        $_FILES['file']['error'] = $_FILES['ProductDp']['error'][$i]; 
	                        $_FILES['file']['size']  = $_FILES['ProductDp']['size'][$i]; 

	                        $path = realpath(APPPATH.'../assets/produits/');
							$config['upload_path'] = $path;
							$config['max_size'] = 2000;
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$this->load->library('upload', $config);

							if ($this->upload->do_upload('file')) {

								$fileName = $this->upload->data();
								$uploadData[$i]['prodId'] = $productID;								
								$uploadData[$i]['pimgName'] = $fileName['file_name'];
								$uploadData[$i]['uploadet_at'] = date("Y-m-d H:i:s");
								
						    }else{
                                $errorUpload .= $fileImages[$key].'('.$this->upload->display_errors('', '').') | ';  
						    	$error = $this->upload->display_errors();
								setFlashData('alert-danger',$error, 'index.php/admin/newProduct');	
						    }
                		}
                        $errorUpload = !empty($errorUpload)?' Upload Error: '.trim($errorUpload, ' | '):''; 

                		if (!empty($uploadData)) {

	                			$addData = $this->Adminmodel->insertImage($uploadData);	
	                	}
	                	setFlashData('alert-success','produit a été ajouté avec succès!!', 'index.php/admin/newProduct');

				    }else{
						setFlashData('alert-danger','le champ d\'image ne doit pas être vide!!','index.php/admin/newProduct');

				    }

                }

			}
			else{
				setFlashData('alert-danger','le nom du produit est obligatoire', 'index.php/admin/newProduct');

			}


		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration pour ajouter une catégorie', 'index.php/admin/login');
		}	
	}   				

	public function allProducts(){

		if (adminLoggedIn()){

			$config['base_url'] = site_url('index.php/admin/allProducts');
			$totalRows = $this->Adminmodel->getAllproducts();
			$config['total_rows'] = $totalRows;
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3))? $this->uri->segment(3): 0;
			$data['allproducts'] = $this->Adminmodel->fechAllproducts($config['per_page'], $page);
			$data['links'] = $this->pagination->create_links();
			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/allProducts', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}

	}

	public function view($pId){
		if (adminLoggedIn()) {

			$data = array(); 
         
	        // Check whether id is not empty 
	        if(!empty($pId)){ 
	            $data['product'] = $this->Adminmodel->getProduct($pId); 
	            // $data['pName'] = $data['products']['pName']; 
	             
	            // Load the details page view 
	            $this->load->view('admin/entete/header');
				$this->load->view('admin/entete/css');
				$this->load->view('admin/entete/navtop');
				$this->load->view('admin/entete/navleft');
				$this->load->view('admin/home/view', $data);
				$this->load->view('admin/entete/footer');
				$this->load->view('admin/entete/htmlclose');
	        }else{
	        	setFlashData('alert-danger','Produit n\'a pas été modifiénavec succès', 'index.php/admin/allProducts');
            } 
			# code...
		}else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');
		}
        
    }

	public function editProducts($pId){
		if (adminLoggedIn()) 
		{
			// if (!empty($pId) && isset($pId)) {
				$data['categories'] = $this->Adminmodel->getCategories();
				$data['product'] = $this->Adminmodel->checkProductById($pId);

		
					$this->load->view('admin/entete/header');
					$this->load->view('admin/entete/css');
					$this->load->view('admin/entete/navtop');
					$this->load->view('admin/entete/navleft');
					$this->load->view('admin/home/editProduct', $data);
					$this->load->view('admin/entete/footer');
					$this->load->view('admin/entete/htmlclose');
			// }else{

			// 		setFlashData('alert-danger','produit non trouvé', 'index.php/admin/allProducts');
			// }


		}else{

			setFlashData('alert-danger','La vous devez-vous connecté!!', 'index.php/admin/login');
		}
	} 

	public function updateProduct(){
		if (adminLoggedIn()) {

			$errorUpload = '';

			$data['pName'] = $this->input->post('productName', true);
			$data['pDescription'] = $this->input->post('productDescription', true);
			$data['pPrice'] = $this->input->post('productPrice', true);
			$data['pQuantity'] = $this->input->post('productQtity', true);
			$data['pro_availability'] = $this->input->post('pro_availability',true);
			$data['pStatus'] = $this->input->post('pro_status',true);
			$data['top_product'] = $this->input->post('top_product',true);

			$data['categoryId'] = $this->input->post('categoryId', true);
			$pId = $this->input->post('xid', true);

			if (!empty($data['pName']) && isset($data['pName'])){

				$data['adminId'] = getAdminId('aId');	
				// var_dump($data);
				// die();			
				$update = $this->Adminmodel->updateProduct($data, $pId);

				if($update){ 
                    if(!empty($_FILES['ProductDp']['name'])){ 
                        $filesCount = count($_FILES['ProductDp']['name']); 
                        for($i = 0; $i < $filesCount; $i++){ 
                            $_FILES['file']['name']     = $_FILES['ProductDp']['name'][$i]; 
                            $_FILES['file']['type']     = $_FILES['ProductDp']['type'][$i]; 
                            $_FILES['file']['tmp_name'] = $_FILES['ProductDp']['tmp_name'][$i]; 
                            $_FILES['file']['error']    = $_FILES['ProductDp']['error'][$i]; 
                            $_FILES['file']['size']     = $_FILES['ProductDp']['size'][$i]; 
                             
                            // File upload configuration 
	                        $path = realpath(APPPATH.'../assets/produits/');
                            $config['upload_path'] = $path; 
                            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                             
                            // Load and initialize upload library 
                            $this->load->library('upload', $config); 
                            $this->upload->initialize($config); 
                             
                            // Upload file to server 
                            if($this->upload->do_upload('file')){ 
                                // Uploaded file data 
                                $fileData = $this->upload->data(); 
                                $uploadData[$i]['prodId'] = $pId; 
                                $uploadData[$i]['pimgName'] = $fileData['file_name']; 
                                $uploadData[$i]['uploadet_at'] = date("Y-m-d H:i:s"); 
                            }else{ 

                                $errorUpload .= $fileImages[$key].'('.$this->upload->display_errors('', '').') | '; 
						    	$error = $this->upload->display_errors();
								setFlashData('alert-danger',$error, 'index.php/admin/allProducts');	

                            } 
                        } 
                         
                        // File upload error message 
                        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                         
                        if(!empty($uploadData)){ 
                            // Insert files data into the database 
                            $insert = $this->Adminmodel->insertImage($uploadData); 
                        } 
                    }
                    setFlashData('alert-success','Produit modifiénavec succès', 'index.php/admin/allProducts'); 
                }else{
                    setFlashData('alert-danger','Produit n\'a pas été modifiénavec succès', 'index.php/admin/allProducts');
                }
			}else{
                    setFlashData('alert-danger','Produit n\'a pas été modifiénavec succès', 'index.php/admin/allProducts');
			}
			
		}else{
			setFlashData('alert-danger','Désolé connectez-vous d\'abbord!', 'index.php/admin/login');		
		}

	}

	public function deleteProduct($pId){
		
		if (adminLoggedIn()) {
			if ($pId){
					
				$ProductData = $this->Adminmodel->getProduct($pId);

				$delete = $this->Adminmodel->deleteproduct($pId); 

				if($delete){ 
		                // Delete images data  
		            $condition = array('prodId' => $pId);  
		            $deleteImg = $this->Adminmodel->deleteImageProduct($condition);  
		                  
		                // Remove files from the server  
		            if(!empty($ProductData['images'])){  
		                    foreach($ProductData['images'] as $img){  
		                        @unlink('assets/produits/'.$img['file_name']);  
		                    }  
		                }  
		                 
		                setFlashData('alert-success', 'Produit supprimé avec succès.', 'index.php/admin/allProducts'); 
           		    }else{ 
                		setFlashData('alert-danger', 'Some problems occurred, please try again.','index.php/admin/allProducts'); 
                    } 

			}else{

				setFlashData('alert-danger', 'Some problems occurred, please try again.','index.php/admin/allProducts');
			}
			
		}else{
			setFlashData('alert-danger','Désolé connectez-vous d\'abbord!', 'index.php/admin/login');		
		}
    } 
     
    public function deleteImage(){ 
        $status  = 'err';  
        // If post request is submitted via ajax 
        if($this->input->post('pimgId')){ 
            $pimgId = $this->input->post('pimgId'); 
            $imgData = $this->Adminmodel->getImgRow($pimgId); 
             
            // Delete image data 
            $con = array('pimgId' => $pimgId); 
            $delete = $this->Adminmodel->deleteImageProduct($con); 
             
            if($delete){ 
                // Remove files from the server  
                @unlink('assets/produits/'.$imgData['file_name']);  
                $status = 'ok';  
            } 
        } 
        echo $status;die;  

	}



	public function newModel(){

		if (adminLoggedIn()){
			$data['products'] = $this->Adminmodel->getProducts();

			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/newModel', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}

	}
	public function addModel(){

			if (adminLoggedIn()) {

				$data['mName'] = $this->input->post('modelName', true);
				$data['mDescription'] = $this->input->post('modelDescription', true);
				$data['mDp'] = $this->input->post('mDp', true);
				$data['productId'] = $this->input->post('productId', true);
				$data['adminId'] = getAdminId('aId');

				if (!empty($data['mName']) && !empty($data['mDescription']) && !empty($data['productId'])) {

					$path = realpath(APPPATH.'../assets/models/');
					$config['upload_path'] = $path;
					$config['max_size'] = 200;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('mDp')) {

						$error = $this->upload->display_errors();
					setFlashData('alert-danger',$error, 'index.php/admin/newModel');
						
					}else{
						$fileName = $this->upload->data();
						$data['mDp'] = $fileName['file_name'];
						// $data['mDate'] = date('dd-MM-YY h:s:sa');
						$data['adminId'] = getAdminId('aId');
					}
					$checkData = $this->Adminmodel->checkmodels($data);
				
					if ($checkData->num_rows() > 0)
					{
						setFlashData('alert-danger','Cette catégorie existe pas encore déjà!', 'index.php/admin/newModel');
						
					}else
					{
						$addData = $this->Adminmodel->addmodels($data);
						if ($addData)
						{
							setFlashData('alert-success','catégorie a été ajouté avec succès!!', 'index.php/admin/newModel');

					    }else
					    {
						 	setFlashData('alert-danger','Desolé la catégorie n\' a pas été sauvée ', 'index.php/admin/newModel');
						}
				    }
					
				}else{
					setFlashData('alert-danger','le nom de la catégorie est obligatoire', 'index.php/admin/newModel');

			    }


			}else{
				setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');
			}

	}

	public function allModels(){
		if (adminLoggedIn()) 
		{
			$config['base_url'] = site_url('index.php/admin/allModels');
			$totalRows = $this->Adminmodel->getAllmodels();
			$config['total_rows'] = $totalRows;
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3))? $this->uri->segment(3): 0;
			$data['allmodels'] = $this->Adminmodel->fechAllmodels($config['per_page'], $page);
			$data['links'] = $this->pagination->create_links();
			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/allmodels', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
			
		}else{

			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration pour ajouter un model', 'index.php/admin/login');

		}
	}
	
	public function editModel($mdId){
		if (adminLoggedIn()) 
		{
			if (!empty($mdId) && isset($mdId)) {
				$data['model'] = $this->Adminmodel->checkmodelById($mdId);

				if(count($data['model']) == 1) 
				{		
					$this->load->view('admin/entete/header');
					$this->load->view('admin/entete/css');
					$this->load->view('admin/entete/navtop');
					$this->load->view('admin/entete/navleft');
					$this->load->view('admin/home/editModel', $data);
					$this->load->view('admin/entete/footer');
					$this->load->view('admin/entete/htmlclose');

				}else{

					setFlashData('alert-danger','catégorie non trouvé', 'index.php/admin/allModels');

				}
			}else{

					setFlashData('alert-danger','catégorie non trouvé', 'index.php/admin/allModels');
			}


		}else{

			setFlashData('alert-danger','La catégorie n\'a pas été modifiée!!', 'index.php/admin/allModels');
		}
	}

	public function updateModel(){

		if (adminLoggedIn()) {
			
			$data['mName'] = $this->input->post('modelName', true);

			$mdId = $this->input->post('xid', true);
			$oldImg = $this->input->post('oldImg', true);

			if (!empty($data['mName']) && isset($data['mName'])) {

				if (isset($_FILES['mDp']) && is_uploaded_file($_FILES['mDp']['tmp_name'])) {
					$path = realpath(APPPATH.'../assets/models/');
					$config['upload_path'] = $path;
					$config['max_size'] = 200;
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('catDp')) {

						$error = $this->upload->display_errors();
					    setFlashData('alert-danger',$error, 'index.php/admin/allModels');
						
					}else{
						$fileName = $this->upload->data();
						$data['mDp'] = $fileName['file_name'];
				    }
				}

				$reply = $this->Adminmodel->updatemodel($data, $cId);

				if ($reply) {

					if (!empty($data['mDp']) && isset($data['mDp'])) {
						if (file_exists($path.'/'.$oldImg)) {
							unlink($path.'/'.$oldImg);						}
					}

					setFlashData('alert-success','le model modifié avec succès !!', 'index.php/admin/allModels');

				}else{

					setFlashData('alert-danger','le modification de la model c\'est mal passée !!', 'index.php/admin/allModels');
				}

			}else{
			setFlashData('alert-danger','le nom du model est obligatoire !!', 'index.php/admin/allModels');

			}

		}else{
			setFlashData('alert-danger','le model n\'a pas été modifié!!', 'index.php/admin/login');
		}
	}

	public function deleteModel(){
		if (adminLoggedIn()) {
			if ($this->input->is_ajax_request()) {

				$this->input->post('id', true);
				 $mdId = $this->input->post('text', true);

				if (!empty($mdId) && isset($mdId)) {
					
					$mdId = $this->encryption->decrypt($mdId);

					$oldImage = $this->Adminmodel->getModelImage($mdId);

					if (!empty($oldImage) && count($oldImage) == 1) {
						$realImage = $oldImage[0]['mDp'];
			    	}

			    

			    	$checkMD = $this->Adminmodel->deletemodel($mdId);
			    	if ($checkMD) {

			    		if (!empty($realImage) && isset($realImage)) {
							$path = realpath(APPPATH.'../assets/models/');
							if (file_exists($path.'/'.$realImage)) {
								unlink($path.'/'.$realImage);						
							}
					    }
					    
					    $data['return'] = true;
					    $data['message'] = 'Le model supprimée avec succès';

					    echo json_encode($data);

					}else{

						$data['return'] = false;
					    $data['message'] = 'Le model n\'a pas été supprimé';

					    echo json_encode($data);

						
					}
					
				}else{

					$data['return'] = false;
					    $data['message'] = 'Cette valeur n\'existe pas!!';

					    echo json_encode($data);

				}
			}else{
			setFlashData('alert-danger','Le model n\'a pas été supprimé!!', 'index.php/admin');

			}
			
		}else{
			setFlashData('alert-danger','Désolé connectez-vous d\'abbord!', 'index.php/admin/login');

		}
	}

    public function newSpec(){

		if (adminLoggedIn()){
			$data['models'] = $this->Adminmodel->getModels();

			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/newSpec', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}

	}

	public function addSpec(){

		if (adminLoggedIn()) {

			$data['spName'] = $this->input->post('sp_name', true);
			$specvalues = $this->input->post('sp_val', true);
			$specvalues = array_filter($specvalues);
			$data['modelId'] = $this->input->post('modelId', true);


			if (!empty($data['spName']) && !empty($specvalues) && !empty($data['modelId'])) {

				$data['adminId'] = getAdminId('aId');
				$checkData = $this->Adminmodel->checkspecs($data);
					
				if ($checkData->num_rows()> 0)
				{
					setFlashData('alert-danger','Cette spécifications existe déjà!', 'index.php/admin/newSpec');
					
				}
				else{

					$spId = $this->Adminmodel->checkspecName($data);


					if (is_numeric($spId)) {
						$specValues = array();
						foreach ($specvalues as $specval) {
							$specValues[] = array(	
								'spId' => $spId,
								'adminId' => $data['adminId'],	
								'spvDate' => date("Y-m-d H:i:s"),	
								'spvName' => $specval
							);
						}

						$specvalStatus = $this->Adminmodel->checkspecValues($specValues);

						if ($specvalStatus){
							setFlashData('alert-success','spécifications a été ajouté avec succès!!', 'index.php/admin/newSpec');
						}else{

							setFlashData('alert-danger','Desolé la spécifications n\' a pas été sauvée ', 'index.php/admin/newSpec');
						}	
					}else{
					 	setFlashData('alert-danger','Desolé la spécifications n\' a pas été sauvée ', 'index.php/admin/newSpec');
					}
				}

			}
			else{
				setFlashData('alert-danger','le nom de la spécifications est obligatoire', 'index.php/admin/newSpec');

			}
			
		}

		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration pour ajouter une catégorie', 'index.php/admin/login');
		}

	} 

	public function allSpecs(){
		if (adminLoggedIn()){
			$config['base_url'] = site_url('index.php/admin/allSpecs');
			$totalRows = $this->Adminmodel->getAllspecs();
			$config['total_rows'] = $totalRows;
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$this->load->library('pagination');
			$this->pagination->initialize($config);

			$page = ($this->uri->segment(3))? $this->uri->segment(3): 0;
			$data['allspecs'] = $this->Adminmodel->fechAllspecs($config['per_page'], $page);
			$data['links'] = $this->pagination->create_links();

			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/allSpecs', $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}

	}

	public function editSpec($spId){
		if (adminLoggedIn()) 
		{
			if (!empty($spId) && isset($spId)) {
				$data['spec'] = $this->Adminmodel->checkspecById($spId);

				if(count($data['spec']) == 1){

					$data['models'] = $this->Adminmodel->getModels();
					$this->load->view('admin/entete/header');
					$this->load->view('admin/entete/css');
					$this->load->view('admin/entete/navtop');
					$this->load->view('admin/entete/navleft');
					$this->load->view('admin/home/editSpec', $data);
					$this->load->view('admin/entete/footer');
					$this->load->view('admin/entete/htmlclose');

				}else{

					setFlashData('alert-danger','catégorie non trouvé', 'index.php/admin/allSpecs');

				}
			}else{

					setFlashData('alert-danger','catégorie non trouvé', 'index.php/admin/allSpecs');
			}


		}else{

			setFlashData('alert-danger','La catégorie n\'a pas été modifiée!!', 'index.php/admin/allSpecs');
		}
	}


	public function updateSpec(){

		if (adminLoggedIn()) {
			$data['spName'] = $this->input->post('sp_name', true);
			$data['modelId'] = $this->input->post('modelId', true);
			$specId = $this->input->post('specId', true);

			if (!empty($data['spName']) && !empty($specId) && !empty($data['modelId'])) {

				$checkData = $this->Adminmodel->checkspecs($data);

				if ($checkData->num_rows() > 0)
				{
					setFlashData('alert-danger','Cette spécifications existe pas encore déjà!', 'index.php/admin/allSpecs');
					
				}else{

					$updateSpec = $this->Adminmodel->updatespec($data , $specId);
					if ($updateSpec) {

						setFlashData('alert-success','la modification de la spécification c\'est bien passée !!', 'index.php/admin/allSpecs');						
					}else{
						setFlashData('alert-danger','la modification de la spécification c\'est mal passée !!', 'index.php/admin/allSpecs');
					}
				}

			}else{
			setFlashData('alert-danger','le nom de la spécification est obligatoire !!', 'index.php/admin/allSpecs');

			}

		}else{
			setFlashData('alert-danger','le model n\'a pas été modifié!!', 'index.php/admin/login');
		}
	}



	public function deleteSpec(){
		if (adminLoggedIn()) {
			if ($this->input->is_ajax_request()) {

				$this->input->post('id', true);
				$spId = $this->input->post('text', true);

				if (!empty($spId) && isset($spId)) {
					
					$spId = $this->encryption->decrypt($spId);
			    	$checkMD = $this->Adminmodel->deletespec($spId);
			    	if ($checkMD) {
					    $data['return'] = true;
					    $data['message'] = 'L\'élémént supprimé avec succès';

					    echo json_encode($data);

					}else{

						$data['return'] = false;
					    $data['message'] = 'L\'élément n\'a pas été supprimé';

					    echo json_encode($data);

						
					}
					
				}else{

					$data['return'] = false;
					    $data['message'] = 'Cette valeur n\'existe pas!!';

					    echo json_encode($data);

				}
			}else{
			setFlashData('alert-danger','Le model n\'a pas été supprimé!!', 'index.php/admin');

			}
			
		}else{
			setFlashData('alert-danger','Désolé connectez-vous d\'abbord!', 'index.php/admin/login');

		}
	}

	public function newSlider(){

		if(adminLoggedIn()){
			 // $data['categories'] = $this->Adminmodel->getCategories();

			$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/newSlider');
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');
		}
		else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

		}

	}

	public function save_slider() {
		if (adminLoggedIn()) {

			$data = array();
        	$data['slider_title'] = $this->input->post('slider_title', true);
        	$data['slider_link'] = $this->input->post('slider_link', true);
        	$data['publication_status'] = $this->input->post('publication_status', true);



        	if (!empty($data['slider_title']) && !empty($data['slider_link'])) {
        		
				$path = realpath(APPPATH.'../assets/slider/');
		        $config['upload_path'] = $path;
		        $config['allowed_types'] = 'gif|jpg|png|jpeg';
		        $config['max_size'] = 4096;
		        $config['max_width'] = 2000;
		        $config['max_height'] = 2000;
				$this->load->library('upload', $config);
		        $this->upload->initialize($config);

		            if (!$this->upload->do_upload('slider_image')) {
		                $error = $this->upload->display_errors();
				        setFlashData('alert-danger',$error, 'index.php/admin/newSlider');
		                // $this->session->set_flashdata('message', $error);
		                // redirect('add/slider');
		            }
		            else{

		                $post_image = $this->upload->data();
		                $data['slider_image'] = $post_image['file_name'];
					    $data['adminId'] = getAdminId('aId');

		            }
		        
		        $result = $this->Adminmodel->save_slider_info($data);
		        if ($result) {

		        	setFlashdata('message', 'Slider Inserted Sucessfully', 'index.php/admin/allSlider');


	            }else{

	            	$this->session->set_flashdata('message', 'Slider Inserted Failed');
	                redirect('index.php/admin/allSlider');
            }
        		
        	}else{
        		setFlashData('alert-danger', 'tous les champs sont obligatoire', 'index.php/admin/newSlider');
        	}
			
		}else{
			setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');
		}
    }

    public function allSlider(){
    	if (adminLoggedIn()) {

    		$data= array();
    		$data['all_slider'] = $this->Adminmodel->getall_slider_info();

    		$this->load->view('admin/entete/header');
			$this->load->view('admin/entete/css');
			$this->load->view('admin/entete/navtop');
			$this->load->view('admin/entete/navleft');
			$this->load->view('admin/home/allSlider' , $data);
			$this->load->view('admin/entete/footer');
			$this->load->view('admin/entete/htmlclose');

    		
    	}else{
    		setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');
    	}
    }

    public function delete_slider($id){

    	if (adminLoggedIn()) {


        unlink('../assets/slider/'.$delete_image->slider_image);
        $result = $this->Adminmodel->delete_slider_info($id);
        if ($result) {
            setFlashdata('alert-success', 'Slider suppriméavec succès','index.php/admin/allSlider');
            
        } else {
            $this->session->set_flashdata('alert-danger', 'erreur de suppression de slide', 'index.php/admin/allSlider');
             
        }
    		
    	}else{

    		setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

    	}
        
    }

    public function editSlider($id){

    	if (adminLoggedIn()) {

    		if (!empty($id) && isset($id)) {
    			// $data= array();
		        $data['slider'] = $this->Adminmodel->edit_slider_info($id);
		        $this->load->view('admin/entete/header');
				$this->load->view('admin/entete/css');
			    $this->load->view('admin/entete/navtop');
				$this->load->view('admin/entete/navleft');
				$this->load->view('admin/home/editSlider', $data);
				$this->load->view('admin/entete/footer');
				$this->load->view('admin/entete/htmlclose');
    		}else{

					setFlashData('alert-danger','slider non trouvé', 'index.php/admin/allSlider');


    		}
    		
    	}else{
    		setFlashData('alert-danger','Connectez-vous d\'abord pour accéder au panneau d\'administration', 'index.php/admin/login');

    	}
        
    }

    public function updateSlider($id){
        $data = array();
        $data['slider_title'] = $this->input->post('slider_title');
        $data['slider_link'] = $this->input->post('slider_link');
        $data['publication_status'] = $this->input->post('publication_status');
        $delete_image = $this->input->post('slider_delete_image');
        
       

        $this->form_validation->set_rules('slider_title', 'Slider Title', 'trim|required');
        $this->form_validation->set_rules('slider_link', 'Slider Link', 'trim|required');
       // $this->form_validation->set_rules('product_image', 'Product Image', 'trim|required');
        $this->form_validation->set_rules('publication_status', 'Publication Status', 'trim|required');

        if (!empty($_FILES['slider_image']['name'])) {

        	$path = realpath(APPPATH.'../assets/slider/');
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 4096;
            $config['max_width'] = 2000;
            $config['max_height'] = 2000;
            $this->load->library('upload', $config); 
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('slider_image')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('message', $error);
                redirect('index.php/admin/allSlider');
            }
            else{
                $post_image = $this->upload->data();
                $data['slider_image'] = $post_image['file_name'];
                unlink('./assets/slider/'.$delete_image);
            }
        }
        if ($this->form_validation->run() == true) {
                    
            
            $result = $this->Adminmodel->update_slider_info($data,$id);

            if ($result) {
                setFlashdata('alert-success', ' mise à jour succès Slider', 'index.php/admin/allSlider');
                
            } else {
                setFlashdata('alert-danger', ' erreur de mise à jour Slider ', 'index.php/admin/allSlider');
               
            }
        } else {
            $this->session->set_flashdata('message', validation_errors());
            redirect('index.php/admin/newSlider');
        }
        
    }

    public function published_slider($id){
        $result = $this->Adminmodel->published_slider_info($id);
        if ($result) {
            setFlashdata('alert-success', 'Published Slider Sucessfully', 'index.php/admin/allSlider');
            
        } else {
            setFlashdata('alert-danger', 'Published Slider  Failed', 'index.php/admin/allSlider');
             
        }
    }
    
    public function unpublished_slider($id){
        $result = $this->Adminmodel->unpublished_slider_info($id);
        if ($result) {
            setFlashdata('alert-success', 'UnPublished Slider Sucessfully', 'index.php/admin/allSlider');
            
        } else {
            setFlashdata('alert-danger', 'UnPublished Slider  Failed', 'index.php/admin/allSlider');
        }
    }

    public function newBrand(){

    	$this->load->view('admin/entete/header');
		$this->load->view('admin/entete/css');
		$this->load->view('admin/entete/navtop');
		$this->load->view('admin/entete/navleft');
		$this->load->view('admin/home/newBrand');
		$this->load->view('admin/entete/footer');
		$this->load->view('admin/entete/htmlclose');

    }

    public function saveBrand(){
        $data = array();
        $data['brand_name']=$this->input->post('brand_name');
        $data['brand_description']=$this->input->post('brand_description');
        $data['publication_status']=$this->input->post('publication_status');
        
        $this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required');
        $this->form_validation->set_rules('brand_description', 'Brand Description', 'trim|required');
        $this->form_validation->set_rules('publication_status', 'Publication Status', 'trim|required');
        
        if($this->form_validation->run() == true){
            $result = $this->Adminmodel->save_brand_info($data);
            if($result){
                setFlashdata('alert-success','Brand Inseted Sucessfully', 'index.php/admin/allBrand');
                
            }
            else{
                setFlashdata('alert-danger','Brand Inserted Failed', 'index.php/admin/allBrand');
               
            }
        }
        else{
            $this->session->set_flashdata('message',validation_errors());
            redirect('index.php/admin/newBrand');
        }
        
    }
    public function allBrand() {
        $data= array();
        $data['all_brand'] = $this->Adminmodel->getall_brand_info();

        $this->load->view('admin/entete/header');
		$this->load->view('admin/entete/css');
		$this->load->view('admin/entete/navtop');
		$this->load->view('admin/entete/navleft');
		$this->load->view('admin/home/allBrand', $data);
		$this->load->view('admin/entete/footer');
		$this->load->view('admin/entete/htmlclose');
        
    }

    public function delete_brand($id){
        $result = $this->Adminmodel->delete_brand_info($id);
        if ($result) {

        	setFlashdata('alert-success', 'Brand Deleted Sucessfully', 'index.php/admin/allBrand');

        } else {
            setFlashdata('alert-danger', 'Brand Deleted Failed', 'index.php/admin/allBrand');
             
        }
    }
    
     public function editBrand($id){
        $data= array();
        $data['brand_info_by_id'] = $this->Adminmodel->edit_brand_info($id);
        $this->load->view('admin/entete/header');
		$this->load->view('admin/entete/css');
		$this->load->view('admin/entete/navtop');
		$this->load->view('admin/entete/navleft');
		$this->load->view('admin/home/editBrand', $data);
		$this->load->view('admin/entete/footer');
		$this->load->view('admin/entete/htmlclose');
    }
    
    public function update_brand($id){
        $data = array();
        $data['brand_name']=$this->input->post('brand_name');
        $data['brand_description']=$this->input->post('brand_description');
        $data['publication_status']=$this->input->post('publication_status');
        
        $this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required');
        $this->form_validation->set_rules('brand_description', 'Brand Description', 'trim|required');
        $this->form_validation->set_rules('publication_status', 'Publication Status', 'trim|required');
        
        if($this->form_validation->run() == true){
            $result = $this->Adminmodel->update_brand_info($data,$id);
            if($result){
                setFlashdata('alert-success','Brand Update Sucessfully', 'index.php/admin/allBrand');
                 
            }
            else{

            	setFlashdata('alert-danger','Brand Update Failed', 'index.php/admin/allBrand');
                
            }
        }
        else{
            $this->session->set_flashdata('message',validation_errors());
            redirect('add/brand');
        }
        
    }
    
    public function published_brand($id){
        $result = $this->Adminmodel->published_brand_info($id);
        if ($result) {
            setFlashdata('alert-success', 'Published Brand Sucessfully', 'index.php/admin/allBrand');
           
        } else {

        	setFlashdata('alert-danger', 'Published Brand  Failed', 'index.php/admin/allBrand');
             
        }
    }
    
    public function unpublished_brand($id){
        $result = $this->Adminmodel->unpublished_brand_info($id);
        if ($result) {
            setFlashdata('alert-success', 'UnPublished Brand Sucessfully', 'index.php/admin/allBrand');
            
        } else {
            $this->session->setFlashdata('alert-danger', 'UnPublished Brand  Failed', 'index.php/admin/allBrand');
            
        }
    }

    public function themeOption(){

    	$this->load->view('admin/entete/header');
		$this->load->view('admin/entete/css');
		$this->load->view('admin/entete/navtop');
		$this->load->view('admin/entete/navleft');
		$this->load->view('admin/home/themeOption');
		$this->load->view('admin/entete/footer');
		$this->load->view('admin/entete/htmlclose');
    }


    public function save_option(){
        
        $data = array();
        $data['site_copyright'] = $this->input->post('site_copyright');
        $data['site_contact_num1'] = $this->input->post('site_contact_num1');
        $data['site_contact_num2'] = $this->input->post('site_contact_num2');
        $data['site_facebook_link'] = $this->input->post('site_facebook_link');
        $data['site_twitter_link'] = $this->input->post('site_twitter_link');
        $data['site_google_plus_link'] = $this->input->post('site_google_plus_link');
        $data['site_email_link'] = $this->input->post('site_email_link');
        $data['contact_title'] = $this->input->post('contact_title');
        $data['contact_subtitle'] = $this->input->post('contact_subtitle');
        $data['contact_description'] = $this->input->post('contact_description');
        $data['company_location'] = $this->input->post('company_location');
        $data['company_number'] = $this->input->post('company_number');
        $data['company_email'] = $this->input->post('company_email');
        $data['company_facebook'] = $this->input->post('company_facebook');
        $data['company_twitter'] = $this->input->post('company_twitter');
        
        $delete_logo = $this->input->post('delete_logo');
        $delete_favicon = $this->input->post('delete_favicon');

        $this->form_validation->set_rules('site_copyright', 'Product Title', 'trim|required');
        $this->form_validation->set_rules('site_contact_num1', 'Product Short Description', 'trim|required');
        $this->form_validation->set_rules('site_contact_num2', 'Product Long Status', 'trim|required');
        $this->form_validation->set_rules('site_facebook_link', 'Product Price', 'trim|required');
        $this->form_validation->set_rules('site_twitter_link', 'Product Quantity', 'trim|required');
        $this->form_validation->set_rules('site_google_plus_link', 'Product Category', 'trim|required');
        $this->form_validation->set_rules('site_email_link', 'Product Brand', 'trim|required');
        $this->form_validation->set_rules('contact_title', 'Product Feature', 'trim');
        $this->form_validation->set_rules('contact_subtitle', 'Publication Status', 'trim|required');
        $this->form_validation->set_rules('contact_description', 'Publication Status', 'trim|required');
        $this->form_validation->set_rules('company_location', 'Publication Status', 'trim|required');
        $this->form_validation->set_rules('company_number', 'Publication Status', 'trim|required');
        $this->form_validation->set_rules('company_email', 'Publication Status', 'trim|required');
        $this->form_validation->set_rules('company_facebook', 'Publication Status', 'trim|required');
        $this->form_validation->set_rules('company_twitter', 'Publication Status', 'trim|required');

        if (!empty($_FILES['site_logo']['name'])) {
        	$path = realpath(APPPATH.'../assets/uploads/');       	
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 555;
            $config['max_width'] = 555;
            $config['max_height'] = 555;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('site_logo')) {
                $error = $this->upload->display_errors();
                setFlashdata('alert-danger', $error, 'index.php/admin/themeOption');
                
            }
            else{
                unlink('./assets/uploads/'.$delete_logo);
                $post_image = $this->upload->data();
                $data['site_logo'] = $post_image['file_name'];
            }
        }
        
        if (!empty($_FILES['site_favicon']['name'])) {
        	$path = realpath(APPPATH.'../assets/uploads/');
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 555;
            $config['max_width'] = 555;
            $config['max_height'] = 555;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('site_favicon')) {
                $error = $this->upload->display_errors();
                setFlashdata('message', $error, 'index.php/admin/themeOption');
               
            }
            else{
                unlink('./assets/uploads/'.$delete_favicon);
                $post_image = $this->upload->data();
                $data['site_favicon'] = $post_image['file_name'];
            }
        }
        
        if ($this->form_validation->run() == true) {
                    
            
            $result = $this->Adminmodel->save_option_info($data);

            if ($result) {
                setFlashdata('alert-success', 'Option Updated Sucessfully', 'index.php/admin/themeOption');
                
            } else {
                setFlashdata('alert-danger', 'Option Updated Failed', 'index.php/admin/themeOption');
                
            }
        } else {
            setFlashdata('alert-danger', validation_errors(), 'index.php/admin/themeOption');
            
        }
    }

    public function manageOrder(){
        $data= array();
        $data['all_manage_order_info'] =$this->Adminmodel->manage_order_info();
        $this->load->view('admin/entete/header');
		$this->load->view('admin/entete/css');
		$this->load->view('admin/entete/navtop');
		$this->load->view('admin/entete/navleft');
		$this->load->view('admin/home/manageOrder', $data);
		$this->load->view('admin/entete/footer');
		$this->load->view('admin/entete/htmlclose');
       
    }
    
    
    public function order_details($order_id){
        $data= array();
        $order_info =$this->Adminmodel->order_info_by_id($order_id);
        $customer_id = $order_info->customer_id;
        $shipping_id = $order_info->shipping_id;
        $payment_id = $order_info->payment_id;
        
        
        $data['customer_info'] =$this->Adminmodel->customer_info_by_id($customer_id);
        $data['shipping_info'] =$this->Adminmodel->shipping_info_by_id($shipping_id);
        $data['payment_info'] =$this->Adminmodel->payment_info_by_id($payment_id);
        $data['order_details_info'] =$this->Adminmodel->orderdetails_info_by_id($order_id);
        $data['order_info'] =$this->Adminmodel->order_info_by_id($order_id);
        $this->load->view('admin/entete/header');
		$this->load->view('admin/entete/css');
		$this->load->view('admin/entete/navtop');
		$this->load->view('admin/entete/navleft');
		$this->load->view('admin/home/orderDetail', $data);
		$this->load->view('admin/entete/footer');
		$this->load->view('admin/entete/htmlclose');
        
    }
    
    public function pdf($order_id) {
        $data = array();
        $order_info = $this->Adminmodel->order_info_by_id($order_id);
        $customer_id = $order_info->customer_id;
        $shipping_id = $order_info->shipping_id;
        $payment_id = $order_info->payment_id;


        $data['customer_info'] = $this->Adminmodel->customer_info_by_id($customer_id);
        $data['shipping_info'] = $this->Adminmodel->shipping_info_by_id($shipping_id);
        $data['payment_info'] = $this->Adminmodel->payment_info_by_id($payment_id);
        $data['order_details_info'] = $this->Adminmodel->orderdetails_info_by_id($order_id);
        $data['order_info'] = $this->Adminmodel->order_info_by_id($order_id);

        $this->load->library('pdf');
        $this->pdf->load_view('admin/pages/pdf', $data);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("commande.pdf");
    }


}