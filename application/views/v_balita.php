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
                            <h3 class="card-title">Data Balita</h3>
                        </div>
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah</button>
                        </div>
                        <?php if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'bidan') { ?>
                            <div class="card-header posyandu-header">
                                <a href="<?php echo base_url("balita"); ?>" class="btn btn-info">All</a>
                                <?php
                                foreach ($posyandu_data as $posyandu) {
                                ?>

                                    <a href="<?php echo base_url("balita/posyandu/$posyandu->id"); ?>" class="btn btn-info"><?= $posyandu->nama ?></a>
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
                                                <th>Nama</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Umur</th>
                                                <th>Orangtua</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Posyandu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($balita_data as $balita) { ?>
                                                <tr>
                                                    <td style="width: 10px"><?= $i ?></td>
                                                    <td><?= $balita->nama ?></td>
                                                    <td><?= $balita->tanggal_lahir ?></td>
                                                    <td><?= $balita->umur ?></td>
                                                    <td><?= $balita->orangtua ?></td>
                                                    <td><?= $balita->telepon ?></td>
                                                    <td><?= $balita->alamat ?></td>
                                                    <td><?= $balita->posyandu_nama ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-view" data-id="<?= $balita->id; ?>" data-nama="<?= $balita->nama; ?>" data-tanggal_lahir="<?= $balita->tanggal_lahir; ?>" data-tanggal_ukur="<?= $balita->tanggal_ukur; ?>" data-umur="<?= $balita->umur; ?>" data-tinggi_badan="<?= $balita->tinggi_badan; ?>" data-berat_badan="<?= $balita->berat_badan; ?>" data-lingkar_kepala="<?= $balita->lingkar_kepala; ?>" data-vitamin_a="<?= $balita->vitamin_a; ?>" data-obat_cacing="<?= $balita->obat_cacing; ?>" data-alamat="<?= $balita->alamat; ?>" data-telepon="<?= $balita->telepon; ?>" data-orangtua="<?= $balita->orangtua; ?>" data-posyandu_nama="<?= $balita->posyandu_nama; ?>"><i class="fa fa-eye"></i></a>
                                                        <a href="#" class="btn btn-info btn-edit" data-id="<?= $balita->id; ?>" data-nama="<?= $balita->nama; ?>" data-tanggal_lahir="<?= $balita->tanggal_lahir; ?>" data-tanggal_ukur="<?= $balita->tanggal_ukur; ?>" data-umur="<?= $balita->umur; ?>" data-tinggi_badan="<?= $balita->tinggi_badan; ?>" data-berat_badan="<?= $balita->berat_badan; ?>" data-lingkar_kepala="<?= $balita->lingkar_kepala; ?>" data-vitamin_a="<?= $balita->vitamin_a; ?>" data-obat_cacing="<?= $balita->obat_cacing; ?>" data-alamat="<?= $balita->alamat; ?>" data-telepon="<?= $balita->telepon; ?>" data-orangtua="<?= $balita->orangtua; ?>" data-posyandu_id="<?= $balita->posyandu_id; ?>"><i class="fa fa-marker"></i></a>
                                                        <a href="#" class="btn btn-danger btn-delete" data-id="<?= $balita->id; ?>"><i class="fa fa-trash"></i></a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- Modal Add Product-->
<form action="<?php echo base_url("balita/save"); ?>" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Ukur</label>
                        <input type="date" class="form-control" name="tanggal_ukur" placeholder="Tanggal Ukur">
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" class="form-control" name="umur" placeholder="Umur">
                    </div>
                    <div class="form-group">
                        <label>Tinggi Badan</label>
                        <input type="number" class="form-control" name="tinggi_badan" placeholder="Tinggi Badan">
                    </div>
                    <div class="form-group">
                        <label>Berat Badan</label>
                        <input type="number" class="form-control" name="berat_badan" placeholder="Berat Badan">
                    </div>
                    <div class="form-group">
                        <label>Lingkar Kepala</label>
                        <input type="number" class="form-control" name="lingkar_kepala" placeholder="Lingkar Kepala">
                    </div>
                    <div class="form-group">
                        <label>Vitamin A</label>
                        <select name="vitamin_a" class="form-control" required>
                            <option value="">-- Pilih Status Vitamin A --</option>
                            <option value="1">Sudah</option>
                            <option value="0">Belum</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Obat Cacing</label>
                        <select name="obat_cacing" class="form-control" required>
                            <option value="">-- Pilih Status Obat Cacing --</option>
                            <option value="1">Sudah</option>
                            <option value="0">Belum</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Orangtua</label>
                        <input type="text" class="form-control" name="orangtua" placeholder="Orangtua">
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control" name="telepon" placeholder="Telepon">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                    </div>
                    <?php
                    if ($this->session->userdata('level') != 'kader') {
                    ?>
                        <div class="form-group">
                            <label>Posyandu</label>
                            <select name="posyandu_id" class="form-control" required>
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
<form action="<?php echo base_url("balita/update"); ?>" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control nama" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir required">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Ukur</label>
                        <input type="date" class="form-control tanggal_ukur" name="tanggal_ukur" placeholder="Tanggal Ukur" required>
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" class="form-control umur" name="umur" placeholder="Umur" required>
                    </div>
                    <div class="form-group">
                        <label>Tinggi Badan</label>
                        <input type="number" class="form-control tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan" required>
                    </div>
                    <div class="form-group">
                        <label>Berat Badan</label>
                        <input type="number" class="form-control berat_badan" name="berat_badan" placeholder="Berat Badan" required>
                    </div>
                    <div class="form-group">
                        <label>Lingkar Kepala</label>
                        <input type="number" class="form-control lingkar_kepala" name="lingkar_kepala" placeholder="Lingkar Kepala" required>
                    </div>
                    <div class="form-group">
                        <label>Vitamin A</label>
                        <select name="vitamin_a" class="form-control vitamin_a" required>
                            <option value="">-- Pilih Status Vitamin A --</option>
                            <option value="1">Sudah</option>
                            <option value="0">Belum</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Obat Cacing</label>
                        <select name="obat_cacing" class="form-control obat_cacing" required>
                            <option value="">-- Pilih Status Obat Cacing --</option>
                            <option value="1">Sudah</option>
                            <option value="0">Belum</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Orangtua</label>
                        <input type="text" class="form-control orangtua" name="orangtua" placeholder="Orangtua" required>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control telepon" name="telepon" placeholder="Telepon" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control alamat" name="alamat" placeholder="Alamat" required>
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
                    <h5 class="modal-title" id="exampleModalLabel">Lihat Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control nama" name="nama" placeholder="Nama" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Ukur</label>
                        <input type="date" class="form-control tanggal_ukur" name="tanggal_ukur" placeholder="Tanggal Ukur" disabled>
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" class="form-control umur" name="umur" placeholder="Umur" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tinggi Badan</label>
                        <input type="number" class="form-control tinggi_badan" name="tinggi_badan" placeholder="Tinggi Badan" disabled>
                    </div>
                    <div class="form-group">
                        <label>Berat Badan</label>
                        <input type="number" class="form-control berat_badan" name="berat_badan" placeholder="Berat Badan" disabled>
                    </div>
                    <div class="form-group">
                        <label>Lingkar Kepala</label>
                        <input type="number" class="form-control lingkar_kepala" name="lingkar_kepala" placeholder="Lingkar Kepala" disabled>
                    </div>
                    <div class="form-group">
                        <label>Vitamin A</label>
                        <select name="vitamin_a" class="form-control vitamin_a" disabled>
                            <option value="">-- Pilih Status Vitamin A --</option>
                            <option value="1">Sudah</option>
                            <option value="0">Belum</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Obat Cacing</label>
                        <select name="obat_cacing" class="form-control obat_cacing" disabled>
                            <option value="">-- Pilih Status Obat Cacing --</option>
                            <option value="1">Sudah</option>
                            <option value="0">Belum</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Orangtua</label>
                        <input type="text" class="form-control orangtua" name="orangtua" placeholder="Orangtua" disabled>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control telepon" name="telepon" placeholder="Telepon" disabled>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control alamat" name="alamat" placeholder="Alamat" disabled>
                    </div>
                    <div class="form-group">
                        <label>Posyandu</label>
                        <input type="text" class="form-control posyandu_nama" name="posyandu_id" placeholder="Posyandu" disabled>
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
<form action="<?php echo base_url("balita/delete"); ?>" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apa anda yakin ingin menghapus data balita?</h5>
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
        $('#datatables').DataTable();
        $('.btn-edit').on('click', function() {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const tanggal_lahir = $(this).data('tanggal_lahir');
            const tanggal_ukur = $(this).data('tanggal_ukur');
            const umur = $(this).data('umur');
            const tinggi_badan = $(this).data('tinggi_badan');
            const berat_badan = $(this).data('berat_badan');
            const lingkar_kepala = $(this).data('lingkar_kepala');
            const vitamin_a = $(this).data('vitamin_a');
            const obat_cacing = $(this).data('obat_cacing');
            const orangtua = $(this).data('orangtua');
            const telepon = $(this).data('telepon');
            const alamat = $(this).data('alamat');
            const posyandu_id = $(this).data('posyandu_id');
            $('.id').val(id);
            $('.nama').val(nama);
            $('.tanggal_lahir').val(tanggal_lahir);
            $('.tanggal_ukur').val(tanggal_ukur);
            $('.umur').val(umur);
            $('.tinggi_badan').val(tinggi_badan);
            $('.berat_badan').val(berat_badan);
            $('.lingkar_kepala').val(lingkar_kepala);
            $('.vitamin_a').val(vitamin_a);
            $('.obat_cacing').val(obat_cacing);
            $('.orangtua').val(orangtua);
            $('.telepon').val(telepon);
            $('.alamat').val(alamat);
            $('.posyandu_id').val(posyandu_id);
            $('#editModal').modal('show');
        });

        $('.btn-view').on('click', function() {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const tanggal_lahir = $(this).data('tanggal_lahir');
            const tanggal_ukur = $(this).data('tanggal_ukur');
            const umur = $(this).data('umur');
            const tinggi_badan = $(this).data('tinggi_badan');
            const berat_badan = $(this).data('berat_badan');
            const lingkar_kepala = $(this).data('lingkar_kepala');
            const vitamin_a = $(this).data('vitamin_a');
            const obat_cacing = $(this).data('obat_cacing');
            const orangtua = $(this).data('orangtua');
            const telepon = $(this).data('telepon');
            const alamat = $(this).data('alamat');
            const posyandu_nama = $(this).data('posyandu_nama');
            $('.id').val(id);
            $('.nama').val(nama);
            $('.tanggal_lahir').val(tanggal_lahir);
            $('.tanggal_ukur').val(tanggal_ukur);
            $('.umur').val(umur);
            $('.tinggi_badan').val(tinggi_badan);
            $('.berat_badan').val(berat_badan);
            $('.lingkar_kepala').val(lingkar_kepala);
            $('.vitamin_a').val(vitamin_a);
            $('.obat_cacing').val(obat_cacing);
            $('.orangtua').val(orangtua);
            $('.telepon').val(telepon);
            $('.alamat').val(alamat);
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