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
                        <h4 class="title float-left">Role Create</h4>
                        <a class="btn btn-info float-right" href="{{ route('role.index') }}">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('role.update',$role->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label for="name">{{ __('Role Name') }}</label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror" id="name"
                                               placeholder="Role name" value="{{$role->name}}" required autofocus>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"><b>{{ __('Select all') }}</b></label>
                                    </div>
                                </div>
                        
                                @foreach($permissions as $index => $modules)
                                    <div class="col-xl-12 col-lg-12 col-md-6 mb-2">
                                        <table class="table  table-borderless card" style="height: 100%; border: 1px solid #DEDEEB">
                                            <tr class="row pl-3">
                                                <td  style="vertical-align:top">{{ucfirst($index)}}</td>
                                                <td width="30%" style="vertical-align:top">
                                                    <div class="custom-control custom-checkbox mb-1">
                                                        <input type="checkbox" class="custom-control-input {{$index}}" onclick="checkPermissionByGroupName('role_{{$loop->iteration}}_management_td', this) "  id="exampleCheckbox{{$index}}" value="{{$index}}">
                                                        <label class="custom-control-label" for="exampleCheckbox{{$index}}">Select All</label>
                                                    </div>
                                                </td>
                                                <td  style="vertical-align:top" class="role_{{$loop->iteration}}_management_td">
                                                    @foreach($modules as $permission)
                                                        <div class="custom-control custom-checkbox mb-1">
                                                            <input type="checkbox" name="permissions[]" {{$role->hasPermissionTo($permission->id) ? 'checked': ''}}
                                                            class="custom-control-input {{$index}}"
                                                                id="exampleCheckbox{{$permission->id}}"
                                                                value="{{$permission->id}}">
                                                            @php $string = array('.', '-') @endphp
                                                            <label class="custom-control-label" for="exampleCheckbox{{$permission->id}}">{{ucfirst(str_replace($string, ' ', $permission->name))}}</label>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-primary waves-effect waves-float waves-light float-right mt-3" type="submit">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script type="text/javascript">
    $('#checkAll').click(function () {
        $('input:checkbox').prop('checked', this.checked);
    });
</script>
<script type="text/javascript">
    function checkPermissionByGroupName(className, checkThis){
        let groupIdName = $('#'+checkThis.id);
        let classCheckBox = $('.'+className+' input');
        if(groupIdName.is(':checked')){
            classCheckBox.prop('checked', true);
        }else {
            classCheckBox.prop('checked', false);
        }
    }
</script>
@endpush