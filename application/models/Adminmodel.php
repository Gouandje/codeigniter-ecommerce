<?php

class Adminmodel extends CI_Model
{
	public function checkAdmin($data)
	{
		return $this->db->get_where('admin', $data)
			->result_array();
	}

	public function checkcategorie($data)
	{
	 	return $this->db->get_where('categories', array('cName' => $data['cName'] ));
	}

	public function addcategorie($data = array()){

		if(!empty($data)){ 
            if(!array_key_exists("cDate", $data)){ 
                $data['cDate'] = date("Y-m-d H:i:s"); 
            }
            $insert = $this->db->insert('categories', $data);
            return $insert?$this->db->insert_id():false;     
	    }
	    return false;
	 }

	 public function getAllcategories()
	 {
	 	return $this->db->get_where('categories', array('cStatus' => 1))->num_rows();
	 }

	 public function fechAllcategories($limit, $start)
	 {
	 	$this->db->limit($limit, $start);
	 	$query = $this->db->get_where('categories', array('cStatus' => 1));
	 	if ($query->num_rows() > 0) {
	 		foreach ($query->result() as $row) {
	 			$data[] = $row;

	 		}

	 		return $data;
	    }return false;

	} 
	
	public function checkCategoryById($cId){

		return $this->db->get_where('categories',  array('cId' => $cId))->result_array();
	}

	public function updateCategory($data, $cId)
	{
		$this->db->where('cId', $cId);
		return $this->db->update('categories', $data);
	}

	public function deletecategory($cId){
		$this->db->where('cId', $cId);
		return $this->db->delete('categories');
	}

	public function getCategoryImage($cId){

		return $this->db->select('cDp')
			->from('categories')
			->where('cId', $cId)
			->get()
		->result_array();
	}

	public function getCategories()
	{
		return $this->db->get_where('categories', array('cStatus' =>1));
	}
	////////////////sous catégorie/////////////////////////////

	public function checksubcategorie($data)
	{
	 	return $this->db->get_where('sub_categories', array('SbCatName' => $data['SbCatName'] ));
	}

	public function addSubCategorie($data = array()){
		if(!empty($data)){ 
            if(!array_key_exists("subCatDate", $data)){ 
                $data['subCatDate'] = date("Y-m-d H:i:s"); 
            }
            $insert = $this->db->insert('sub_categories', $data);
            return $insert?$this->db->insert_id():false;     
	    }
	    return false;
	}

	public function getAllSubCategories()
	{
		return $this->db->get_where('sub_categories', array('subCatStatus' =>1))->num_rows();
	}

	public function fechAllSubcategories($limit, $start){

	 	$this->db->limit($limit, $start);
	 	$query = $this->db->get_where('sub_categories', array('subCatStatus' =>1));
	 	if ($query->num_rows() > 0) {
	 		foreach ($query->result() as $row) {
	 			$data[] = $row;
	 		}

	 		return $data;
	    }return false;

	}
	public function checksubCategoryById($sbCatId){

		return $this->db->get_where('sub_categories',  array('sbCatId' => $sbCatId))->result_array();
	}

	public function updateSubCategory($data, $sbCatId)
	{
		$this->db->where('sbCatId', $sbCatId);
		return $this->db->update('sub_categories', $data);
	}

	public function deletesubCategory($sbCatId){
		$this->db->where('sbCatId', $sbCatId);
		return $this->db->delete('sub_categories');
	}

	//////////////////Produits/////////////////////////////////////////


	public function checkproduct($data)
	{
	 	return $this->db->get_where('products', array('pName' => $data['pName'] ));
	}

