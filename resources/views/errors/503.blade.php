@extends('layouts.errors')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1><span class="fa fa-exclamation-traingle orange"></span> 503 Service Unavailble</h1>
            <p class="lead">
                The web server is returning an unexpected temporary error for <em><span id="display-domain"></span></em>.
            </p>
            <a href="javascript:document.location.reload(true);" class="btn btn-default btn-lg text-center"><span class="green">Try this page again.</span></a>
        </div>
    </div>

    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-md-6">
                    <h2>What happend?</h2>
                    <p class="lead">
                        A 503 error status implies that this is a temporary condition due to a temporary 
                        overloading or maintenance of the server. This error is normally a brief temporary interruption.
                    </p>
                </div>

                <div class="col-md-6">
                    <h2>What can I do?</h2>
                    
                    <p class="lead">If you're a site visitor</p>
                    <p>If you need immediate assistance, please send us an email instead. We apologize for any inconvenience.</p>

                    <p class="lead">If you're the site owner</p>
                    <p>This error is mostly likely very brief, the best thing to do is to check back in a few minutes and everything will probably be working normal again.</p>
                </div>            
            </div>
        </div>
    </div>
@endsection