@extends ('layouts.header')
    <body>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            @include ('layouts.links')
        </div>
            <div class="content">
                <div class="title m-b-md col-md-12">{{$secret}}</div>
                <div class="col-md-12" style="font-family: Courier New, Courier;">
                    <h2>
                        @foreach ($kv as $key => $value) 
                            <div id="key" class="col-md-6 colon" style="text-align:right;">{{ $key }}</div>
                            <div id="value" class="col-md-6" style="text-align:left;">{{ $value }}</div>
                        @endforeach   
                    </h2>

                    <form action="/destroy" method="POST" enctype="application/json">
                    @csrf
                        <input type="hidden" name="alias" value="{{$secret}}">
                        <button class="btn btn-danger" style="margin:5px; width:100%" type="submit">Destroy</button>
                    </form>

                    <h4><a href="/">Go back</a></h4>
                </div>
            </div>
        </div>
    </body>
</html>
