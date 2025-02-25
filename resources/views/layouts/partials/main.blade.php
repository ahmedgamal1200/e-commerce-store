<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">@yield('title')</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        @section('breadcrumb')
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        @show
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
</main>
<!--end::App Main-->
