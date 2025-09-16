<!--main table view-->
@include('pages.tasks.components.table.table')

<!--export-->
@if(config('visibility.list_page_actions_exporting'))
@include('pages.export.tasks.export')
@endif