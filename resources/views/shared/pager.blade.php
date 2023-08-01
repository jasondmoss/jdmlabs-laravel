<!-- pager.blade -->
@if ($paginator->hasPages())
  @php(
    isset($this->numberOfPaginatorsRendered[$paginator->getPageName()])
        ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++
        : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1
  )
  <nav class="" role="navigation" aria-label="Pagination Navigation">

    <span>
      @if ($paginator->onFirstPage())
        <span class="">
          {!! __('pagination.previous') !!}
        </span>
      @else
        <button type="button" class="" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before">
          {!! __('pagination.previous') !!}
        </button>
      @endif
    </span>

    <span>
      @if ($paginator->hasMorePages())
        <button type="button" class="" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before">
          {!! __('pagination.next') !!}
        </button>
      @else
        <span class="">
          {!! __('pagination.next') !!}
        </span>
      @endif
    </span>

    <div class="">
      <p class="">
        <span>{!! __('Showing') !!}</span> <span class="">{{ $paginator->firstItem() }}</span>
        <span>{!! __('to') !!}</span> <span class="">{{ $paginator->lastItem() }}</span>
        <span>{!! __('of') !!}</span> <span class="">{{ $paginator->total() }}</span>
        <span>{!! __('results') !!}</span>
      </p>

      <div class="">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
            <span class="" aria-hidden="true">
              <svg viewBox="0 0 20 20" class="" width="24" height="24" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            </span>
          </span>
        @else
          <button type="button" class="" wire:click="previousPage('{{ $paginator->getPageName() }}')" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="prev" aria-label="{{ __('pagination.previous') }}">
            <svg class="" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>
          </button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
            <span aria-disabled="true">
              <span class="">{{ $element }}</span>
            </span>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
            @foreach ($element as $page => $url)
              <span wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                @if ($page == $paginator->currentPage())
                  <span aria-current="page">
                    <span class="">{{ $page }}</span>
                  </span>
                @else
                  <button type="button" class="" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                    {{ $page }}
                  </button>
                @endif
              </span>
            @endforeach
          @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <button type="button" class="" wire:click="nextPage('{{ $paginator->getPageName() }}')" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="next" aria-label="{{ __('pagination.next') }}">
            <svg viewBox="0 0 20 20" class="" fill="currentColor">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
          </button>
        @else
          <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
            <span class="" aria-hidden="true">
              <svg viewBox="0 0 20 20" class="" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
            </span>
          </span>
        @endif
      </div>
    </div>
  </nav>
@endif
