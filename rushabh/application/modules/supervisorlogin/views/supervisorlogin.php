<main>
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side">

                    </div>
                    <div class="form-side">
                        <span class="logo-single"></span>
                        <h6 class="mb-4">Supervisor Login</h6>
                        <?php
                        $attributes = array('class' => 'form', 'id' => 'loginform');
                        echo form_open('', $attributes);
                        ?>
                        <label class="has-float-label mb-4"><span>USERNAME</span>
                            <input class="form-control" name="username">

                        </label>

                        <label class="form-group has-float-label mb-4"><span>PASSWORD</span>
                            <input class="form-control" type="password" id = "userpassword" name = "userpassword" placeholder="">

                        </label>

                        <div id="errormessage"></div>
                        <div class="d-flex justify-content-between align-items-center"><a href="#">Forget password?</a> <button class="btn btn-primary btn-lg btn-shadow" id = "login" type="submit">LOGIN</button></div>
                        <?php
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

