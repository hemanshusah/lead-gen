@extends('pages.settings.ajaxwrapper')
@section('settings-page')
<!-- action buttons -->
@include('pages.settings.sections.leads.misc.list-page-actions')
<!-- action buttons -->

<!--heading-->
@include('pages.settings.sections.leads.table.table')

@if(config('system.settings_type') == 'standalone')
<!--[standalone] - settings documentation help-->
@endif

@endsection