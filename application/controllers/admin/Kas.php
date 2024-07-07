<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Kas extends CI_Controller
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
        $data['title']      = 'Data Kas';
        $data['subtitle']   = 'Semua data Kas akan muncul disini';

        $data['kas']   = $this->m_model->get_desc('tb_kas');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/kas');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_kas');
        $this->session->set_flashdata('pesan', 'Data kas Berhasil dihapus!');
        redirect('admin/kas');
    }

    public function insert()
    {
        $tanggal            = $_POST['tanggal'];
        $jenis_kas            = $_POST['jenis_kas'];
        $jumlah            = $_POST['jumlah'];
        $keterangan            = $_POST['keterangan'];
        $data = array(
            'tanggal'         => $tanggal,
            'jenis_kas'           => $jenis_kas,
            'jumlah'             => $jumlah,
            'keterangan'         => $keterangan,
        );

        $this->m_model->insert($data, 'tb_kas');
        $this->session->set_flashdata('pesan', 'Data kas Berhasil Ditambahkan!');
        redirect('admin/kas');
    }

    public function update($id)
    {

        $tanggal            = $_POST['tanggal'];
        $jenis_kas            = $_POST['jenis_kas'];
        $jumlah            = $_POST['jumlah'];
        $keterangan            = $_POST['keterangan'];
        $data = array(
            'tanggal'         => $tanggal,
            'jenis_kas'           => $jenis_kas,
            'jumlah'             => $jumlah,
            'keterangan'         => $keterangan,
        );
        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_kas');
        $this->session->set_flashdata('pesan', 'Data Router Berhasil Diubah!');
        redirect('admin/kas');
    }
}
