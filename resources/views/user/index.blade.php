@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> {{-- Search modal --}}
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-sm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-search" aria-hidden="true"></span> Search user</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.index') }}" id="run" class="form-horizontal" method="GET">
                        {{ csrf_field() }} {{-- CSRF form protection --}}

                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Email" name="term">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-default" form="run"><span class="fa fa-search" aria-hidden="true"></span> Search</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><span class="fa fa-close" aria-hidden="true"></span> Close</button>
                </div>
            </div>
        </div>
    </div> {{-- /search Modal --}}

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <h3 class="modal-title">{{ $result->total() }} {{ str_plural('User', $result->count()) }} </h3>
                </div>
                <div class="col-md-7 page-action text-right">
                    @if ((int) $result->count() > 6)
                        <a href="#" data-toggle="modal" data-target="#search" class="btn btn-default btn-sm"><span class="fa fa-search" aria-hidden="true"></span> Search</a>
                    @endif

                    @can('add_users')
                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Create</a>
                    @endcan
                </div>
            </div>

            <div class="result-set">
                <table class="table table-bordered table-condensed table-striped table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>

                            @can('edit_users', 'delete_users')
                                <th class="text-center">Actions</th>
                            @endcan

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->roles->implode('name', ', ') }}</td>
                                <td>{{ $item->created_at->toFormattedDateString() }}</td>

                                @can('edit_users')
                                    <td class="text-center">
                                        @if(auth()->user()->can('edit_users') && auth()->user()->can('edit_roles'))
                                            @if ($item->isBanned())
                                                <a href="{{ route('user.unban', $item) }}" class="btn btn-xs btn-success">
                                                    <span class="fa fa-unlock" aria-hidden="true"></span> Activeer
                                                </a>
                                            @else
                                                <a href="{{ route('user.ban', $item) }}" class="btn btn-xs btn-warning">
                                                    <span class="fa fa-lock" aria-hidden="true"></span> Blokkeer
                                                </a>
                                            @endif
                                        @endif

                                        @include('shared._actions', ['entity' => 'users', 'id' => $item->id])
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center">
                    {{ $result->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
