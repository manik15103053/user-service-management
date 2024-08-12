@extends('layouts.master')
@section('main-content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Passport Information</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                  <th width='5%'>Sl</th>
                                  <th width='10%'>Name</th>
                                  <th width='10%'>Email</th>
                                  <th width='10%'>Phone</th>
                                  <th width='10%'>PNumber</th>
                                  <th width='10%'>NID</th>
                                  <th width='10%'>Gender</th>
                                  <th width='10%'>DOB</th>
                                  <th width='10%'>Height</th>
                                  <th width='10%'>Weight</th>
                                  <th width='10%'>Religion</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if ($passports->isNotEmpty())
                                    @foreach ($passports as $key =>$item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $item->first_name }}</td>
                                            <td>{{  $item->email }}</td>
                                            <td>{{  $item->phone }}</td>
                                            <td>{{  $item->passport_number }}</td>
                                            <td>{{  $item->nid_number }}</td>
                                            <td>{{  $item->gender }}</td>
                                            <td>{{  date('d M Y',strtotime($item->date_of_birth)) }}</td>
                                            <td>{{  $item->height }}</td>
                                            <td>{{  $item->weight }}</td>
                                            <td>{{  $item->religion }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
