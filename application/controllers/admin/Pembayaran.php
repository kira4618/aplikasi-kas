<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
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
		$data['title']		= 'Data Pembayaran';
		$data['subtitle']	= 'Semua data pembayaran akan muncul disini';

		$data['siswa']		= $this->m_model->get_desc('tb_siswa');
		$data['pembayaran']	= $this->m_model->get_desc('tb_pembayaran');
		$data['user']		= $this->m_model->get_desc('tb_user');
		$data['spp']		= $this->m_model->get_desc('tb_spp');

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/pembayaran');
		$this->load->view('admin/templates/footer');
	}

	public function cari()
	{
		$idSiswa = $_POST['id_siswa'];

		redirect("admin/pembayaran/detailpembayaran/$idSiswa");
	}

	public function detailpembayaran($idSiswa)
	{
		$data['title']		= 'Detail Pembayaran';
		$data['subtitle']	= 'Semua detail pembayaran siswa yang dipilih akan muncul disini';

		$data['id_siswa']	= $idSiswa;
		$this->db->where('id', $idSiswa);
		$data['siswa']		= $this->m_model->get_desc('tb_siswa');
		$this->db->where('id_siswa', $idSiswa);
		$data['pembayaran']		= $this->m_model->get_desc('tb_pembayaran');
		$data['spp']		= $this->m_model->get_desc('tb_spp');

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/detailpembayaran');
		$this->load->view('admin/templates/footer');
	}

	public function delete($id, $id_siswa)
	{
		$where = array('id' => $id);

		$this->m_model->delete($where, 'tb_pembayaran');
		$this->session->set_flashdata('pesan', 'Data Pembayaran Berhasil Dihapus!');

		redirect("admin/pembayaran/detailpembayaran/$id_siswa");
	}

	public function insert($id_siswa)
	{
		date_default_timezone_set("Asia/Jakarta");

		$id_siswa		= $id_siswa;
		$idUser			= $this->session->userdata('id');
		$tanggal		= $_POST['tgl_bayar'];
		$nominal		= $_POST['jumlah_bayar'];
		$id_spp		= $_POST['id_spp'];
		$bulan_bayar		= $_POST['bulan_bayar'];

		$data = array(
			'id_siswa' 	=> $id_siswa,
			'id_user' 		=> $idUser,
			'tgl_bayar' 		=> $tanggal,
			'jumlah_bayar' 		=> $nominal,
			'id_spp' 	=> $id_spp,
			'bulan_bayar' 	=> $bulan_bayar,
		);

		$this->m_model->insert($data, 'tb_pembayaran');
		$this->session->set_flashdata('pesan', 'Data Pembayaran Berhasil Ditambahkan!');

		redirect("admin/pembayaran/detailpembayaran/$id_siswa");
	}

	public function update($id, $id_siswa)
	{
		date_default_timezone_set("Asia/Jakarta");

		$id_siswa		= $id_siswa;
		$idUser			= $this->session->userdata('id');
		$tanggal		= $_POST['tgl_bayar'];
		$nominal		= $_POST['jumlah_bayar'];
		$id_spp			= $_POST['id_spp'];
		$bulan_bayar		= $_POST['bulan_bayar'];

		$data = array(
			'id_siswa' 	=> $id_siswa,
			'id_user' 		=> $idUser,
			'tgl_bayar' 		=> $tanggal,
			'jumlah_bayar' 		=> $nominal,
			'id_spp' 	=> $id_spp,
			'bulan_bayar' 	=> $bulan_bayar,
		);

		$where = array('id' => $id);

		$this->m_model->update($where, $data, 'tb_pembayaran');
		$this->session->set_flashdata('pesan', 'Data Pembayaran Berhasil Diubah!');

		redirect("admin/pembayaran/detailpembayaran/$id_siswa");
	}
}
