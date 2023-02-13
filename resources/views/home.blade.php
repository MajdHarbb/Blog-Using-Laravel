@extends('layouts.app')

@section('content')
<div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if (count($posts)) 
    @include('components.search-component')
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-success">
                <th scope="col"></th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
                    
            @foreach($posts as $post)
            <tr>
                <td>
                    <img width="75" height="75" src="./images/{{$post->picture}}" alt="Image"/>
                </td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td class="text-center"><a href="/edit/{{ $post->id }}" class="btn btn-outline-primary">Edit</a></td>
                <td class="text-center">
                    <form id="delete-frm" class="" action="edit/{{ $post->id }}" method="POST">
                        <input type="hidden" id="post-id" name="id" value="{{ $post->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            
            @endforeach

        </tbody>
    </table>
    @else 
    <div class="row justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">There are no posts yet</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Click on the navigation menu "Create Blog Post" to create a new post. 
                    
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- Pagination --}}
    @include('components.paginator')
    
</div>

@endsection
