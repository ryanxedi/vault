@extends ('layouts.header')
    <body>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            @include ('layouts.links')
        </div>
            <div class="content">
                <div class="title m-b-md">
                    Store a Key/Value in Vault
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="/store" method="POST" enctype="application/json">
                        @csrf
                        <input name="alias" id="alias" type="text" class="form-control" placeholder="Alias" required autofocus>
                        <div class="col-md-6" style="padding:0 5px 0 0">
                            <input name="key" id="key" type="text" class="form-control" style="margin-top:10px" placeholder="Key" required>
                        </div>
                        <div class="col-md-6" style="padding:0 0 0 5px">
                            <input name="value" id="value" type="text" class="form-control" style="margin-top:10px" placeholder="Value" required>
                        </div>
                        <button class="btn btn-primary" style="margin:20px 0; width:100%" type="submit">Store your secret</button>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </body>
</html>
