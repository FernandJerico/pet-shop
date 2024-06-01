@php
$meta = App\Models\SystemInfo::pluck('meta_value', 'meta_field')->toArray();
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <button class="navbar-toggler btn btn-sm" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">
            @if (!empty($meta['logo']))
            <img src="{{ Storage::url($meta['logo']) }}" width="30" height="30" class="d-inline-block align-top" alt=""
                loading="lazy">
            @else
            <img src="{{ asset('assets/img/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt=""
                loading="lazy">
            @endif
            @if (!empty($meta['short_name']))
            {{ $meta['short_name'] }}
            @else
            CLeoow
            @endif
        </a>
        <form class="form-inline" id="search-form" action="{{ url('/') }}" method="GET">
            <div class="input-group">
                <input class="form-control form-control-sm form" type="search" placeholder="Search" aria-label="Search"
                    name="search" value="{{ old('search', $search) }}" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-success btn-sm m-0" type="submit" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a></li>
                @foreach ($categories as $category)
                @php
                $subCategories = $category->subCategories->where('status', 'active');
                @endphp
                @if ($subCategories->isEmpty())
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('category.products', $category->name) }}">{{
                        $category->name }}</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown{{ $category->id }}" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{ $category->name }}</a>
                    <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown{{ $category->id }}">
                        @foreach ($subCategories as $subCategory)
                        <li>
                            <a class="dropdown-item border-bottom"
                                href="{{ route('subcategory.products', ['category' => $category->name, 'subcategory' => $subCategory->name]) }}">{{
                                $subCategory->name }}</a>
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
                <button class="btn btn-outline-dark ml-2" type="button" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Login</button>
                @include('partials.modal.login-modal')
                @else
                <a class="text-dark nav-link" href="{{ url('cart') }}" style="margin-right: 10px">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart-count">
                        {{ auth()->user()->carts->count() }}
                    </span>
                </a>
                <a href="" class="text-dark nav-link"><b>Hi,
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}!</b></a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="text-dark nav-link"
                    style="margin-left: 10px;"><i class="fa fa-sign-out-alt"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
