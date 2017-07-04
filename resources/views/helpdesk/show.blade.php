@extends('layouts.app')

@section('content')
    <div class="row">
        @php $comments = $question->comments()->simplePaginate(5) @endphp

        <div class="col-md-9"> {{-- Question content --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    Question: {{ $question->title }}

                    @if ((int) $question->author_id === auth()->user()->id)
                        <div class="pull-right">
                            <a href="" class="btn btn-xs btn-default">
                                <span class="fa fa-pencil" aria-hidden="true"></span> Edit
                            </a>
                        </div>
                    @endif
                </div>

                <div class="panel-body">{{ $question->description }}</div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="blog-comment">
                        <ul class="comments">
                            @foreach ($comments as $comment)

                                <li class="clearfix">
                                    <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar img-responsive" alt="">
                                    <div class="post-comments">
                                        <p class="meta">
                                            {{ $comment->created_at->format('d F Y') }} <a href="#">{{ $comment->author->name }}</a> says:
                                            <span class="pull-right">
                                                @if (auth()->user()->id == $comment->author_id or auth()->user()->hasRole('Admin'))
                                                    <a class="btn btn-warning btn-xs" href="{{ route('comments.delete', $comment) }}">
                                                        <small>
                                                            <span class="fa fa-close" aria-hidden="true"></span> Delete
                                                        </small>
                                                    </a>
                                                @endif

                                                <a class="btn btn-xs btn-danger" href="#" onclick="">
                                                    <small>
                                                        <span class="fa fa-exclamation-triangle" aria-hidden="true"></span> Report
                                                    </small>
                                                </a>
                                            </span>
                                        </p>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </li>
                            @endforeach

                            {{ $comments->render() }}

                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar img-responsive" alt="">
                                <div class="post-comments">
                                    <p class="meta">{{ auth()->user()->name }}:</p>

                                    <form class="form-horizontal" method="POST" action="{{ route('comments.store') }}">
                                        {{ csrf_field() }} {{-- CSRF form protection --}}
                                        <input type="hidden" name="author_id"   value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="question_id" value="{{ $question->id }}">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <textarea style="resize: none;" name="comment" class="form-control" rows="3" placeholder="Uw reactie."></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <span class="fa fa-check" aria-hidden="true"></span> Comment
                                                </button>
                                                <button type="reset" class="btn btn-sm btn-danger">
                                                    <span class="fa fa-undo" aria-hidden="true"></span> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div> {{-- /Question content --}}

        <div class="col-sm-3"> {{-- Question information sidebar --}}
            <div class="list-group">
                <div class="list-group-item">
                    <strong>Questioner:</strong> <span class="pull-right">{{ $question->author->name }}</span>
                </div>
                <div class="list-group-item">
                    <strong>Category:</strong> <span class="pull-right">{{ $question->categories->name }}</span>
                </div>

                <div class="list-group-item">
                    <strong>Created at:</strong> <span class="pull-right">{{ $question->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div> {{-- Question information sidebar --}}
    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('js/ajax-modal.js') }}"></script>
@endsection
