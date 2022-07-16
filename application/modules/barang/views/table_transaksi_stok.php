<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title?></h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Tanggal transaksi</th>
                                <th>Nama Pengirim</th>
                                <th>No Polisi</th>
                                <th>No Pengiriman</th>
                                <th>No DO</th>
                                <th>No SO/SA</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['transaksi_stok'] as $value) { ?>
                                <tr>
                                    <td><?= format_indo_without_time($value['tanggal_transaksi']);?></td>
                                    <td><?= $value['nama_pengirim']?></td>
                                    <td><?= $value['nomor_polisi']?></td>
                                    <td><?= $value['nomor_shipment']?></td>
                                    <td><?= $value['nomor_do']?></td>
                                    <td><?= $value['nomor_so_sa']?></td>
                                    <td>
                                        <a class="btn-sm btn-primary" href="<?=base_url().'data-transaksi/detail-transaksi/'.$value['id']?>">detail</a>
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