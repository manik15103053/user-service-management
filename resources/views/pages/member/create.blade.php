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
                        <a class="btn btn-info float-right" href="{{ route('member.index') }}">Back</a>
                    </div>
                    <form action="{{ route('member.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">First Name <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="" name="first_name" value="{{ old('first_name') }}">
                                        <span class="text-danger">
                                            @error('first_name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Last Name <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control" id="" name="last_name" value="{{ old('last_name') }}">
                                        <span class="text-danger">
                                            @error('last_name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Email <small class="text-danger">*</small></label>
                                        <input type="email" class="form-control" id="" name="email" value="{{ old('email') }}">
                                        <span class="text-danger">
                                            @error('email')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Phone <small class="text-danger">*</small></label>
                                        <input type="number" class="form-control" id="" name="phone" value="{{ old('phone') }}">
                                        <span class="text-danger">
                                            @error('phone')
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
