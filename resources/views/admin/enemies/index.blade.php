@extends('layouts.app')

@section('content')
<did class="row">
    <h1>Lista de Enemigos</h1>
</did>


<div class="row">
    <a href="{{route('enemy.create')}}" class="btn btn-primary mb-2 mt-2">Crear</a>
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
        <th scope="col">Precio</th>    
        <th scope="col">Experiencia</th>    
        <th scope="col">Acciones</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($enemies as $enemy)
            <tr>
                <th scope="row">{{ $enemy->id }}</th>
                <td>{{ $enemy->name }}</td>
                <td>{{ $enemy->hp }}</td>
                <td>{{ $enemy->atq }}</td>
                <td>{{ $enemy->def }}</td>                
                <td>{{ $enemy->coins }}</td> 
                <td>{{ $enemy->xp }}</td>                
                <td>
                    <div class="row">
                        <div class="col">
                            <a href="{{route('enemy.edit', $enemy->id )}}" class="btn btn-warning">Modificar</a>  
                        </div>
                        <div class="col">
                            <form action="{{route('enemy.destroy', $enemy->id )}}" method = "POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $enemy->id }}">Borrar</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $enemy->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Borrar Enemigo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Estas seguro que quieres borrar el enemigo?
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