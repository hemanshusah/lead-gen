<!--bulk actions-->
@include('pages.fooos.components.misc.bulk-actions')

<!--main table view-->
@include('pages.fooos.components.table.table')

<!--filter panel-->
@if(auth()->user()->is_team)
@include('pages.fooos.components.misc.filter')
@endif
