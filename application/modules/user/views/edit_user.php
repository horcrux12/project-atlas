<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Edit User</h4>
                <form class="cmxform" id="signupForm" method="post" action="<?=base_url();?>user/edit-user/<?=$data['data_user']['id_user'];?>">
                <fieldset>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input id="nama" class="form-control" name="nama" type="text" required value="<?=$data['data_user']['nama'];?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" class="form-control" name="username" type="text" value="<?=$data['data_user']['username'];?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-control" name="password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm password</label>
                        <input id="confirm_password" class="form-control" name="confirm_password" type="password">
                    </div>
                    <a class="btn btn-success" href="<?=base_url()?>user">Kembali</a>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>