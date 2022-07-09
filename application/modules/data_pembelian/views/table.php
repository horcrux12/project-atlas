<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title?></h4>
        <div class="row">
            <?php if($this->session->userdata('level') == 2) {?>
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-md-end">
                    <a type="button" class="btn btn-primary btn-icon-text" href="<?= base_url();?>data-pembelian/tambah-pembelian">Tambah Pembelian</a>
                </div>
            </div>
            <?php } ?>
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
                                    <a class="btn btn-outline-primary" href="<?=base_url().'data-pembelian/detail-pembelian/'.$data['id'];?>">Detail</a>
                                    <?php if($this->session->userdata('level') == 1  && $data['status'] == "Sedang Proses") {?>
                                        <a class="btn btn-outline-warning" href="<?= base_url().'data-pembelian/proses-pembelian/'.$data['id'];?>">Proses</a>
                                    <?php } else if($this->session->userdata('level') == 2 && $data['status'] == "Sedang Proses") {?>
                                        <a class="btn btn-outline-danger" id="btn-hapus" href="<?= base_url().'data-pembelian/hapus-pembelian/'.$data['id'];?>">Hapus</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>