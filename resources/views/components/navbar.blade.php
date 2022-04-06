<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">Presto.it</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                <li class="nav-item"><a class="nav-link active" aria-current="page"
                        href="{{ route('home') }}">Home</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{__('ui.category')}}</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            @foreach ($categories as $category)
                                <a class="dropdown-item"
                                    href="{{ route('announcements.category', [$category->name, $category->id]) }}">{{ $category->name }}</a>
                            @endforeach
                        </li>
                    </ul>
                </li>

                @guest

                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{__('ui.create')}}</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{__('ui.login')}}</a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{__('ui.register')}}</a></li>

                @else

                    <li class="nav-item"><a class="nav-link" href="{{ route('announcements.new') }}">{{__('ui.create')}}</a></li>

                    @if (Auth::user()->is_revisor)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.revisor') }}">Admin
                                <span
                                    class="badge badge-pill badge-warning text-dark bg-warning">{{ \App\Models\Announcement::ToBeRevisionedCount() }}</span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault()
                                document.getElementById('logout').submit()">{{__('ui.logout')}}</a>
                            </li>
                            <form method="POST" action="{{ route('logout') }}" id="logout">
                                @csrf
                            </form>
                        </ul>
                    </li>

                @endguest
            </ul>

            <form action="{{ route('search') }}" method="GET" class="d-flex">
                <input type="text" name="q" class="form-control me-2" type="search" placeholder="Cerca"aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">Ricerca</button>
            </form>

        </div>
    </div>
</nav>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Presto.it</h1>
            <p class="lead fw-normal text-white-50 mb-0">{{__('ui.slogan')}}</p>

            <form action="{{ route('search') }}" method="GET" class="d-flex mt-4">
                <input type="text" name="q" class="form-control me-2" type="search" placeholder=""aria-label="Search">
                <button class="btn btn-light" type="submit">Cerca</button>
            </form>

        </div>
    </div>
</header>