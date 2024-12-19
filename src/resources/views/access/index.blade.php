<!DOCTYPE html>
<html>
<head>
    <title>{{config('access.page_title')}}</title>
    <meta charset="utf-8"/>
    <meta name="robots" content="noindex"/>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width"/>
    <style>* {
            -webkit-box-sizing: inherit;
            box-sizing: inherit
        }

        body, html {
            min-height: 100vh
        }

        html {
            text-align: center;
            text-rendering: optimizeLegibility;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            line-height: 1.5;
            word-wrap: break-word;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            background: #eeeeee;
            color: #333333
        }

        .Content, body {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column
        }

        body {
            padding: 32px 8px;
            margin: 0;
            background: #d6d6c5;
        }

        .Content {
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin: 32px;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1
        }

        @media screen and (max-width: 768px) {
            .Content {
                padding: 0;
                margin: 32px 0
            }
        }

        .accessBox {
            max-width: 100%;
            background: #fff;
            border: 1px solid #eaebeb;
            -webkit-box-shadow: 0 4px 8px rgba(146, 151, 155, .15);
            box-shadow: 0 4px 8px rgba(146, 151, 155, .15);
            padding-top: 2em;
            width: 36em
        }

        .accessLogo {
            margin-bottom: 1em
        }

        @media only screen and (max-width: 420px) and (pointer: coarse) {
            .accessLogo {
                margin-top: 1em
            }

            .accessCompanyLogo {
                padding: 1em 0
            }
        }

        .Content {
            margin-top: 8px
        }

        .accessBox {
            border-radius: 5px;
            margin-top: 0;
            margin-bottom: 0
        }

        .accessBox .accessBox-error-box-footer {
            border-radius: 5px 0 .5em .5em;
            background: rgba(0, 0, 0, .03);
            border-top: 1px solid rgba(0, 0, 0, .15)
        }

        .accessBox .accessBoxRow--name {
            font-size: 15px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block
        }

        .accessBox-RequestCode {
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            padding-bottom: 2.5em
        }

        .ErrorBlock-icon > svg {
            display: block;
            height: 100%;
            width: 100%
        }

        .accessBox-text {
            color: #4a4a4a;
            font-size: 1.25em;
            font-weight: 600;
            padding-top: 1em;
            margin-bottom: 24px
        }

        .AuthServiceLogin .AuthServiceLogin-row {
            padding-bottom: 1em
        }

        .accessFormLogin-row {
            text-align: left;
            margin: auto;
            max-width: 22em;
            padding: 1em 8px 0
        }

        .Footer-text span {
            white-space: pre-line
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: .5em
        }

        .Button {
            position: relative;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: inline-block;
            cursor: pointer;
            text-decoration: none;
            font: inherit;
            color: #fff;
            background: #333;
            padding: .5em 0;
            border: 0;
            margin: 0;
            border-radius: 5px
        }

        .Button.Button-uses-org-theme-accent-color {
            background-color: #038f53;
            padding: 0 8px;
            width: 100%
        }

        .Button:hover {
            -webkit-box-shadow: inset 0 0 0 999em rgba(255, 255, 255, .2);
            box-shadow: inset 0 0 0 999em rgba(255, 255, 255, .2)
        }

        .Button.Button-is-juicy {
            border-radius: 5px;
            padding-top: .75em;
            padding-bottom: .75em;
            max-width: 14em;
            font-weight: 300
        }

        .Button.Button-is-block {
            display: block;
            margin: auto
        }

        .Button.Button-is-auth {
            background-color: #d6d6c5;
            border: 1px solid #d5d7d8;
            color: inherit;
            text-align: left;
            min-height: 55px;
            margin: 0 3.5em;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-wrap: inherit;
            flex-wrap: inherit;
            padding-left: .5em
        }

        .Button.Button-is-auth .Button-auth-service-icon {
            width: 2.8em;
            height: auto;
            padding: .5em;
            color: #1d1f20;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .Button.Button-is-auth .Button-auth-service-icon > svg {
            fill: currentColor;
            display: block;
            min-width: 25px;
            width: 25px;
            height: 25px
        }

        .Button.Button-uses-org-theme-accent-color {
            margin: 0;
            max-width: unset
        }

        .Button.Button-is-auth .Button-auth-service-icon, .Message, .RayID {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex
        }

        .alert-message {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            font-size: .9em;
            overflow: hidden;
            margin-bottom: 0.5em;
            border-radius: 5px;
            text-align: center;
        }

        .alert-message-error {
            background: #ff5959;
            color: #ffffff;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
        }

        .StandardInput {
            position: relative;
            -webkit-user-select: auto;
            -moz-user-select: auto;
            -ms-user-select: auto;
            user-select: auto;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: inline-block;
            text-align: left;
            font: inherit;
            color: "#333333";
            padding: .5em 1em;
            border: 1px solid #cacaca;
            margin: 0;
            border-radius: 5px
        }

        .StandardInput:focus {
            outline: 0;
            border-color: #777
        }

        .StandardInput.StandardInput-is-block {
            display: block;
            font-size: 1em;
            width: 100%
        }

        .StandardInput.StandardInput-is-code {
            font-family: Monaco, "Bitstream Vera Sans Mono", "Lucida Console", Terminal, monospace
        }

        .StandardInput.StandardInput-is-entry-code {
            font-size: 20px
        }

        .StandardInput:-moz-placeholder, .StandardInput::-webkit-input-placeholder {
            font-family: inherit
        }

        .company-logo img {
            margin-bottom: .5em
        }

        .App-name {
            text-align: center;
            font-weight: 200
        }

        .App-name {
            font-size: 1.5em
        }

        @media screen and (max-width: 650px) {

            .accessFormLogin .accessFormLogin-row {
                width: auto
            }

            .Content {
                margin: 8px 0
            }
        }</style>
