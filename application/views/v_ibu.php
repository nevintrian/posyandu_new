<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Ibu Hamil</h3>
                        </div>
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah</button>
                        </div>
                        <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'bidan') { ?>
                            <div class="card-header posyandu-header">
                                <a href="<?php echo base_url("ibu"); ?>" class="btn btn-info">All</a>
                                <?php
                                foreach ($posyandu_data as $posyandu) {
                                ?>
                                    <a href="<?php echo base_url("ibu/posyandu/$posyandu->id"); ?>" class="btn btn-info"><?= $posyandu->nama ?></a>
                                <?php
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="card-body p-0">
                                    <table class="table table-bordered" id="datatables">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>NIK</th>
                                                <th>Nama Ibu</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Daftar</th>
                                                <th>Telepon</th>
                                                <th>Posyandu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($ibu_data as $ibu) { ?>
                                                <tr>
                                                    <td style="width: 10px"><?= $i ?></td>
                                                    <td><?= $ibu->nik ?></td>
                                                    <td><?= $ibu->nama_ibu ?></td>
                                                    <td><?= $ibu->alamat ?></td>
                                                    <td><?= $ibu->tanggal_daftar ?></td>
                                                    <td><?= $ibu->telepon ?></td>
                                                    <td><?= $ibu->posyandu_nama ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-view" data-id="<?= $ibu->id; ?>" data-nik="<?= $ibu->nik; ?>" data-nama_ibu="<?= $ibu->nama_ibu; ?>" data-nama_suami="<?= $ibu->nama_suami; ?>" data-alamat="<?= $ibu->alamat; ?>" data-rt="<?= $ibu->rt; ?>" data-rw="<?= $ibu->rw; ?>" data-tanggal_daftar="<?= $ibu->tanggal_daftar; ?>" data-umur_kehamilan="<?= $ibu->umur_kehamilan; ?>" data-telepon="<?= $ibu->telepon; ?>" data-keluhan="<?= $ibu->keluhan; ?>" data-terapi="<?= $ibu->terapi; ?>" data-nama_pemeriksa="<?= $ibu->nama_pemeriksa; ?>" data-posyandu_nama="<?= $ibu->posyandu_nama; ?>" data-usia_ibu="<?= $ibu->usia_ibu; ?>" data-usia_anak_terakhir="<?= $ibu->usia_anak_terakhir; ?>" data-sistol="<?= $ibu->sistol; ?>" data-diastol="<?= $ibu->diastol; ?>" data-diastol_miring="<?= $ibu->diastol_miring; ?>" data-diastol_terlentang="<?= $ibu->diastol_terlentang; ?>" data-berat_badan="<?= $ibu->berat_badan; ?>" data-tinggi_badan="<?= $ibu->tinggi_badan; ?>"><i class="fa fa-eye"></i></a>
                                                        <a href="#" class="btn btn-info btn-edit" data-id="<?= $ibu->id; ?>" data-nik="<?= $ibu->nik; ?>" data-nama_ibu="<?= $ibu->nama_ibu; ?>" data-nama_suami="<?= $ibu->nama_suami; ?>" data-alamat="<?= $ibu->alamat; ?>" data-rt="<?= $ibu->rt; ?>" data-rw="<?= $ibu->rw; ?>" data-tanggal_daftar="<?= $ibu->tanggal_daftar; ?>" data-umur_kehamilan="<?= $ibu->umur_kehamilan; ?>" data-telepon="<?= $ibu->telepon; ?>" data-keluhan="<?= $ibu->keluhan; ?>" data-terapi="<?= $ibu->terapi; ?>" data-nama_pemeriksa="<?= $ibu->nama_pemeriksa; ?>" data-posyandu_id="<?= $ibu->posyandu_id; ?>" data-usia_ibu="<?= $ibu->usia_ibu; ?>" data-usia_anak_terakhir="<?= $ibu->usia_anak_terakhir; ?>" data-sistol="<?= $ibu->sistol; ?>" data-diastol="<?= $ibu->diastol; ?>" data-diastol_miring="<?= $ibu->diastol_miring; ?>" data-diastol_terlentang="<?= $ibu->diastol_terlentang; ?>" data-berat_badan="<?= $ibu->berat_badan; ?>" data-tinggi_badan="<?= $ibu->tinggi_badan; ?>"><i class="fa fa-marker"></i></a>
                                                        <a href="#" class="btn btn-danger btn-delete" data-id="<?= $ibu->id; ?>"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php
                            $id = basename($_SERVER['REQUEST_URI']);
                            ?>
                            <a href=" <?php echo base_url("ibu/cetak_pdf/$id"); ?>" class="btn btn-info">Cetak Data Ibu Hamil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Modal Add Product-->
<form action="<?php echo base_url("ibu/save"); ?>" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Ibu Hamil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="nik_lama">
                        <label>NIK Pasien Lama (Opsional)</label>
                        <select name="nik" id="data_nik" class="form-control" required>
                            <option value="">-- Pilih NIK --</option>
                            <?php foreach ($ibu_data as $ibu) : ?>
                                <option value="<?= $ibu->id; ?>"><?= $ibu->nik; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group" id="nik_baru">
                        <label>NIK</label>
                        <input type="text" class="form-control nik" name="nik" placeholder="NIK" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control nama_ibu" name="nama_ibu" placeholder="Nama Ibu" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Suami</label>
                        <input type="text" class="form-control nama_suami" name="nama_suami" placeholder="Nama Suami" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control alamat" name="alamat" placeholder="Alamat" required>
                    </div>
                    <div class="form-group">
                        <label>RT</label>
                        <input type="text" class="form-control rt" name="rt" placeholder="RT" required>
                    </div>
                    <div class="form-group">
                        <label>RW</label>
                        <input type="text" class="form-control rw" name="rw" placeholder="RW" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Daftar</label>
                        <input type="date" class="form-control" name="tanggal_daftar" placeholder="Tanggal Daftar" required>
                    </div>
                    <div class="form-group">
                        <label>Usia Ibu</label>
                        <input type="text" class="form-control" name="usia_ibu" placeholder="Usia Ibu" required>
                    </div>
                    <div class="form-group">
                        <label>Umur Kehamilan (bulan)</label>
                        <input type="number" class="form-control" name="umur_kehamilan" placeholder="Umur Kehamilan" required>
                    </div>
                    <div class="form-group">
                        <label>Usia Anak Terakhir (bulan)</label>
                        <input type="number" class="form-control" name="usia_anak_terakhir" placeholder="Usia Anak Terakhir" required>
                    </div>
                    <div class="form-group">
                        <label>Sistol</label>
                        <input type="text" class="form-control" name="sistol" placeholder="Siastol" required>
                    </div>
                    <div class="form-group">
                        <label>Diastol</label>
                        <input type="text" class="form-control" name="diastol" placeholder="Diastol" required>
                    </div>
                    <div class="form-group">
                        <label>Diastol Miring</label>
                        <input type="text" class="form-control" name="diastol_miring" placeholder="Diastol Miring" required>
                    </div>
                    <div class="form-group">
                        <label>Diastol Terlentang</label>
                        <input type="text" class="form-control" name="diastol_terlentang" placeholder="Diastol Terlentang" required>
                    </div>
                    <div class="form-group">
                        <label>Berat Badan (kg)</label>
                        <input type="number" class="form-control" name="berat_badan" placeholder="Berat Badan" required>
                    </div>
                    <div class="form-group">
                        <label>Tinggi Badan (cm)</label>
                        <input type="number" class="form-control" name="tinggi_badan" placeholder="Tinggi Badan" required>
                    </div>
                    <div class="form-group">
                        <label>Keluhan</label>
                        <input type="text" class="form-control" name="keluhan" placeholder="Keluhan" required>
                    </div>
                    <div class="form-group">
                        <label>Terapi</label>
                        <input type="text" class="form-control" name="terapi" placeholder="Terapi" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemeriksa</label>
                        <input type="text" class="form-control" name="nama_pemeriksa" placeholder="Nama Pemeriksa" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control telepon" name="telepon" placeholder="Telepon" required>
                    </div>
                    <?php
                    if ($this->session->userdata('level') != 'kader') {
                    ?>
                        <div class="form-group">
                            <label>Posyandu</label>
                            <select name="posyandu_id" class="form-control posyandu_id" required>
                                <option value="">-- Pilih Posyandu --</option>
                                <?php foreach ($posyandu_data as $posyandu) : ?>
                                    <option value="<?= $posyandu->id; ?>"><?= $posyandu->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php
                    } else {
                    ?>
                        <input type="hidden" name="posyandu_id" class="posyandu_id" value="<?= $this->session->userdata('posyandu_id') ?>">
                    <?php
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Add Product-->

<!-- Modal Edit Product-->
<form action="<?php echo base_url("ibu/update"); ?>" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Ibu Hamil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control nik" name="nik" placeholder="NIK" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control nama_ibu" name="nama_ibu" placeholder="Nama Ibu" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Suami</label>
                        <input type="text" class="form-control nama_suami" name="nama_suami" placeholder="Nama Suami" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control alamat" name="alamat" placeholder="Alamat" required>
                    </div>
                    <div class="form-group">
                        <label>RT</label>
                        <input type="text" class="form-control rt" name="rt" placeholder="RT" required>
                    </div>
                    <div class="form-group">
                        <label>RW</label>
                        <input type="text" class="form-control rw" name="rw" placeholder="RW" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Daftar</label>
                        <input type="date" class="form-control tanggal_daftar" name="tanggal_daftar" placeholder="Tanggal Daftar" required>
                    </div>
                    <div class="form-group">
                        <label>Usia Ibu</label>
                        <input type="text" class="form-control usia_ibu" name="usia_ibu" placeholder="Usia Ibu" required>
                    </div>
                    <div class="form-group">
                        <label>Umur Kehamilan (bulan)</label>
                        <input type="number" class="form-control umur_kehamilan" name="umur_kehamilan" placeholder="Umur Kehamilan" required>
                    </div>
                    <div class="form-group">
                        <label>Usia Anak Terakhir (bulan)</label>
                        <input type="number" class="form-control usia_anak_terakhir" name="usia_anak_terakhir" placeholder="Usia Anak Terakhir" required>
                    </div>
                    <div class="form-group">
                        <label>Sistol</label>
                        <input type="text" class="form-control sistol" name="sistol" placeholder="Siastol" required>
                    </div>
                    <div class="form-group">
                        <label>Diastol</label>
                        <input type="text" class="form-control diastol" name="diastol" placeholder="Diastol" required>
                    </div>
                    <div class="form-group">
                        <label>Diastol Miring</label>
                        <input type="text" class="form-control diastol_miring" name="diastol_miring" placeholder="Diastol Miring" required>
                    </div>
                    <div class="form-group">
                        <label>Diastol Terlentang</label>
                        <input type="text" class="form-control diastol_terlentang" name="diastol_terlentang" placeholder="Diastol Terlentang" required>
                    </div>
                    <div class="form-group">
                        <label>Berat Badan (kg)</label>
                        <input type="number" class="form-control berat_badan" name="berat_badan" placeholder="Berat Badan" required>
                    </div>
                    <div class="form-group">
                        <label>Tinggi Badan (cm)</label>
                        <input type="number" class="form-control tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan" required>
                    </div>
                    <div class="form-group">
                        <label>Keluhan</label>
                        <input type="text" class="form-control keluhan" name="keluhan" placeholder="Keluhan" required>
                    </div>
                    <div class="form-group">
                        <label>Terapi</label>
                        <input type="text" class="form-control terapi" name="terapi" placeholder="Terapi" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemeriksa</label>
                        <input type="text" class="form-control nama_pemeriksa" name="nama_pemeriksa" placeholder="Nama Pemeriksa" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control telepon" name="telepon" placeholder="Telepon" required>
                    </div>
                    <?php
                    if ($this->session->userdata('level') != 'kader') {
                    ?>
                        <div class="form-group">
                            <label>Posyandu</label>
                            <select name="posyandu_id" class="form-control posyandu_id" required>
                                <option value="">-- Pilih Posyandu --</option>
                                <?php foreach ($posyandu_data as $posyandu) : ?>
                                    <option value="<?= $posyandu->id; ?>"><?= $posyandu->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php
                    } else {
                    ?>
                        <input type="hidden" name="posyandu_id" class="posyandu_id" value="<?= $this->session->userdata('posyandu_id') ?>">
                    <?php
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Product-->

<!-- Modal View Product-->
<form>
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat Ibu Hamil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control nik" name="nik" placeholder="NIK" disabled>
                    </div>
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control nama_ibu" name="nama_ibu" placeholder="Nama Ibu" disabled>
                    </div>
                    <div class="form-group">
                        <label>Nama Suami</label>
                        <input type="text" class="form-control nama_suami" name="nama_suami" placeholder="Nama Suami" disabled>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control alamat" name="alamat" placeholder="Alamat" disabled>
                    </div>
                    <div class="form-group">
                        <label>RT</label>
                        <input type="text" class="form-control rt" name="rt" placeholder="RT" disabled>
                    </div>
                    <div class="form-group">
                        <label>RW</label>
                        <input type="text" class="form-control rw" name="rw" placeholder="RW" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Daftar</label>
                        <input type="date" class="form-control tanggal_daftar" name="tanggal_daftar" placeholder="Tanggal Daftar" disabled>
                    </div>
                    <div class="form-group">
                        <label>Usia Ibu</label>
                        <input type="text" class="form-control usia_ibu" name="usia_ibu" placeholder="Usia Ibu" disabled>
                    </div>
                    <div class="form-group">
                        <label>Umur Kehamilan (bulan)</label>
                        <input type="number" class="form-control umur_kehamilan" name="umur_kehamilan" placeholder="Umur Kehamilan" disabled>
                    </div>
                    <div class="form-group">
                        <label>Usia Anak Terakhir (bulan)</label>
                        <input type="number" class="form-control usia_anak_terakhir" name="usia_anak_terakhir" placeholder="Usia Anak Terakhir" disabled>
                    </div>
                    <div class="form-group">
                        <label>Sistol</label>
                        <input type="text" class="form-control sistol" name="sistol" placeholder="Siastol" disabled>
                    </div>
                    <div class="form-group">
                        <label>Diastol</label>
                        <input type="text" class="form-control diastol" name="diastol" placeholder="Diastol" disabled>
                    </div>
                    <div class="form-group">
                        <label>Diastol Miring</label>
                        <input type="text" class="form-control diastol_miring" name="diastol_miring" placeholder="Diastol Miring" disabled>
                    </div>
                    <div class="form-group">
                        <label>Diastol Terlentang</label>
                        <input type="text" class="form-control diastol_terlentang" name="diastol_terlentang" placeholder="Diastol Terlentang" disabled>
                    </div>
                    <div class="form-group">
                        <label>Berat Badan (kg)</label>
                        <input type="number" class="form-control berat_badan" name="berat_badan" placeholder="Berat Badan" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tinggi Badan (cm)</label>
                        <input type="number" class="form-control tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan" disabled>
                    </div>
                    <div class="form-group">
                        <label>Keluhan</label>
                        <input type="text" class="form-control keluhan" name="keluhan" placeholder="Keluhan" disabled>
                    </div>
                    <div class="form-group">
                        <label>Terapi</label>
                        <input type="text" class="form-control terapi" name="terapi" placeholder="Terapi" disabled>
                    </div>
                    <div class="form-group">
                        <label>Nama Pemeriksa</label>
                        <input type="text" class="form-control nama_pemeriksa" name="nama_pemeriksa" placeholder="Nama Pemeriksa" disabled>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control telepon" name="telepon" placeholder="Telepon" disabled>
                    </div>
                    <div class="form-group">
                        <label>Posyandu</label>
                        <input type="text" class="form-control posyandu_nama" name="posyandu_nama" placeholder="Posyandu" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal View Product-->

<!-- Modal Delete Product-->
<form action="<?php echo base_url("ibu/delete"); ?>" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Ibu Hamil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apa anda yakin ingin menghapus data ibu?</h5>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->

<script src="<?php echo base_url('templates/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('templates/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('#data_nik').change(function() {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('ibu/cek_data_ibu') ?>',
                Cache: false,
                dataType: "json",
                data: 'id=' + id,
                success: function(resp) {
                    $('.nik').val(resp.nik);
                    $('.nama_ibu').val(resp.nama_ibu);
                    $('.nama_suami').val(resp.nama_suami);
                    $('.alamat').val(resp.alamat);
                    $('.rt').val(resp.rt);
                    $('.rw').val(resp.rw);
                    $('.telepon').val(resp.telepon);
                    $('.posyandu_id').val(resp.posyandu_id);
                }
            });
        });
        $('#datatables').DataTable();
        $('.btn-edit').on('click', function() {
            const id = $(this).data('id');
            const nik = $(this).data('nik');
            const nama_ibu = $(this).data('nama_ibu');
            const nama_suami = $(this).data('nama_suami');
            const alamat = $(this).data('alamat');
            const rt = $(this).data('rt');
            const rw = $(this).data('rw');
            const tanggal_daftar = $(this).data('tanggal_daftar');
            const umur_kehamilan = $(this).data('umur_kehamilan');
            const keluhan = $(this).data('keluhan');
            const terapi = $(this).data('terapi');
            const nama_pemeriksa = $(this).data('nama_pemeriksa');
            const telepon = $(this).data('telepon');
            const usia_anak_terakhir = $(this).data('usia_anak_terakhir');
            const sistol = $(this).data('sistol');
            const diastol = $(this).data('diastol');
            const diastol_miring = $(this).data('diastol_miring');
            const diastol_terlentang = $(this).data('diastol_terlentang');
            const berat_badan = $(this).data('berat_badan');
            const tinggi_badan = $(this).data('tinggi_badan');
            const usia_ibu = $(this).data('usia_ibu');
            const posyandu_id = $(this).data('posyandu_id');
            $('.id').val(id);
            $('.nik').val(nik);
            $('.nama_ibu').val(nama_ibu);
            $('.nama_suami').val(nama_suami);
            $('.alamat').val(alamat);
            $('.rt').val(rt);
            $('.rw').val(rw);
            $('.tanggal_daftar').val(tanggal_daftar);
            $('.umur_kehamilan').val(umur_kehamilan);
            $('.keluhan').val(keluhan);
            $('.terapi').val(terapi);
            $('.nama_pemeriksa').val(nama_pemeriksa);
            $('.telepon').val(telepon);
            $('.usia_anak_terakhir').val(usia_anak_terakhir);
            $('.sistol').val(sistol);
            $('.diastol').val(diastol);
            $('.diastol_miring').val(diastol_miring);
            $('.diastol_terlentang').val(diastol_terlentang);
            $('.berat_badan').val(berat_badan);
            $('.tinggi_badan').val(tinggi_badan);
            $('.usia_ibu').val(usia_ibu);
            $('.posyandu_id').val(posyandu_id);
            $('#editModal').modal('show');
        });

        $('.btn-view').on('click', function() {
            const id = $(this).data('id');
            const nik = $(this).data('nik');
            const nama_ibu = $(this).data('nama_ibu');
            const nama_suami = $(this).data('nama_suami');
            const alamat = $(this).data('alamat');
            const rt = $(this).data('rt');
            const rw = $(this).data('rw');
            const tanggal_daftar = $(this).data('tanggal_daftar');
            const umur_kehamilan = $(this).data('umur_kehamilan');
            const keluhan = $(this).data('keluhan');
            const terapi = $(this).data('terapi');
            const nama_pemeriksa = $(this).data('nama_pemeriksa');
            const telepon = $(this).data('telepon');
            const usia_anak_terakhir = $(this).data('usia_anak_terakhir');
            const sistol = $(this).data('sistol');
            const diastol = $(this).data('diastol');
            const diastol_miring = $(this).data('diastol_miring');
            const diastol_terlentang = $(this).data('diastol_terlentang');
            const berat_badan = $(this).data('berat_badan');
            const tinggi_badan = $(this).data('tinggi_badan');
            const usia_ibu = $(this).data('usia_ibu');
            const posyandu_nama = $(this).data('posyandu_nama');
            $('.id').val(id);
            $('.nik').val(nik);
            $('.nama_ibu').val(nama_ibu);
            $('.nama_suami').val(nama_suami);
            $('.alamat').val(alamat);
            $('.rt').val(rt);
            $('.rw').val(rw);
            $('.tanggal_daftar').val(tanggal_daftar);
            $('.umur_kehamilan').val(umur_kehamilan);
            $('.terapi').val(terapi);
            $('.keluhan').val(keluhan);
            $('.nama_pemeriksa').val(nama_pemeriksa);
            $('.telepon').val(telepon);
            $('.usia_anak_terakhir').val(usia_anak_terakhir);
            $('.sistol').val(sistol);
            $('.diastol').val(diastol);
            $('.diastol_miring').val(diastol_miring);
            $('.diastol_terlentang').val(diastol_terlentang);
            $('.berat_badan').val(berat_badan);
            $('.tinggi_badan').val(tinggi_badan);
            $('.usia_ibu').val(usia_ibu);
            $('.posyandu_nama').val(posyandu_nama);
            $('#viewModal').modal('show');
        });

        $('.btn-delete').on('click', function() {
            const id = $(this).data('id');
            $('.id').val(id);
            $('#deleteModal').modal('show');
        });

    });
</script>