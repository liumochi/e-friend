<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}
    public function about()
    {
        $this->load->view('about');
    }
	
	 public function article(){
		 $this->load->view('article');
	 }
	public function upload(){
		$writer=$this->input->post('writer');
		$content=$this->input->post('content');
		$title=$this->input->post('title');
		$this->load->model('insert_read');
		$this->insert_read->insert_article($writer,$content,$title);
	}
	public function read(){
		$this->load->model('insert_read');
		$total=$this->insert_read->read_article();
		$this->load->library('pagination');
		$config['base_url'] = 'http://localhost:81/phpprac/E-friend/Welcome/read';
		$config['total_rows'] =count($total);
		$config['per_page'] = 10;
		$config['first_link'] = '首页';
		$config['last_link'] = '末页';
		$config['full_tag_open'] = '<div class="paging">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		echo $this->pagination->create_links();
         $offset=$this->uri->segment(3);
		$result=$this->insert_read->paging($offset,$config['per_page']);
		$data=array();
		$data["result"]=$result;
		$this->load->view('typography',$data);
	}
	public function detail($art_id){
		$this->load->model('insert_read');
		$result=$this->insert_read->check_article($art_id);
		$data=array();
		
		if($result){
			$data["result"]=$result;
			$this->load->view('detail',$data);
		}
	}
	public function recompose($art_id){
		$content=$this->input->post('content');
		 $this->load->model('insert_read');
		 $recompose=$this->insert_read->recompose($art_id,$content);
		if($recompose){
		   redirect('Welcome/read');
		}
	}
	//删除表白
	public function del($art_id){
		$this->load->model('insert_read');
		$result=$this->insert_read->del($art_id);
		if($result){
			redirect('Welcome/read');
		}
	}
}
