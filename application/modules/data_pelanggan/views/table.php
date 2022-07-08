<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title?></h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                <table id="order-listing" class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['data_pelanggan'] as $data) { ?>
                            <tr>
                                <td><?= $data['username']?></td>
                                <td><?= $data['nama_pelanggan']?></td>
                                <td><?= $data['alamat']?></td>
                                <td>
                                    <label class="badge badge-<?= ($data['status'] == "Aktif") ? "info" : "danger"?>"><?= $data['status']?></label>
                                </td>
                                <td>
                                    <?php if($data['status'] == "Non-Aktif") { ?>
                                        <button class="btn btn-outline-primary btnaction" data-id="<?= $data['id']?>">Aktifkan</button>
                                    <?php }else { ?>
                                        -    
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