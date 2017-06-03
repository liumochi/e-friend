<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  class User extends CI_Controller{
      public function __construct()
      {
          parent::__construct();
          $this->load->library('pagination');
          $this->load->helper('cookie');
      }
      public function reg(){
//          header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
//          header("Access-Control-Allow-Origin: *");
          $this->load->view('reg');
      }
      public function do_reg(){
          //注册
          header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
          header("Access-Control-Allow-Origin: *");
          $name=$this->input->post('rname');
          $pwd=$this->input->post('rpwd');
          $this->load->model('user_model');
          //检查用户名是否可用
          $rs=$this->user_model->checkName($name);
          if($rs){
              redirect('user/reg');
          }else{
              //用户名可用，插入数据库
              $rs=$this->user_model->getInsert($name,$pwd);
              if($rs){
                  //设置cookie uname;
                  set_cookie('username',$name,60);
                  redirect('user/perfectInformation');

              }else{
                  redirect('user/reg');
              }
          }
      }
      public function perfectInformation(){
          //查找新注册的uid，设置cookie，跳转完善信息页面
          $username=get_cookie("username");
          $this->load->model('user_model');
          $rs=$this->user_model->getInsertUid($username);
//          var_dump($rs) ;
//          echo $rs->uid;
//          die();
          if($rs){
              $uid= $rs->u_id;
              set_cookie('userid',$uid,60);
          }
          $this->load->view('perfectInformation.php');
      }
      public function do_perfectInformation(){
          //完善信息
          $nickName=$this->input->post('nickName');
          $sex=$this->input->post('Sex');
          $birth=$this->input->post('birth');
          $school=$this->input->post('school');
          $tel=$this->input->post('tel');
          $email=$this->input->post('uemail');
          $username=get_cookie("username");
          $uid=get_cookie('userid');
          //获取checkbox值
          $result = [];
          $j=0;
          foreach( $_POST['Hobby'] as $i) {

              $result[$j]=$i;
              $j++;
       }
          $this->load->model('user_model');
          //插入完善信息（不包含checkbox值）
          $rs=$this->user_model->perfectInformation($nickName,$sex,$birth,$school,$tel,$email,$uid);
          //插入checkbox值
          $rs1=$this->user_model->addHobby($username,$result,$uid);
          if($rs && $rs1){
              redirect('user/index');
          }else{
              redirect('user/perfectInformation');
          }
      }
      public function check(){
          //检查用户名是否可用
          header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
          header("Access-Control-Allow-Origin: *");
          $name=$this->input->post('uname');
          $this->load->model('user_model');
          $rs=$this->user_model->checkName($name);
          if ($rs){
              echo 'exist';
          }else{
              echo 'success';
          }
      }
      
      
      public function wer(){
          $name=$this->input->post('num');
          echo  $name;
      }
      public function index(){
          $this->load->view('index.php');
      }
      public function do_login(){
          //登录
          $this->load->model('user_model');
          $name=$this->input->post('lname');
          $pwd=$this->input->post('lpwd');
          $rs=$this->user_model->checkLogin($name,$pwd);
          if($rs){
             set_cookie("username",$name,60);
             redirect('user/index');
          }else{
              redirect('user/reg');
          }
      }
  }
?>