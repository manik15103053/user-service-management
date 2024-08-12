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
                        <h4 class="title float-left">Update Blog</h4>
                        <a class="btn btn-info float-right" href="{{ route('blog.index') }}">Back</a>
                    </div>
                    <form action="{{ route('blog.update',$blog->slug) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Category <small class="text-danger">*</small></label>
                                        <select name="category_id[]" id="category_id" class="form-control select2" multiple>
                                            <option  disabled>Select One</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id, json_decode($blog->category_id)) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                        @error('category_id')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title}}">
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
                                        <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ date('Y-m-d',strtotime($blog->publication_date))  }}">
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
                                        <img class="mt-2" src="{{ asset($blog->image) }}" alt="Blog Image" width="65" height="60">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">Content <small class="text-danger">*</small></label>
                                        <textarea name="text_content" id="text_content" cols="30" class="form-control" rows="3">{{ $blog->text_content }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info">Update</button>
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
