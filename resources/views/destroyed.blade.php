@extends ('layouts.header')
    <body>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            @include ('layouts.links')
        </div>
            <div class="content">
                <div class="title m-b-md">
                    <h1 style="font-family: Courier New, Courier">{{ $alias }}</h1>
                    <h2 style="color:red">has been <strong>destroyed</strong></h2>
                </div>
            </div>
        </div>
    </body>
</html>
