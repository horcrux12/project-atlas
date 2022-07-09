<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title?></h4>
                <form class="cmxform" class="forms-sample" id="tambahDataForm" method="get" action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cbarang">Nama barang</label>
                                <select name="barang" id="select-barang" class="form-control form-control-lg" id="loginAs" style="color:black" required>
                                    <option value="">Pilih Barang</option>
                                    <?php for ($i=0; $i < count($data['barang']); $i++) { ?>
                                        <option value='<?= json_encode($data['barang'][$i])?>'><?= $data['barang'][$i]['nama_barang']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cbarang">Jumlah pembelian</label>
                                <input disabled="true" id="jumlah-barang" class="form-control form-control-lg" type="number" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-md-end">
                        <input class="btn btn-primary" type="submit" value="Tambah data">
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-lg-12 mb-3">
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="isiTable">
                                    <tr>
                                        <td colspan="3" style="text-align: center">Tidak ada Data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-md-end">
                            <button type="button" id="btn-submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>