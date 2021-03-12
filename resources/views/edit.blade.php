@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
@if(Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
</div>
<div class="w-100 h-100 d-flex justify-content-center align-todos-center">
    <div class="text-center" style="width:40%">
    <h1 class="display-2 text-white" style="margin-top:100px;">Edit Todos</h1>
    <h3 class="text-white pt-2 mr-5 mt-3">Update This one!!</h3>
    <form action="{{route('todo.update',$todo->id)}}" method="POST">
    @csrf
    @method('PUT')
        <div class="input-group md-3 wb-100">
        <input type="text" class="form-control form-control-lg" name="title"  value="{{$todo->title}}"
        aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
             <button class="btn btn-success" type="submit" id="button-addon-2">Update the list </button>
            </div>
        </div>
    </form>
 

      </div>
    </div> 
@endsection