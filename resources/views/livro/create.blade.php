@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            @include('crud.sidebar')
            <section class="col-12 col-md-9 my-5 m-md-0">
                <div class="container">
                    @if ($errors->any())
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show rounded-0 my-2" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="card rounded-0 card-crud">
                                <h2 class="card-header">
                                    <i class="fa-solid fa-book-open-reader"></i> Cadastro de Livro
                                </h2>
                                <div class="card-body p-3">
                                    <form class="form container form-validate" method="POST" action="{{ route('livro.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 mb-1">
                                                <p><strong>Todos os campos são obrigatórios.</strong></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="titulo" class="form-label">Título</label>
                                                <input type="text" class="form-control rounded-0" name="titulo" id="titulo" placeholder="Coloque o título do livro aqui..." required maxlength="40" value="{{ old('titulo') }}">
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="preco" class="form-label">Preço</label>
                                                <input type="text" class="form-control rounded-0" name="preco" id="preco" placeholder="Coloque o preço aqui..." required value="{{ old('preco') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-4 mb-3">
                                                <label for="editora" class="form-label">Editora</label>
                                                <input type="text" class="form-control rounded-0" name="editora" id="editora" placeholder="Ex: Editora Marmota..." required maxlength="40" value="{{ old('editora') }}">
                                            </div>
                                            <div class="col-12 col-md-4 mb-3">
                                                <label for="edicao" class="form-label">Edição</label>
                                                <input type="number" class="form-control rounded-0" name="edicao" id="edicao" placeholder="Ex: 1, 2, 3, etc..." required value="{{ old('edicao') }}">
                                            </div>
                                            <div class="col-12 col-md-4 mb-3">
                                                <label for="ano_publicacao" class="form-label">Ano de publicação</label>
                                                <input type="number" class="form-control rounded-0" name="ano_publicacao" id="ano_publicacao" placeholder="Ex: 1993" required maxlength="4" minlength="4" value="{{ old('ano_publicacao') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="assuntos" class="form-label">Assunto</label>
                                                <select class="form-select rounded-0 select-select2" multiple name="assuntos[]" id="assuntos" required data-source="{{ route('assunto.select2') }}"></select>
                                            </div>
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="autores" class="form-label">Autor(es)</label>
                                                <select class="form-select rounded-0 select-select2" multiple name="autores[]" id="autores" required data-source="{{ route('autor.select2') }}"></select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 my-3 mx-auto">
                                                <button class="btn btn-primary btn-submit rounded-0 w-100" type="submit"><i class="fa-solid fa-cloud-arrow-up"></i> Salvar</button>
                                            </div>
                                            <div class="col-6 my-3 mx-auto">
                                                <a href="{{ route('livro.index') }}" class="btn btn-secondary btn-cancel rounded-0 w-100"><i class="fa-solid fa-ban"></i> Cancelar</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/select2.js?src=0') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-mask-money@4.1.3/lib/simple-mask-money.umd.min.js"></script>
    <script>
        const price = SimpleMaskMoney.setMask('#preco');

        $("form.form-validate").validate({
            submitHandler: function(form) {
              form.submit();
            }
        });
    </script>
    @endpush
@endsection