<style>
    .badge-lg {
        font-size: 1.25em;
        /* Ubah ukuran teks sesuai kebutuhan */
    }

    .status-badge {
        font-size: 0.75em; /* Ukuran teks badge */
        padding: 5px 10px; /* Padding agar badge terlihat lebih jelas */
        border-radius: 10px; /* Membuat sudut badge melengkung */
        display: inline-block; /* Membuat badge menjadi inline block */
        text-align: center; /* Pusatkan teks di dalam badge */
        margin-bottom: 5px; /* Jarak antara badge */
    }

    /* Atur warna latar belakang untuk status Open */
    .status-open {
        background-color: green;
        color: white;
    }

    /* Atur warna latar belakang untuk status Waiting Close */
    .status-waiting {
        background-color: orange;
        color: white;
    }

    .status-not-set {
        background-color: red;
        color: white;
    }
</style>
<!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                    </div>
                    <button type="button" class="btn btn-danger mb-3" id="logbookButton">
                        Logbook
                    </button>     
                    <button type="button" class="btn btn-primary mb-3" id="checklistButton">
                        Checklist
                    </button>

                    <!-- Tabel Logbook Unit -->
                    <!-- <form action="<?= site_url('admin/search') ?>" method="get" id="searchForm">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?= isset($keyword) ? esc($keyword) : '' ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form> -->

                <?php foreach ($unit as $u) : ?>
                    <h2 class="title-1">E-Logbook Unit : <?= $u->unit ?></h2>
                <?php endforeach; ?>
            <div class="row m-t-25">
                <div class="table-responsive table--no-card m-b-30" id="logbookTable">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Layanan</th>
                                <th>Judul</th>
                                <th>lampiran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if (!empty($log)) : ?>
                                <?php foreach ($log as $lb) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= date('Y-m-d H:i', strtotime($lb->tgl)) ?></td>
                                        <td><?= $lb->kategori; ?></td>
                                        <td><?= $lb->layanan; ?></td>
                                        <td><?= $lb->judul; ?></td>
                                        <td>
                                            <?php if (!empty($lb->lampiran)) : ?>
                                                <img src="<?= base_url('assets/lampiran/' . $lb->lampiran) ?>" alt="Uploaded Image" style="max-width:150px; max-height:150px;">
                                            <?php else : ?>
                                                Tidak ada lampiran
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                        <?php
                                        // Tambahkan logika untuk memeriksa status dan berikan kelas sesuai kondisi
                                        $statusClass = '';
                                        if ($lb->status == 'Open') {
                                            $statusClass = 'status-open';
                                        } elseif ($lb->status == 'Waiting Close') {
                                            $statusClass = 'status-waiting';
                                        } else {
                                            $statusClass = 'status-not-set';
                                        }
                                        ?>
                                            <span class="status-badge <?= $statusClass ?>">
                                            <?= ($lb->status == 'Open' || $lb->status == 'Waiting Close') ? $lb->status : 'Belum ada' ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>Tidak ada data logbook.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Tabel Checklist -->
                <div class="table-responsive table--no-card m-b-30" id="checklistTable">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Shift</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($checklist as $cl) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $cl['username'] ?></td>
                                    <td><?= date('Y-m-d H:i', strtotime($cl['tgl'])) ?></td>
                                    <td><?= $cl['shift'] ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Log the data to the console
    console.log(<?php echo json_encode($log); ?>);
</script>

<!-- <div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Layanan</th>
                <th>Judul</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($logbookuser as $lbu) : ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $lbu->tgl ?></td>
                    <td><?= $lbu->kategori ?></td>
                    <td><?= $lbu->layanan ?></td>
                    <td><?= $lbu->judul ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        console.log(<?php echo json_encode($log); ?>);

        $('#checklistTable').hide();

        $('#logbookButton').on('click', function () {
            $('#logbookTable').show();
            $('#checklistTable').hide();
        });

        $('#checklistButton').on('click', function () {
            $('#logbookTable').hide();
            $('#checklistTable').show();
        });

});

</script>


<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->