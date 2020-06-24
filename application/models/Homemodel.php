<?php

class HomeModel extends CI_Model {

    public function get_all_featured_product() {
        $this->db->select('*,(SELECT pimgName FROM product_images WHERE prodId = products.pId ORDER BY pId DESC LIMIT 1) as default_image');
        $this->db->from('products');
        $this->db->join('categories', 'categories.cId=products.categoryId');
        $this->db->join('tbl_brand', 'tbl_brand.brand_id=products.brandId');
        $this->db->order_by('products.pId', 'DESC');
        $this->db->where('products.pStatus', 1);
        $this->db->where('product_feature', 1);
        $this->db->limit(4);
        $info = $this->db->get();
        return $info->result();
    }

    public function get_all_new_product() {
        $this->db->select('*,(SELECT pimgName FROM product_images WHERE prodId = products.pId ORDER BY pId DESC LIMIT 1) as default_image');
        $this->db->from('products');
        $this->db->join('categories', 'categories.cId=products.categoryId');
        $this->db->join('tbl_brand', 'tbl_brand.brand_id=products.brandId');
        $this->db->order_by('products.pId', 'DESC');
        $this->db->where('products.pStatus', 1);
        $this->db->limit(4);
        $info = $this->db->get();
        return $info->result();
    }

    public function get_all_product() {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('categories', 'categories.cId=products.categoryId');
        $this->db->join('tbl_brand', 'tbl_brand.brand_id=products.brandId');
        $this->db->order_by('products.pId', 'DESC');
        $this->db->where('products.pStatus', 1);
        $info = $this->db->get();
        return $info->result();
    }

    public function get_single_product($id) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('categories', 'categories.cId=products.categoryId');
        $this->db->join('tbl_brand', 'tbl_brand.brand_id=products.brandId');
        $this->db->where('products.pId', $id);
        $info = $this->db->get();
        return $info->row();
    }

    public function get_all_category() {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('publication_status', 1);
        $info = $this->db->get();
        return $info->result();
    }

    public function get_all_product_by_cat($id) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('categories', 'categories.cId=products.categoryId');
        $this->db->join('tbl_brand', 'tbl_brand.brand_id=products.brandId');
        $this->db->order_by('products.pId', 'DESC');
        $this->db->where('products.publication_status', 1);
        $this->db->where('categories.cId', $id);
        $info = $this->db->get();
        return $info->result();
    }

    public function get_product_by_id($id) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('categories', 'categories.cId=products.categoryId');
        $this->db->join('tbl_brand', 'tbl_brand.brand_id=products.brandId');
        $this->db->order_by('products.pId', 'DESC');
        $this->db->where('products.publication_status', 1);
        $this->db->where('products.pId', $id);
        $info = $this->db->get();
        return $info->row();
    }

    public function save_customer_info($data) {
        $this->db->insert('tbl_customer', $data);
        return $this->db->insert_id();
    }

    public function save_shipping_address($data) {
        $this->db->insert('tbl_shipping', $data);
        return $this->db->insert_id();
    }

    public function get_customer_info($data) {
        $this->db->select('*');
        $this->db->from('tbl_customer');
        $this->db->where($data);
        $info = $this->db->get();
        return $info->row();
    }

    public function save_payment_info($data) {
        $this->db->insert('tbl_payment', $data);
        return $this->db->insert_id();
    }
    
    public function save_order_info($data) {
        $this->db->insert('tbl_order', $data);
        return $this->db->insert_id();
    }
    
    public function save_order_details_info($oddata){
        $this->db->insert('tbl_order_details', $oddata);
    }
    
    public function get_all_slider_post() {
        $this->db->select('*');
        $this->db->from('tbl_slider');
        $this->db->where('publication_status', 1);
        $info = $this->db->get();
        return $info->result();
    }
    
    public function get_all_popular_posts() {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('publication_status', 1);
        $this->db->limit(4);
        $info = $this->db->get();
        return $info->result();
    }
    
    public function get_all_search_product($search){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('categories', 'categories.cId=products.categoryId');
        $this->db->join('tbl_brand', 'tbl_brand.brand_id=products.brandId');
        $this->db->join('admin', 'admin.aId=products.adminId');
        $this->db->order_by('products.pId', 'DESC');
        $this->db->where('products.publication_status', 1);
        $this->db->like('products.pName',$search,'both');
        $this->db->or_like('products.pDescription',$search,'both');
        // $this->db->or_like('products.product_long_description',$search,'both');
        $this->db->or_like('categories.cName',$search,'both');
        $this->db->or_like('tbl_brand.brand_name',$search,'both');
        $info = $this->db->get();
        return $info->result();
    }

}
