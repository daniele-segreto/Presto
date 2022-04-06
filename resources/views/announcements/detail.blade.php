<x-layout>
    <h1 class="text-center mt-5 mb-5">Ecco il tuo annuncio:</h1>

    <div class="container mt-5 border w-100">
        <div class="row justify-content-around">

            <div class="col-12 col-md-4 mt-5 mb-4">

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        {{-- @foreach ($announcement->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ $image->getUrl(300, 150) }}" class="d-block w-100" alt="img">
                            </div>
                        @endforeach --}}
                        <div id="carouselControls-{{ $announcement->id }}" class="carousel slide"
                            data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($announcement->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ $image->getUrl(300, 150) }}" class="d-block w-100" alt="img">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselControls-{{ $announcement->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselControls-{{ $announcement->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <p class="card-text mt-1"><small class="text-muted">Annuncio creato il:
                        {{ $announcement->created_at->format('d/m/Y, h:s') }} - da:
                        {{ $announcement->user->name }}</small>
                </p>

            </div>

            <div class="col-12 col-md-5 mt-4 mb-4">

                <h2>{{ $announcement->title }}</h2>

                <p class="mt-4">{{ $announcement->body }}</p>

                <p class="card-text fs-3 mt-3">Prezzo: <strong>{{ $announcement->price }} €</strong></p>

                <p class="mt-4">Categoria: <strong><a class="text-decoration-none"
                            href="{{ route('announcements.category', [$announcement->category->name, $announcement->category->id]) }}">{{ $announcement->category->name }}</a></strong>
                </p>

                <a class="btn btn-outline-dark btn-sm mt-2 me-4" href="{{ route('home') }}">Torna indietro</a>

            </div>

        </div>
    </div>
</x-layout>
