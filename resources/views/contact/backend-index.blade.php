@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9"> {{-- Content --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Contact berichten:</div>
                </div>
                <div class="panel-body">
                    @if ($unreads->count() > 0)
                        @php $messages = $unreads->paginate(25) @endphp

                        <table class="table table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id:</th>
                                    <th>Person:</th>
                                    <th>Subject:</th>
                                    <th colspan="2">Sent at:</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $message->id }}</td>
                                        <td>
                                            <a href="mailto:{{ $message->email }}">
                                                {{ ucfirst($message->first_name) }} {{ ucfirst($message->last_name) }}
                                            </a>
                                        </td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ $message->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('contact.backend.show', $message) }}" style=""class="pull-right btn btn-info btn-xs">
                                                <span class="fa fa-info-circle" aria-hidden="true"></span> Show
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $messages->render() }}
                    @else
                        <div class="alert alert-success" role="alert">
                            Er zijn geen contact berichten in het systeem.
                        </div>
                    @endif
                </div>
            </div>
        </div> {{-- /Content --}}

        <div class="col-md-3">
            <div class="list-group">
                <a class="list-group-item">
                    Ongelezen berichten <span class="badge">{{ $unreads->count() }}</span>
                </a>

                <a class="list-group-item">
                    Gelezen berichten <span class="badge">0</span>
                </a>
            </div>
        </div>
    </div>
@endsection
