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
                            <h3 class="card-title">Data Jadwal Balita</h3>
                        </div>
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah</button>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="card-body p-0">
                                    <table class="table table-bordered" id="datatables">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Tanggal</th>
                                                <th>Kegiatan</th>
                                                <th>Imunisasi</th>
                                                <th>Penyuluhan</th>
                                                <th>Posyandu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($jadwal_balita_data as $jadwal_balita) { ?>
                                                <tr>
                                                    <td style="width: 10px"><?= $i ?></td>
                                                    <td><?= $jadwal_balita->jadwal ?></td>
                                                    <td><?= $jadwal_balita->kegiatan_nama ?></td>
                                                    <td><?= $jadwal_balita->imunisasi_balita_nama ?></td>
                                                    <td><?= $jadwal_balita->penyuluhan_balita_nama ?></td>
                                                    <td><?= $jadwal_balita->posyandu_nama ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-view" data-id="<?= $jadwal_balita->id; ?>" data-jadwal="<?= $jadwal_balita->jadwal; ?>" data-kegiatan_nama="<?= $jadwal_balita->kegiatan_nama; ?>" data-imunisasi_balita_nama="<?= $jadwal_balita->imunisasi_balita_nama; ?>" data-penyuluhan_balita_nama="<?= $jadwal_balita->penyuluhan_balita_nama; ?>" data-posyandu_nama="<?= $jadwal_balita->posyandu_nama; ?>"><i class="fa fa-eye"></i></a>
                                                        <a href="#" class="btn btn-info btn-edit" data-id="<?= $jadwal_balita->id; ?>" data-jadwal="<?= $jadwal_balita->jadwal; ?>" data-kegiatan_id="<?= $jadwal_balita->kegiatan_id; ?>" data-imunisasi_balita_id="<?= $jadwal_balita->imunisasi_balita_id; ?>" data-penyuluhan_balita_id="<?= $jadwal_balita->penyuluhan_balita_id; ?>" data-posyandu_id="<?= $jadwal_balita->posyandu_id; ?>"><i class="fa fa-marker"></i></a>
                                                        <a href="#" class="btn btn-danger btn-delete" data-id="<?= $jadwal_balita->id; ?>"><i class="fa fa-trash"></i></a>
                                                        <?php if ($jadwal_balita->status == 0) { ?>
                                                            <a href="#" class="btn btn-secondary"><i class="fa fa-paper-plane"></i></a>
                                                        <?php } ?>
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
<form action="jadwal_balita/save" method="post">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jadwal</label>
                        <input type="date" class="form-control jadwal" name="jadwal" placeholder="Jadwal" required>
                    </div>
                    <div class="form-group">
                        <label>Kegiatan</label>
                        <select name="kegiatan_id" class="form-control" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            <?php foreach ($kegiatan_data as $kegiatan) : ?>
                                <option value="<?= $kegiatan->id; ?>"><?= $kegiatan->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Imunisasi</label>
                        <select name="imunisasi_balita_id" class="form-control" required>
                            <option value="">-- Pilih Imunisasi --</option>
                            <?php foreach ($imunisasi_balita_data as $imunisasi_balita) : ?>
                                <option value="<?= $imunisasi_balita->id; ?>"><?= $imunisasi_balita->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Penyuluhan</label>
                        <select name="penyuluhan_balita_id" class="form-control" required>
                            <option value="">-- Pilih Penyuluhan --</option>
                            <?php foreach ($penyuluhan_balita_data as $penyuluhan_balita) : ?>
                                <option value="<?= $penyuluhan_balita->id; ?>"><?= $penyuluhan_balita->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
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
<form action="jadwal_balita/update" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jadwal</label>
                        <input type="date" class="form-control jadwal" name="jadwal" placeholder="Jadwal">
                    </div>
                    <div class="form-group">
                        <label>Kegiatan</label>
                        <select name="kegiatan_id" class="form-control kegiatan_id" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            <?php foreach ($kegiatan_data as $kegiatan) : ?>
                                <option value="<?= $kegiatan->id; ?>"><?= $kegiatan->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Imunisasi</label>
                        <select name="imunisasi_balita_id" class="form-control imunisasi_balita_id" required>
                            <option value="">-- Pilih Imunisasi --</option>
                            <?php foreach ($imunisasi_balita_data as $imunisasi_balita) : ?>
                                <option value="<?= $imunisasi_balita->id; ?>"><?= $imunisasi_balita->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Penyuluhan</label>
                        <select name="penyuluhan_balita_id" class="form-control penyuluhan_balita_id" required>
                            <option value="">-- Pilih Penyuluhan --</option>
                            <?php foreach ($penyuluhan_balita_data as $penyuluhan_balita) : ?>
                                <option value="<?= $penyuluhan_balita->id; ?>"><?= $penyuluhan_balita->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
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
                    <h5 class="modal-title" id="exampleModalLabel">Lihat Jadwal Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jadwal</label>
                        <input type="date" class="form-control jadwal" name="jadwal" placeholder="Jadwal" disabled>
                    </div>
                    <div class="form-group">
                        <label>Kegiatan</label>
                        <input type="text" class="form-control kegiatan_nama" name="kegiatan_nama" placeholder="Kegiatan" disabled>
                    </div>
                    <div class="form-group">
                        <label>Imunisasi</label>
                        <input type="text" class="form-control imunisasi_balita_nama" name="imunisasi_balita_nama" placeholder="Imunisasi" disabled>
                    </div>
                    <div class="form-group">
                        <label>Penyuluhan</label>
                        <input type="text" class="form-control penyuluhan_balita_nama" name="penyuluhan_balita_nama" placeholder="Penyuluhan" disabled>
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
<form action="jadwal_balita/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Jadwal Balita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apa anda yakin ingin menghapus data jadwal balita?</h5>
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
            const jadwal = $(this).data('jadwal');
            const kegiatan_id = $(this).data('kegiatan_id');
            const penyuluhan_balita_id = $(this).data('penyuluhan_balita_id');
            const imunisasi_balita_id = $(this).data('imunisasi_balita_id');
            const posyandu_id = $(this).data('posyandu_id');
            $('.id').val(id);
            $('.jadwal').val(jadwal);
            $('.kegiatan_id').val(kegiatan_id);
            $('.penyuluhan_balita_id').val(penyuluhan_balita_id);
            $('.imunisasi_balita_id').val(imunisasi_balita_id);
            $('.posyandu_id').val(posyandu_id);
            $('#editModal').modal('show');
        });

        $('.btn-view').on('click', function() {
            const id = $(this).data('id');
            const jadwal = $(this).data('jadwal');
            const kegiatan_nama = $(this).data('kegiatan_nama');
            const penyuluhan_balita_nama = $(this).data('penyuluhan_balita_nama');
            const imunisasi_balita_nama = $(this).data('imunisasi_balita_nama');
            const posyandu_nama = $(this).data('posyandu_nama');
            $('.id').val(id);
            $('.jadwal').val(jadwal);
            $('.kegiatan_nama').val(kegiatan_nama);
            $('.penyuluhan_balita_nama').val(penyuluhan_balita_nama);
            $('.imunisasi_balita_nama').val(imunisasi_balita_nama);
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

<!-- EAAYIhixngCoBABXSQ4gIZCdhfK6shZA5TNHpp6e2LtrgmJxZCmZAAPZBc97eKh5dSFrKkUe9WZAWILd1LWZAOXseFQrFIEI7CQZCSR1bCEZBjZALSIdsMeFQguwZBq8ZCwd9M6kxsw9Q5Ja0DH73siljy4NtgqYTNeSWoTAkRio3mIvSXU5j5nsNWBzH -->