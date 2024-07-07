<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_model extends CI_Model
{

	public function get_where($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	public function insert($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_desc($table)
	{
		$this->db->ORDER_BY('id', 'desc');
		return $this->db->get($table);
	}

	public function delete($where, $table)
	{
		$this->db->delete($table, $where);
	}

	public function update($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function view_all()
	{
		return $this->db->get('tb_kas')->result(); // Tampilkan semua data kas
	}

	public function view_by_date($tgl_awal, $tgl_akhir)
	{
		$tgl_awal = $this->db->escape($tgl_awal);
		$tgl_akhir = $this->db->escape($tgl_akhir);
		$this->db->where('DATE(tanggal) BETWEEN ' . $tgl_awal . ' AND ' . $tgl_akhir); // Tambahkan where tanggal nya
		return $this->db->get('tb_kas')->result(); // Tampilkan data santri sesuai tanggal yang diinput oleh user pada filter
	}
}
