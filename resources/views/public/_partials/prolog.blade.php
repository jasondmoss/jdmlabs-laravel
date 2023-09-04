<meta charset="utf-8">
<!--
 * @author    Jason D. Moss <work@jdmlabs.com>
 * @copyright 2005-2023 Jason D. Moss. All rights freely given.
 * @license   https://www.jdmlabs.com/LICENSE.md [MIT License]
 *
 * @link {Profile} https://behance.net/jasondmoss
 * @link {Profile} https://github.com/jasondmoss
 * @link {Profile} https://twitter.com/jasondmoss
 * @link {Profile} https://about.me/jasondmoss
 * @link {Profile} https://www.linkedin.com/in/jasondmoss
 * @link {Profile} https://www.last.fm/user/jasonmoss
-->
@if (Request::is('/'))
<title>{{ config('jdmlabs.title_home', 'JdmLabs') }}</title>
@elseif ($title)
<title>{{ $title }} &#160;&#11825;&#160; {{ config('jdmlabs.title', 'JdmLabs') }}</title>
@endif
<meta name="canonical" content="{{ config('app.url') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="generator" content="Laravel 10">
<meta name="title" content="@if ($title) {{ $title }} &#160;&#11825;&#160; @endif {{ config('jdmlabs.title', 'JdmLabs') }}">
<meta name="description" content="{{ config('jdmlabs.description') }}">
<meta name="author" content="jasondmoss">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="color-scheme" content="dark light">

<link rel="profile" href="https://microformats.org/profile/hcard">
<link rel="profile me" href="https://mastodon.online/@jasondmoss">

<link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/bmono--400.woff2') }}" as="font" crossorigin>
<link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/bmono--700.woff2') }}" as="font" crossorigin>

<style>@font-face{font-family:"Berkeley Mono";font-style:normal;font-weight:normal;font-display:swap;src:url("{{ Vite::asset('resources/assets/fonts/bmono--400.woff2') }}") format("woff2");}@font-face{font-family:"Berkeley Mono Bold";font-style:normal;font-weight:normal;font-display:swap;src:url("{{ Vite::asset('resources/assets/fonts/bmono--700.woff2') }}") format("woff2");}</style>

<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://unpkg.com">
<link rel="dns-prefetch" href="https://unpkg.com">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ config('app.url') }}">
<meta property="og:title" content="@if ($title){{ $title }} &#160;&#11825;&#160; @endif{{ config('jdmlabs.title', 'JdmLabs') }}">
<meta property="og:description" content="{{ config('jdmlabs.description') }}">
<meta property="og:image" content="{{ Vite::asset('resources/assets/images/' . config('jdmlabs.image_share', '')) }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator:id" content="156621819">
<meta name="twitter:url" content="{{ config('app.url') }}">
<meta name="twitter:title" content="@if ($title){{ $title }} &#160;&#11825;&#160;@endif {{ config('jdmlabs.title', 'JdmLabs') }}">
<meta name="twitter:description" content="{{ config('jdmlabs.description') }}">
<meta name="twitter:image" content="{{ Vite::asset('resources/assets/images/' . config('jdmlabs.image_share', '')) }}">

<link rel="icon" href="{{ Vite::asset('resources/assets/images/icon/favicon.ico') }}" type="image/vnd.microsoft.icon">
<link rel="icon" href="{{ Vite::asset('resources/assets/images/icon/site-icon.svg') }}" type="image/svg+xml">
<link rel="apple-touch-icon" href="{{ Vite::asset('resources/assets/images/icon/site-icon--180.png') }}">
<link rel="manifest" href="{{ asset('jdmlabs.webmanifest') }}">

@vite('resources/assets/css/public/style.css')
