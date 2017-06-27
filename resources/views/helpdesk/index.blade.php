@extends('layouts.app')

@section('title', 'Helpdesk')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-question-circle" aria-hidden="true"></span> Questions:
                    </div>

                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object img-thumbnail img-rounded" style="width: 64px; height:64px;" src="{{ asset('img/questions.svg') }}" alt="Questions">
                            </div>
                            <div class="media-body">
                                <p>
                                    De helpdesk is de plak waar je al je vragen kunt stellen omtrent het platform en zijn petities. <br>
                                    Onze admins en ontwikkelaars zullen alles in gang zetten om zo snel mogelijk op je vragen te antwoorden. <br>
                                    Ook als je een fout ondekt kun je hier terecht.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading"><span class="fa fa-bar-chart" aria-hidden="true"></span> Statistieken:</div>

                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <span class="fa fa-asterisk fa-btn" aria-hidden="true"></span> Gesloten vragen:
                            <span class="label label-danger pull-right">0</span>
                        </a>

                        <a href="#" class="list-group-item">
                            <span class="fa fa-asterisk fa-btn" aria-hidden="true"></span> Open vragen:
                            <span class="label label-success pull-right">{{ $open }}</span>
                        </a>

                        <a href="#" class="list-group-item">
                            <span class="fa fa-asterisk fa-btn" aria-hidden="true"></span> Totaal aantal vragen:
                            <span class="label label-info pull-right">{{ $all }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading"><span class="fa fa-asterisk" aria-hidden="true"></span> Opties:</div>

                    <div class="list-group">
                        <a href="{{ route('helpdesk.create') }}" class="list-group-item"><span class="fa fa-btn fa-plus" aria-hidden="true"></span> Stel een nieuwe vraag.</a>
                        <a href="{{ route('helpdesk.user') }}" class="list-group-item"><span class="fa fa-btn fa-user" aria-hidden="true"></span> Bekijk jouw vragen.</a>
                        <a href="" class="list-group-item"><span class="fa fa-btn fa-globe" aria-hidden="true"></span> Bekijk de publieke vragen.</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
