@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{$category->category_name}}</div>

                <div class="card-body">
                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <h3><a href="/post/{{$post->post_slug}}">{{$post->post_title}}</a></h3>
                                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                                    </div>
                                </div>                                
                            </div>
                            <hr>
                        @endforeach
                        {{$posts->links()}}
                    @else
                        <p>No posts found</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">
                    <form action="/search" class="search-form">
                        @csrf
                        <div class="form-group">
                          <input type="search" name="search" id="search" placeholder="What are you looking for?">
                          <button type="submit" class="submit"><i class="fa fa-search"></i>Search</button>
                        </div>
                    </form>

                    @if(count($categories) > 0)
                        <ul class="list-group mt-3">
                            @foreach($categories as $category)
                            
                                <li class="list-group-item">
                                    <a href="/category/{{$category->category_slug}}">{{$category->category_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No categories found</p>
                    @endif
                </div>
            </div>
        </div>


    </div>
</div>
@endsection