</head>

<body>
@if(config('access.company_logo'))
    <div class="accessLogo">
        <div class="company-logo">
            <img height=50 src="{{config('access.company_logo')}}" style="display:none;"
                 onload="this.style.display=''"/>
        </div>
    </div>
@endif
<div class="Content">

    <div class="accessBox">
        <div class="accessBox-body">
            @if(config('access.app_logo'))
                <div class="company-logo">
                    <img height=50 src="{{config('access.app_logo')}}" style="display:none;"
                         onload="this.style.display=''"/>
                </div>
            @endif
            @if(config('access.app_name'))
                <div class="accessBox-App">
                    <div class="App-name">
                        {{config('access.app_name')}}
                    </div>
                </div>
            @endif

            <div class="accessBox-Normal">
                <div class="accessBox-RequestCode ">
                    <div class="accessFormLogin-row" style="text-align: center">
                        @if(config('access.custom_title'))
                            <div class="accessBox-text">
                                {{config('access.custom_title')}}
                            </div>
                        @endif

                        @if(config('access.custom_description'))
                            <span style="font-size: 17px; color: #858585">
                                {{config('access.custom_description')}}
                            </span>
                        @endif
                    </div>
                    <form class="accessFormLogin" action='{{route('access.send_code')}}' method="post" id="totp-form">
                        @csrf
                        <div class="accessFormLogin-row">
                            @if(session('message'))
                                <div class="alert-message">
                                    <div class="alert-message-error">{{ session('message') }}</div>
                                </div>
                            @endif
                            <label>Email</label>
                            <input class="StandardInput StandardInput-is-block EmailInput" type="email" required
                                   placeholder="example@email.com" spellcheck="false" autocomplete="off"
                                   autocapitalize="none"
                                   autofocus name="email">
                        </div>
                        <div class="accessFormLogin-row">
                            <button type="submit" form="totp-form"
                                    class="Button Button-is-block Button-is-juicy Button-uses-org-theme-accent-color">
                                {{config('access.custom_button')}}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
