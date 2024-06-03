<aside class="col-12 col-md-3">
    <h2><i class="fa-brands fa-font-awesome"></i> Assuntos</h2>
    <ul>
        @foreach($assuntos as $assunto)
            <li><a href="" title="{{ $assunto->descricao }}">{{ $assunto->descricao }}</a></li>
        @endforeach
    </ul>

    <h2><i class="fa-solid fa-user-tie"></i> Autores</h2>
    <ul>
        @foreach($autores as $autor)
            <li><a href="" title="{{ $autor->nome }}">{{ $autor->nome }}</a></li>
        @endforeach
    </ul>
</aside>