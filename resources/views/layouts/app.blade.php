<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Landoretti Art makes it possible buy auctions and to bid on them.">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        @yield('pagetitle')
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <div >
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img id="logo" src="{{'/storage/1_Logo.jpg'}}" alt="Logo Landoretti Art">
                </a>
                <div id="greenbar1"></div>
                <nav id="topnav" class="navbar navbar-default navbar-static-top">
                    <div>
                        <ul class="nav navbar-nav" >
                            @guest
                                <li><a href="{{ route('login') }}">@lang('Login')</a></li>
                                <li><a href="{{ route('register') }}">@lang('Register')</a></li>
                            @else
                            <li><a href="/watchlist">@lang('WATCHLIST')</a></li>
                                <li><a href="/user">@lang('PROFILE')</a></li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">@lang('LOGOUT')</a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endguest
                        </ul>                        
                    </div>
                </nav>
                <nav id="secondnav" class="navbar navbar-default navbar-static-top">
                    <div>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="/">HOME</a></li>
                                <li><a href="/auctions">@lang('ART')</a></li>
                                <li><a href="/auctions/myauctions">@lang('MYAUCTIONS')</a></li>
                                <li><a href="/bids/mybids">@lang('MYBIDS')</a></li>
                                <li><a href="#">CONTACT</a></li>
                            </ul>
                            <ul class="nav navbar-nav navlang">
                                <li><a href="/lang/nl">NL</a></li>
                                <li><a href="/lang/en">EN</a></li>                        
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="content">
                @yield('content')
            </div>            
            <footer>
                <div class="row">
                    <div class="col-md-3">
                        <div id="helpSection">
                            <p>HELP</p>
                            <p><a href="{{ route('login') }}">Login</a></p>
                            <p><a href="{{ route('register') }}">Register</a></p>
                        </div>
                        <div id="help2Section">
                            <p><a href="#">Term of Service</a></p>
                            <p><a href="#">Privacy Policy</a></p>
                            <p><a href="#">FAQ</a></p>
                            <p><a href="#">Contact Us</a></p>
                            <p><a href="#">About Us</a></p>
                        </div>
                        <div id="languageSection">
                            <p>LANGUAGES</p>
                            <p><a href="/lang/nl">Nederlands</a></p>
                            <p><a href="/lang/en">Engels</a></p>
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div id="styleFilter">
                            <p>STYLE</p>
                            <p><a href="/auctions/filter/style-African_American">African American</a></p>
                            <p><a href="/auctions/filter/style-Asian_Contemporary">Asian Contemporary</a></p>
                            <p><a href="/auctions/filter/style-Conceptual">Conceptual</a></p>
                            <p><a href="/auctions/filter/style-Contemporary">Contemporary</a></p>
                            <p><a href="/auctions/filter/style-Emerging_Artists">Emerging Artists</a></p>
                            <p><a href="/auctions/filter/style-Figurative">Figurative</a></p>
                            <p><a href="/auctions/filter/style-Middle_Eastern_Contemporary">Middle Easter Contemporary</a></p>
                            <p><a href="/auctions/filter/style-Minimalism">Minimalism</a></p>
                            <p><a href="/auctions/filter/style-Modern">Modern</a></p>
                            <p><a href="/auctions/filter/style-Pop">Pop</a></p>
                            <p><a href="/auctions/filter/style-Urban">Urban</a></p>
                            <p><a href="/auctions/filter/style-Vintage_Photographs">Vintage Photographs</a></p>
                        </div>
                        <div id="mediaFilter">
                            <p>MEDIA</p>
                            <p><a href="/auctions/filter/media-Design">Design</a></p>
                            <p><a href="/auctions/filter/media-Paintings_and_Works_on_Paper">Paintings and Works on Paper</a></p>
                            <p><a href="/auctions/filter/media-Photographs">Photographs</a></p>
                            <p><a href="/auctions/filter/media-Prints_and_Multiples">Prints and Multiples</a></p>
                            <p><a href="/auctions/filter/media-Sculpture">Sculpture</a></p>
                        </div>
                    </div>  
                    <div class="col-md-3">
                        <div id="priceFilter">
                            <p>PRICE</p>
                            <p><a href="/auctions/filter/price-between-0-and-5000">Up to 5.000</a></p>
                            <p><a href="/auctions/filter/price-between-5000-and-10000">5.000-10.000</a></p>
                            <p><a href="/auctions/filter/price-between-10000-and-25000">10.000-25.000</a></p>
                            <p><a href="/auctions/filter/price-between-25000-and-50000">25.000-50.000</a></p>
                            <p><a href="/auctions/filter/price-between-50000-and-100000">50.000-100.000</a></p>
                            <p><a href="/auctions/filter/price-above">Above</a></p>
                        </div>
                        <div id="eraFilter">
                            <p>ERA</p>
                            <p><a href="/auctions/filter/prewar">Pre-War</a></p>
                            <p><a href="/auctions/filter/yearbetween-1940-1960">1940s-1950s</a></p>
                            <p><a href="/auctions/filter/yearbetween-1960-1990">1960s-1980s</a></p>
                            <p><a href="/auctions/filter/yearabove">1990s-present</a></p>
                        </div>
                        <div id="endingFilter">
                            <p>ENDING</p>
                            <p><a href="/auctions/filter/ending-thisweek">Ending this week</a></p>
                            <p><a href="/auctions/filter/ending-purchasenow">Purchase now</a></p>
                        </div>            
                    </div>
                    <div class="col-md-3">
                        <div id="contactSection">
                            <p>CONTACT</p>
                            <p>Landoretti ART</p>
                            <p>Straatnaam xxx</p>
                            <p>xxx Oostende</p>
                            <p></p>
                            <p>+xx (0)x xxx xx xx</p>
                            <p><a href="mailto:info@landorettiart.com">info@landorettiart.com</a></p>
                        </div>
                    </div>  
                </div>
                <div>       
                    <nav id="thirdnav" class="navbar navbar-default navbar-static-top">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img id="logo2" src="{{'/storage/1_Logo.jpg'}}" alt="Logo Landoretti Art">
                        </a>
                        <div>
                            <ul class="nav navbar-nav">
                                <li><a href="/">HOME</a></li>
                                <li><a href="/auctions">@lang('ART')</a></li>
                                <li><a href="/auctions/myauctions">@lang('MYAUCTIONS')</a></li>
                                <li><a href="/bids/mybids">@lang('MYBIDS')</a></li>
                                <li><a href="/contact">CONTACT</a></li>
                            </ul>

                            <ul class="nav navbar-nav navlang">
                                <li><a href="/lang/nl">NL</a></li>
                                <li><a href="/lang/en">EN</a></li>                        
                            </ul>                        
                        </div>
                    </nav>
                    
                    <div id="greenbar2"></div>
                </div>
            </footer>
        </div>
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        
    </body>
    
</html>
