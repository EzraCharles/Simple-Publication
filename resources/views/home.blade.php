@extends('layouts.app')

@section('content')

    @include('layouts.navbar')

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <br/>
                        <div class="alert alert-danger alert-block" style="margin-left: 30px; margin-right: 30px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div id="create-publication" hidden>
                        <form id="create" action="{{ route('publications.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="firstName">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title" minlength="4" maxlength="63" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="lastName">Content:</label>
                                    <textarea rows="4" type="text" class="form-control" id="content" name="content" minlength="4" maxlength="65535" required></textarea>
                                </div>
                                <hr class="mb-4">
                                <div class="col-md-6">
                                    <button id="cancel" class="btn btn-danger btn-block" type="button">Cancel</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <br/>
                    <button id="btn-create" class="btn btn-primary btn-lg btn-block">Create new publication</button>
                    <br/>

                    @if ($last)
                        <div class="jumbotron p-4 p-md-5 text-white rounded" style="background: #1A90A3">
                            <div class="col-md-9 px-0">
                                <h4 style="color: white">The most recent publication: {{ $last->created_at->format('jS F Y h:i:s A') }}</h4>
                                <h1 class="display-4 font-italic">{{ Illuminate\Support\Str::limit($last->title, 20) }}</h1>
                                <p class="lead my-3">{{ Illuminate\Support\Str::limit($last->content, 50) }}</p>
                                <p class="lead mb-0"><a href="{{ url('publications/' . $last->id) }}" class="text-white font-weight-bold">Continue reading</a></p>
                            </div>
                        </div>
                    @endif

                    <div class="row mb-2">
                        @foreach ($publications as $publication)
                            <div class="col-md-6">
                                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                    <div class="col p-4 d-flex flex-column position-static">
                                        <h3 class="mb-0">{{ Illuminate\Support\Str::limit($publication->title, 15) }}</h3>
                                        <div class="mb-1 text-muted">{{ $publication->created_at->format('jS F Y h:i:s A') }}</div>
                                        <p class="card-text mb-auto">{{ Illuminate\Support\Str::limit($publication->content, 90) }}</p>
                                        <a href="{{ url('publications/' . $publication->id) }}" class="stretched-link">Continue reading</a>
                                    </div>
                                    <div class="col-auto d-none d-lg-block">
                                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail">
                                            <rect width="100%" height="100%" fill="#9EB635"/>
                                            <text x="10%" y="50%" fill="#eceeef" dy=".3em">
                                                <a href="{{ url('users/' . $publication->user->id) }}"> By {{ $publication->user->name }} </a>
                                            </text>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            <div class="row" style="display: inline !important; float: right !important;">
                                <div class="col-12" >
                                    <!-- Pagination -->
                                    <nav aria-label="navigation">
                                        <ul class="pagination justify-content-end mt-50">
                                            {{ $publications->onEachSide(1)->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>
    <script>
        $(document).ready(function(){
            $('#btn-create').on('click', function() {
                $('#create-publication').attr('hidden', false);
                $(this).attr('hidden', true);
            });

            $('#cancel').on('click', function() {
                $('#create-publication').attr('hidden', true);
                $('#btn-create').attr('hidden', false);
            });

        });
    </script>
    @include('layouts.footer')
@endsection
