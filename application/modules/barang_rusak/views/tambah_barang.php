<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title?></h4>
                <form class="form-sample" id="tambahDataForm" method="POST" action="<?= base_url();?>barang-rusak/store-barang-rusak">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="select-barang" style="font-size:0.9rem;">Nama barang</label>
                                <select name="barang" id="select-barang" class="form-control form-control-lg" id="loginAs" style="color:black" required>
                                    <option value="">Pilih Barang</option>
                                    <?php for ($i=0; $i < count($data['barang']); $i++) { ?>
                                        <option value='<?= $data['barang'][$i]['id_barang']?>'><?= $data['barang'][$i]['nama_barang']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cbarang">Jumlah</label>
                                <input id="jumlah-barang" name="jumlah" class="form-control form-control-lg" type="number" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-md-end">
                        <input class="btn btn-primary" type="submit" value="Tambah data">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>