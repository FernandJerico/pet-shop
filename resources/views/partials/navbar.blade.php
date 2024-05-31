<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <button class="navbar-toggler btn btn-sm" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo.png') }}" width="30" height="30" class="d-inline-block align-top"
                alt="" loading="lazy">
            CLeoow
        </a>
        <form class="form-inline" id="search-form" action="{{ url('products/search') }}" method="GET">
            <div class="input-group">
                <input class="form-control form-control-sm form" type="search" placeholder="Search" aria-label="Search"
                    name="search" value="{{ request('search') }}" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-success btn-sm m-0" type="submit" id="button-addon2"><i
                            class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a></li>
                @foreach ($categories as $category)
                    @php
                        $subCategories = $category->subCategories()->where('status', 'active')->get();
                    @endphp
                    @if ($subCategories->isEmpty())
                        <li class="nav-item"><a class="nav-link" aria-current="page"
                                href="#">{{ $category->name }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown{{ $category->id }}" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $category->name }}</a>
                            <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown{{ $category->id }}">
                                @foreach ($subCategories as $subCategory)
                                    <li><a class="dropdown-item border-bottom"
                                            href="#">{{ $subCategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            </ul>
            <div class="d-flex align-items-center">
                @guest
                    <button class="btn btn-outline-dark ml-2" id="login-btn" type="button">Login</button>
                @else
                    <a class="text-dark mr-2 nav-link" href="{{ url('cart') }}">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart-count">
                            {{-- @php
                                if (isset($_SESSION['userdata']['id'])):
                                    $count = $conn
                                        ->query(
                                            'SELECT SUM(quantity) as items from `cart` where client_id =' .
                                                $_settings->userdata('id'),
                                        )
                                        ->fetch_assoc()['items'];
                                    echo $count > 0 ? $count : 0;
                                else:
                                    echo '0';
                                endif;
                            @endphp --}}
                        </span>
                    </a>
                    <a href="#" class="text-dark nav-link"><b>Hi,
                            {{ auth()->user()->name }}!</b></a>
                    <a href="#" class="text-dark nav-link"><i class="fa fa-sign-out-alt"></i></a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
    $(function() {
        $('#login-btn').click(function() {
            uni_modal("", "login.php")
        })
        $('#navbarResponsive').on('show.bs.collapse', function() {
            $('#mainNav').addClass('navbar-shrink')
        })
        $('#navbarResponsive').on('hidden.bs.collapse', function() {
            if ($('body').offset.top == 0)
                $('#mainNav').removeClass('navbar-shrink')
        })
    })

    $('#search-form').submit(function(e) {
        e.preventDefault()
        var sTxt = $('[name="search"]').val()
        if (sTxt != '')
            location.href = '{{ url('products/search') }}?search=' + sTxt;
    })
</script>
