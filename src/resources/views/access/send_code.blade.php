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

        .Button.Button-is-auth {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex
        }

        .Message svg {
            height: 1em;
            width: 1em;
            margin-right: .5em
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
            <div class="company-logo">
                <img height=50 src="{{config('access.app_logo')}}" style="display:none;"
                     onload="this.style.display=''"></img>
            </div>
            <div class="accessBox-App">
                <div class="App-name">
                    {{config('access.app_name')}}
                </div>
            </div>
            <div class="accessBox-Normal">
                <div class="accessBox-RequestCode ">
                    <div class="accessFormLogin-row" style="text-align: center">
                        <div class="accessBox-text">
                            {{config('access.custom_title')}}
                        </div>
                        <span style="font-size: 17px; color: #858585">
                            {{config('access.custom_description')}}
                        </span>
                    </div>
                    <form class="accessFormLogin" action='{{route('access.validate_code')}}' method="post"
                          id="{{$formId}}">
                        @method('PUT')
                        <div class="accessFormLogin-row">
                            <label>Code</label>
                            <input class="StandardInput StandardInput-is-block EmailInput"
                                   type="text"
                                   required
                                   placeholder="000000"
                                   spellcheck="false"
                                   autocomplete="off"
                                   autocapitalize="none"
                                   autofocus
                                   name="code"
                                   inputmode="numeric"
                                   pattern="\d{6}"
                            >
                            <input
                                hidden
                                type="text"
                                name="nonce"
                                value="{{$nonce}}"
                            />
                            <input
                                hidden
                                type="text"
                                name="_token"
                                value="{{csrf_token()}}"
                            />
                            <input
                                hidden
                                type="text"
                                name="form_id"
                                value="{{$formId}}"
                            />
                        </div>
                        <div class="accessFormLogin-row">
                            <button type="submit" form="{{$formId}}"
                                    class="Button Button-is-block Button-is-juicy Button-uses-org-theme-accent-color">
                                {{config('access.custom_button_valid_code')}}
                            </button>
                        </div>
                        <div class="accessFormLogin-row" style="text-align: center;">
                            <a href="{{route('access.index')}}">
                                {{config('access.custom_button_resend_code')}}
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
