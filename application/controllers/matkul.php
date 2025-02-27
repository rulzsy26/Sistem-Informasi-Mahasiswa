<?php
defined('BASEPATH') or exit('No direct script access allowed');

class matkul extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_matkul'); // Memuat model M_dosen
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->helper('form');
        $this->load->library('form_validation');

    }

    public function index()
    {
        $query = $this->db->get('tb_matkul');
        $data['matkul'] = $query->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('matkul/viewmatkul', $data);  // Pastikan nama view sesuai
        $this->load->view('template/footer');
    }

    public function add()
    {
        $data = [
            'kode_matkul' => $this->input->post('kode_matkul'),
            'nama_matkul' => $this->input->post('nama_matkul'),
            'sks' => $this->input->post('sks'),
            'semester' => $this->input->post('semester'),
            'jurusan' => $this->input->post('jurusan'),
            'hari' => $this->input->post('hari'), // Menambahkan kolom hari
            'waktu' => $this->input->post('waktu') // Menambahkan kolom waktu
        ];

        $this->M_matkul->add_matkul($data); // Pastikan model mendukung ini
        $this->session->set_flashdata('message', 'Data Mata Kuliah berhasil ditambahkan!');
        redirect('matkul');
    }


    public function print()
    {
        // Memanggil data dari model
        $data['matkul'] = $this->M_matkul->get_data();

        // Memuat view dengan data
        $this->load->view('matkul/print_matkul', $data);
    }

    public function excel()
    {
        // Load data dari model
        $data = $this->M_matkul->get_data(); // Sesuaikan dengan nama model yang Anda gunakan

        // Cek apakah data tersedia
        if (empty($data)) {
            echo "Data tidak tersedia.";
            return;
        }

        // Convert data ke format array untuk XLSXWriter
        $exportData = [];
        $exportData[] = ['No', 'Kode Mata Kuliah', 'Nama Mata Kuliah', 'SKS', 'Semester', 'Jurusan', 'Hari', 'Waktu']; // Header row
        $no = 1;
        foreach ($data as $row) {
            $exportData[] = [
                $no++,
                $row['kode_matkul'], // Pastikan nama kolom sesuai dengan tabel tb_matkul
                $row['nama_matkul'],
                $row['sks'],
                $row['semester'],
                $row['jurusan'],
                $row['hari'], // Menambahkan kolom hari
                $row['waktu'] // Menambahkan kolom waktu
            ];
        }

        // Sertakan library XLSXWriter
        include_once APPPATH . '/third_party/PHP_XLSXWriter/xlsxwriter.class.php';

        // Set filename dengan timestamp
        $filename = "Laporan Mata Kuliah-" . date('d-m-Y') . ".xlsx";

        // Set headers untuk memaksa download file Excel
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');

        // Buat objek XLSXWriter
        $writer = new XLSXWriter();

        // Set header untuk sheet
        $sheetHeaders = [
            'No' => 'integer',
            'Kode Mata Kuliah' => 'string',
            'Nama Mata Kuliah' => 'string',
            'SKS' => 'integer',
            'Semester' => 'integer',
            'Jurusan' => 'string',
            'Hari' => 'string', // Menambahkan kolom hari
            'Waktu' => 'string' // Menambahkan kolom waktu
        ];

        // Tulis header sheet
        $writer->writeSheetHeader('Sheet1', $sheetHeaders);

        // Tulis baris data
        foreach ($exportData as $row) {
            $writer->writeSheetRow('Sheet1', $row);
        }

        // Set metadata tambahan
        $writer->setAuthor('Muhamad Syahrul Adha');

        // Output file Excel
        $writer->writeToStdOut();

        // Menghentikan eksekusi setelah output
        exit;
    }

    public function export()
    {
        $this->load->library('Pdf');
        error_reporting(0);

        // Initialize PDF in portrait orientation
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);

        // Title
        $pdf->Cell(0, 10, 'DAFTAR MATA KULIAH', 0, 1, 'C');
        $pdf->Ln(5); // Spacer

        // Adjusted Table Headers with smaller "Hari" and "Waktu" columns
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(200, 220, 255); // Light blue background for headers

        // Header Row
        $pdf->Cell(10, 15, 'No', 1, 0, 'C', true);
        $pdf->Cell(30, 15, 'Kode Mata Kuliah', 1, 0, 'C', true);
        $pdf->Cell(50, 15, 'Nama Mata Kuliah', 1, 0, 'C', true);
        $pdf->Cell(13, 15, 'SKS', 1, 0, 'C', true);
        $pdf->Cell(17, 15, 'Semester', 1, 0, 'C', true);
        $pdf->Cell(35, 15, 'Jurusan', 1, 0, 'C', true);
        $pdf->Cell(20, 15, 'Hari', 1, 0, 'C', true);  // Reduced width
        $pdf->Cell(25, 15, 'Waktu', 1, 1, 'C', true); // Reduced width

        $pdf->SetFont('Arial', '', 10);
        $matkul = $this->db->get('tb_matkul')->result();
        $no = 0;

        // Loop through each matkul data and add rows
        foreach ($matkul as $data) {
            $no++;

            // Add row data with consistent height and spacing
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(30, 10, $data->kode_matkul, 1, 0);
            $pdf->Cell(50, 10, $data->nama_matkul, 1, 0);
            $pdf->Cell(13, 10, $data->sks, 1, 0, 'C');
            $pdf->Cell(17, 10, $data->semester, 1, 0, 'C');
            $pdf->Cell(35, 10, $data->jurusan, 1, 0);
            $pdf->Cell(20, 10, $data->hari, 1, 0);  // Reduced width
            $pdf->Cell(25, 10, $data->waktu, 1, 1); // Reduced width
        }

        // Output PDF
        $pdf->Output();
    }

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['matkul'] = $this->M_matkul->get_keyword($keyword);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('matkul/viewmatkul', $data);
        $this->load->view('template/footer');
    }

    public function csv()
    {
        // Tentukan nama file CSV
        $file_name = 'data_matkul_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");

        // Ambil data mata kuliah dari model M_matkul
        $matkul_data = $this->M_matkul->fetch_matkul_data();

        // Buat file CSV
        $file = fopen('php://output', 'w');

        // Tentukan header CSV
        $header = array("Kode Mata Kuliah", "Nama Mata Kuliah", "SKS", "Semester", "Jurusan", "Hari", "Waktu");
        fputcsv($file, $header);

        // Loop melalui data mata kuliah dan tulis ke dalam file CSV
        foreach ($matkul_data->result_array() as $value) {
            // Menulis baris data mata kuliah ke file CSV
            $csv_row = array(
                $value['kode_matkul'],
                $value['nama_matkul'],
                $value['sks'],
                $value['semester'],
                $value['jurusan'],
                $value['hari'],
                $value['waktu']
            );
            fputcsv($file, $csv_row);
        }

        fclose($file);
        exit;
    }

    public function edit($id)
    {
        $data['matkul'] = $this->M_matkul->edit_data($id); // Mengambil data mata kuliah berdasarkan ID
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('matkul/edit_matkul', $data); // Mengarahkan ke view edit_matkul
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        // Data yang akan diperbarui
        $data = [
            'kode_matkul' => $this->input->post('kode_matkul'),
            'nama_matkul' => $this->input->post('nama_matkul'),
            'sks' => $this->input->post('sks'),
            'semester' => $this->input->post('semester'),
            'jurusan' => $this->input->post('jurusan'), // Menyimpan jurusan
        ];

        if ($this->M_matkul->update_data($id, $data)) {
            $this->session->set_flashdata('message', 'Data mata kuliah berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data mata kuliah.');
        }

        redirect('matkul'); // Arahkan kembali ke halaman mata kuliah
    }

    public function hapus($id_matkul)
    {
        if ($this->M_matkul->hapus_data($id_matkul)) {
            $this->session->set_flashdata('warning', 'Data mahasiswa berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data mahasiswa.');
        }
        redirect('matkul');
    }

}