<footer class="page-footer green lighten-1">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Nyheter</h5>
          <p class="white-text">
             Rebuy är nu ett registrerat varumärke.
          </p>
        </div>
      </div>
    </div>
    <div class="footer-copyright green">
      <div class="container">
        &copy; 2017 Rebuy &reg;  
      </div>
    </div>
    </footer>
    <!--  Scripts-->
    @include('layouts._partials._scripts')

    @if(Session::has("flash_message"))
        <script type="text/javascript">
            $("div.alert").not(".alert-important").delay(5000).slideUp(function(){
                $(this).remove();
            });
        </script>
    @endif
    </body>
</html>
