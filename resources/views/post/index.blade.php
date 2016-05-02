@extends('layout.layout')

@section('title')
    Visit to Laravel
@endsection
@section('content')
    <ul>
        @foreach($posts as $post)
            <li><a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a></li>
        @endforeach
    </ul>
    <a class="btn btn-primary" href="{{route('posts.create')}}">Create New</a>
@endsection

@section('footer')
    hello footer
@endsection