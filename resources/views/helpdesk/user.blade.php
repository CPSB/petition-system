@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12"> {{-- Info block --}}
            <div class="panel panel-default">
                <div class="panel-heading">Helpdesk:</div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object img-thumbnail img-rounded" style="width: 64px; height:64px;" src="{{ asset('img/questions.svg') }}" alt="Questions">
                        </div>
                        <div class="media-body">
                            <p>
                                Here are your personal questions you asked to the developer(s) and admin(s) off this platform. <br>
                                Please don't re-open questions for a simple 'ok' or 'thanks'. So we can help others faster.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{-- /Info Block --}}

        <div class="col-md-12"> {{-- Question listing --}}
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-info-circle" aria-hidden="true"></span> Your questions:</div>

                <div class="panel-body">
                    @if ((int) count($questions) > 0) {{-- The user has questions asked. --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Status:</th>
                                <th>Category:</th>
                                <th colspan="2">Title:</th> {{-- Colspan="2" needed for the options --}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td><code>#Q{{ $question->id }}</code></td>
                                    <td>
                                        @if ((string) $question->open === 'Y') {{-- The question open --}}
                                        <span class="label label-success">Open</span>
                                        @else {{-- The question is closed --}}
                                        <span class="label label-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td>{{ $question->categories->name }}</td>
                                    <td>{{ $question->title }}</td>
                                    <td class="pull-right"> {{-- Options --}}
                                        <a href="{{ route('helpdesk.show', ['helpdesk' => $question->id]) }}" class="label label-info">Show</a>

                                        @if ((string) $question->open === 'Y') {{-- The question open --}}
                                        <a href="" class="label label-danger">Close</a>
                                        @else {{-- The question is closed --}}
                                        <a href="" class="label label-success">Reopen</a>
                                        @endif
                                    </td> {{-- /Options --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $questions->render() }} {{-- Pagination instance --}}
                    </div>
                    @else {{-- The user has no questions asked. --}}
                    <div class="alert alert-info" role="alert">
                        <strong><span class="fa fa-exclamation-triangle" aria-hidden="true"></span> Info:</strong>
                        You haven't create any question. If you got a question. <a href="{{ route('helpdesk.create') }}">You can ask it to us.</a>
                    </div>
                    @endif
                </div>
            </div>
        </div> {{-- /Question listing --}}
    </div>
@endsection
