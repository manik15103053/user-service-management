@extends('layouts.master')
@section('main-content')
    <div class="row mt-5">
        <div class="col-md-3">
            @include('layouts.partial.sidebar')
        </div>
        <div class="col-md-9">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title float-left">Blog Category</h4>
                        <a class="btn btn-info float-right" href="{{ route('blog.index') }}">Back</a>
                    </div>
                    <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Category <small class="text-danger">*</small></label>
                                        <select name="category_id[]" id="category_id" class="form-control select2" multiple >
                                            <option  disabled>Select One</option>
                                            @foreach($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('title')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="priority" name="title" value="{{ old('title') }}">
                                        <span class="text-danger">
                                            @error('title')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="publication_date">Publication Date <small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" id="publication_date" name="publication_date" value="">
                                        <span class="text-danger">
                                            @error('publication_date')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image" name="image" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">Content <small class="text-danger">*</small></label>
                                        <textarea name="text_content" id="text_content" cols="30" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
