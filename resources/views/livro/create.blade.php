@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            @include('crud.sidebar')
            <section class="col-12 col-md-9 my-5 m-md-0">
                <div class="container">
                    @error('nome')
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show rounded-0 my-2" role="alert">
                                    Ocorreu um problema durante o cadastro: <strong>{{ $message }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @enderror
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="card rounded-0 card-crud">
                                <h2 class="card-header">
                                    <i class="fa-solid fa-book-open-reader"></i> Cadastro de Autor
                                </h2>
                                <div class="card-body p-3">
                                    <form class="form container form-validate" method="POST" action="{{ route('autor.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 mb-1">
                                                <p><strong>Todos os campos são obrigatórios.</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="nome" class="form-label">Autor</label>
                                                <input type="text" class="form-control rounded-0" name="nome" id="nome" placeholder="Coloque o nome do autor aqui..." required maxlength="40" value="{{ old('nome') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 my-3 mx-auto">
                                                <button class="btn btn-primary btn-submit rounded-0 w-100" type="submit"><i class="fa-solid fa-cloud-arrow-up"></i> Salvar</button>
                                            </div>
                                            <div class="col-6 my-3 mx-auto">
                                                <a href="{{ route('autor.index') }}" class="btn btn-secondary btn-cancel rounded-0 w-100"><i class="fa-solid fa-ban"></i> Cancelar</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @push('scripts')
    <script>
        $("form.form-validate").validate({
            submitHandler: function(form) {
              form.submit();
            }
        });
    </script>
    @endpush
@endsection