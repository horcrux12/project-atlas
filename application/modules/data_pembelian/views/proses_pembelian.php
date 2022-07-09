<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title?></h4>
                <div class="row">
                    <div class="col-lg-12 row">
                        <div class="col-lg-3">
                            Nama Pembeli
                        </div>
                        <div class="col-lg-9">
                            : &ensp; <?= $data['data_pembelian']['nama']?>
                        </div>
                    </div>
                    <div class="col-lg-12 row">
                        <div class="col-lg-3">
                            Alamat Pembeli
                        </div>
                        <div class="col-lg-9">
                            : &ensp; <?= $data['data_pembelian']['alamat']?>
                        </div>
                    </div>
                </div>
                <form class="cmxform forms-sample mt-5" id="tambahDataForm" method="POST" action="<?= base_url(); ?>data-pembelian/input-proses-pembelian">
                    <fieldset>    
                        <input type="hidden" name="id_pembelian" value="<?= $data['data_pembelian']['id'] ?>">
                        <input type="hidden" name="id_user" value="<?= $data['data_pembelian']['id_user'] ?>">
                        <div class="form-group">
                            <label for="select-status" style="font-size: 1rem;">Status</label>
                            <select name="status" id="select-status" class="form-control form-control-lg" style="color:black" required>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Disetujui">Disetujui</option>
                            </select>
                        </div>
                        <div class="form-group" id="input-pesan">
                            <label for="select-status" style="font-size: 1rem;">Pesan</label>
                            <textarea name="pesan" class="form-control form-control-lg"></textarea>
                        </div>
                        <div class="table-responsive pt-3 mb-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Stok</th>
                                        <th>Jumlah Disetujui</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['data_keranjang'] as $key) { ?>
                                        <input type="hidden" value="<?=$key['id'] ?>" name="id[]">
                                        <tr>
                                            <td><?= $key['nama_barang']?></td>
                                            <td><?= $key['jumlah_pembelian']?></td>
                                            <td><?= $key['stok']?></td>
                                            <td>
                                                <div class="form-group">
                                                    <input name="jumlah_disetujui[]" disabled="true" class="form-control form-control-lg jumlah-barang" type="number" data-max="<?= $key['stok']?>" required>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-md-end">
                            </div>
                        <div class="d-flex p-2 justify-content-md-between">
                            <a href="<?= base_url(); ?>data-pembelian" class="btn btn-success "><i class="ti-arrow-left me-1"></i>Back</a>
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>