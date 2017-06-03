<?php
   class Product_model extends CI_Model{
//       public function get_all_count(){
//           $this->db->select('product.*,img.img_src as prod_img');
//           $this->db->from('t_product product');
//           $this->db->join('t_product_img img','product.prod_id=img.prod_id');
//           $this->db->where('img.is_main',1);
//           return $this->db->count_all_results();
//       }
//        public function get_product($limit,$offset){
//            $this->db->select('product.*,img.img_src as prod_img');
//            $this->db->from('t_product product');
//            $this->db->join('t_product_img img','product.prod_id=img.prod_id');
//            $this->db->where('img.is_main',1);
//            $this->db->limit($limit,$offset);
//           return $this->db->get()->result();
//        }
    public function get_all_count($array){
       $sql = "select product.*, img.img_src as prod_img from t_product product, t_product_img img where product.prod_id=img.prod_id and img.is_main=1";
       if(isset($array['cate_id'])){
           $sql='SELECT prod.*,img.img_src as prod_img FROM(SELECT * FROM t_product where cate_id IN
         (SELECT cate_id FROM t_category WHERE p_id='.$array['cate_id'].'
           UNION
          SELECT cate_id FROM t_category WHERE p_id IN(SELECT cate_id FROM t_category WHERE p_id='.$array['cate_id'].'))) prod,t_product_img img
          where prod.prod_id=img.prod_id AND img.is_main=1';
      }
         return $this->db->query($sql)->num_rows();
      }
    public function get_product($limit,$offset,$array){
        $sql = "select product.*, img.img_src as prod_img from t_product product, t_product_img img where product.prod_id=img.prod_id and img.is_main=1 limit $offset, $limit";
        if(isset($array['tag_id'])){
            $sql='SELECT prod.*,img.img_src AS prod_img FROM t_product prod,t_product_img img WHERE prod.prod_id=img.prod_id AND img.is_main=1 AND prod.prod_id IN
(SELECT prod_id FROM t_product_tag pt WHERE pt.tag_id='.$array['tag_id'].')';
        }else if(isset($array['cate_id'])){
            $sql='SELECT prod.*,img.img_src as prod_img FROM(SELECT * FROM t_product where cate_id IN
          (SELECT cate_id FROM t_category WHERE p_id='.$array['cate_id'].'
           UNION
          SELECT cate_id FROM t_category WHERE p_id IN(SELECT cate_id FROM t_category WHERE p_id='.$array['cate_id'].'))) prod,t_product_img img
          where prod.prod_id=img.prod_id AND img.is_main=1';
        }
        return $this->db->query($sql)->result();
       }
    public function get_prod($prod_id){
        $sql="SELECT t_product.*,t_product_img.img_src as img_src FROM t_product,t_product_img where t_product.prod_id=$prod_id AND t_product_img.prod_id=$prod_id AND t_product_img.is_main=1";
//       return $this->db->get_where('t_product',array('prod_id'=>$prod_id))->row();
        return $this->db->query($sql)->result();
    }
   }
?>