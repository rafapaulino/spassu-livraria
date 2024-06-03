<section class="col-12 col-md-9 my-5 m-md-0">
    <div class="container">
        
        @if (session('success'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show rounded-0 my-2" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show rounded-0 my-2" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mb-2">
            <div class="col-12">
                <div class="card rounded-0 card-crud">
                    <h2 class="card-header">
                        <i class="fa-solid fa-clipboard-list"></i> Listagem de Autores
                    </h2>
                    <div class="card-body p-3">
                        <a href="{{ route('autor.create') }}" class="btn btn-primary btn-action rounded-0 mb-3"><i class="fa-solid fa-plus"></i> Adicionar Novo Autor</a>
                        <div class="table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Autor</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($autores as $autor)
                                    <tr>
                                        <td>{{ $autor->nome }}</td>
                                        <td>
                                            <a href="{{ route('autor.edit', $autor->id) }}" class="btn btn-primary rounded-0 btn-action"><i class="fa-solid fa-file-pen"></i> Editar</a>

                                            <form action="{{ route('autor.destroy', $autor->id) }}" method="POST" style="display:inline;" class="form-destroy">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger rounded-0 btn-action"><i class="fa-solid fa-trash-can"></i> Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Autor</th>
                                        <th>Ações</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                {{ $autores->links() }}
            </div>
        </div>

    </div>
</section>