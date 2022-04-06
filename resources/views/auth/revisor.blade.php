<x-layout>

    @if ($announcement)

        <div class="container mt-4 mb-4">
            <div class="row mt-4 justify-content-center">
                <div class="col-12 col-md-6">

                    <div class="card border-dark mb-3">

                        <div class="card-header bg-transparent border-dark text-center">Annuncio da revisionare:
                            #{{ $announcement->id }}</div>

                        <div class="card-body text-dark text-center">

                            <h5 class="card-title">Titolo</h5>
                            <p class="card-text">{{ $announcement->title }}</p>

                            <hr>

                            <h5 class="card-title">Descrizione</h5>
                            <p class="card-text">{{ $announcement->body }}</p>

                            <hr>

                            <h5 class="card-title">Immagine</h5>
                            {{-- <img src="https://via.placeholder.com/250x150.png" class="rounded" alt="img"> --}}
                            @foreach ($announcement->images as $image)
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <img src="{{ $image->getUrl(300, 150) }}" alt="img"
                                            class="rounded mb-3"><br>
                                        adult: {{ $image->adult }} <br>
                                        spoof: {{ $image->spoof }} <br>
                                        medical: {{ $image->medical }} <br>
                                        violence: {{ $image->violence }} <br>
                                        racy: {{ $image->racy }} <br>
                                        {{-- id: {{ $image->id }} <br>
                                        pub: {{ $image->file }} <br>
                                        sto: {{ Storage::url($image->file) }} <br> --}}
                                        <br>
                                        {{-- Verifica delle etichette --}}
                                        <b>Labels</b><br>
                                        <ul>
                                            @if ($image->labels)
                                                @foreach ($image->labels as $label)
                                                    {{ $label }} |
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                            <hr>

                            <h5 class="card-title">Utente</h5>
                            <p class="card-text">#{{ $announcement->user->id }},
                                {{ $announcement->user->name }}, {{ $announcement->user->email }},</p>

                        </div>

                        <div class="card-footer bg-transparent border-dark d-flex flex-row justify-content-evenly">

                            <form action="{{ route('revisor.accept', $announcement->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark btn-sm">Accetta</button>
                            </form>

                            <form action="{{ route('revisor.reject', $announcement->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark btn-sm">Rifiuta</button>
                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12">
                    <h1 class="text-center">Non ci sono annunci da visionare</h1>
                </div>
            </div>
        </div>
    @endif

</x-layout>