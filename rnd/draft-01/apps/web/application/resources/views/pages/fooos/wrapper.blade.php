@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        @include('misc.heading-crumbs')


        <!-- action buttons -->
        @include('pages.fooos.components.misc.list-page-actions')

    </div>

    <!-- main content -->
    <div class="row">
        <div class="col-12">
            <!--fooos table-->
            @include('pages.fooos.components.table.wrapper')
        </div>
    </div>

    <!--filter panel-->
    @include('pages.fooos.components.misc.filter')

</div>
@endsection