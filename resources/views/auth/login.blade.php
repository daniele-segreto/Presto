<x-layout>

    <h1 class="text-center mt-5">LOGIN</h1>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <form method="POST" action="{{route("login")}}">
                    @csrf
                    <div class="mb-3">
                        <label for="InputName1" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" id="InputEmail1" aria-describedby="nameHelp">
                    </div>
                    <div class="mb-3">
                        <label for="InputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="InputPassword1">
                    </div>

                    <button type="submit" class="btn btn-dark mt-1 mb-3">Login</button>

                    <p class="mt-4">Se non sei ancora iscritto al nostro sito, <a href="{{route("register")}}">REGISTRATI</a> adesso.</p>
                </form>
            </div>
        </div>
    </div>

</x-layout>