	public function addproduct($data = array()) { 
        if(!empty($data)){ 
            if(!array_key_exists("pDate", $data)){ 
                $data['pDate'] = date("Y-m-d H:i:s"); 
            }   

            $insert = $this->db->insert('products', $data); 
             
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    } 


	public function insertImage($data = array()) { 
        if(!empty($data)){   
            
            $insert = $this->db->insert_batch('product_images', $data); 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }

    public function getAllproducts()
	{
		$this->db->select("*, (SELECT pimgName FROM product_images WHERE prodId = products.pId ORDER BY pId DESC LIMIT 1) as default_image");
		$this->db->from('products');
		$query = $this->db->get();
        $result = $query->num_rows();
	 	// $result = $query->result_array();
	 	return $result;
	}

	public function fechAllproducts($limit, $start)
	{

	 	$this->db->select("*, (SELECT pimgName FROM product_images WHERE prodId = products.pId ORDER BY pId DESC LIMIT 1) as default_image");
		$this->db->from('products');
		$this->db->limit($limit, $start);
	 	$query = $this->db->get();
	 	return $query->result_array();
	}
	public function checkProductById($pId){
		 $this->db->select('*');
		 $this->db->from('products');
		if ($pId) {

			$this->db->where('pId', $pId); 
        	$query  = $this->db->get(); 
        	$result = ($query->num_rows() > 0)?$query->row_array():array(); 
             
        	if(!empty($result)){ 
	            $this->db->select('*'); 
	            $this->db->from("product_images"); 
	            $this->db->where('prodId', $result['pId']); 
	            $this->db->order_by('pimgId', 'desc'); 
	            $query  = $this->db->get(); 
	            $result2 = ($query->num_rows() > 0)?$query->result_array():array(); 
	            $result['ProductDp'] = $result2;  
            }  
			
		}else{ 
            $this->db->order_by('pId', 'desc'); 
            $query  = $this->db->get(); 
            $result = ($query->num_rows() > 0)?$query->result_array():array(); 
        } 
         
        // return fetched data 
        return !empty($result)?$result:false;
		
	}
	public function getProduct($pId =''){
		$this->db->select("*, (SELECT pimgName FROM product_images WHERE prodId = products.pId ORDER BY pId DESC LIMIT 1) as default_image");
		$this->db->from('products');
		if ($pId) {
			$this->db->where('pId', $pId); 
            $query  = $this->db->get(); 
            $result = ($query->num_rows() > 0)?$query->row_array():array();
            if(!empty($result)){ 
                $this->db->select('*'); 
                $this->db->from('product_images'); 
                $this->db->where('prodId', $result['pId']); 
                $this->db->order_by('pimgId', 'desc'); 
                $query  = $this->db->get(); 
                $result2 = ($query->num_rows() > 0)?$query->result_array():array(); 
                $result['images'] = $result2;  
            }
		}else{ 
            $this->db->order_by('pId', 'desc'); 
            $query  = $this->db->get(); 
            $result = ($query->num_rows() > 0)?$query->result_array():array(); 
        }
        return !empty($result)?$result:false; 
 
	}

	public function updateProduct($data, $pId) { 
        if(!empty($data) && !empty($pId)){ 
            // Add modified date if not included 
            if(!array_key_exists("modified", $data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
             
            // Update gallery data 
            $update = $this->db->update('products', $data, array('pId' => $pId)); 
             
            // Return the status 
            return $update?true:false; 
        } 
        return false; 
    } 

	public function deleteproduct($pId){ 
        // Delete gallery data 
        $delete = $this->db->delete('products', array('pId' => $pId)); 
         
        // Return the status 
        return $delete?true:false; 
    } 
     
    /* 
     * Delete image data from the database 
     * @param array filter data based on the passed parameter 
     */ 
    public function deleteImageProduct($con){ 
        // Delete image data 
        $delete = $this->db->delete('product_images', $con); 
         
        // Return the status 
        return $delete?true:false; 
    } 

	public function getProducts(){
		return $this->db->get_where('products', array('pStatus' => 1));
	} 

	public function getImgRow($pimgId){ 
        $this->db->select('*'); 
        $this->db->from('product_images'); 
        $this->db->where('pimgId', $pimgId); 
        $query  = $this->db->get(); 
        return ($query->num_rows() > 0)?$query->row_array():false; 
    }


	public function checkmodels($data)
	{
	 	return $this->db->get_where('models', array('mName' => $data['mName'] ));
	}

	public function addmodels($data = array()){
		if (!empty($data)) {
			if(!array_key_exists("mDate", $data)){ 
                $data['mDate'] = date("Y-m-d H:i:s"); 
            }
	 	    return $this->db->insert('models', $data);
            return $insert?$this->db->insert_id():false; 
			
		}

	 	return false;
	}

	public function getAllmodels()
	{
	 	return $this->db->get_where('models', array('mStatus' => 1))->num_rows();
	}

	public function fechAllmodels($limit, $start)
	 {
	 	$this->db->limit($limit, $start);
	 	$query = $this->db->get_where('models', array('mStatus' => 1));
	 	if ($query->num_rows() > 0) {
	 		foreach ($query->result() as $row) {
	 			$data[] = $row;

	 		}

	 		return $data;
	    }return false;

	}

	public function checkmodelById($mdId){

		return $this->db->get_where('models',  array('mdId' => $mdId))->result_array();
	}

	public function updatemodel($data, $mdId)
	{
		$this->db->where('mdId', $mdId);
		return $this->db->update('models', $data);
	}

	public function deletemodel($mdId){
		$this->db->where('mdId', $mdId);
		return $this->db->delete('models');
	}

	public function getModelImage($mdId){

		return $this->db->select('mDp')
			->from('models')
			->where('mdId', $mdId)
			->get()
		->result_array();
	}


	public function getModels(){
		return $this->db->get_where('models', array('mStatus' => 1));
	} 

	public function checkspecs($data)
	{
		return $this->db->get_where('specs', array(
	 		'spName' => $data['spName'],
	 		'modelId' => $data['modelId']));
	 	
	}

	public function checkspecName($data = array()){
		if (!empty($data)) {
			if(!array_key_exists("spDate", $data)){ 
                $data['spDate'] = date("Y-m-d H:i:s"); 
            }
            $insert = $this->db->insert('specs', $data);
            return $insert?$this->db->insert_id():false; 	
		}
		return false;
	} 

	public function checkspecValues($values){

		return  $this->db->insert_batch('spec_value', $values);		
	}

	public function getAllspecs()
	{
	 	return $this->db->get_where('specs', array('spStatus' => 1))->num_rows();
	}


	public function fechAllspecs($limit, $start)
	{
	 	$this->db->limit($limit, $start);
	 	$this->db->order_by('spId', 'desc');
	 	$query = $this->db->select('specs.*,models.mName')
	 		->from('specs')
	 		->where('specs.spStatus','1')
	 		->join('models','models.mdId = specs.modelId')
	 		->get();
	 	// $query = $this->db->get_where('specs', array('spStatus' => 1));
	 	if ($query->num_rows() > 0) {
	 		foreach ($query->result() as $row) {
	 			$data[] = $row;

	 		}

	 		return $data;
	    }return false;

	}

	public function checkspecById($spId){

		return $this->db->get_where('specs',  array('spId' => $spId))->result_array();
	}

	public function updatespec($data, $spId)
	{
		$this->db->where('spId', $spId);
		return $this->db->update('specs', $data);
	}

	public function deletespec($spId){
		$this->db->where('spId', $spId);
		return $this->db->delete('specs');
	}

	public function save_slider_info($data){
        return $this->db->insert('slider', $data);
    }

    public function getall_slider_info(){
        $this->db->select('*');
        $this->db->from('slider');
        $info = $this->db->get();
        return $info->result();
    }
    public function edit_slider_info($id){
        $this->db->select('*');
        $this->db->from('slider');
        $this->db->where('sliderId',$id);
        $info = $this->db->get();
        return $info->row();
    }

    public function delete_slider_info($id){
        $this->db->where('sliderId', $id);
        return $this->db->delete('slider');
    }
    
    public function update_slider_info($data,$id){
        $this->db->where('sliderId', $id);
        return $this->db->update('slider', $data);
    }
    
    public function published_slider_info($id) {
        $this->db->set('publication_status', 1);
        $this->db->where('sliderId', $id);
        return $this->db->update('slider');
    }
    
    public function unpublished_slider_info($id) {
        $this->db->set('publication_status', 0);
        $this->db->where('sliderId', $id);
        return $this->db->update('slider');
    }

    public function save_brand_info($data){
        return $this->db->insert('tbl_brand', $data);
    }
    
    public function getall_brand_info(){
        $this->db->select('*');
        $this->db->from('tbl_brand');
        $info = $this->db->get();
        return $info->result();
    }
    
    
    public function edit_brand_info($id){
        $this->db->select('*');
        $this->db->from('tbl_brand');
        $this->db->where('brand_id',$id);
        $info = $this->db->get();
        return $info->row();
    }
    
    public function delete_brand_info($id){
        $this->db->where('brand_id', $id);
        return $this->db->delete('tbl_brand');
    }
    
    public function update_brand_info($data,$id){
        $this->db->where('brand_id', $id);
        return $this->db->update('tbl_brand', $data);
    }
    
    public function published_brand_info($id) {
        $this->db->set('publication_status', 1);
        $this->db->where('brand_id', $id);
        return $this->db->update('tbl_brand');
    }
    
    public function unpublished_brand_info($id) {
        $this->db->set('publication_status', 0);
        $this->db->where('brand_id', $id);
        return $this->db->update('tbl_brand');
    }


    public function save_option_info($data){
        $this->db->where('option_id', 1);
        return $this->db->update('tbl_option', $data);
    }

    public function manage_order_info(){
        $this->db->select('*');
        $this->db->from('tbl_order');
        $this->db->join('customer', 'customer.customer_id = tbl_order.customer_id');
        $this->db->join('tbl_shipping', 'tbl_shipping.shipping_id = tbl_order.shipping_id');
        $result = $this->db->get();
        return $result->result();
    }
    
    public function order_info_by_id($order_id){
        $this->db->select('*');
        $this->db->from('tbl_order');
        $this->db->where('order_id',$order_id);
        $result = $this->db->get();
        return $result->row();
    }
    
    public function customer_info_by_id($custoemr_id){
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('customer_id',$custoemr_id);
        $result = $this->db->get();
        return $result->row();
    }
    
    public function shipping_info_by_id($shipping_id){
        $this->db->select('*');
        $this->db->from('tbl_shipping');
        $this->db->where('shipping_id',$shipping_id);
        $result = $this->db->get();
        return $result->row();
    }
    
    public function payment_info_by_id($payment_id){
        $this->db->select('*');
        $this->db->from('tbl_payment');
        $this->db->where('payment_id',$payment_id);
        $result = $this->db->get();
        return $result->row();
    }
    
    public function orderdetails_info_by_id($order_id){
        $this->db->select('*');
        $this->db->from('tbl_order_details');
        $this->db->where('order_id',$order_id);
        $result = $this->db->get();
        return $result->result();
    }


}