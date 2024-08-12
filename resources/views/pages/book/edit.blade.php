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
                        <h4 class="title float-left">Member</h4>
                        <a class="btn btn-info float-right" href="{{ route('book.index') }}">Back</a>
                    </div>
                    <form action="{{ route('book.update',$book->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="" name="title" value="{{$book->title }}">
                                        <span class="text-danger">
                                            @error('title')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">ISBN<small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="" name="isbn" value="{{$book->isbn}}">
                                        <span class="text-danger">
                                            @error('isbn')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Author Name <small class="text-danger">*</small></label>
                                        <select name="author_id" id="author_id" class="form-control select2"  >
                                            <option  disabled>Select One</option>
                                            @foreach($authors as $item)
                                                <option value="{{ $item->id }}" @if($item->id == $book->author_id ) selected @endif>{{ $item->name }}</option>
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
                                        <label for="title">Published Date<small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" id="" name="published_date" value="{{$book->published_date }}">
                                        <span class="text-danger">
                                            @error('published_date')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Available Copy <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" id="" name="available_copy" value="{{$book->available_copy}}">
                                        <span class="text-danger">
                                            @error('available_copy')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Total Copy <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" id="" name="total_copy" value="{{$book->total_copy}}">
                                        <span class="text-danger">
                                            @error('total_copy')
                                            {{ $message }}
                                            @enderror
                                        </span>
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
