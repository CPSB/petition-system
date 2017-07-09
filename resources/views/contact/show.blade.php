@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <div class="row">
        <div class="col-md-8"> {{-- Content --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Onderwerp: {{ $message->subject }}

                    <div class="btn-group pull-right">
                        <a href="{{ route('contact.backend.index') }}" class="btn btn-xs btn-default"><span class="fa fa-undo" aria-hidden="true"></span> Back</a>
                        <a href="mailto:{{ $message->email }}" class="btn btn-xs btn-default"><span class="fa fa-envelope" aria-hidden="true"></span> Mail sender</a>
                        <a href="{{ route('contact.backend.destroy', $message) }}" class="btn btn-xs btn-danger">
                            <span class="fa fa-close" aria-hidden="true"></span> Delete
                        </a>
                    </div>
                </div>

                <div class="panel-body">
                    {{ $message->message }}
                </div>
            </div>
        </div> {{-- /End content --}}

        <div class="col-md-4"> {{-- Sender details --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="fa fa-user" aria-hidden="true"></span> Sender details:
                </div>
                <div class="list-group">
                    <div class="list-group-item">
                        <strong>Name:</strong>
                        <span class="pull-right">
                            {{ ucfirst($message->first_name) }} {{ ucfirst($message->last_name) }}
                        </span>
                    </div>
                    <div class="list-group-item">
                        <strong>Email:</strong> <span class="pull-right">{{ $message->email }}</span>
                    </div>
                    <div class="list-group-item">
                        <strong>Send at:</strong>
                        <span class="pull-right">{{ $message->created_at->format('d-m-Y H:i:s') }}</span>
                    </div>
                </div>
            </div>
        </div> {{-- Sender details --}}
    </div>
@endsection
