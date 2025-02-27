<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_mhs');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Load pagination library
        $this->load->library('pagination');

        // Configuration for pagination
        $config['base_url'] = site_url('dashboard/index');
        $config['total_rows'] = $this->M_mhs->count_all();  // Total number of records
        $config['per_page'] = 5;  // Number of records per page
        $config['uri_segment'] = 3;  // Segment for page number in URL
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['attributes'] = ['class' => 'page-link'];

        // Initialize pagination
        $this->pagination->initialize($config);

        // Get data for the current page
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['mahasiswa'] = $this->M_mhs->get_data_pagination($config['per_page'], $page);

        // Load the views with pagination links
        $data['pagination_links'] = $this->pagination->create_links();

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('mhs/mahasiswa', $data);
        $this->load->view('template/footer');
    }

    public function add()
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
                'nama_mhs' => $this->input->post('nama_mhs'),
                'nim' => $this->input->post('nim'),
                'alamat' => $this->input->post('alamat'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jurusan' => $this->input->post('jurusan'),
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'foto' => $foto
            ];

            if ($this->M_mhs->add_data($data)) {
                $this->session->set_flashdata('message', 'Data mahasiswa berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data mahasiswa.');
            }

            redirect('dashboard');
        } else {
            // Menangani error upload
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('dashboard');
        }
    }

    public function edit($id)
    {
        $data['mahasiswa'] = $this->M_mhs->edit_data($id);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('mhs/edit_mahasiswa', $data);
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
            'nama_mhs' => $this->input->post('nama_mhs'),
            'nim' => $this->input->post('nim'),
            'alamat' => $this->input->post('alamat'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jurusan' => $this->input->post('jurusan'),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
        ];

        if ($this->upload->do_upload('foto')) {
            $upload_data = $this->upload->data();
            $data['foto'] = $upload_data['file_name'];
        }

        if ($this->M_mhs->update_data($id, $data)) {
            $this->session->set_flashdata('message', 'Data mahasiswa berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data mahasiswa.');
        }

        redirect('dashboard');
    }

    public function hapus($id)
    {
        if ($this->M_mhs->hapus_data($id)) {
            $this->session->set_flashdata('warning', 'Data mahasiswa berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data mahasiswa.');
        }
        redirect('dashboard');
    }

    public function detail($id_mhs = NULL)
    {
        $detail = $this->M_mhs->detail_data($id_mhs);

        if ($detail) {
            $data['mahasiswa'] = $detail;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('mhs/detail', $data);
            $this->load->view('template/footer');
        } else {
            show_404();
        }
    }

    public function print()
    {
        $data['mahasiswa'] = $this->M_mhs->get_data();
        $this->load->view('mhs/print_mahasiswa', $data);
    }

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['mahasiswa'] = $this->M_mhs->get_keyword($keyword);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('mhs/mahasiswa', $data);
        $this->load->view('template/footer');
    }

    public function tambah_aksi()
    {
        if ($this->input->post()) {
            $this->add();
        } else {
            redirect('dashboard');
        }
    }

    public function export()
    {
        $this->load->library('Pdf');
        error_reporting(0);

        // Initialize PDF
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Title
        $pdf->Cell(0, 7, 'DAFTAR MAHASISWA', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1); // Spacer

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Nama Mahasiswa', 1, 0, 'C');
        $pdf->Cell(30, 10, 'NIM', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Tanggal Lahir', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Jurusan', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $mahasiswa = $this->db->get('tb_mhs')->result();
        $no = 0;

        foreach ($mahasiswa as $data) {
            $no++;
            $pdf->Cell(10, 10, $no, 1, 0, 'C');
            $pdf->Cell(60, 10, $data->nama_mhs, 1, 0);
            $pdf->Cell(30, 10, $data->nim, 1, 0);
            $pdf->Cell(50, 10, $data->tgl_lahir, 1, 0);
            $pdf->Cell(50, 10, $data->jurusan, 1, 1);
        }

        // Output PDF
        $pdf->Output();
    }


    public function excel()
    {
        // Load data dari model
        $data = $this->M_mhs->get_data();

        // Cek apakah data tersedia
        if (empty($data)) {
            echo "Data tidak tersedia.";
            return;
        }

        // Convert data ke format array untuk XLSXWriter
        $exportData = [];
        $exportData[] = ['No', 'Nama Mahasiswa', 'NIM', 'Tanggal Lahir', 'Jurusan']; // Header row
        $no = 1;
        foreach ($data as $row) {
            $exportData[] = [
                $no++,
                $row['nama_mhs'], // Gunakan array style karena $row adalah array asosiatif
                $row['nim'],
                $row['tgl_lahir'],
                $row['jurusan']
            ];
        }

        // Sertakan library XLSXWriter
        include_once APPPATH . '/third_party/PHP_XLSXWriter/xlsxwriter.class.php';

        // Set filename dengan timestamp
        $filename = "Laporan Mhs-" . date('d-m-Y') . ".xlsx";

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
            'Nama Mahasiswa' => 'string',
            'NIM' => 'string',
            'Tanggal Lahir' => 'string',
            'Jurusan' => 'string'
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

    public function csv()
    {
        $file_name = 'data_mahasiswa_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");

        // Ambil data mahasiswa dari model M_mhs
        $mahasiswa_data = $this->M_mhs->fetch_mahasiswa_data();

        // Buat file CSV
        $file = fopen('php://output', 'w');

        // Tentukan header CSV
        $header = array("Nama Mahasiswa", "NIM", "Alamat", "Tanggal Lahir", "Jurusan", "Email", "No. Telepon");
        fputcsv($file, $header);

        // Loop melalui data mahasiswa dan tulis ke dalam file CSV
        foreach ($mahasiswa_data->result_array() as $value) {
            // Menulis baris data mahasiswa ke file CSV
            $csv_row = array(
                $value['nama_mhs'],
                $value['nim'],
                $value['alamat'],
                $value['tgl_lahir'],
                $value['jurusan'],
                $value['email'],
                $value['no_telp']
            );
            fputcsv($file, $csv_row);
        }

        fclose($file);
        exit;
    }


    public function tampil_grafik()
    {
        $this->load->model('M_mhs');
        $data['hasil'] = $this->M_mhs->jumlah_mahasiswa_perjurusan();
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('mhs/v_grafik', $data);
        $this->load->view('template/footer');
    }

    public function cek_login($username, $password)
    {
        // Menggunakan md5 untuk hash password
        return $this->db->get_where('tb_users', [
            'username' => $username,
            'password' => md5($password) // Pastikan password di-hash dengan md5
        ])->row_array(); // Mengembalikan hasil sebagai array
    }

    // Method login, jika belum login redirect ke halaman login
    public function login()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

}