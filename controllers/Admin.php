<?php
error_reporting(1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
public function __construct()
    {
        parent::__construct();
  
        $this->load->library('session');
      	$this->load->database(); 
        $this->load->helper('url');
    }


   public function index()
	{
		$this->load->helper('url');
	    if($this->input->post('email'))
		{
		    
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
		$login_query = $this->db->query("select * from tbl_adminlogin where email = '".$email."' and password = '".$password."'");
			
			if($login_query->num_rows() > 0)
			{
				$user_row = $login_query->row();
				
		 		$this->session->set_userdata('admin_id', $user_row->id);
				$this->session->set_userdata('admin_email', $user_row->email);
		 		redirect('admin/dashboard');
			}
			else
			{
				// unsuccessfull login
				$data['error_message'] = 'Email Or Password was wrong';
			}
		}
    	$this->load->view('admin/login');
    
	}


	public function logout()
	{
		$this->load->helper('url');
		$this->session->sess_destroy();
		redirect('Admin');
	}


	public function dashboard()
	{
	    $admin_admin = $this->session->userdata('admin_id');
		if($admin_admin == "")
		{
			redirect('Admin');
		}
		$where=array();

		$sql_users=$this->db->query('SELECT * FROM tbl_bmember ORDER BY id DESC');
		$users=$sql_users->result();
		$data['user_list'] = $users;


	if($this->input->post('Update')){
		    $id=$this->input->post('service_id');
		    $f_name=$this->input->post('f_name');
		    $l_name=$this->input->post('l_name');
		    $email=$this->input->post('email');
		    $courses=$this->input->post('courses');
		    $information=$this->input->post('information');

		    $this->db->query('UPDATE tbl_bmember SET f_name="'.$f_name.'",l_name="'.$l_name.'",email="'.$email.'",courses="'.$courses.'",information="'.$information.'" WHERE id="'.$id.'"');
		    	$this->session->set_flashdata('success', 'User Details updated successfuly.');
			redirect("Admin/dashboard");
		}




	    //$get_company = $this->webservice_common_model->get_where("company_master",$where);
		//$page_data['companies'] = $get_company;
	  //  $this->load->view('admin/includes/header');
    	$this->load->view('admin/dashboard',$data);
    //	$this->load->view('admin/includes/footer');
	}




public function delete_user(){
   $id= $this->input->post('id');
   $this->db->query('DELETE FROM tbl_bmember WHERE id="'.$id.'"');
   $data['success']='1';
   $data['message']='Deleted succesfully';
   echo json_encode($data);
}









}