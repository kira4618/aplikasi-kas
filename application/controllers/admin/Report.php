<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']        = 'Laporan';
        $data['subtitle']    = 'Semua data laporan kas akan muncul disini';

        $data['kas']    = $this->m_model->get_desc('tb_kas');

        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->m_model->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $url_cetak = 'report/cetak';
            $label = 'Semua Data Laporan Kas';
        } else { // Jika terisi
            $transaksi = $this->m_model->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $url_cetak = 'report/cetak?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir;
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
        }
        $data['transaksi'] = $transaksi;
        $data['url_cetak'] = base_url('index.php/admin/' . $url_cetak);
        $data['label'] = $label;

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/report');
        $this->load->view('admin/templates/footer');
    }

    public function cetak()
    {
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->m_model->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $label = 'Semua Data';
        } else { // Jika terisi
            $transaksi = $this->m_model->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
        }
        $data1 =  $label;
        $data = $transaksi;
        // $data['label'] = $label;
        // $data['transaksi'] = $transaksi;
        // ob_start();
        // $this->load->view('print', $data);
        // $html = ob_get_contents();
        // ob_end_clean();
        // require './assets/libraries/html2pdf/autoload.php'; // Load plugin html2pdfnya
        // $pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');  // Settingan PDFnya
        // $pdf->WriteHTML($html);
        // $pdf->Output('Data Transaksi.pdf', 'D');
        //

        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('L', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Rekap Data Kas ', 0, 1, 'C');
        $pdf->Cell(0, 7,  $data1, 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Tanggal ', 1, 0, 'C');
        $pdf->Cell(37, 6, 'Jenis Kas', 1, 0, 'C');
        $pdf->Cell(34, 6, 'Jumlah', 1, 0, 'C');
        $pdf->Cell(34, 6, 'Keterangan', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 10);

        $gangguan =  $data;
        //$where = array('id' => $id);
        //$gangguan = $this->db->get('tb_pelatihankaryawan')->result();
        $no = 0;
        foreach ($gangguan as $data) {
            $no++;
            $pdf->Cell(10, 6, $no, 1, 0, 'C');
            $pdf->Cell(20, 6, $data->tanggal, 1, 0);
            $pdf->Cell(37, 6, $data->jenis_kas, 1, 0);
            $pdf->Cell(34, 6, $data->jumlah, 1, 0);
            $pdf->Cell(34, 6, $data->keterangan, 1, 1);
        }
        $pdf->Output();
    }
}
