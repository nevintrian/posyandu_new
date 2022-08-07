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
                                <?php
                                foreach ($posyandu_data as $posyandu) {
                                ?>
                                    <a href="ibu/<?= $posyandu->id ?>" class="btn btn-info"><?= $posyandu->nama ?></a>
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
                                                <th>Nama Ibu</th>
                                                <th>Nama Suami</th>
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
                                                    <td><?= $ibu->nama_ibu ?></td>
                                                    <td><?= $ibu->nama_suami ?></td>
                                                    <td><?= $ibu->alamat ?></td>
                                                    <td><?= $ibu->tanggal_daftar ?></td>
                                                    <td><?= $ibu->telepon ?></td>
                                                    <td><?= $ibu->posyandu_nama ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-view" data-id="<?= $ibu->id; ?>" data-nama_ibu="<?= $ibu->nama_ibu; ?>" data-nama_suami="<?= $ibu->nama_suami; ?>" data-alamat="<?= $ibu->alamat; ?>" data-tanggal_daftar="<?= $ibu->tanggal_daftar; ?>" data-umur_kehamilan="<?= $ibu->umur_kehamilan; ?>" data-telepon="<?= $ibu->telepon; ?>" data-keluhan="<?= $ibu->keluhan; ?>" data-posyandu_nama="<?= $ibu->posyandu_nama; ?>"><i class="fa fa-eye"></i></a>
                                                        <a href="#" class="btn btn-info btn-edit" data-id="<?= $ibu->id; ?>" data-nama_ibu="<?= $ibu->nama_ibu; ?>" data-nama_suami="<?= $ibu->nama_suami; ?>" data-alamat="<?= $ibu->alamat; ?>" data-tanggal_daftar="<?= $ibu->tanggal_daftar; ?>" data-umur_kehamilan="<?= $ibu->umur_kehamilan; ?>" data-telepon="<?= $ibu->telepon; ?>" data-keluhan="<?= $ibu->keluhan; ?>" data-posyandu_id="<?= $ibu->posyandu_id; ?>"><i class="fa fa-marker"></i></a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Modal Add Product-->
<form action="ibu/save" method="post">
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
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu">
                    </div>
                    <div class="form-group">
                        <label>Nama Suami</label>
                        <input type="text" class="form-control" name="nama_suami" placeholder="Nama Suami">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Daftar</label>
                        <input type="date" class="form-control" name="tanggal_daftar" placeholder="Tanggal Daftar">
                    </div>
                    <div class="form-group">
                        <label>Umur Kehamilan</label>
                        <input type="number" class="form-control" name="umur_kehamilan" placeholder="Umur Kehamilan">
                    </div>
                    <div class="form-group">
                        <label>Keluhan</label>
                        <input type="text" class="form-control" name="keluhan" placeholder="Keluhan">
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control" name="telepon" placeholder="Telepon">
                    </div>
                    <div class="form-group">
                        <label>Posyandu</label>
                        <select name="posyandu_id" class="form-control" required>
                            <option value="">-- Pilih Posyandu --</option>
                            <?php foreach ($posyandu_data as $posyandu) : ?>
                                <option value="<?= $posyandu->id; ?>"><?= $posyandu->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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
<form action="ibu/update" method="post">
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
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control nama_ibu" name="nama_ibu" placeholder="Nama Ibu">
                    </div>
                    <div class="form-group">
                        <label>Nama Suami</label>
                        <input type="text" class="form-control nama_suami" name="nama_suami" placeholder="Nama Suami">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control alamat" name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Daftar</label>
                        <input type="date" class="form-control tanggal_daftar" name="tanggal_daftar" placeholder="Tanggal Daftar">
                    </div>
                    <div class="form-group">
                        <label>Umur Kehamilan</label>
                        <input type="number" class="form-control umur_kehamilan" name="umur_kehamilan" placeholder="Umur Kehamilan">
                    </div>
                    <div class="form-group">
                        <label>Keluhan</label>
                        <input type="text" class="form-control keluhan" name="keluhan" placeholder="Keluhan">
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="number" class="form-control telepon" name="telepon" placeholder="Telepon">
                    </div>
                    <div class="form-group">
                        <label>Posyandu</label>
                        <select name="posyandu_id" class="form-control posyandu_id" required>
                            <option value="">-- Pilih Posyandu --</option>
                            <?php foreach ($posyandu_data as $posyandu) : ?>
                                <option value="<?= $posyandu->id; ?>"><?= $posyandu->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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
                        <label>Tanggal Daftar</label>
                        <input type="date" class="form-control tanggal_daftar" name="tanggal_daftar" placeholder="Tanggal Daftar" disabled>
                    </div>
                    <div class="form-group">
                        <label>Umur Kehamilan</label>
                        <input type="number" class="form-control umur_kehamilan" name="umur_kehamilan" placeholder="Umur Kehamilan" disabled>
                    </div>
                    <div class="form-group">
                        <label>Keluhan</label>
                        <input type="text" class="form-control keluhan" name="keluhan" placeholder="Keluhan" disabled>
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
<form action="ibu/delete" method="post">
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

<script src="templates/plugins/jquery/jquery.min.js"></script>
<script src="templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatables').DataTable();
        $('.btn-edit').on('click', function() {
            const id = $(this).data('id');
            const nama_ibu = $(this).data('nama_ibu');
            const nama_suami = $(this).data('nama_suami');
            const alamat = $(this).data('alamat');
            const tanggal_daftar = $(this).data('tanggal_daftar');
            const umur_kehamilan = $(this).data('umur_kehamilan');
            const keluhan = $(this).data('keluhan');
            const telepon = $(this).data('telepon');
            const posyandu_id = $(this).data('posyandu_id');
            $('.id').val(id);
            $('.nama_ibu').val(nama_ibu);
            $('.nama_suami').val(nama_suami);
            $('.alamat').val(alamat);
            $('.tanggal_daftar').val(tanggal_daftar);
            $('.umur_kehamilan').val(umur_kehamilan);
            $('.keluhan').val(keluhan);
            $('.telepon').val(telepon);
            $('.posyandu_id').val(posyandu_id);
            $('#editModal').modal('show');
        });

        $('.btn-view').on('click', function() {
            const id = $(this).data('id');
            const nama_ibu = $(this).data('nama_ibu');
            const nama_suami = $(this).data('nama_suami');
            const alamat = $(this).data('alamat');
            const tanggal_daftar = $(this).data('tanggal_daftar');
            const umur_kehamilan = $(this).data('umur_kehamilan');
            const keluhan = $(this).data('keluhan');
            const telepon = $(this).data('telepon');
            const posyandu_nama = $(this).data('posyandu_nama');
            $('.id').val(id);
            $('.nama_ibu').val(nama_ibu);
            $('.nama_suami').val(nama_suami);
            $('.alamat').val(alamat);
            $('.tanggal_daftar').val(tanggal_daftar);
            $('.umur_kehamilan').val(umur_kehamilan);
            $('.keluhan').val(keluhan);
            $('.telepon').val(telepon);
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