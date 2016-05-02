@extends('layout.layout')

@section('title')
    Visit to Laravel
@endsection
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(['action' => 'PostController@store', 'class'=>'form-horizontal']) !!}
    {{--{!! Form::token() !!}--}}
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <!-- Text Area -->
    <div class="form-group">
        {!! Form::label('body', 'Body', ['class' => 'control-label']) !!}
        <div class="">
            {!! Form::textarea('body', $value = null, ['class' => 'form-control', 'rows' => 3]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
        <a class="btn btn-info" href="{{route('posts.index')}}">Go back</a>
    </div>
    {!! Form::Close() !!}
@endsection

@section('footer')
    hello footer
@endsection