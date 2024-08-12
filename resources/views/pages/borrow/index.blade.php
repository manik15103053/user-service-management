@extends('layouts.master')
@section('main-content')
<style>
    .btn-disable{
        background: rgb(108, 147, 169);
    }
</style>
    <div class="row mt-5">
        <div class="col-md-3">
            @include('layouts.partial.sidebar')
        </div>
        <div class="col-md-9">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h4 class="title float-left">All List</h4>
                        <a class="btn btn-info float-right" href="{{ route('borrow.create') }}">Add New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Member Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Book</th>
                                    <th scope="col">Borrow Date</th>
                                    <th scope="col">Return Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                    @foreach($borrows as $key=> $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->member->first_name }} {{ $item->member->last_name }}</td>
                                            <td>{{ $item->member->phone }}</td>
                                            <td>{{ $item->book->title }}</td>
                                            <td>{{ $item->borrow_date }}</td>
                                            <td>{{ $item->return_date }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                @if($item->status=='Returned')
                                                <a disabled class="btn btn-disable btn-sm"><i class="fa fa-edit text-white"></i></a>
                                                @else
                                                <a href="{{ route('borrow.edit',$item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit text-white"></i></a>
                                                @endif
                                                <a href="{{ route('borrow.delete',$item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white" onclick="return confirm('Are Yor sure! you went to delete this item..?')"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                       {{ $borrows->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
