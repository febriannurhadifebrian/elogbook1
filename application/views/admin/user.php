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
                    Add New User
                </button>
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIP</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Jabatan</th>
                                <th>Role</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($alluser as $au) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $au->nip ?></td>
                                    <td><?= $au->name ?></td>
                                    <td><?= $au->username ?></td>
                                    <td><?= $au->jabatan ?></td>
                                    <td><?= $au->role ?></td>
                                    <td><?= $au->unit ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>admin/hapus_user/<?= $au->id ?>" class="badge badge-pill badge-danger tombol-hapus">delete</a>
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
                <h5 class="modal-title" id="newRoleModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('admin/user'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Pegawai">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP Pegawai">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <select name="role" id="role" class="form-control">
                        <option disabled selected>Role</option>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="jabatan" id="jabatan" class="form-control">
                        <option value="">Jabatan</option>
                        <option value="Manager Service Solution Care Center">Manager Service Solution Care Center</option>
                        <option value="Officer 1 Service Solution Care Center">Officer 1 Service Solution Care Center</option>
                        <option value="Officer 2 Service Solution Care Center">Officer 2 Service Solution Care Center</option>
                        <option value="Officer 3 Service Solution Care Center">Officer 3 Service Solution Care Center</option>
                        <option value="Officer 3 Service Solution Care Center">Officer 3 Service Solution Care Center</option>
                        <option value="EOS BRI">EOS BRI</option>
                        <option value="EOS POLRI">EOS POLRI</option>
                        <option value="Leader Care Center 5 (remote vsat, mobilevsat, mpls bgan, msp, fbb, sbb, cpe & hts sat)">Leader Care Center 5 (remote vsat, mobilevsat, mpls bgan, msp, fbb, sbb, cpe & hts sat)</option>
                        <option value="Leader Care Center 6 (mcs & Gyro)">Leader Care Center 6 (mcs & Gyro)</option>
                        <option value="Care Center 4 (Starlink)">Care Center 4 (Starlink)</option>
                        <option value="Leader Care Center 4 (Starlink)">Leader Care Center 4 (Starlink)</option>
                        <option value="EOS RRI">EOS RRI</option>
                        <option value="CARE CENTER 1 (Bakti BBS, AI & VSat Star BAKTI)">CARE CENTER 1 (Bakti BBS, AI & VSat Star BAKTI)</option>
                        <option value="LEADER CARE CENTER 1 (Bakti BBS, AI & VSat Star BAKTI)">LEADER CARE CENTER 1 (Bakti BBS, AI & VSat Star BAKTI)</option>
                        <option value="Staff Support Admin SSCC">Staff Support Admin SSCC</option>
                        <option value="Care Center 5 (Remote VSAT, mobile VSAT, MPLS, BGAN, MSP, CPE, FBB, dan HT Sat)">Care Center 5 (Remote VSAT, mobile VSAT, MPLS, BGAN, MSP, CPE, FBB, dan HT Sat)</option>
                        <option value="EOS PERTAMINA SHIPPING">EOS PERTAMINA SHIPPING</option>
                        <option value="EOS PERTAMINA PERSERO">EOS PERTAMINA PERSERO</option>
                        <option value="Care Center 3 (Mangoes Family & radio ip)">Care Center 3 (Mangoes Family & radio ip)</option>
                        <option value="Leader Care Center 3 (Mangoes Family & radio ip)">Leader Care Center 3 (Mangoes Family & radio ip)</option>
                        <option value="EOS KEMENDAGRI / DUKCAPIL">EOS KEMENDAGRI / DUKCAPIL</option>
                        <option value="EOS TENESA JKT">EOS TENESA JKT</option>
                        <option value="EOS KEJARI / KORLANTAS">EOS KEJARI / KORLANTAS</option>
                        <option value="EOS BEA CUKAI">EOS BEA CUKAI</option>
                        <option value="Leader Care center 2 (Broadcast, scpc & dscpc)">Leader Care center 2 (Broadcast, scpc & dscpc)</option>
                        <option value="EOS POSINDO">EOS POSINDO</option>
                        <option value="EOS BANK DANAMON">EOS BANK DANAMON</option>
                        <option value="EOS ALFAMART">EOS ALFAMART</option>
                        <option value="EOS BTN">EOS BTN</option>
                        <option value="EOS ALFAMART SDWAN TELKOMSEL">EOS ALFAMART SDWAN TELKOMSEL</option>
                        <option value="EOS BANK CIMB NIAGA">EOS BANK CIMB NIAGA</option>
                        <option value="EOS PEGADAIAN">EOS PEGADAIAN</option>
                        <option value="EOS Bank Jateng">EOS Bank Jateng</option>
                        <option value="EOS Bank DKI">EOS Bank DKI</option>
                        <option value="EOS Bank Index">EOS Bank Index</option>
                        <option value="Care center 2 (Broadcast, scpc & dscpc)">Care center 2 (Broadcast, scpc & dscpc)</option>
                        <option value="Care Center 6 (MCS & Maritim gyro)">Care Center 6 (MCS & Maritim gyro)</option>
                        <option value="Data Collecting">Data Collecting</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="kode" id="kode" class="form-control">
                        <option value="">Select Unit</option>
                        <?php foreach ($unit as $u) : ?>
                            <option value="<?= $u['kode']; ?>"><?= $u['unit']; ?></option>
                        <?php endforeach; ?>
                    </select>
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