@extends('layout.layout')

@section('title')
    Visit to Laravel
@endsection
@section('content')
    <h1>{{$post->title}}</h1>
    <div class="">
        <p>{{$post->body}}</p>
    </div>
    <a class="btn btn-info" href="{{route('posts.index')}}">Go back</a>
    <a class="btn btn-warning" href="{{$post->id.'/edit'}}">Edit</a>
@endsection

@section('footer')
    hello footer
@endsection