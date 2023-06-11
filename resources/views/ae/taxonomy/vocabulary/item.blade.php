<x-ae.layout title="Taxonomy" page="index" livewire="true">
  <header class="panel-header">
    <h1>{{ __('Vocabulary ') . $vocabulary->name }}</h1>
  </header>
{{--  <style>
    div.taxonomy-label {
      display: table-cell;
      width: 60%;
    }
    div.taxonomy-actions {
      display: table-cell;
      text-align: right;
      width: 40%;
    }
    div.taxonomy-term {
      padding-right: 15px;
      display: table;
      width: 100%;
      border-bottom: 1px dotted #ccc;
    }
    div.taxonomy-term:hover {
      background-color: #ccc;
    }
  </style>--}}
  <div class="">
    {{--<h2>Vocabulary {{$vocabulary->name}}</h2>--}}

    @can('update', $vocabulary)
      <a class="button" href="{{ route('vocabularies.edit', [ $vocabulary->id ]) }}" role="button">
        <i class="fa-solid fa-pen-to-square"> Edit</i>
      </a>
    @endcan
  </div>

  <div class="">
    <h3>Description</h3>
    <div class="">
      <p>{{ $vocabulary->description }}</p>
    </div>

    <h3>Terms</h3>
    @can('update', $vocabulary)
      <div class="" data-model="term" data-vocabulary_id="{{ $vocabulary->id }}" role="button">
        <a href="#" class="button"><i class="fa-sharp fa-solid fa-plus"> Add</i></a>
      </div>
    @endcan

    @if ( $vocabulary->terms->count() > 0)
      <ol id="term-0" class="sortable">
        @foreach ($vocabulary->rootTerms() as $term)
          @include('taxonomy::terms.branch', [ 'term' => $term ])
        @endforeach
      </ol>
    @endif

    {{--@include('includes.ownership_details',[
      'model' => 'vocabulary',
      'item' => $vocabulary
    ])--}}
  </div>

  @include('shared.modal', [
    $modal_id = 'editItem',
    $modal_title = 'Edit Term'
  ])

  <script src="{{asset('js/laroute.js')}}"></script>
  <script src="{{asset('vendor/jlab/taxonomy/js/taxonomy.js')}}"></script>
  <script>
$(function () {

    $(".sortable").sortable({
        connectWith: ".sortable",
        update: function (event, ui) {
            taxonomy.reorderTerms($(event.target).attr("id"), $(event.target).sortable("toArray"));
        }
    });

    $(".sortable>li>ol").sortable({
        connectWith: ".sortable>li>ol",
        update: function (event, ui) {
            taxonomy.reorderTerms($(event.target).attr("id"), $(event.target).sortable("toArray"));
        }
    });

    $(".btn-edit").on("click", taxonomy.editItemDialog);
    $(".btn-add").on("click", taxonomy.editItemDialog);
    $(".btn-users").on("click", taxonomy.editUsersDialog);
    $(".btn-delete").on("click", taxonomy.deleteItemDialog);

    $(".editable").editable();
});
  </script>
</x-ae.layout>
