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
                        <h4 class="title float-left">All Author</h4>
                        <a class="btn btn-info float-right" href="{{ route('author.create') }}">Add New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Bio</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                    @foreach($authors as $key=> $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->bio }}</td>
                                            <td>
                                                <a href="{{ route('author.edit',$item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit text-white"></i></a>
                                                <a href="{{ route('author.delete',$item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white" onclick="return confirm('Are Yor sure! you went to delete this item..?')"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                       {{ $authors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
