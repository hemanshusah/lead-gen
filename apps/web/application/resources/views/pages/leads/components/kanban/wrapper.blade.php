<!--main table view-->
@include('pages.leads.components.kanban.kanban')

<!--Update Card Poistion-->
<!--export-->
@if(config('visibility.list_page_actions_exporting'))
@include('pages.export.leads.export')
@endif