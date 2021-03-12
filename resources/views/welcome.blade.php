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
    <div class="text-center"style="width:40%">
    <h1 class="display-2 text-white">Todo App</h1>
    <h3 class="text-white pt-2 mr-5">Add something??</h3>
    <form action="{{route('todo.store')}}" method="POST">
    @csrf
        <div class="input-group md-3 wb-100">
        <input type="text" class="form-control form-control-lg" name="title"  placeholder="Type task here...." 
        aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
             <button class="btn btn-success" type="submit" id="button-addon-2">Add to the list </button>
            </div>
        </div>
    </form>
    <h2 class="text-white pt-3" >My Todo List</h2>
      <div style="background-color:#e7eda8">
      <table class="table" style="width:100%">
    <tr>  
      <th scope="col">#</th>
      <th scope="col" style="width:90%">Title</th>
      <th scope="col" class="pr-6" width="100%">Status</th>
      <th scope="col" width="100%">Action</th>
    </tr>
       @foreach($todos as $key=>$todo)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td> 
      @if($todo->completed==0)
    
     <div style="background-color:#f5754e"> {{$todo->title}}<div>

     @else

     <div style="background-color:#9afa91"> {{$todo->title}}<div>
     @endif
     </td>
      <td style="text-align:right">
      @if($todo->completed==0)
      <form action="{{route('todo.show',[$todo->id])}}" method="POST">
       @method('PATCH')
       @csrf
       <input type="text" value="1" name="completed" hidden>
       <button class="btn btn-warning btn-sm" width=100%>Not&nbsp;&nbsp;Completed</button>
       </form>
       @else
       <form action="{{route('todo.show',[$todo->id])}}" method="POST">
       @method('PATCH')
       @csrf
       <input type="text" value="0" name="completed" hidden>
       <button class="btn btn-primary btn-sm">Completed</button>
       </form>
      @endif

      </td>
      <td class="pr-3" >
      <a  class="inlane-block" href="{{route('todo.edit',[$todo->id])}}" >
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#03853d" class="bi bi-pencil-square " viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg>
      </a>
      <a href="#" data-toggle="modal" data-target="#exampleModal{{$todo->id}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
        </svg>
      </a>
      <div class="modal fade" id="exampleModal{{$todo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{route('todo.destroy',[$todo->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Do you really want to delete?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
      </td>
    </tr>
       @endforeach
   
       </table>
      </div>
      <div class="w-100 h-100 d-flex justify-content-center align-todos-center">
      {{ $todos->links() }}
      </div>
    </div>
</div>
@endsection