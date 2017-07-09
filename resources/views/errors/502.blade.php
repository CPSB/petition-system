@extends('layouts.error')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>
                <span class="fa fa-bolt orange" aria-hidden="true"></span>
                502 Bad gateway.
            </h1>
            <p class="lead">
                The web server is returning an unexpected networking error for <em><span id="display-domain"></span>.</em>
            </p>

            <a href="javascript:document.location.reload(true)" class="btn btn-default btn-lg text-center">
                <span class="green">Try this page again.</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="body-content">
            <div class="row">
                <div class="col-md-6">
                    <h2>What happend?</h2>
                    <p class="lead">
                        A 502 error status implies that the server received an invalid response from an upstream server it accessed to fulfill the request. 
                    </p>
                </div>

                <div class="col-md-6">
                    <h2>What can i do?</h2>

                    <p class="lead">If you're a site visitor</p>
                    <p>
                        <a onclick="javascript:checkSite();">
                            Check to see if this website is down for everyone or just you.</a>
                        </a>
                    </p>

                    <p>
                        Also, clearing your browser caching and refreshing the page may clear this issue. 
                        If the problem persists, and you need immediate assistance, please send us an email instead. 
                    </p>

                    <p class="lead">If you're the site owner</p>
                    <p>
                        Clearing your browser cache and refreshing the page may clear this issue.
                        If the problem persists and you need immediate assistance, 
                        please contact your website provider.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection