<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card card-rounded table-darkBGImg">
            <div class="card-body">
                <div class="col-sm-8">
                    <h3 class="text-white upgrade-info mb-0">
                        Selamat datang <span class="fw-bold"><?= $this->session->userdata('nama'); ?></span>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
    <div class="card card-rounded">
        <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <?php if($this->session->userdata('level') == 1) {?>
                            <h4 class="card-title card-title-dash">Diagram Transaksi Stok Barang</h4>
                        <?php }else { ?>
                            <h4 class="card-title card-title-dash">Diagram Pembelian Barang</h4>
                        <?php } ?>
                    </div>
                </div>
                <div class="mt-3" style="height: 40vh">
                    <canvas id="leaveReport"></canvas>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>