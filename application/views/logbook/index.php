<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1"><?= $title ?></h2>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#mediumModal">
                    Tambah Logbook
                </button>
                            <script>
                document.getElementById('attachment').addEventListener('change', function() {
                    var selectedFile = this.files[0];
                    console.log('File yang diunggah:', selectedFile);
                });
            </script>

            <a  type="button" class="btn btn-success mb-3 ml-2" href="<?php echo base_url('Fitur/export_excel');?>" target="_blank">Export Excel</a>


                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>layanan</th>
                                <th>Judul</th>
                                <th>lampiran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($logbookuser as $lbu) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $lbu->nip ?></td> 
                                    <td><?= date('Y-m-d h:i A', strtotime($lbu->tgl)) ?></td>
                                    <td><?= $lbu->kategori ?></td>
                                    <td><?= $lbu->layanan ?></td>
                                    <td><?= $lbu->judul ?></td>
                                    <td>
                                        <img src="<?= base_url('assets/lampiran/' . $lbu->lampiran) ?>" alt="Uploaded Image" style="max-width:200px; max-height:200px;">
                                    </td>
                                    <td>
                                        <a href="<?= base_url(); ?>fitur/edit_book/<?= $lbu->id ?>" class="btn btn-success btn-sm">Update</a>
                                        <a href="<?= base_url(); ?>fitur/hapus_book/<?= $lbu->id ?>" class="btn btn-danger btn-sm tombol-hapus">Delete</a>
                                        <button type="button" class="btn btn-info btn-sm tombol-view" data-toggle="modal" data-target="#viewModal<?=$lbu->id?>">View</button>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
            <?php if ($this->session->flashdata('flash')) : ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->

<!-- modal medium -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah Logbook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('fitur/add_logbook', 'id="addLogBookForm"'); ?> 
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="nip" name="nip" value="<?= $user['nip'] ?>">
                </div>
                <div class="row form-group">
                    <div class="col-12 col-md-14">
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tgl">Tanggal</label>
                    <input type="datetime-local" class="form-control" id="tgl" name="tgl">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="monitoring">Monitoring</option>
                        <option value="customer complain">Customer complain</option>
                    </select>
                </div>
                <!-- <div class="form-group">
                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi kategori"> 
                </div> -->
                <div class="form-group">
                <label for="layanan">Layanan</label>
                    <select name="layanan" id="layanan" class="form-control">
                        <option value="BBS Bakti">BBS Bakti</option>
                        <option value="Ai Bakti">Ai Bakti</option>
                        <option value="Vsatstar">Vsatstar</option>
                        <option value="Remote Vsat IP">Remote Vsat IP</option>
                        <option value="Mobile Vsat IP">Mobile Vsat IP</option>
                        <option value="Mangosfamily">Mangosfamily</option>
                        <option value="Radio IP">Radio IP</option>
                        <option value="MCS (Mobile Connectivity Service)">MCS (Mobile Connectivity Service)</option>
                        <option value="Maritim Gyro">Maritim Gyro</option>
                        <option value="Broadcast">Broadcast</option>
                        <option value="Vsat SCPC">Vsat SCPC</option>
                        <option value="Vsat DSCPC">Vsat DSCPC</option>
                        <option value="MPLS">MPLS</option>
                        <option value="BGAN (Broadband Global Area Network)">BGAN (Broadband Global Area Network)</option>
                        <option value="MSP">MSP</option>
                        <option value="FBB (Fleet Broadband)">FBB (Fleet Broadband)</option>
                        <option value="SBB (Swift Broadbanding)">SBB (Swift Broadbanding)</option>
                        <option value="CPE">CPE</option>
                        <option value="HT Satellite">HT Satellite</option>
                        <option value="SN (Support Network)">SN (Support Network)</option>
                        <option value="SGN (Solution Global Network)">SGN (Solution Global Network)</option>
                        
                    </select>   
                </div>
                <div class="form-group">
                <label for="Judul">Judul</label>
                    <textarea name="judul" id="judul" rows="4" placeholder="Tulis judul" class="form-control"></textarea>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" class="form-control" id="attachment" name="attachment">
                        <small class="form-text text-muted">Pilih berkas dengan format jpg, jpeg, png, atau gif Max. 2 MB</small>
                    </div>
                    <!-- Add an <img> tag to display the uploaded image -->
                    <img id="image-preview" src="#" alt="Uploaded Image" style="max-width:100%; max-height:200px; display:none;">
                </div>
                <!-- <div class="form-group">
                    <textarea name="ket" id="ket" rows="4" placeholder="Tulis Keterangan" class="form-control"></textarea>
                </div> -->
                <div class="form-group">
                    <input type="hidden" class="form-control" id="nama" name="nama" value="<?= $user['name'] ?>">
                    <input type="hidden" class="form-control" id="level" name="level" value="<?= $user['jabatan'] ?>">
                    <input type="hidden" class="form-control" id="kode" name="kode" value="<?= $user['kode'] ?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<!-- end modal medium -->
<!-- Modal View -->
<?php foreach ($logbookuser as $lbu) : ?>
    <div class="modal fade" id="viewModal<?= $lbu->id ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detail Logbook</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td>Nama:</td>
                            <td><?= $user['username'] ?></td> 
                        </tr>
                        <tr>
                            <td>Tanggal:</td>
                            <td><?= date('Y-m-d / h:i A', strtotime($lbu->tgl)) ?></td>
                        </tr>
                        <tr>
                            <td>Kategori:</td>
                            <td><?= $lbu->kategori ?></td>
                        </tr>
                        <tr>
                            <td>Layanan:</td>
                            <td><?= $lbu->layanan ?></td>
                        </tr>
                        <tr>
                            <td>Judul:</td>
                            <td><?= $lbu->judul ?></td>
                        </tr>
                        <tr>
                            <td>Lampiran:</td>
                            <td>
                                <img src="<?= base_url('assets/lampiran/' . $lbu->lampiran) ?>" alt="Uploaded Image" style="max-width:200px; max-height:200px;">
                            </td>
                        </tr>
                        <!-- Add more fields as needed -->
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

