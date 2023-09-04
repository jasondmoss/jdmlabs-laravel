<!-- message.blade -->
<figure class="alert flex gap-x-5 my-10 mx-10 px-10 py-5 border rounded-md shadow-md {{ $context }}">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-6 h-6" aria-hidden="true">
    <path d="m.057658 15.128 2.22-6.8512c5.1115 1.8055 8.8281 3.3638 11.14 4.6831-.60979-5.8209-.93063-9.8245-.96451-12.011h6.9967c-.09964 3.1825-.46631 7.1741-1.112 11.963 3.316-1.67 7.1063-3.2144 11.387-4.6332l2.218 6.8492c-4.0852 1.3511-8.0907 2.2538-12.013 2.7022 1.9609 1.7058 4.7269 4.7448 8.302 9.117l-5.7911 4.1032c-1.8633-2.5388-4.0673-5.9963-6.6081-10.374-2.3794 4.5336-4.4718 7.9971-6.2713 10.374l-5.6914-4.1032c3.7305-4.5974 6.3989-7.6364 8.005-9.117-4.147-.8011-8.0868-1.7058-11.817-2.7022" stroke-width="1.9928"></path>
  </svg>
  <figcaption>
    @if (count($errors) > 0)
      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach
    @else
      {{ $message }}
    @endif
  </figcaption>
</figure>
