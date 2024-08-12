@extends('layouts.master')

@section('main-content')
        <!-----Blog Post----->
        <div class="row mt-5" style="margin-bottom: 50px">
            @if($blogs->isNotEmpty())
                @foreach($blogs as $blog)
                    <div class="col-md-4">
                        <div class="card mt-3">
                            <img src="{{ asset($blog->image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title ?? "" }}</h5>
                                <p class="card-text">{{ Str::limit($blog->text_content,200,'..') ?? "" }}.</p>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
@endsection
