@extends ('layouts.header')
    <body>
    <div class="flex-center position-ref full-height">
        <div class="top-right links">
            @include ('layouts.links')
        </div>
            <div class="content">
                <div class="col-md-6">
                    <div class="m-b-md" style="font-size: 50px">
                        Store a Key/Value
                    </div>
                    <div>
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
                </div>
                <div class="col-md-6">
                    <div class="m-b-md" style="font-size: 50px">
                        Stored Secrets
                    </div>

                    @if($keys === [])
                        <div class="col-md-12">
                            <h4 style="text-align: center">No secrets yet!</h4>
                        </div>
                    @else
                        @foreach($keys as $key)
                            <div class="col-md-12">
                                <form action="/destroy" method="POST" enctype="application/json">
                                @csrf
                                    <div class="col-md-6" style="font-size: 32px;">
                                        <a href="/show/{{$key}}">{{$key}}</a>  
                                        <input type="hidden" name="alias" value="{{$key}}">
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger" style="margin:5px; width:100%" type="submit">Destroy</button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
