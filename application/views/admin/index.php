<div class="container-fluid">
    <!-- row ux-->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 bg-
primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-
uppercase mb-1">Jumlah Anggota</div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                <?= $this->User_model->getUserWhere(['Role_id' => 1])->num_rows() ?></div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('user/anggota') ?>"><i
                                    class="fas fa-users fa-3x text-warning"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-
warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-
uppercase mb-1">Stok Buku Terdaftar
                            </div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                <?php
                                $where = ['stok != 0'];
                                $totalstok = $this->Buku_model->total('Stok', $where);
                                echo $totalstok;
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('buku') ?>"><i class="fas fa-
book fa-3x text-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 bg-
danger">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-
uppercase mb-1">Buku yang dipinjam
                            </div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                <?php
                                $where = ['dipinjam != 0'];
                                $totaldipinjam = $this->Buku_model->total('Dipinjam', $where);
                                echo $totaldipinjam;
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('admin') ?>"><i class="fas fa-
user-tag fa-3x text-success"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 bg-
success">

                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-white text-
uppercase mb-1">Buku yang dibooking
                            </div>
                            <div class="h1 mb-0 font-weight-bold text-white">
                                <?php
                                $where = ['dibooking !=0'];
                                $totaldibooking = $this->Buku_model->total('Dibooking', $where);
                                echo $totaldibooking;
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('user') ?>"><i
                                    class="fas fa-
shopping-cart fa-3x text-danger"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row ux-->
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- row table-->
    <div class="row">
        <div class="table-responsive table-bordered col-sm-5 ml-auto mr-
auto mt-2">
            <div class="page-header">
                <span class="fas fa-users text-primary mt-2 "> Data
                    User</span>
                <a class="text-danger" href="<?php echo base_url('admin/data_user'); ?>"><i class="fas fa-search mt-2 float-
right">
                        Tampilkan</i></a>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Anggota</th>
                        <th>Email</th>
                        <th>Role ID</th>
                        <th>Aktif</th>
                        <th>Member Sejak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
  $i = 1;
  foreach ($anggota as $a) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $a['Nama'] ?></td>
                        <td><?= $a['Email'] ?></td>
                        <td><?= $a['Role_id'] ?></td>
                        <td><?= $a['Is_active'] ?></td>
                        <td><?= date('Y', $a['Tanggal_input']) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="table-responsive table-bordered col-sm-5 ml-auto mr-
auto mt-2">
            <div class="page-header">
                <span class="fas fa-book text-warning mt-2"> Data
                    Buku</span>
                <a href="<?= base_url('buku') ?>"><i class="fas fa-search
text-primary mt-2 float-right">
                        Tampilkan</i></a>
            </div>
            <div class="table-responsive">
                <table class="table mt-3" id="table-datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>ISBN</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
  $i = 1;
  foreach ($buku as $b) { ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $b['Judul_buku'] ?></td>
                            <td><?= $b['Pengarang'] ?></td>
                            <td><?= $b['Penerbit'] ?></td>
                            <td><?= $b['Tahun_terbit'] ?></td>
                            <td><?= $b['ISBN'] ?></td>
                            <td><?= $b['Stok'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end of row table-->
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
