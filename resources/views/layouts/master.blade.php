<!DOCTYPE html>
<html>
  <head>
      @section('headers')
      @show
  </head>
  <body class="hold-transition skin-purple sidebar-mini">
      <div class="wrapper">
          @section('navbar')
          @show

          @section('sidebar')
          @show

          <div class="content-wrapper">
              @section('content-header')
              @show
              <section class="content">
                  @section('content')
                  @show
              </section>
          </div>
      </div>
      @section('scripts')
      @show
  </body>
</html>
