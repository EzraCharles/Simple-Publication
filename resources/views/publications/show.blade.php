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

                    <div class="container">

                        <div class="row">

                          <!-- Post Content Column -->
                            <div class="col-lg-8">

                                <!-- Title -->
                                <h1 class="mt-4">{{ $publication->title }}</h1>

                                <!-- Author -->
                                <p class="lead">
                                by
                                <a href="{{ url('users/' . $publication->user->id) }}">{{ $publication->user->name }}</a>
                                </p>

                                <hr>

                                <!-- Date/Time -->
                                <p>Posted {{ $publication->created_at->format('jS F Y h:i:s A') }}</p>

                                <hr>

                                <!-- Post Content -->
                                <p class="lead">{{ $publication->content }}</p>

                                <blockquote class="blockquote">
                                <footer class="blockquote-footer">{{ $publication->user->email }}
                                </footer>
                                </blockquote>

                                <hr>

                                <!-- Comments Form -->
                                <div class="card my-4">
                                    <h5 class="card-header">Leave a Comment:</h5>
                                    <div class="card-body">
                                        <form action="{{ route('comments.store') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <input type="text" value="{{ $publication->id }}" name="publication_id" hidden readonly>
                                                <textarea class="form-control" rows="3" minlength="4" name="content" maxlength="65535"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Comments -->
                                @foreach ($publication->comments as $comment) {{-- $publication->comments->where('status', 'APROBADO') --}}
                                    <div class="media mb-4">
                                        <img style="height: 90px" class="d-flex mr-3 rounded-circle" src="{{ asset('img/logo-twgroup-200.png') }}" alt="">
                                        <div class="media-body">
                                            <h5 class="mt-0">{{ $comment->user->name }}</h5>
                                            {{ $comment->content }}
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                          <!-- Sidebar Widgets Column -->
                            <div class="col-md-4">

                                <!-- Search Widget -->
                                {{-- <div class="card my-4">
                                    <h5 class="card-header">Search</h5>
                                    <div class="card-body">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search for...">
                                            <span class="input-group-append">
                                                <button class="btn btn-secondary" type="button">Go!</button>
                                            </span>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- More Publications Widget -->
                                <div class="card my-4">
                                    <h5 class="card-header">{{ $publication->user->name }} publications</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <ul class="list-unstyled mb-0">
                                                    <?php $count = 0; ?>
                                                    @foreach ($publication->user->publications as $publisherPublication)
                                                        <?php if($count == 5) break; ?>
                                                        <li>
                                                            <a href="{{ url('publications/' . $publisherPublication->id) }}">{{ $publisherPublication->title }}</a>
                                                        </li>
                                                        <?php $count++; ?>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Other Publishers Widget -->
                                <div class="card my-4">
                                    <h5 class="card-header">Other Publishers</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php $count = 0; ?>
                                            @foreach ($publishers as $publisher)
                                                <?php if($count == 5) break; ?>
                                                <div class="col-6">
                                                    <li>
                                                        <a href="{{ url('users/' . $publisher->id) }}">{{ $publisher->name }}</a>
                                                    </li>
                                                </div>
                                                <?php $count++; ?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- /.row -->

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
