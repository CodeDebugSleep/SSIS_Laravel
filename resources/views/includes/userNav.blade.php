@include('includes.scripts_styles')
<nav class="navbar navbar-expand-lg navbar-light noBorder">
    <a class="navbar-brand"><img src = "/images/ss-logo.png" class = "navbar-logo"></a>
    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto largeFont">
            
            <li class="nav-item">
                <a class="nav-link " href="/home">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Inventories</a>
                <div class="dropdown-menu myDropdown">
                    <a class="dropdown-item" href="{{ route('stocks.index') }}">Stock</a>
                    <a class="dropdown-item" href="{{ route ('items.index') }}">Items and Products</a>
                </div>
            </li>
        </ul>
        @guest
            @if (Route::has('register'))

            @endif
        @else
        <ul class="navbar-nav ml-auto largeFont">
            <!-- Authentication Links -->
            
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profiles.index') }}">My Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>
