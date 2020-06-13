@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">Dashboard</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Dashboard</a>
                        </li>
                    </ol>
                </nav>
            </div>
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Welcome to your app</h3>
                    </div>
                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            We’ve put everything together, so you can start working on your Laravel project as soon as possible! OneUI assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.
                        </p>
                        <p class="font-size-sm text-muted">
                            Feel free to use any examples you like from the full versions to build your own pages. <strong>Wish you all the best and happy coding!</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

</div>

            <ol class="list-reset grid gs4" role="presentation">
                <li class="grid--cell">
                    <a href="#"
                        class="-marketing-link js-gps-track js-products-menu"
                        aria-controls="products-popover"
                        data-controller="s-popover"
                        data-action="s-popover#toggle"
                        data-s-popover-placement="bottom"
                        data-gps-track="top_nav.products.click({location:2, destination:1})"
                        data-ga="[&quot;top navigation&quot;,&quot;products menu click&quot;,null,null,null]">
                        Products
                    </a>
                </li>

                    <li class="grid--cell md:d-none">
                        <a href="/teams/customers" class="-marketing-link js-gps-track"
                           data-gps-track="top_nav.products.click({location:2, destination:7})"
                            data-ga="[&quot;top navigation&quot;,&quot;customers menu click&quot;,null,null,null]">Customers</a>
                    </li>
                    <li class="grid--cell md:d-none">
                        <a href="/teams/use-cases" class="-marketing-link js-gps-track"
                           data-gps-track="top_nav.products.click({location:2, destination:8})"
                           data-ga="[&quot;top navigation&quot;,&quot;use cases menu click&quot;,null,null,null]">Use cases</a>
                    </li>
            </ol>
            <div class="s-popover ws2 p6"
                    id="products-popover"
                    role="menu"
                    aria-hidden="true">
                <div class="s-popover--arrow"></div>
                <ol class="list-reset s-anchors s-anchors__inherit">
                    <li>
                        <a href="/questions" class="d-block py6 px6 bar-sm h:bg-orange-500 h:fc-white js-gps-track"
                           data-gps-track="top_nav.products.click({location:2, destination:2})"
                           data-ga="[&quot;top navigation&quot;,&quot;public qa submenu click&quot;,null,null,null]">
                            <span class="fs-body1 d-block">Stack Overflow</span>
                            <span class="fs-caption d-block o70">Public questions and answers</span>
                        </a>
                    </li>
                    <li>
                        <a href="/teams" class="d-block py6 px6 bar-sm h:bg-orange-500 h:fc-white js-gps-track"
                           data-gps-track="top_nav.products.click({location:2, destination:3})"
                           data-ga="[&quot;top navigation&quot;,&quot;teams submenu click&quot;,null,null,null]">
                            <span class="fs-body1 d-block">Teams</span>
                            <span class="fs-caption d-block o70">Private questions and answers for your team</span>
                        </a>
                    </li>
                    <li>
                        <a href="/enterprise" class="d-block py6 px6 bar-sm h:bg-orange-500 h:fc-white js-gps-track"
                           data-gps-track="top_nav.products.click({location:2, destination:4})"
                           data-ga="[&quot;top navigation&quot;,&quot;enterprise submenu click&quot;,null,null,null]">
                            <span class="fs-body1 d-block">Enterprise</span>
                            <span class="fs-caption d-block o70">Private self-hosted questions and answers for your enterprise</span>
                        </a>
                    </li>
                    <li class="bt bc-black-3 mln6 mrn6 mt6 pt6 px6">
                        <a href="https://stackoverflow.com/talent" class="d-block py6 px6 bar-sm h:bg-orange-500 h:fc-white js-gps-track"
                           data-gps-track="top_nav.products.click({location:2, destination:5})"
                           data-ga="[&quot;top navigation&quot;,&quot;talent submenu click&quot;,null,null,null]">
                            <span class="fs-body1 d-block">Talent</span>
                            <span class="fs-caption d-block o70">Hire technical talent</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://stackoverflow.com/advertising" class="d-block py6 px6 bar-sm h:bg-orange-500 h:fc-white js-gps-track"
                           data-gps-track="top_nav.products.click({location:2, destination:6})"
                           data-ga="[&quot;top navigation&quot;,&quot;advertising submenu click&quot;,null,null,null]">
                            <span class="fs-body1 d-block">Advertising</span>
                            <span class="fs-caption d-block o70">Reach developers worldwide</span>
                        </a>
                    </li>

                </ol>
            </div>

