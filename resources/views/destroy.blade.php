@extends ('layouts.header')
    <body>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            @include ('layouts.links')
        </div>
            <div class="content">
                <div class="title m-b-md">
                    Destroy a secret
                </div>
                    <form action="/destroy" method="POST" enctype="application/json">
                        @csrf
                        <input name="alias" id="alias" type="text" class="form-control" placeholder="Alias" required autofocus>
                        <button class="btn btn-primary" style="margin:20px 0; width:100%" type="submit">Destroy my secret</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
