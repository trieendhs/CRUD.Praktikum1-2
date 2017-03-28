<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function index()
	{
		$this->load->model('pegawai_model');
		$data["pegawai_list"] = $this->pegawai_model->getDataPegawai();
		$this->load->view('pegawai',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		//public function customAlpha($str) 
		//{
    		//if ( !preg_match('/^[a-z .,\-]+$/i',$str) )
    		//{	
        	//return false;
    		//}
		//}
    	//$this->form_validation->set_rules('nama', 'Nama','required|callback_customAlpha');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|numeric');
		$this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->load->model('pegawai_model');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_pegawai_view');

		}else{
			$this->pegawai_model->insertPegawai();
			$this->load->view('tambah_pegawai_sukses');

		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{

		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		/*function alpha_dash_space($str_in)
		{
			if (! preg_match("/^([-a-z0-9_ ])+$/i", $str_in)) {
    			$this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha-numeric characters, spaces, underscores, and dashes.');
    			return FALSE;
    		} else {
    			return TRUE;
    		}
    	} 
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_customAlpha');
		//$this->form_validation->set_rules('nama', 'Nama','required|callback_alpha_dash_space');
		*/
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|numeric');
		$this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		

		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('pegawai_model');
		$data['pegawai']=$this->pegawai_model->getPegawai($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_pegawai_view',$data);

		}else{
			$this->pegawai_model->updateById($id);
			$this->load->view('edit_pegawai_sukses');

		}
	}

	public function delete()
	{
		
		$this->load->model('pegawai_model');
		$id = $this->uri->segment(3);
		$this->pegawai_model->deleteById($id);
		redirect('pegawai/index');
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>