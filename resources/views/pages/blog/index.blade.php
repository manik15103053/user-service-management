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
                        <h4 class="title float-left">All Blogs</h4>
                        <a class="btn btn-info float-right" href="{{ route('blog.create') }}">Add New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Publication Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                    @foreach($blogs as $key=> $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ asset($item->image) }}" alt="" width="65" height="60">
                                            </td>
                                            <td>{{ Str::limit($item->title,25,'..') }}</td>
                                            <td>
                                                @foreach(json_decode($item->category_id) as $key => $categoryId)
                                                    {{ \App\Models\Category::find($categoryId)->name ?? "N/A" }}
                                                @endforeach

                                            </td>
                                            <td>{{ date('d M Y',strtotime($item->publication_date)) }}</td>
                                            <td>
                                                <a href="{{ route('blog.edit',$item->slug) }}" class="btn btn-info btn-sm"><i class="fa fa-edit text-white"></i></a>
                                                <a href="{{ route('blog.delete',$item->slug) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white" onclick="return confirm('Are Yor sure! you went to delete this item..?')"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                       {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
