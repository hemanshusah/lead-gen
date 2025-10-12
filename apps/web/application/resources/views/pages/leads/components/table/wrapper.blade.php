<!--bulk actions-->
@include('pages.leads.components.actions.checkbox-actions')

<!--custom table view-->
@include('pages.leads.components.table.table')

<!--export-->
@if(config('visibility.list_page_actions_exporting'))
@include('pages.export.leads.export')
@endif