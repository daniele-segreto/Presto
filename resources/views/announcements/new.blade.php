<x-layout>

    <h1 class="text-center mt-4">CREA ANNUNCIO</h1>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <form method="POST" action="{{ route('announcements.create') }}">
                    @csrf
                    <input type="hidden" name="uniqueSecret" value="{{ $uniqueSecret }}">

                    @if ($errors->messages())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- <h3>DEBUG:: SECRET {{$uniqueSecret}}</h3> --}}

                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingText" placeholder="Titolo annuncio"
                                name="title">
                            <label for="floatingText">Titolo</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"
                                style="height: 100px" name="body"></textarea>
                            <label for="floatingTextarea">Descrizione</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <select name="category" class="form-select" aria-label="Default">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}
                                {{ old('category') == $category->id ? 'selected' : ' ' }}">{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="floatingText" placeholder="Prezzo"
                                name="price">
                            <label for="floatingText">Prezzo</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="images" class="col-md-12 col-form-label text-md-right">Immagini</label>
                        <div class="col-md-12">

                            <div class="dropzone" id="drophere"></div>

                            @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-dark mt-3">Crea</button>
                </form>
            </div>
        </div>
    </div>

</x-layout>
