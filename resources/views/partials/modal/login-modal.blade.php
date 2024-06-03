@include('partials.modal.register-modal')
<div class="modal" tabindex="-1" id="loginModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content px-2">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="" class="control-label">Email</label>
                        <input type="email" class="form-control form" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Password</label>
                        <input type="password" class="form-control form" name="password" required>
                    </div>
                    <div class="form-group d-flex justify-content-between mt-2">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Create
                            Account</a>
                        <button type="submit" class="btn btn-primary btn-flat">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
