<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('form').on('click', '.btn-delete', function(event) {
                event.preventDefault();
                if(confirm('¿Realmente desea eliminar este registro?')) {
                    $(this).parent().submit();
                }
            });
        });
    </script>
</head>

<div class="container">

<nav class="navbar navbar-default navbar-static-top">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/employee') }}">Empleados</a></li>
          <li><a href="{{ url('/company') }}">Compañias</a></li>
        </ul>


         <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav navbar-right">
            <li>
                <form method="POST" action="{{ route('logout') }}"
                class="navbar-form">
                @csrf
                <li><a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    ><i class="fa fa-sign-out "></i>  Cerrar Sesion</a></li>
                </form>
              </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    @yield('content')

</nav>
</div>
