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
                        <?php foreach ($data['data_pembelian'] as $value) { ?>
                            <tr>
                                <td><?= $value['tanggal_pembelian']?></td>
                                <td><?= $value['nama']?></td>
                                <td><?= $value['status']?></td>
                                <td>
                                    <a class="btn btn-primary" href="<?=base_url().'data-pembelian/detail-pembelian/'.$value['id_pembelian'];?>">Detail</a>
                                    <?php if($this->session->userdata('level') == 1  && $value['status'] == "Menunggu Konfirmasi") {?>
                                        <a class="btn btn-warning" href="<?= base_url().'data-pembelian/proses-pembelian/'.$value['id_pembelian'];?>">Proses</a>
                                    <?php } else if($this->session->userdata('level') == 2 && $value['status'] == "Menunggu Konfirmasi") {?>
                                        <a class="btn btn-danger btn-hapus" href="<?= base_url().'data-pembelian/hapus-pembelian/'.$value['id_pembelian'];?>">Hapus</a>
                                    <?php } else if($this->session->userdata('level') == 2 && $value['status'] == "Menunggu Pembayaran") {?>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-pembelian-<?=$value['id_pembelian'];?>">Upload Bukti Pembayaran</button>
                                    <?php } else if($this->session->userdata('level') == 1 && $value['status'] == "Menunggu Konfirmasi Pembayaran") {?>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-konfirmasi-<?=$value['id_pembelian'];?>">Konfirmasi Pembayaran</button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-pembelian-<?=$value['id_pembelian'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Upload bukti pembayaran</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?=base_url()."data-pembelian/upload-pembayaran/".$value["id_pembelian"];?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Upload pembayaran:</label>
                                                <input type="file" class="form-control" name="bukti_pembayaran"/>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Upload</button>
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modal-konfirmasi-<?=$value['id_pembelian'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Konfirmasi pembayaran</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="lightgallery" class="row justify-content-md-center">
                                                <div class="col text-center">
                                                    <?php if($value['bukti_pembayaran'] != "") { ?>
                                                    <a href="<?=base_url().'assets/images/uploads/bukti-pembayaran/'.$value['bukti_pembayaran'];?>" target="_blank" class="image-tile"><img src="<?=base_url().'assets/images/uploads/bukti-pembayaran/'.$value['bukti_pembayaran'];?>" style="max-height:29rem" alt="image small"></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?= base_url().'data-pembelian/konfirmasi-pembelian/'.$value['id_pembelian'];?>" class="btn btn-success">Konfirmasi Pembayaran</a>
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>