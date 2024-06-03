<section class="col-12 col-md-9 my-5 m-md-0">
    <div class="container">
        <div class="row">

            @foreach($livros as $livro)
                <div class="col-12 col-md-4 mb-4">
                    <div class="card rounded-0">
                        <img src="{{ $livro->getImagem() }}" class="card-img-top rounded-0" alt="{{ $livro->titulo }}">
                        <div class="card-body">
                            <p class="card-price"><a href="" title="{{ $livro->titulo }}"><span>R$</span> {{ $livro->preco }}</a></p>
                            <h3 class="card-title"><a href="" title="{{ $livro->titulo }}">{{ $livro->titulo }}</a></h3>
                        </div>
                    </div>
                </div> 
            @endforeach                          
        </div>

        <div class="row">
            <div class="col-12">
                {{ $livros->links() }}
            </div>
        </div>

    </div>
</section>