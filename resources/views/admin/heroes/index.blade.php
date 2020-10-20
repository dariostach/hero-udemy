@extends('layouts.app')

@section('content')
<did class="row">
    <h1>Lista de Heroes</h1>
</did>


<div class="row">
    <a href="{{route('heroes.create')}}" class="btn btn-primary mb-2 mt-2">Crear</a>
</div>

<div class="row">
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">HP</th>
        <th scope="col">Ataque</th>
        <th scope="col">Defensa</th>
        <th scope="col">Suerte</th>
        <th scope="col">Monedas</th>
        <th scope="col">Experiencia</th>      
        <th scope="col">Acciones</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($heroes as $hero)
            <tr>
                <th scope="row">{{ $hero->id }}</th>
                <td>{{ $hero->name }}</td>
                <td>{{ $hero->hp }}</td>
                <td>{{ $hero->atq }}</td>
                <td>{{ $hero->def }}</td>
                <td>{{ $hero->luck }}</td>
                <td>{{ $hero->coins }}</td>
                <td>{{ $hero->xp }}</td>
                <td>
                    <div class="row">
                        <div class="col">
                            <a href="{{route('heroes.edit', $hero->id )}}" class="btn btn-warning">Modificar</a>  
                        </div>
                        <div class="col">
                            <form action="{{route('heroes.destroy', $hero->id )}}" method = "POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $hero->id }}">Borrar</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $hero->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Borrar Heroe</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Estas seguro que quieres borrar el heroe?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>        
                                        <button type="submit" class="btn btn-primary">SI</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>                                                            
                </td>
            </tr>
        @endforeach

        
        

    </tbody>
    </table>
</div>

@endsection