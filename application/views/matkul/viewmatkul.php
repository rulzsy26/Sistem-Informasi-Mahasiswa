<section class="content">
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Daftar Mata Kuliah</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                <a href="<?php echo site_url('matkul/print'); ?>" class="btn btn-danger">
                    <i class="fa fa-print me-2"></i> Print
                </a>
                <a class="btn btn-danger" href="<?= site_url("matkul/export") ?>">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
                <a class="btn btn-success" href="<?= site_url("matkul/excel") ?>">
                    <i class="fa fa-file-excel"></i> Export Excel
                </a>
                <a href="<?php echo site_url('matkul/csv'); ?>" class="btn btn-success">
                    <i class="fa fa-download me-2"></i> Export to CSV
                </a>
            </div>
            <div>
                <?php echo form_open('matkul/search'); ?>
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" required>
                    <button type="submit" class="btn btn-success">Cari</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">KODE MATA KULIAH</th>
                        <th class="text-center">NAMA MATA KULIAH</th>
                        <th class="text-center">SKS</th>
                        <th class="text-center">SEMESTER</th>
                        <th class="text-center">JURUSAN</th>
                        <th class="text-center" colspan="2">JADWAL</th>
                        <th class="text-center">HAPUS</th>
                        <th class="text-center">EDIT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($matkul)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($matkul as $mk): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $mk->kode_matkul; ?></td>
                                <td><?php echo $mk->nama_matkul; ?></td>
                                <td><?php echo $mk->sks; ?></td>
                                <td><?php echo $mk->semester; ?></td>
                                <td><?php echo $mk->jurusan; ?></td>
                                <td><?php echo $mk->hari; ?></td>
                                <td><?php echo $mk->waktu; ?></td>
                                <td onclick="javascript: return confirm('Anda yakin ingin Hapus?')">
                                    <a href="<?php echo site_url('matkul/hapus/' . $mk->id_matkul); ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('matkul/edit/' . $mk->id_matkul); ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data mata kuliah.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Tambah Mata Kuliah -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo site_url('matkul/add'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_matkul" class="form-label">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" id="kode_matkul" name="kode_matkul" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" required>
                    </div>
                    <div class="mb-3">
                        <label for="sks" class="form-label">SKS</label>
                        <input type="number" class="form-control" id="sks" name="sks" required>
                    </div>
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="number" class="form-control" id="semester" name="semester" required>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                    </div>
                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <input type="text" class="form-control" id="hari" name="hari" required>
                    </div>
                    <div class="mb-3">
                        <label for="waktu" class="form-label">Waktu</label>
                        <input type="text" class="form-control" id="waktu" name="waktu" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Include Bootstrap CSS (if not already included) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery and DataTables libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<style>
    /* Center align the pagination */
    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    /* Style pagination buttons */
    .dataTables_paginate .paginate_button {
        border: 1px solid #0056b3;
        border-radius: 5px;
        padding: 5px 15px;
        margin: 0 3px;
        font-weight: bold;
        background-color: #f0f8ff;
        /* Light blue background */
        color: #0056b3;
        /* Dark blue text */
        transition: background-color 0.3s, color 0.3s;
    }

    /* Highlight the current page button */
    .dataTables_paginate .paginate_button.current {
        background-color: #0056b3;
        /* Dark blue background */
        color: #ffffff;
        /* White text */
        border-color: #0056b3;
    }

    /* Hover effect */
    .dataTables_paginate .paginate_button:hover {
        background-color: #0056b3;
        /* Dark blue background on hover */
        color: #ffffff;
        /* White text on hover */
    }

    /* Remove focus outline */
    .dataTables_paginate .paginate_button:focus {
        outline: none;
    }
</style>

<script>
    $(document).ready(function () {
        $('#example1').DataTable({
            pagingType: "simple_numbers", // Use full pagination control
            dom: 'Bfrtip', // Add buttons at the top of the table
            buttons: [
                {
                    extend: 'colvis',
                    text: 'Column Visibility' // Button label for toggling columns
                }
            ],
            searching: false, // Disable search
            lengthChange: false, // Disable length selection
            language: {
                paginate: {
                    previous: "<", // Replace "Previous" with "<"
                    next: ">"      // Replace "Next" with ">"
                }
            }
        });
    });
</script>