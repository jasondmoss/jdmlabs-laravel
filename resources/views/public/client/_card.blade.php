@php
@endphp
<client class="">
  {{--<img class="" src="@if ($client->image) {{ Storage::url($client->image->url) }} @else https://cdn.pixabay.com/photo/2022/01/08/14/53/town-6924142_960_720.jpg @endif" alt="">--}}
  <div class="">
    <h2 class="">
      <a href="{{ route(\App\Client\Interface\Http\Controllers\SingleController::class, $client->slug) }}">
        {{ $client->title }}
      </a>
    </h2>
    <div class="">
      {!! $client->summary !!}
    </div>
  </div>
</client>
