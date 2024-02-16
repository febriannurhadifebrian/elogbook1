<style>
    .status-badge {
        font-size: 0.75em; /* Ukuran teks badge */
        padding: 5px 10px; /* Padding agar badge terlihat lebih jelas */
        border-radius: 10px; /* Membuat sudut badge melengkung */
        display: inline-block; /* Membuat badge menjadi inline block */
        text-align: center; /* Pusatkan teks di dalam badge */
        margin-bottom: 5px; /* Jarak antara badge */
    }
    .status-open {
        background-color: green;
        color: white;
    }
    .status-waiting {
        background-color: orange;
        color: white;
    }
    .status-not-set {
        background-color: red;
        color: white;
    }
</style>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <!-- Tampilan data user di sini -->
                <div class="table-responsive m-t-25">
                    <h2 class="mb-3">Close Logbook User</h2>

                    <div class=" row">
                        <div class="col-md-3">
                            <form action="<?= base_url('admin/close'); ?>" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cari Nama..." name="search" autocomplete="off" autofocus>
                                    <div class="input-group-append">
                                        <input class="btn btn-primary" type="submit" name="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- filter date -->
                        <div class="col-md-3">
                            <form action="<?= base_url('admin/close'); ?>" method="post">
                                <div class="input-group mb-3">
                                <input type="date" class="form-control" name="start_date" placeholder="From Date">
                                <input type="date" class="form-control" name="end_date" placeholder="To Date">
                                    <div class="input-group-append">
                                        <input class="btn btn-primary" type="submit" name="submit_date" value="Filter">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <!-- Add Reset Filters button -->
                            <form action="<?= base_url('admin/close'); ?>" method="post">
                                <div class="input-group mb-3">
                                    <input class="btn btn-secondary" type="submit" name="reset_filters" value="Reset">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="<?= base_url('admin/export_excel'); ?>" class="btn btn-success">Export to Excel</a>
                        </div>

                            <!-- <div class="col-md-3">
                                <form action="<?= base_url('datauser/close'); ?>" method="post">
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="sort_category">
                                            <option value="">Sort by Kategori</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= $category; ?>"><?= $category; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="input-group-append">
                                            <input class="btn btn-secondary" type="submit" name="submit_sort_category" value="Sort">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="<?= base_url('datauser/close'); ?>" method="post">
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="sort_service">
                                            <option value="">Sort by Layanan</option>
                                            <?php foreach ($services as $service) : ?>
                                                <option value="<?= $service; ?>"><?= $service; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="input-group-append">
                                            <input class="btn btn-secondary" type="submit" name="submit_sort_service" value="Sort">
                                        </div>
                                    </div>
                                </form>
                            </div> -->
                    </div>
                    
                    <!-- Tabel data logbook -->
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Created By</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Layanan</th>
                                <th>Judul</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logbooks as $lbu) : ?>
                                <tr>
                                    <td><?= ++$start; ?></td>
                                    <td> <h5><?= $lbu['name']; ?></h5></td>
                                    <td><?= date('Y-m-d h:i A', strtotime($lbu['tgl'])) ?></td>
                                    <td><?= $lbu['kategori']; ?></td>
                                    <td><?= $lbu['layanan']; ?></td>
                                    <td><?= $lbu['judul']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End Tabel data logbook -->
                </div>
            </div>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</div>

<!-- Modal Medium Ubah Status -->
<?php foreach ($logbooks as $val) : ?>
    <div class="modal fade" id="statusModal-<?= $val['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newRoleModalLabel">Ubah Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?= form_open("admin/changeStatus/{$val['id']}"); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="Open" <?= ($val['status'] == 'Open') ? 'selected' : '' ?>>Open</option>
                            <option value="Waiting Close" <?= ($val['status'] == 'Waiting Close') ? 'selected' : '' ?>>Waiting Close</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
