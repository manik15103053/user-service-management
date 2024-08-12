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
                        <a class="btn btn-info float-right" href="{{ route('borrow.index') }}">Back</a>
                    </div>
                    <form action="{{ route('borrow.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Member <small class="text-danger">*</small></label>
                                        <select name="member_id" id="member_id" class="form-control select2"  >
                                            <option  disabled>Select One</option>
                                            @foreach($members as $item)
                                                <option value="{{ $item->id }}">{{ $item->first_name }} {{ $item->last_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('member_id')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Book <small class="text-danger">*</small></label>
                                        <select name="book_id" id="book_id" class="form-control select2"  >
                                            <option  disabled>Select One</option>
                                            @foreach($books as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">
                                            @error('book_id')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Borrow Date<small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" id="" name="borrow_date" value="{{ old('borrow_date') }}">
                                        <span class="text-danger">
                                            @error('borrow_date')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Return Date<small class="text-danger">*</small></label>
                                        <input type="date" class="form-control" id="" name="return_date" value="{{ old('return_date') }}">
                                        <span class="text-danger">
                                            @error('return_date')
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
