<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="generator" content="Laravel 10">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="canonical" content="{{ config('app.url') }}">
  <meta name="title" content="@if ($title) {{ $title }} &#160;&#11825;&#160; @endif {{ config('jdmlabs.base.title', 'JdmLabs') }}">
  <meta name="description" content="{{ config('jdmlabs.base.description') }}">
  <meta name="author" content="jasondmoss">
  <meta name="color-scheme" content="dark light">

  <title>@if ($title) {{ $title }} &#160;&#11825;&#160; @endif {{ config('jdmlabs.base.title', 'JdmLabs') }}</title>

  <link rel="profile" href="https://microformats.org/profile/hcard">
  <link rel="profile me" href="https://mastodon.online/@jasondmoss">

  <link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/berkeley-mono--400.woff2') }}" as="font" crossorigin>
  <link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/berkeley-mono--400-italic.woff2') }}" as="font" crossorigin>
  <link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/berkeley-mono--700.woff2') }}" as="font" crossorigin>
  <link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/berkeley-mono--700-italic.woff2') }}" as="font" crossorigin>
  <link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/fira-sans--400.woff2') }}" as="font" crossorigin>
  <link rel="preload" type="font/woff2" href="{{ Vite::asset('resources/assets/fonts/fira-sans--700.woff2') }}" as="font" crossorigin>
  <style>
@font-face{font-family:"Berkeley Mono";font-style:normal;font-weight:400;font-display:swap;src:local("Berkeley Mono Regular"),local("BerkeleyMono-Regular"),url("{{ Vite::asset('resources/assets/fonts/berkeley-mono--400.woff2') }}") format("woff2");}
@font-face{font-family:"Fira Sans";font-style:normal;font-weight:400;font-display:swap;src:local("Fira Sans Regular"),local("FiraSans-Regular"),url("{{ Vite::asset('resources/assets/fonts/fira-sans--400.woff2') }}") format("woff2");}
  </style>
  <link rel="preconnect" href="https://cdn.jsdelivr.net">
  <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
  <link rel="preconnect" href="https://unpkg.com">
  <link rel="dns-prefetch" href="https://unpkg.com">

  <link rel="icon" href="{{ Vite::asset('resources/assets/images/icon/favicon.ico') }}" type="image/vnd.microsoft.icon">
  <link rel="icon" href="{{ Vite::asset('resources/assets/images/icon/site-icon.svg') }}" type="image/svg+xml">
  <link rel="apple-touch-icon" href="{{ Vite::asset('resources/assets/images/icon/site-icon--180.png') }}">
  <link rel="manifest" href="{{ asset('jdmlabs.webmanifest') }}">

  @stack('vendor-styles')
  @vite('resources/assets/css/aenginus/style.css')
</head>
