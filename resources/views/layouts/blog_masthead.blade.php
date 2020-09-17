@if(isset($blog->heading_image_path))

    <header class="masthead" id="masthead" style="background-image: url({{ $blog->header_image_url }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1 id="masthead-h1">@yield('heading')</h1>
                        <span class="subheading">@yield('subheading')</span>
                        <span class="meta">@yield('meta')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@else

    <header class="masthead" id="masthead" style="background-image: url({{ '/storage/0' . rand(1,5) . '.jpg' }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1 id="masthead-h1">@yield('heading')</h1>
                        <span class="subheading">@yield('subheading')</span>
                        <span class="meta">@yield('meta')</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

@endif
