<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Kelas extends CI_Controller
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
        $data['title']      = 'Data kelas';
        $data['subtitle']   = 'Semua data kelas akan muncul disini';

        $data['kelas']   = $this->m_model->get_desc('tb_kelas');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/kelas');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_kelas');
        $this->session->set_flashdata('pesan', 'Data kelas Berhasil dihapus!');
        redirect('admin/kelas');
    }

    public function insert()
    {
        $nama_kelas            = $_POST['nama_kelas'];
        $kompetensi_keahlian            = $_POST['kompetensi_keahlian'];


        $data = array(
            'nama_kelas'         => $nama_kelas,
            'kompetensi_keahlian'           => $kompetensi_keahlian,
        );

        $this->m_model->insert($data, 'tb_kelas');
        $this->session->set_flashdata('pesan', 'Data kelas Berhasil Ditambahkan!');
        redirect('admin/kelas');
    }

    public function update($id)
    {

        $nama_kelas            = $_POST['nama_kelas'];
        $kompetensi_keahlian          = $_POST['kompetensi_keahlian'];


        $data = array(
            'nama_kelas'         => $nama_kelas,
            'kompetensi_keahlian'         => $kompetensi_keahlian,
        );

        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_kelas');
        $this->session->set_flashdata('pesan', 'Data Kelas Berhasil Diubah!');
        redirect('admin/kelas');
    }
}
