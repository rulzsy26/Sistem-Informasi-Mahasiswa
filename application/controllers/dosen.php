<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dosen'); // Memuat model M_dosen
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->helper('form');
        $this->load->library('form_validation');

    }

    public function print()
    {
        // Memanggil data dari model
        $data['dosen'] = $this->M_dosen->get_data();

        // Memuat view dengan data
        $this->load->view('dosen/print_dosen', $data);
    }

    public function add_dosen()
    {
        // Konfigurasi pengaturan upload
        $config['upload_path'] = './assets/Gambar/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];

            $data = [
                'nama_dosen' => $this->input->post('nama_dosen'),
                'nik_nidn' => $this->input->post('nik_nidn'),
                'prodi' => $this->input->post('prodi'),
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'foto' => $foto
            ];

            if ($this->M_dosen->add_data($data)) {
                $this->session->set_flashdata('message', 'Data dosen berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data dosen.');
            }

            redirect('dosen');
        } else {
            // Menangani error upload
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('dosen');
        }
    }

    public function tambah_aksi()
    {
        if ($this->input->post()) {
            $this->add_dosen();
        } else {
            redirect('dosen');
        }
    }

    public function detail_dosen($id_dosen = NULL)
    {
        $detail = $this->M_dosen->detail_data($id_dosen);

        if ($detail) {
            $data['dosen'] = $detail;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('dosen/detail_dosen', $data);
            $this->load->view('template/footer');
        } else {
            show_404();
        }
    }

    public function index()
    {
        $query = $this->db->get('tb_dosen');
        $data['dosen'] = $query->result();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('dosen/dosenview', $data);  // Pastikan nama view sesuai
        $this->load->view('template/footer');
    }

    public function hapus($id_dosen)
    {
        if ($this->M_dosen->hapus_data($id_dosen)) {
            $this->session->set_flashdata('warning', 'Data mahasiswa berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data mahasiswa.');
        }
        redirect('dosen');
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
        $pdf->Cell(0, 10, 'DAFTAR DOSEN', 0, 1, 'C');
        $pdf->Ln(5); // Spacer

        // Table Headers with better layout
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(200, 220, 255); // Light blue background for headers
        $pdf->Cell(10, 15, 'No', 1, 0, 'C', true);
        $pdf->Cell(35, 15, 'Nama Dosen', 1, 0, 'C', true);
        $pdf->Cell(25, 15, 'NIK/NIDN', 1, 0, 'C', true);
        $pdf->Cell(30, 15, 'Prodi', 1, 0, 'C', true);
        $pdf->Cell(40, 15, 'Email', 1, 0, 'C', true);
        $pdf->Cell(25, 15, 'No Telepon', 1, 0, 'C', true);
        $pdf->Cell(30, 15, 'Foto', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 10);
        $dosen = $this->db->get('tb_dosen')->result();
        $no = 0;

        // Loop through each dosen data and add rows
        foreach ($dosen as $data) {
            $no++;

            // Add row data
            $pdf->Cell(10, 30, $no, 1, 0, 'C');
            $pdf->Cell(35, 30, $data->nama_dosen, 1, 0);
            $pdf->Cell(25, 30, $data->nik_nidn, 1, 0);
            $pdf->Cell(30, 30, $data->prodi, 1, 0);
            $pdf->Cell(40, 30, $data->email, 1, 0);
            $pdf->Cell(25, 30, $data->no_telp, 1, 0);

            // Foto column
            if (!empty($data->foto)) {
                $foto_path = FCPATH . 'assets/Gambar/' . $data->foto; // Local path
                if (file_exists($foto_path)) {
                    // Display the image if it exists
                    $x = $pdf->GetX();
                    $y = $pdf->GetY();
                    $pdf->Cell(30, 30, '', 1, 0, 'C'); // Create a placeholder cell
                    $pdf->Image($foto_path, $x + 2.5, $y + 2.5, 25, 25); // Adjust size and position
                } else {
                    $pdf->Cell(30, 30, 'No Image', 1, 0, 'C');
                }
            } else {
                $pdf->Cell(30, 30, 'No Image', 1, 0, 'C');
            }

            $pdf->Ln(); // New line after each row
        }

        // Output PDF
        $pdf->Output();
    }

    public function excel()
    {
        // Load data dari model
        $data = $this->M_dosen->get_data();

        // Cek apakah data tersedia
        if (empty($data)) {
            echo "Data tidak tersedia.";
            return;
        }

        // Convert data ke format array untuk XLSXWriter
        $exportData = [];
        $exportData[] = ['No', 'Nama Dosen', 'NIK/NIDN', 'Prodi', 'Email', 'No Telp']; // Header row
        $no = 1;
        foreach ($data as $row) {
            $exportData[] = [
                $no++,
                $row['nama_dosen'], // Gunakan array style karena $row adalah array asosiatif
                $row['nik_nidn'],
                $row['prodi'],
                $row['email'],
                $row['no_telp']
            ];
        }

        // Sertakan library XLSXWriter
        include_once APPPATH . '/third_party/PHP_XLSXWriter/xlsxwriter.class.php';

        // Set filename dengan timestamp
        $filename = "Laporan Dosen-" . date('d-m-Y') . ".xlsx";

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
            'Nama Dosen' => 'string',
            'NIK/NIDN' => 'string',
            'Prodi' => 'string',
            'Email' => 'string',
            'No Telp' => 'string'
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

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['dosen'] = $this->M_dosen->get_keyword($keyword);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('dosen/dosenview', $data);
        $this->load->view('template/footer');
    }

    public function edit($id)
    {
        $data['dosen'] = $this->M_dosen->edit_data($id);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('dosen/edit_dosen', $data);
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        // Konfigurasi upload
        $config['upload_path'] = './assets/Gambar/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;

        $this->upload->initialize($config);

        $data = [
            'nama_dosen' => $this->input->post('nama_dosen'),
            'nik_nidn' => $this->input->post('nik_nidn'),
            'prodi' => $this->input->post('prodi'),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
        ];

        if ($this->upload->do_upload('foto')) {
            $upload_data = $this->upload->data();
            $data['foto'] = $upload_data['file_name'];
        }

        if ($this->M_dosen->update_data($id, $data)) {
            $this->session->set_flashdata('message', 'Data mahasiswa berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data mahasiswa.');
        }

        redirect('dosen');
    }

    public function csv()
    {
        $file_name = 'data_dosen_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");

        // Ambil data dosen dari model M_dosen
        $dosen_data = $this->M_dosen->fetch_dosen_data();

        // Buat file CSV
        $file = fopen('php://output', 'w');

        // Tentukan header CSV
        $header = array("Nama Dosen", "NIK/NIDN", "Program Studi", "Email", "No. Telepon");
        fputcsv($file, $header);

        // Loop melalui data dosen dan tulis ke dalam file CSV
        foreach ($dosen_data->result_array() as $value) {
            // Menulis baris data dosen ke file CSV
            $csv_row = array(
                $value['nama_dosen'],
                $value['nik_nidn'],
                $value['prodi'],
                $value['email'],
                $value['no_telp']
            );
            fputcsv($file, $csv_row);
        }

        fclose($file);
        exit;
    }

    public function fetch_data()
    {
        // Get search value, pagination, and sorting options from AJAX request
        $search_value = $this->input->post('search')['value'];  // Correct way to access search value
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order_column = $this->input->post('order')[0]['column'];
        $order_direction = $this->input->post('order')[0]['dir'];

        // Debugging: Log the received post data
        log_message('debug', 'POST data: ' . print_r($this->input->post(), true));

        // Get data from model
        $dosen_data = $this->Dosen_model->get_dosen_data($search_value, $limit, $start, $order_column, $order_direction);
        $total_data = $this->Dosen_model->count_all_dosen();

        // Prepare response in JSON format
        $response = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $total_data,
            "recordsFiltered" => count($dosen_data),
            "data" => $dosen_data
        );

        // Check if response is valid
        log_message('debug', 'Response: ' . json_encode($response));

        echo json_encode($response);
    }



}
