<x-layout>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5">

            <h3 class="text-secondary mt-2 mb-5">Annunci per categoria: {{ $category->name }}</h3>

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($announcements as $announcement)
                    <div class="col-12 col-md-6 mb-5">
                        <div class="card h-100">

                            {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="announcement"/> --}}
                            <div id="carouselControls-{{ $announcement->id }}" class="carousel slide"
                                data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($announcement->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ $image->getUrl(300, 150) }}" class="d-block w-100"
                                                alt="img">
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

                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">

                                    @if ($announcement->user)

                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $announcement->title }}</h5>
                                        
                                        <!-- Product price-->
                                        {{ $announcement->price }},00 €

                                        <hr>

                                        
                                        <small class="text-muted">
                                            Pubblicato da {{ $announcement->user->name }},
                                            il {{ $announcement->created_at->format('d/m/Y') }}
                                            alle ore{{ $announcement->created_at->format('H:s') }}
                                        </small>

                                        <div class="text-center mt-3"><a href="{{ route('announcements.detail', compact('announcement')) }}">Vai al dettaglio</a></div>
                                        
                                </div>
                            </div>

                            <!-- Product actions-->
                            {{-- Permesso di modificare, solo all'utente loggato che lo ha caricato --}}
                            @if ($announcement->user->id === Auth::id())
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex flex-row justify-content-evenly">

                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto btn-sm" href="{{ route('announcements.update', compact('announcement')) }}">Modifica</a></div>

                                    {{-- <form method="POST" action="{{ route('announcements.delete', compact('announcement')) }}">
                                        @csrf
                                        @method('delete')
                                        <div class="text-center"><button class="btn btn-outline-dark mt-auto btn-sm" type="submit">Cancella</button></div>
                                    </form> --}}

                                </div>
                            @endif
                            @endif

            <div class="card-footer fs-6 text-center">
                <strong>
                    <a class="text-decoration-none text-dark"
                        href="{{ route('announcements.category', [$announcement->category->name, $announcement->category->id]) }}">{{ $announcement->category->name }}</a>
                </strong>
            </div>

        </div>
        </div>
        
        @endforeach
        </div>

        </div>
    </section>
</x-layout>