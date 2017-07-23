@extends('layouts.app')

@section('title', 'Index')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <h2>ActivismeBE - Petities</h2>

                <p class="lead">
                    Een petitie platform gedreven en onderhouden door een community.
                </p>
             
                <a href="{{ $share['twitter'] }}" target="_blank" class="btn btn-default"><span class="fa fa-twitter" aria-hidden="true"></span> Twitter</a>
                <a href="{{ $share['facebook'] }}" target="_blank" class="btn btn-default"><span class="fa fa-facebook" aria-hidden="true"></span> Facebook</a>
                <a href="https://github.com/CPSB/petition-system" target="_blank" class="btn btn-default"><span class="fa fa-github" aria-hidden="true"></span> Github</a>
                <a href="mailto:tom@activisme.be" class="btn btn-default"><span class="fa fa-envelope" aria-hidden="true"></span> Contact</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <i class="fa fa-github fa-3x fa-pull-left fa-border" aria-hidden="true"></i>
                    Dit project is tot stand gekomen als een project voor de gemeenschap. En daarom hebben 
                    we ook besloten om de broncode vrij te geven als open-source. Waarin u 
                    kunt mee beslissen over de ontwikkeling.
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <i class="fa fa-heart fa-3x fa-pull-left fa-border" aria-hidden="true"></i>
                    Petities met een ondersteuning. Indien je een vraag hebt of snapt iets niet. Kunt u gewoon als gebruiker 
                    een vraag stellen in onze helpdesk en dan doen wij ons onderste best om spoedig te antwoorden.
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <i class="fa fa-quote-left fa-3x fa-pull-left fa-border" aria-hidden="true"></i>
                    Elke regering keurt soms beslissing goed waarbij de bevolking meer kwaad in ziet dan goed. 
                    En dan is vaak een petitie de eerste manier om die beslissing ongedaan te maken en of bij te sturen waar nodig...
                </div>
            </div>
        </div>
    </div>
@endsection
