@extends('adminlte::page')
@section('title',  __('members.title'))
@section('content')
    <div class="">
        <a href="{{ route("groups.members.create", $group->id) }}" class="btn btn-success">{{ __('members.add') }}</a>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ __('members.title') }}
        </div>
        <div class="panel-body">
            <table class="table table-striped">

                <thead>
                    <th>{{ __('members.name') }}</th>
                    <th>{{ __('members.email') }}</th>
                    <th>{{ __('members.birthday') }}</th>
                    <th>{{ __('members.phone') }}</th>
                    <th>{{ __('members.address') }}</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="table-text">
                                <div>{{ $user->name }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $user->email }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $user->birthday }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $user->phone }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $user->address }}</div>
                            </td>
                            <td>
                                <form action="{{route('groups.members.destroy', [$group->id, $user->id])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> {{ __('members.delete' )}}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection
