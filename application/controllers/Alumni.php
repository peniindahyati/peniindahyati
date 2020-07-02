<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alumni extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_alumni');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'alumni/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'alumni/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'alumni/index.html';
            $config['first_url'] = base_url() . 'alumni/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_alumni->total_rows($q);
        $alumni = $this->M_alumni->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'alumni_data' => $alumni,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('adminlte/header');
        $this->load->view('adminlte/navbar');
        $this->load->view('adminlte/sidebar');
        $this->load->view('alumni/tb_alumni_list', $data);
        $this->load->view('adminlte/footer');
    }

    public function read($id) 
    {
        $row = $this->M_alumni->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'npm' => $row->npm,
		'nama' => $row->nama,
		'jk' => $row->jk,
		'alamat' => $row->alamat,
		'prodi' => $row->prodi,
		'angkatan' => $row->angkatan,
		'id_pekerjaan' => $row->id_pekerjaan,
		'alamat_kantor' => $row->alamat_kantor,
		'keterangan' => $row->keterangan,
	    );
            $this->load->view('adminlte/header');
            $this->load->view('adminlte/navbar');
            $this->load->view('adminlte/sidebar');
            $this->load->view('alumni/tb_alumni_read', $data);
            $this->load->view('adminlte/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alumni'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('alumni/create_action'),
	    'id' => set_value('id'),
	    'npm' => set_value('npm'),
	    'nama' => set_value('nama'),
	    'jk' => set_value('jk'),
	    'alamat' => set_value('alamat'),
	    'prodi' => set_value('prodi'),
	    'angkatan' => set_value('angkatan'),
	    'id_pekerjaan' => set_value('id_pekerjaan'),
	    'alamat_kantor' => set_value('alamat_kantor'),
	    'keterangan' => set_value('keterangan'),
	);
        $this->load->view('adminlte/header');
        $this->load->view('adminlte/navbar');
        $this->load->view('adminlte/sidebar');
        $this->load->view('alumni/tb_alumni_form', $data);
        $this->load->view('adminlte/footer');
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
		'alamat' => $this->input->post('alamat',TRUE),
		'prodi' => $this->input->post('prodi',TRUE),
		'angkatan' => $this->input->post('angkatan',TRUE),
		'id_pekerjaan' => $this->input->post('id_pekerjaan',TRUE),
		'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->M_alumni->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('alumni'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_alumni->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('alumni/update_action'),
		'id' => set_value('id', $row->id),
		'npm' => set_value('npm', $row->npm),
		'nama' => set_value('nama', $row->nama),
		'jk' => set_value('jk', $row->jk),
		'alamat' => set_value('alamat', $row->alamat),
		'prodi' => set_value('prodi', $row->prodi),
		'angkatan' => set_value('angkatan', $row->angkatan),
		'id_pekerjaan' => set_value('id_pekerjaan', $row->id_pekerjaan),
		'alamat_kantor' => set_value('alamat_kantor', $row->alamat_kantor),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->load->view('adminlte/header');
            $this->load->view('adminlte/navbar');
            $this->load->view('adminlte/sidebar');
            $this->load->view('alumni/tb_alumni_form', $data);
            $this->load->view('adminlte/footer');

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alumni'));
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
		'alamat' => $this->input->post('alamat',TRUE),
		'prodi' => $this->input->post('prodi',TRUE),
		'angkatan' => $this->input->post('angkatan',TRUE),
		'id_pekerjaan' => $this->input->post('id_pekerjaan',TRUE),
		'alamat_kantor' => $this->input->post('alamat_kantor',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->M_alumni->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('alumni'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_alumni->get_by_id($id);

        if ($row) {
            $this->M_alumni->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('alumni'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('alumni'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('npm', 'npm', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jk', 'jk', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('prodi', 'prodi', 'trim|required');
	$this->form_validation->set_rules('angkatan', 'angkatan', 'trim|required');
	$this->form_validation->set_rules('id_pekerjaan', 'id pekerjaan', 'trim|required');
	$this->form_validation->set_rules('alamat_kantor', 'alamat kantor', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_alumni.xls";
        $judul = "tb_alumni";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Prodi");
	xlsWriteLabel($tablehead, $kolomhead++, "Angkatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Pekerjaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Kantor");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->M_alumni->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->npm);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->prodi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->angkatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_pekerjaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_kantor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tb_alumni.doc");

        $data = array(
            'tb_alumni_data' => $this->M_alumni->get_all(),
            'start' => 0
        );
        
        $this->load->view('alumni/tb_alumni_doc',$data);
    }

}

/* End of file Alumni.php */
/* Location: ./application/controllers/Alumni.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-01 09:14:18 */
/* http://harviacode.com */