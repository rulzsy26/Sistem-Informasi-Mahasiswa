<section class="content">
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('warning'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Data Dosen</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                <a href="<?php echo site_url('dosen/print'); ?>" class="btn btn-danger">
                    <i class="fa fa-print me-2"></i> Print
                </a>
                <a class="btn btn-danger" href="<?= site_url("dosen/export") ?>">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
                <a class="btn btn-success" href="<?= site_url("dosen/excel") ?>">
                    <i class="fa fa-file-excel"></i> Export Excel
                </a>
                <a href="<?php echo site_url('dosen/csv'); ?>" class="btn btn-success">
                    <i class="fa fa-download me-2"></i> Export to CSV
                </a>
            </div>
            <div>
                <?php echo form_open('dosen/search'); ?>
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" required>
                    <button type="submit" class="btn btn-success">Cari</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div id="datatable-buttons"></div> <!-- Tombol DataTables -->
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NAMA DOSEN</th>
                        <th class="text-center">NIK/NIDN</th>
                        <th class="text-center">PRODI</th>
                        <th class="text-center">EMAIL</th>
                        <th class="text-center">NO TELEPON</th>
                        <th class="text-center">FOTO</th>
                        <th class="text-center">DETAIL</th>
                        <th class="text-center">HAPUS</th>
                        <th class="text-center">EDIT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dosen)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($dosen as $dsn): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $dsn->nama_dosen; ?></td>
                                <td><?php echo $dsn->nik_nidn; ?></td>
                                <td><?php echo $dsn->prodi; ?></td>
                                <td><?php echo $dsn->email; ?></td>
                                <td><?php echo $dsn->no_telp; ?></td>
                                <td>
                                    <?php if (!empty($dsn->foto)): ?>
                                        <img src="<?php echo base_url('assets/Gambar/' . $dsn->foto); ?>" width="50" height="50"
                                            alt="Foto Dosen">
                                    <?php else: ?>
                                        <span>No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo anchor('dosen/detail_dosen/' . $dsn->id_dosen, '<div class="btn btn-success btn-sm"><i class="fa fa-search-plus"></i></div>'); ?>
                                </td>
                                <td onclick="javascript: return confirm('Anda yakin ingin Hapus?')">
                                    <a href="<?php echo site_url('dosen/hapus/' . $dsn->id_dosen); ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('dosen/edit/' . $dsn->id_dosen); ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data dosen.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Tambah Dosen -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo site_url('dosen/add_dosen'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input fields for adding new data -->
                    <div class="mb-3">
                        <label for="nama_dosen" class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik_nidn" class="form-label">NIK/NIDN</label>
                        <input type="text" class="form-control" id="nik_nidn" name="nik_nidn" required>
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Prodi</label>
                        <input type="text" class="form-control" id="prodi" name="prodi" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
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