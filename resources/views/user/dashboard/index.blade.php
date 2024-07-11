<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>
    <div class="wrapper">
        @include('partials.sidebar')

        <div class="main">
            @include('partials.topbar')

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Blank Page</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Empty card</h5>
                                </div>
                                <div class="card-body">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @include('partials.footer')
        </div>
    </div>

    <script src="{{ asset('template/js/app.js') }}"></script>

</body>

</html>
