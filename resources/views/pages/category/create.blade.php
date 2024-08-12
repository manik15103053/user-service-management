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
                        <h4 class="title float-left">Create Category</h4>
                        <a class="btn btn-info float-right" href="{{ route('category.index') }}">Back</a>
                    </div>
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Category name</label>
                                        <input type="text" class="form-control" id="" name="name" value="{{ old('name') }}">
                                        <span class="text-danger">
                                            @error('name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="priority">Priority</label>
                                        <input type="text" class="form-control" id="priority" name="priority" value="{{ old('priority') }}">
                                        <span class="text-danger">
                                            @error('priority')
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
