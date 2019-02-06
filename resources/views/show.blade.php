@extends ('layouts.header')
    <body>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            @include ('layouts.links')
        </div>
            <div class="content">
                <div class="title m-b-md">
                    {{$secret}}
                </div>
                <div class="col-md-6" style="font-family: Courier New, Courier; text-align:right">
                    <h2>
                        Key:<br>
                        Value: 
                    </h2>
                </div>
                <div class="col-md-6" style="font-family: Courier New, Courier; text-align:left">
<!--                     <h2>
                        username<br>
                        ryan
                    </h2> -->
                
                    @foreach($kv as $info)
                        @foreach(explode('.', $info) as $string)
                            {{ $string }}
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
