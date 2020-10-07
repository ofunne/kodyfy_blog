@extends('layouts.app')
@section('content')
    <main class="posts-listing col-lg-8"> 
        <div class="container">
            <header> 
                <h2>Search</h2>
                <p class="text-big">You searched for: <em>{{$search}}</em></p>
            </header>
            <div class="row">
                @if(count($details) > 0)
                    @foreach($details as $detail)
                        <!-- post -->
                        <div class="post col-xl-6">
                            <div class="post-details">
                                <div class="post-meta d-flex justify-content-between">
                                    <div class="category"><a href="/category/{{$detail->category->category_slug}}">{{$detail->category->category_name}}</a></div>
                                </div>
                                <a href="/post/{{$detail->post_slug}}"><h3 class="h4">{{$detail->post_title}}</h3></a>
                                <p class="text-muted">{{ substr($detail->post_content, 0, 100)}}</p>
                                <footer class="post-footer d-flex align-items-center">
                                    <a href="#" class="author d-flex align-items-center flex-wrap">
                                        <div class="title"><span>{{$detail->user->name}}</span></div>
                                    </a>
                                    <div class="date"><i class="icon-clock"></i> {{$detail->created_at->diffForHumans()}}</div>
                                    <div class="comments meta-last"><i class="icon-comment"></i>{{count($detail->comments)}}</div>
                                </footer>
                            </div>
                        </div>

                    @endforeach
                        {{$details->links('vendor.pagination.custom')}}
                    @else
                        <p>No posts found</p>
                @endif
                
            </div>
        </div>
    </main>
@endsection
    