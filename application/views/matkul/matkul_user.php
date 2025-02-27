<section class="content">
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Daftar Mata Kuliah</h2>

        <!-- Filter Section -->
        <!-- Filter Section -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="<?php echo site_url('matkul_user/index'); ?>" method="POST" class="d-flex">
                <!-- Filter Semester -->
                <div class="input-group me-2">
                    <select name="semester_filter" class="form-control">
                        <option value="">-- Pilih Semester --</option>
                        <?php foreach ($semesters as $semester): ?>
                            <option value="<?php echo $semester->semester; ?>" <?php echo (isset($semester_filter) && $semester_filter == $semester->semester) ? 'selected' : ''; ?>>
                                <?php echo "Semester " . $semester->semester; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Filter Jurusan -->
                <div class="input-group me-2">
                    <select name="jurusan_filter" class="form-control">
                        <option value="">-- Pilih Jurusan --</option>
                        <?php foreach ($jurusans as $jurusan): ?>
                            <option value="<?php echo $jurusan->jurusan; ?>" <?php echo (isset($jurusan_filter) && $jurusan_filter == $jurusan->jurusan) ? 'selected' : ''; ?>>
                                <?php echo $jurusan->jurusan; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Filter</button>
            </form>
        </div>

        <!-- Button for Export and Print -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="<?php echo site_url('matkul_user/print'); ?>" class="btn btn-danger">
                    <i class="fa fa-print me-2"></i> Print
                </a>
                <a class="btn btn-danger" href="<?= site_url("matkul_user/export") ?>">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
                <a class="btn btn-success" href="<?= site_url("matkul_user/excel") ?>">
                    <i class="fa fa-file-excel"></i> Export Excel
                </a>
                <a href="<?php echo site_url('matkul_user/csv'); ?>" class="btn btn-success">
                    <i class="fa fa-download me-2"></i> Export to CSV
                </a>
            </div>
            <div>
                <?php echo form_open('matkul_user/search'); ?>
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search" required>
                    <button type="submit" class="btn btn-success">Cari</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <!-- Mata Kuliah Table -->
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
                        <th class="text-center">HARI</th>
                        <th class="text-center">WAKTU</th>
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