<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tb_mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tb_mahasiswa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tb_mahasiswa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tb_mahasiswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tb_mahasiswa/index.html';
            $config['first_url'] = base_url() . 'tb_mahasiswa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tb_mahasiswa_model->total_rows($q);
        $tb_mahasiswa = $this->Tb_mahasiswa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tb_mahasiswa_data' => $tb_mahasiswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('tb_mahasiswa/tb_mahasiswa_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tb_mahasiswa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'npm' => $row->npm,
		'nama' => $row->nama,
		'jk' => $row->jk,
		'prodi' => $row->prodi,
	    );
            $this->load->view('tb_mahasiswa/tb_mahasiswa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tb_mahasiswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tb_mahasiswa/create_action'),
	    'id' => set_value('id'),
	    'npm' => set_value('npm'),
	    'nama' => set_value('nama'),
	    'jk' => set_value('jk'),
	    'prodi' => set_value('prodi'),
	);
        $this->load->view('tb_mahasiswa/tb_mahasiswa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'npm' => $this->input->post('npm',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'jk' => $this->input->post('jk',TRUE),
		'prodi' => $this->input->post('prodi',TRUE),
	    );

            $this->Tb_mahasiswa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tb_mahasiswa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tb_mahasiswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tb_mahasiswa/update_action'),
		'id' => set_value('id', $row->id),
		'npm' => set_value('npm', $row->npm),
		'nama' => set_value('nama', $row->nama),
		'jk' => set_value('jk', $row->jk),
		'prodi' => set_value('prodi', $row->prodi),
	    );
            $this->load->view('tb_mahasiswa/tb_mahasiswa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tb_mahasiswa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'npm' => $this->input->post('npm',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'jk' => $this->input->post('jk',TRUE),
		'prodi' => $this->input->post('prodi',TRUE),
	    );

            $this->Tb_mahasiswa_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tb_mahasiswa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tb_mahasiswa_model->get_by_id($id);

        if ($row) {
            $this->Tb_mahasiswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tb_mahasiswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tb_mahasiswa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('npm', 'npm', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jk', 'jk', 'trim|required');
	$this->form_validation->set_rules('prodi', 'prodi', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_mahasiswa.xls";
        $judul = "tb_mahasiswa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Npm");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Jk");
	xlsWriteLabel($tablehead, $kolomhead++, "Prodi");

	foreach ($this->Tb_mahasiswa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->npm);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->prodi);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tb_mahasiswa.doc");

        $data = array(
            'tb_mahasiswa_data' => $this->Tb_mahasiswa_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tb_mahasiswa/tb_mahasiswa_doc',$data);
    }

}

/* End of file Tb_mahasiswa.php */
/* Location: ./application/controllers/Tb_mahasiswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-22 10:34:10 */
/* http://harviacode.com */