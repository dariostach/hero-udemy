@extends('layouts.app')

@section('content')
    <did class="row">
        <h1>Sistema de batalla</h1>
    </did>
    <div class="row text-center text-white mt-2">
        <div class="col-5 bg-primary">
            <h2> {{ $heroName }} </h2>            
        </div>
        <div class="col-2 bg-warning">
            <h2>VS</h2>
        </div>
        <div class="col-5 bg-danger">
            <h2>{{ $enemyName }}</h2>           
        </div>
    </div>
    <div class="row text-center text-white mt-2">
        <div class="col-5 bg-primary">
            <img src="{{ asset('images/heroes/' .$heroAvatar )  }}" with="100" height="100">                      
        </div>
        <div class="col-2 bg-warning">
            <h2>VS</h2>
        </div>
        <div class="col-5 bg-danger">
            <img src="{{ asset('images/enemies/' .$enemyAvatar ) }}" with="100" height="100">                   
        </div>
    </div>

    <div class="row text-center text-white mt-2 bg-info">
        <div class="col">
            <h2>Eventos de batalla</h2>
        </div>        
    </div>
    <div class="mt-3">
        @foreach($events as $ev)
            <div  class="alert @if($ev['winner'] == 'hero') alert-success @else alert-danger @endif"  role="alert">
                {{ $ev['text'] }}
            </div>
           
        @endforeach
    </div>
    


@endsection

