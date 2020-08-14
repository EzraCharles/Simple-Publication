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


                    <div class="jumbotron p-4 p-md-5 text-white rounded" style="background: #1A90A3">
                        <div class="col-md-9 px-0">
                            <h4 style="color: white">Member since: {{ $user->created_at->format('jS F Y') }}</h4>
                            <h1 class="display-4 font-italic">Publisher: {{ $user->name }}</h1>
                            <p class="lead my-3">{{ $user->email }}</p>
                        </div>
                    </div>

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

    @include('layouts.footer')
@endsection
