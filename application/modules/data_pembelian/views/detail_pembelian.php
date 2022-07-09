<div class="row" id="section-to-print">
    <div class="col-lg-12">
        <div class="card px-2">
            <div class="card-body">
                <div class="container-fluid">
                <h3 class="text-right my-5">Invoice&nbsp;&nbsp;#INV-<?= $data['data_pembelian']['id']?></h3>
                <hr>
                </div>
                <div class="container-fluid d-flex justify-content-between">
                    <div class="col-lg-3 ps-0">
                        <p class="mt-5 mb-2"><b>Toko Gas gas gassss </b></p>
                        <p>Jakarta,<br>Indonesia.</p>
                    </div>
                    <div class="col-lg-3 pr-0">
                        <p class="mt-5 mb-2 text-right"><b>Invoice to</b></p>
                        <p class="text-right"><?= $data['data_pembelian']['nama']?>,<br> <?= $data['data_pembelian']['alamat']?>.</p>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-between">
                    <div class="col-lg-3 ps-0">
                        <p class="mb-0 mt-5">Tanggal Pembelian : <?= format_indo($data['data_pembelian']['tanggal_pembelian'])?></p>
                        <p>Tanggal Persetujuan : <?= ($data['data_pembelian']['status'] == "Disetujui") ? format_indo($data['data_pembelian']['tanggal_pembelian']) : "-";?></p>
                    </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                    <div class="table-responsive w-100">
                        <table class="table">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th class="text-right">Jumlah Permintaan</th>
                                    <th class="text-right">Jumlah Disetujui</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $jumlah = 0;
                                for ($i=0; $i < count($data['data_keranjang']); $i++) { ?>
                                    <tr class="text-right">
                                        <td class="text-left"><?= ($i + 1);?></td>
                                        <td class="text-left"><?= $data['data_keranjang'][$i]['nama_barang']?></td>
                                        <td><?= $data['data_keranjang'][$i]['jumlah_pembelian']?></td>
                                        <td><?= $data['data_keranjang'][$i]['jumlah_disetujui']?></td>
                                        <td><?= $data['data_keranjang'][$i]['harga']?></td>
                                        <td>
                                            <?php 
                                                $final = ($data['data_keranjang'][$i]['harga'] * $data['data_keranjang'][$i]['jumlah_disetujui']);
                                                echo $final; 
                                                $jumlah += $final; 
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
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
                            <p>Pembeli</p>
                            <br>
                            <br>
                            <br>    
                            <p><b><?= $data['data_pembelian']['nama']?></b></p>
                        </div>
                        <div class="col-lg-4 " style="border-left : 1px solid #e3e3e3;">
                            <h4 class="text-right mb-5">Total : <?= $jumlah?></h4>
                            <br>
                            <h4 class="text-right">Status : <?= $data['data_pembelian']['status']?></h4>
                            <?php if ($data['data_pembelian']['status'] == "Ditolak") {?>
                            <p class="text-right">Pesan Admin : <?= $data['data_pembelian']['pesan']?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="container-fluid w-100">
                    <a type="button" href="<?= base_url(); ?>data-pembelian" class="btn btn-success float-right mt-4 ms-2"><i class="ti-arrow-left me-1"></i>Back</a>
                    <?php if($data['data_pembelian']['status'] != "Sedang Proses") { ?>
                    <button onclick="window.print();" class="btn btn-primary float-right mt-4 ms-2"><i class="ti-printer me-1"></i>Print</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>