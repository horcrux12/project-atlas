<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title?></h4>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-md-end">
                    <a class="btn btn-success btn-icon-text mx-3" href="<?= base_url();?>barang-rusak/tambah-barang-rusak">Tambah Barang Rusak</a>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Tanggal Penempatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['data_barang_rusak'] as $value) { ?>
                                <tr>
                                    <td><?= $value['nama_barang']?></td>
                                    <td><?= $value['jumlah']?></td>
                                    <td><?= format_indo($value['tanggal_penempatan']);?></td>
                                    <td>
                                        <!-- <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal-barang-<?=$value['id_barang'];?>">Kurangi stok</button> -->
                                        <a class="btn btn-danger btn-hapus" href="<?=base_url().'barang-rusak/hapus-barang-rusak/'.$value['id_barang_rusak']?>">hapus</a>
                                    </td>
                                </tr>
                            <?php }?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>