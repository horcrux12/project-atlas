<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title?></h4>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-md-end">
                    <a type="button" class="btn btn-primary btn-icon-text" href="<?= base_url();?>data-pembelian/tambah-pembelian">Tambah Pembelian</a>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                <table id="order-listing" class="table">
                    <thead>
                        <tr>
                            <th>Tanggal Pembelian</th>
                            <th>Nama Pembeli</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['data_pembelian'] as $data) { ?>
                            <tr>
                                <td><?= $data['tanggal_pembelian']?></td>
                                <td><?= $data['nama']?></td>
                                <td><?= $data['status']?></td>
                                <td>
                                    <a class="btn btn-outline-primary" href="#">Detail</a>
                                    <a class="btn btn-outline-warning" href="#">Proses</a>
                                </td>
                            </tr>
                        <?php }?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>