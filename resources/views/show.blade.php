@extends ('layouts.header')
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <a href="{{ url('/store') }}">Store</a>
                <a href="{{ url('/') }}">Retrieve</a>
            </div>
            <div class="content">
                <div class="title m-b-md">
                    Retrieve a secret
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="/store" method="POST" enctype="application/json">
                        @csrf
                        <input name="alias" id="alias" type="text" class="form-control" placeholder="Alias" required autofocus>
                        <button class="btn btn-primary" style="margin:20px 0; width:100%" type="submit">Get my secret</button>
                    </form>
                </div>
                <div class="col-md-3"></div>
                <div class="row"></div>
                <h2 style="font-family: Courier New, Courier">Your key is: {{ $kv }}</h2>
            </div>
        </div>
    </body>
</html>
