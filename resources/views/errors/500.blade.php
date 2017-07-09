@extends('layouts.errors')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1><span class="glyphicon glyphicon-fire red"></span> 500 Internal server error.</h1>
            <p class="lead">The web server is returning an internal server errror for <em><span id="display-domain"></span></em></p>
            <a href"javascript:document.location.reload(true);" class="btn btn-default btn-lg text-center">
                <span class="green">Try this page again</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-md-6">
                    <h2>What happend?</h2>
                    <p class="lead">
                        A 500 error status implies there is a problem with the web server's software
                        causing it to malfunction. 
                    </p>
                </div>

                <div class="col-md-6">
                    <h2>What can i do?</h2>
                    <p>Nothig you can do at the moment. If you need immediate assistance, please send us an email instead. We apologize for any inconvenience.</p>            
                    
                    <h2>If you're the site owner.</h2>
                    <p class="lead">This error can only be fixed by server admins, please contact your admins or your website provider.</p>
                </div>
            </div>
        </div>
    </div>
@endsection