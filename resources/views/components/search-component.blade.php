<div class="main my-2">
    <div >
        <form action="/search" method="GET" role="search" class="input-group">
            {{ csrf_field() }}
            <input type="text" name="search" class="form-control" placeholder="Search this blog">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    Search
                </button>
        </div>
        </form>
        @if (isset($tsearch))
        <div class="my-2">
            <h4>Search Results for <span class="font-weight-bold font-italic">"{{ $tsearch }}"</span> in the blog</h4>
        </div>
        @endif
        
    </div>  
</div>