<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title?></h4>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-md-end">
                    <a class="btn btn-success btn-icon-text mx-3" href="<?= base_url();?>user/tambah-user">Tambah User</a>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                <table id="order-listing" class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['data_user'] as $value) { ?>
                            <tr>
                                <td><?= $value['username']?></td>
                                <td><?= $value['nama']?></td>
                                <td>
                                    <a class="btn btn-outline-primary" href="<?=base_url().'user/ubah-user/'.$value['id'];?>">Edit</a>
                                    <a class="btn btn-outline-danger btn-hapus" href="<?=base_url().'user/delete-user/'.$value['id'];?>">Hapus</a>
                                </td>
                            </tr>
                        <?php }?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>