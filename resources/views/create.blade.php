@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
        @endif
            <div class="card">
                <div class="card-header">{{ __('Create Blog Post') }}</div>

                <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="{{ route('create-post') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-xs-12">
                            <div class="form-group">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Post Text</label>
                                <textarea name="body" class="form-control" id="exampleFormControlTextarea1" required placeholder="Enter post text" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 col-xs-12 text-center">
                            <div class="form-group">
                                <img height="150" id="input-img" src="./images/no_img.jpg" alt="No Image"/>
                                <input type="file" name="picture" onchange="updateImage(this)" required class="form-control" id="customFile"/>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="custId" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                Create Post
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateImage(inputResult) {
        try {
            const reader = new FileReader();
            let image = document.getElementById("input-img");
            reader.onload = (event) => {
                image.src = event.target.result;
            }
            reader.readAsDataURL(inputResult.files[0]);
        } catch (error) {
            
        }
    }
</script>
@endsection
