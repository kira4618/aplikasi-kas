<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Spp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']      = 'Data spp';
        $data['subtitle']   = 'Semua data spp akan muncul disini';

        $data['spp']   = $this->m_model->get_desc('tb_spp');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/spp');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_spp');
        $this->session->set_flashdata('pesan', 'Data spp Berhasil dihapus!');
        redirect('admin/spp');
    }

    public function insert()
    {
        $tahun            = $_POST['tahun'];
        $nominal            = $_POST['nominal'];


        $data = array(
            'tahun'         => $tahun,
            'nominal'           => $nominal,
        );

        $this->m_model->insert($data, 'tb_spp');
        $this->session->set_flashdata('pesan', 'Data spp Berhasil Ditambahkan!');
        redirect('admin/spp');
    }

    public function update($id)
    {

        $tahun            = $_POST['tahun'];
        $nominal          = $_POST['nominal'];


        $data = array(
            'tahun'         => $tahun,
            'nominal'         => $nominal,
        );

        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_spp');
        $this->session->set_flashdata('pesan', 'Data Spp Berhasil Diubah!');
        redirect('admin/spp');
    }
}
