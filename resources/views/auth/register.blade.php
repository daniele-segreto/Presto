<x-layout>
    
    <h1 class="text-center mt-5">REGISTRATI</h1>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <form method="POST" action="{{route("register")}}">
                    @csrf
                    <div class="mb-3">
                        <label for="InputName1" class="form-label">Nome Utente</label>
                        <input type="text" name="name" class="form-control" id="InputName1" aria-describedby="nameHelp">
                    </div>
                    <div class="mb-3">
                        <label for="InputEmail1" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="InputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="InputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="InputPassword1" class="form-label">Conferma Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="InputPassword1">
                    </div>

                    <button type="submit" class="btn btn-dark mt-1 mb-3">Accedi</button>

                    <p class="mt-4">Se sei già iscritto, effettua il <a href="{{route("login")}}">LOGIN</a>!</p>
                </form>
            </div>
        </div>
    </div>

</x-layout>