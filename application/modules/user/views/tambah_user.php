<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Tambah User</h4>
                <form class="cmxform" id="signupForm" method="post" action="<?=base_url();?>user/store-user">
                <fieldset>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input id="nama" class="form-control" name="nama" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" class="form-control" name="username" type="text">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-control" name="password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm password</label>
                        <input id="confirm_password" class="form-control" name="confirm_password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="loginAs" style="font-size:0.9rem;">Level</label>
                        <select name="level" class="form-control form-control-lg" id="loginAs" style="color:black" required>
                            <option value="">Pilih Level</option>
                            <option value="1">Admin</option>
                            <option value="3">Pimpinan</option>
                        </select>
                    </div>
                    <a class="btn btn-success" href="<?=base_url()?>user">Kembali</a>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>