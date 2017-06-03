<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model{
    //检查用户名是否可用
    public function checkName($name){
        $query= $this->db->query("select * from t_user where u_name='$name'");
        return $query->row();
    }
    //注册插入用户名、密码
    public function getInsert($name,$pwd){
        $query=$this->db->query("insert into t_user(u_id,u_name,u_pwd) values(null,'$name','$pwd')");

        return $query;
    }
    //注册后获取uid
    public function getInsertUid($name){
        $query= $this->db->query("select u_id from t_user where u_name='$name'");
       
//        return $query->result();
        return $query->row();
       
    }
    //登录验证用户名、密码是否正确
    public function checkLogin($name,$pwd){
        $query=$this->db->query("select * from t_user where u_name='$name' and u_pwd='$pwd'");
        return $query->row();
    }
    //完善信息，插入数据库
    public function perfectInformation($nickName,$sex,$birth,$school,$tel,$email,$uid){
        $query=$this->db->query("update t_user set u_nickname='$nickName',u_sex='$sex',u_birthy='$birth',u_tel='$tel',u_school='$school',u_mail='$email' where u_id='$uid'");
        return $query;
    }
    //插入兴趣 爱好
    public function addHobby($username,$result,$uid){
//        echo count($result);
//        echo var_dump($result) ;
//        die();
        for($i=0;$i<count($result);$i++){
            $query= $query=$this->db->query("insert into t_user_cate(id,u_name,cate_id) values(null,'$username','$result[$i]')");

        }
        return $query;
    }

}

?>