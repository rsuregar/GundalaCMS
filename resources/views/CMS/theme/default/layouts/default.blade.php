
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"> --}}
    <title>{{ $judul }}</title>
    <link rel="canonical" href="{{ $canonical ?? url()->full() }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('CMS/theme/default') }}/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    {{-- <link href="{{ asset('CMS/theme/default') }}/css/carousel.css" rel="stylesheet"> --}}
    <link href="{{ asset('CMS/theme/default') }}/css/style.css" rel="stylesheet">
    {{-- <link href="{{ asset('CMS/theme/default') }}/font/flaticon.css" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

    <style>


        .navbar-nav .dropdown-menu {
            float: none;
            border-radius: 0;
        }
        .dropdown-submenu {
        position: relative;
        border-radius: 0;
        }

        .dropdown-submenu>a:after {
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 2em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            text-align: right;
            border-left: .3em solid transparent;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: 0px;
            margin-left: 0px;
            border-radius:0;
        }

        .widget-link a:hover{
            text-decoration: none !important;
            color: rebeccapurple;
        }
    </style>
  </head>
  <body style="background-color:#fbfbfb;">
    @php
        $commentId = 'facebook';
        $appId = 321539914595425;
    @endphp
    @if ($commentId == 'facebook')
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10&appId={{$appId}}';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    @else

    @endif
    <header>
        @include('CMS.theme.default.components.header')
    </header>

    <main role="main">

    @yield('content')
    @include('CMS.theme.default.components.footer')
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('CMS/theme/default') }}/js/jquery-slim.min.js"><\/script>')</script>
    <script src="{{ asset('CMS/theme/default') }}/js/popper.min.js"></script>
    <script src="{{ asset('CMS/theme/default') }}/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="{{ asset('CMS/theme/default') }}/js/holder.min.js"></script>
    <script>
        $(function() {
        // ------------------------------------------------------- //
        // Multi Level dropdowns
        // ------------------------------------------------------ //
        $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
            event.preventDefault();
            event.stopPropagation();

            $(this).siblings().toggleClass("show");


            if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
            });

        });
        });
    </script>
  </body>
</html>
