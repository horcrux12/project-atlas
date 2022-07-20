<div class="row grid-margin">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title?></h4>
                <h5 class="card-description">
                    Atur waktu pengambilan report
                </h5>
                <form class="form-sample" action="<?= base_url();?>report/print" method="POST">
                    <div class="input-group input-daterange d-flex align-items-center mb-5">
                        <input type="text" class="form-control" name="tanggal_awal" required>
                        <span class="input-group-addon input-group-append border-left">
                            <span class="ti-calendar input-group-text"></span>
                        </span>

                        <div class="input-group-addon mx-4">s/d</div>
                        
                        <input type="text" class="form-control" name="tanggal_akhir" required>
                        <span class="input-group-addon input-group-append border-left">
                            <span class="ti-calendar input-group-text"></span>
                        </span>
                    </div>
                    <div class="d-flex justify-content-md-end">
                        <input class="btn btn-primary" type="submit" value="Tampilkan Report">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>