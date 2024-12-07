@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-outline mb-4">
        <label class="form-label" for="email">Correo</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electronico"
            required />
    </div>
    <div class="text-center pt-1 mb-5 pb-1">
        <button class="btn btn-primary btn-block fs-lg mb-3" type="submit">Enviar enlace de recuperación</button>
    </div>
</form>
