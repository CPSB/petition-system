@extends('layouts.app')

@section('title', 'Roles & Permissions')

@section('content')
    {{-- Modal --}}
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
        <div class="modal-dialog" role="document">
            {{ Form::open(['method' => 'post']) }}

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h4 class="modal-title" id="roleModalLabel">Role</h4>
                </div>
                <div class="modal-body">
                    {{-- Name Form input --}}
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name')}}</p> @endif
                    </div>
                </div>
                <div class="modal-footer">
                    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }} {{-- Submit form button --}}
                    <button type="button" class="btn btn-default" data-dissmiss="modal">Close</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">Roles:</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('add_roles')
                <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#roleModal">
                    <i class="glyphicon glyphicon-plus"></i> New
                </a>
            @endcan
        </div>
    </div>

    @forelse ($roles as $role)
        {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update',  $role->id ], 'style' => 'margin-bottom: 25px;']) !!}

        @if ($role->name === 'Admin')
            @include('shared._permissions', ['title' => $role->name .' Permissions', 'options' => ['disabled'] ])
        @else
            @include('shared._permissions', ['title' => $role->name .' Permissions', 'model' => $role ])

            @can('edit_roles')
                {!! Form::submit('Save ' . $role->name . ' permissions', ['class' => 'btn btn-primary']) !!}
                @if ($role->name !== 'Admin' && $role->name !== 'User')
                    <form action="{{ route('roles.destroy', $role) }}" >
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" type="submit">Delete {{ $role->name }}</button>
                    </form>
                @endif
            @endcan
        @endif

        {!! Form::close() !!}

    @empty
        <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
    @endforelse
@endsection
