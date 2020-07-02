<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prodi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_prodi');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'prodi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'prodi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'prodi/index.html';
            $config['first_url'] = base_url() . 'prodi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_prodi->total_rows($q);
        $prodi = $this->M_prodi->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'prodi_data' => $prodi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('prodi/tb_prodi_list', $data);
    }

    public function read($id) 
    {
        $row = $this->M_prodi->get_by_id($id);
        if ($row) {
            $data = array(
		'No' => $row->No,
		'Nama_Prodi' => $row->Nama_Prodi,
	    );
            $this->load->view('prodi/tb_prodi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prodi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('prodi/create_action'),
	    'No' => set_value('No'),
	    'Nama_Prodi' => set_value('Nama_Prodi'),
	);
        $this->load->view('prodi/tb_prodi_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'Nama_Prodi' => $this->input->post('Nama_Prodi',TRUE),
	    );

            $this->M_prodi->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('prodi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_prodi->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('prodi/update_action'),
		'No' => set_value('No', $row->No),
		'Nama_Prodi' => set_value('Nama_Prodi', $row->Nama_Prodi),
	    );
            $this->load->view('prodi/tb_prodi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prodi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('No', TRUE));
        } else {
            $data = array(
		'Nama_Prodi' => $this->input->post('Nama_Prodi',TRUE),
	    );

            $this->M_prodi->update($this->input->post('No', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('prodi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_prodi->get_by_id($id);

        if ($row) {
            $this->M_prodi->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('prodi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('prodi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('Nama_Prodi', 'nama prodi', 'trim|required');

	$this->form_validation->set_rules('No', 'No', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_prodi.xls";
        $judul = "tb_prodi";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Prodi");

	foreach ($this->M_prodi->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nama_Prodi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tb_prodi.doc");

        $data = array(
            'tb_prodi_data' => $this->M_prodi->get_all(),
            'start' => 0
        );
        
        $this->load->view('prodi/tb_prodi_doc',$data);
    }

}

/* End of file Prodi.php */
/* Location: ./application/controllers/Prodi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-22 10:34:13 */
/* http://harviacode.com */