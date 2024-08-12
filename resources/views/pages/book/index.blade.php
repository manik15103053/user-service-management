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
                        <h4 class="title float-left">All Member</h4>
                        <a class="btn btn-info float-right" href="{{ route('book.create') }}">Add New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Publish date</th>
                                    <th scope="col">Available Copy</th>
                                    <th scope="col">total Copy</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                    @foreach($books as $key=> $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->isbn }}</td>
                                            <td>{{ $item->author->name }}</td>
                                            <td>{{ $item->published_date }}</td>
                                            <td>{{ $item->available_copy }}</td>
                                            <td>{{ $item->total_copy }}</td>
                                            <td>
                                                <a href="{{ route('book.edit',$item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit text-white"></i></a>
                                                <a href="{{ route('book.delete',$item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white" onclick="return confirm('Are Yor sure! you went to delete this item..?')"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                       {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
