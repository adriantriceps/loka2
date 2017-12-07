@include('partials._head')
@include('partials._nav')
    <!-- main-content -->
    <div class="container">
        @include('partials._messages')

        @yield('content')
    </div>
    <hr/><br/>
    <!-- end-main-content -->

  @include('partials._footer')
  @include('partials._javascript')
 @yield('scripts')
  </body>
</html>
