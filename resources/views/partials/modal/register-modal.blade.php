<div class="modal" tabindex="-1" id="registerModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content px-2">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="login-form">
                    <div class="row align-items-center h-100">
                        <div class="col-lg-5 border-right">
                            <div class="form-group">
                                <label for="" class="control-label">Firstname</label>
                                <input type="text" class="form-control form-control-sm form" name="firstname"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Lastname</label>
                                <input type="text" class="form-control form-control-sm form" name="lastname"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Contact</label>
                                <input type="text" class="form-control form-control-sm form" name="contact" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Gender</label>
                                <select name="gender" id="" class="form-control form-select" required>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="" class="control-label">Default Delivery Address</label>
                                <textarea class="form-control form" rows='2' name="default_delivery_address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Email</label>
                                <input type="text" class="form-control form-control-sm form" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Password</label>
                                <input type="password" class="form-control form-control-sm form" name="password"
                                    required>
                            </div>
                            <div class="form-group d-flex justify-content-between mt-2">
                                <a class="text-decoration-none" href="#" data-bs-toggle="modal"
                                    data-bs-target="#loginModal">Already have an Account</a>
                                <button class="btn btn-primary btn-flat">Register</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
