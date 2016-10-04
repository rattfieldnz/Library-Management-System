<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#303F9F" />
        <title>
            @yield('title')
        </title>
        <!-- Styles -->
        <link rel="stylesheet" href="/static/css/material.min.css">
        <link rel="stylesheet" href="/static/css/global.css">
        <script src="/static/js/jquery.min.js"></script>
        <script src="/static/js/material.min.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        </script>
    </head>
    
    <body class="mdl-container mdl-color--grey-100 mdl-color-text--grey-700 mdl-base">
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
                <div class="mdl-layout--large-screen-only mdl-layout__header-row">
                </div>
                <div class="mdl-layout--large-screen-only mdl-layout__header-row">
                    <h3>
                        @yield('title')
                    </h3>
                </div>
                <div class="mdl-layout--large-screen-only mdl-layout__header-row">
                </div>
                <div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
                    <a href="{{ url('/') }}" class="mdl-layout__tab{!!(Request::is('/')) ? ' is-active' : '' !!}">
                        Home
                    </a>
                    <a href="#main" class="mdl-layout__tab{!!(Request::is('/')) ? '' : ' is-active' !!}">
                        Main Page
                    </a>
                    <a href="#search_layout" class="mdl-layout__tab">
                        Search
                    </a>
                    <a href="#help" class="mdl-layout__tab">
                        Help
                    </a>
                    @if (Auth::guest())
                    <a href="#login_layout" class="mdl-layout__tab">
                        Log in
                    </a>
                    <a href="#register_layout" class="mdl-layout__tab">
                        Register
                    </a>
                    @else
                    <a href="#main" class="mdl-layout__tab">
                        {{ Auth::user()->name }}
                    </a>
                    <a href="{{ url('/logout') }}" class="mdl-layout__tab">
                        Logout
                    </a>
                    @endif
                    <a href="#search_layout">
                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-shadow--4dp mdl-color--accent"
                        id="search">
                            <i class="material-icons" role="presentation">
                                search
                            </i>
                            <span class="visuallyhidden">
                                Search
                            </span>
                        </button>
                    </a>
                </div>
            </header>
            <div class="mdl-layout__content">
                <div class="mdl-layout__tab-panel is-active" id="main">
                    @yield('content')
                </div>
                <div class="mdl-layout__tab-panel" id="search_layout">
                    <section class="section--center mdl-grid mdl-grid--no-spacing">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h4>
                                Search
                            </h4>
                            <p>
                                <div class="mdl-textfield mdl-js-textfield">
                                    <input class="mdl-textfield__input" type="text" id="search_text">
                                    <label class="mdl-textfield__label" for="search_text">
                                        Key words
                                    </label>
                                </div>
                                <button onclick="window.location.href='/search/'+$('#search_text').val()+'/page/1';"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                    Search
                                </button>
                            </p>
                        </div>
                    </section>
                </div>
                @if (Auth::guest())
                <div class="mdl-layout__tab-panel" id="login_layout">
                    <section class="section--center mdl-grid mdl-grid--no-spacing">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h4>
                                Log in
                            </h4>
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {!! csrf_field() !!}
                                <p>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            E-Mail Address
                                        </label>
                                        <input type="email" class="mdl-textfield__input" name="email" value="{{ old('email') }}">
                                    </div>
                                    <br />
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            Password
                                        </label>
                                        <input type="password" class="mdl-textfield__input" name="password">
                                    </div>
                                </p>
                                <p>
                                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-1">
                                        <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" name="remember"
                                        checked>
                                        <span class="mdl-checkbox__label">
                                            Remember me?
                                        </span>
                                    </label>
                                </p>
                                <p>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                        <i class="fa fa-btn fa-sign-in">
                                        </i>
                                        Log in
                                    </button>
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                        Forget password?
                                    </a>
                                </p>
                            </form>
                        </div>
                    </section>
                </div>
                <div class="mdl-layout__tab-panel" id="register_layout">
                    <section class="section--center mdl-grid mdl-grid--no-spacing">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h4>
                                Register
                            </h4>
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                {!! csrf_field() !!}
                                <p>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            Name
                                        </label>
                                        <input type="text" class="mdl-textfield__input" name="name" value="{{ old('name') }}">
                                    </div>
                                </p>
                                <p>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            E-Mail Address
                                        </label>
                                        <input type="email" class="mdl-textfield__input" name="email" value="{{ old('email') }}">
                                    </div>
                                </p>
                                <p>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            Password
                                        </label>
                                        <input type="password" class="mdl-textfield__input" name="password">
                                    </div>
                                </p>
                                <p>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <label class="mdl-textfield__label">
                                            Confirm Password
                                        </label>
                                        <input type="password" class="mdl-textfield__input" name="password_confirmation">
                                    </div>
                                </p>
                                <p>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                        <i class="fa fa-btn fa-user">
                                        </i>
                                        Submit
                                    </button>
                                </p>
                            </form>
                        </div>
                    </section>
                </div>
                @endif
                <footer class="mdl-mega-footer">
            <div class="mdl-mega-footer--bottom-section">
                <div class="mdl-logo">
                    Powered By © 2006-2016 林灿斌
                </div>
                <ul class="mdl-mega-footer--link-list">
                    <li>
                        <a href="https://github.com/lincanbin/Library-Management-System">
                            Source Code
                        </a>
                    </li>
                    <li>
                        <a href="http://weibo.com/lincanbin">
                            Weibo
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/lincanbin">
                            GitHub
                        </a>
                    </li>
                </ul>
            </div>
        </footer>
            </div>
        </div>
    </body>
    {{--
    <script src="{{ elixir('js/app.js') }}"></script>
    --}}

</html>