@extends('adminlte::page')
@section('title', __('members.add'))
@section('content_header')
    <h1>{{ __('members.add') }}</h1>
@stop
@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{route('groups.members.store', $group_id)}}" method="post"
                      enctype="multipart/form-data">
                    @include('admin.group_members.form')
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> {{ __('members.add') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{asset('/js/user.js')}}"></script>
@stop
