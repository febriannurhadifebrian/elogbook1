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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            Form <strong><?= $title ?></strong>
                        </div>
                        <div class="card-body card-block">
                            <?= form_open_multipart("fitur/changeBook") ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Tanggal Kejadian</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="hidden" name="id" value="<?= $elogbook['id'] ?>">
                                    <input type="datetime-local" class="form-control" id="tgl" name="tgl" value="<?= date('Y-m-d\TH:i', strtotime($elogbook['tgl'])) ?>">
                                    <?= form_error('tgl', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Kategori</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $elogbook['kategori'] ?>">
                                    <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <!-- <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Lokasi Judul</label>
                                </div> -->
                            <!-- <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $elogbook['lokasi'] ?>">
                                    <?= form_error('lokasi', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div> -->
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="layanan" class="form-control-label">Layanan</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select class="custom-select" id="layanan" name="layanan">
                                        <?php foreach ($listlayanan as $layanan) : ?>
                                            <?php if ($layanan == $elogbook['layanan']) : ?>
                                                <option value="<?= $layanan; ?>" selected><?= $layanan ?></option>
                                            <?php else : ?>
                                                <option value="<?= $layanan; ?>"><?= $layanan ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Judul</label>
                                </div>
                                <img id="image-preview" src="#" alt="Uploaded Image" style="max-width:100%; max-height:200px; display:none;">
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $elogbook['judul'] ?>">
                                    <?= form_error('judul', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="modal-body">
                                <!-- ... Bidang formulir lainnya ... -->
                                <div class="col-12 col-md-9">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="<?= base_url('assets/lampiran/') . $elogbook['lampiran'] ?>" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="attachment" name="attachment">
                                                <label class="custom-file-label" for="attachment">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ... Bidang formulir lainnya ... -->
                            </div>
                            <!-- <div class="row form-group"> -->
                            <!-- <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Keterangan</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="ket" name="ket" value="<?= $elogbook['ket'] ?>">
                                    <?= form_error('ket', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div> -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->