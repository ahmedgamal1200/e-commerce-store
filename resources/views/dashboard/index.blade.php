@extends('layouts.partials.javascript')
 @extends('layouts.partials.fonts')
@section('title', 'Starter Pager')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active" aria-current="page">Starter Page</li>
@endsection



<!doctype html>
<html lang="en">
  <!--begin::Head-->
   @include('layouts.partials.head')
  <!--end::Head-->
        @include('layouts.partials.body')
          <!--begin::Start Navbar Links-->
          @include('layouts.partials.navbar')
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      @include('layouts.partials.sidebar')
      <!--end::Sidebar-->

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                @include('layouts.partials.main')
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
      </main>
      <!--end::App Main-->
    </div>
    <!--end::App Wrapper-->
  </body>
  <!--end::Body-->
</html>

