@extends('layouts.main')

@section('title', 'Tasks Home')

@Section('content')




<div class="row justify-content-center">
    <div class="col-sm-4">
    <a href="{{route('task.create')}}" class="btn btn-outline-info btn-block mt-3"> Create task</a>
    </div>
</div>

<h2 class="mt-3">TASK to do ...</h2>
<hr><hr>
@if($tasks->count()==0)
<p class="lead"> there are no task listed. why don't create one!</p>
@else
@foreach($tasks as $task)
    
<div class="row">
    <div class="col-sm-12">
      <h4>{{$task->name}}
          <small>{{$task->created_at}}</small>
      </h4>  
      <p>{{$task->description}}</p>
      <h4>Due Date :<small> {{$task->due_date}}</small></h4>

      {!! Form::open(['route'=>['task.destroy',$task->id],'method'=>'DELETE'])!!}
    <a href="{{ route('task.edit', $task->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
    
    <button type="submit" class="btn btn-sm btn-outline-danger ">Delete</button>
    <a href="{{ route('task.archive', ['id'=>$task->id,'state'=>1])}}" class="btn btn-sm btn-outline-warning">Do IT ! </a>
    {!! Form::close() !!}

   
</div>
</div>
<hr>

@endforeach

<div class="row justify-content-center">
    <div class="col-sm-6 text-center">
        {{$tasks->links()}}
    </div>
</div>

@endif



<h2 class="do">Archived task</h2>
<hr>
<hr>

@if($archive->count()==0)
<p class="lead"> there are no task listed. why don't create one!</p>
@else
@foreach($archive as $task)
    
<div class="row">
    <div class="col-sm-12">
      <h4 class="do">{{$task->name}}
          <small>{{$task->created_at}}</small>
      </h4>  
      
      <p class="do">{{$task->description}}</p>
      <h4 class="do">Due Date :<small> {{$task->due_date}}</small></h4>

      {!! Form::open(['route'=>['task.destroy',$task->id],'method'=>'DELETE'])!!}
    <a href="{{ route('task.edit', $task->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
    
    <button type="submit" class="btn btn-sm btn-outline-danger ">Delete</button>
    <a href="{{ route('task.archive', ['id'=>$task->id,'state'=>0])}}" class="btn btn-sm btn-outline-warning">Undo</a>
    {!! Form::close() !!}

</div>
</div>
<hr>

@endforeach

<div class="row justify-content-center">
    <div class="col-sm-6 text-center">
        {{$tasks->links()}}
    </div>
</div>

@endif


@endsection