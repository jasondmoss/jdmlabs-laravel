<x-ae.layout title="Taxonomy" page="index" livewire="true">
  <header class="panel-header">
    <h1>{{ __('Taxonomy Vocabularies') }}</h1>
  </header>

{{--  <style>
    table.listing {
      width: 95%;
    }
  </style>--}}
  <h2>Taxonomy</h2>

  <div class="container-fluid">
    <div class="row">
      <p>Taxonomy here refers to the sets of terms that provide classification of ATLis tasks, and to the "vocabularies" of related terms by which the terms are grouped. The taxonomy terms are sometimes referred to as "tags" and "tagging" the process of associating the terms with tasks.</p>
    </div>
  </div>

  <h3>Vocabularies</h3>
  <div>
    <p>The table below lists the taxonomy vocabularies that have been defined. Clicking on a vocabulary name will let the user view the terms it contaings. Creating a new vocabulary is an administrative task. Afer a vocabulary has been created, its management is delegated to a set of users to manage addition and removal of terms.</p>

    <a class="button" href="{{route('vocabularies.create')}}" role="button">
      <i class="fa-solid fa-layer-plus"> New</i></a>
    <table class="table-striped listing">
      <tr>
        <th>Vocabulary</th>
        <th>Description</th>
      </tr>
      @foreach($vocabularies as $vocab)
        <tr>
          <td>{!! route('vocabularies.show', $vocab->name, [ $vocab->id ]) !!}</td>
          <td>{{ $vocab->description }}</td>
        </tr>
      @endforeach
    </table>
  </div>
</x-ae.layout>
