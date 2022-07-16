<div class="row" id="section-to-print">
    <div class="col-lg-12">
        <div class="card px-2">
            <div class="card-body">
                <div class="container-fluid">
                    <h3 class="text-right my-5">Nota Pengiriman Barang &nbsp;&nbsp;#INV-<?= $data['data_transaksi']['id']?></h3>
                    <hr>
                </div>
                <div class="container-fluid d-flex justify-content-between">
                    <div class="col-lg-12 ps-0 row">
                        <div class="col-lg-4">
                            <p>Nama Pengirim</p>
                        </div>
                        <div class="col-lg-8">
                            <p>: <?= $data['data_transaksi']['nama_pengirim'];?></p>
                        </div>
                        <div class="col-lg-4">
                            <p>Nomor Pengiriman</p>
                        </div>
                        <div class="col-lg-8">
                            <p>: <?= $data['data_transaksi']['nomor_shipment'];?></p>
                        </div>
                        <div class="col-lg-4">
                            <p>Nomor Polisi</p>
                        </div>
                        <div class="col-lg-8">
                            <p>: <?= $data['data_transaksi']['nomor_polisi'];?></p>
                        </div>
                        <div class="col-lg-4">
                            <p>Nomor DO</p>
                        </div>
                        <div class="col-lg-8">
                            <p>: <?= $data['data_transaksi']['nomor_do'];?></p>
                        </div>
                        <div class="col-lg-4">
                            <p>Nomor SO/SA</p>
                        </div>
                        <div class="col-lg-8">
                            <p>: <?= $data['data_transaksi']['nomor_so_sa'];?></p>
                        </div>
                        <p class="mb-0 mt-5">Tanggal Pengiriman : <?= format_indo($data['data_transaksi']['tanggal_transaksi'])?></p>
                    </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                    <div class="table-responsive w-100">
                        <table class="table">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th class="text-right">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jumlah = 0;
                                $i = 1;
                                foreach ($data['data_detail_transaksi'] as $value) { 
                                    $jumlah += $value['jumlah']; ?>
                                    <tr class="text-right">
                                        <td class="text-left"><?= $i;?></td>
                                        <td class="text-left"><?= $value['nama_barang']?></td>
                                        <td><?= $value['jumlah']?></td>
                                    </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container-fluid mt-5 w-100">
                    <hr>
                    <div class="row justify-content-between">
                        <div class="col-lg-4 text-center">
                            <p>Yang Menyetujui</p>
                            <br>
                            <br>
                            <br>
                            <p><b>Admin Gas Order</b></p>
                        </div>
                        <div class="col-lg-4 text-center">
                            <p>Pengirim</p>
                            <br>
                            <br>
                            <br>    
                            <p><b><?= $data['data_transaksi']['nama_pengirim']?></b></p>
                        </div>
                        <div class="col-lg-4 " style="border-left : 1px solid #e3e3e3;">
                            <h4 class="text-right mb-5">Total : <?= $jumlah?></h4>
                            <br>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="container-fluid w-100">
                    <a type="button" href="<?= base_url(); ?>data-transaksi" class="btn btn-success float-right mt-4 ms-2"><i class="ti-arrow-left me-1"></i>Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>