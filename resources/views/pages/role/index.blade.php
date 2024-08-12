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
                        <h4 class="title float-left">All Roles</h4>
                        <a class="btn btn-info float-right" href="{{ route('role.create') }}">Add New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Sl</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Permission</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                    @foreach($roles as $key=> $role)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $item)
                                                    <span class="badge bg-secondary text-white">{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                         
                                            <td>
                                                <a href="{{ route('role.edit',$role->id) }}" class=""><i class="fa fa-edit text-success"></i></a>
                                                <a href="{{ route('role.delete',$role->id) }}" class=""><i class="fa fa-trash text-danger" onclick="return confirm('Are Yor sure! you went to delete this item..?')"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                       {{-- {{ $books->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
