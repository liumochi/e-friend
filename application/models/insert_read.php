<?php
class insert_read extends CI_Model{
    public function insert_article($writer,$content,$title){
        $array=array(
            'con_content'=>$content,
        );
        $result=$this->db->insert('t_confession',$array);
        if($result){
           redirect('Welcome/read');
        }else{
            echo '上传失败';
        }
    }
    public function read_article(){
        $query=$this->db->get_where('t_confession',array());
        return $query->result();
    }
    public function paging($offset,$num){
        $query=$this->db->get_where('t_confession',array(),$num,$offset);
        return $query->result();
    }
    public function check_article($art_id){
        $query=$this->db->get_where('t_confession',array(
            'con_id'=>$art_id
        ));
        return $query->row();
    }
    public function recompose($id,$content){
        $data=array(
            "con_content"=>$content
        );
       $this->db->where('con_id',$id);
        $result=$this->db->update('t_confession', $data);
        return $result;
    }
    public function del($art_id){
        $query=$this->db->delete('t_confession', array('con_id' => $art_id));
        return $query;
    }
}
?>