<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


		public function __construct()
    {
        parent::__construct();
  
        $this->load->library('session');
      	$this->load->database(); 
        $this->load->helper('url');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		if($this->input->post())
		{
			$f_name = $this->input->post('f_name');
			$l_name = $this->input->post('l_name');
			$email = $this->input->post('email');
			$courses = $this->input->post('courses');

			if(is_uploaded_file($_FILES['image']['tmp_name']))
			{
  				$image=rand(0,9999).$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'.$image);
				}else{
				$image="";
		    }
			$information = $this->input->post('information');
	
			$data = array(
			        'f_name'=>$f_name,
			        'l_name'=>$l_name,
			        'email'=>$email,
			        'courses'=>$courses,
			        'image'=>$image,
			        'information'=>$information
			        
					);
			$this->db->insert('tbl_bmember',$data);
			}



		$this->load->view('index');
	}
}
