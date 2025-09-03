<!--ALL THIRD PART JAVASCRIPTS-->
<script src="public/vendor/js/vendor.footer.js?v={{ config('system.versioning') }}"></script>


<!--nextloop.core.js-->
<script src="/public/js/core/ajax.js?v={{ config('system.versioning') }}"></script>

<!--MAIN JS - AT END-->
<script src="public/js/core/boot.js?v={{ config('system.versioning') }}"></script>

<!--EVENTS-->
<script src="/public/js/core/events.js?v={{ config('system.versioning') }}"></script>

<!--CORE-->
<script src="/public/js/core/app.js?v={{ config('system.versioning') }}"></script>

<!--SEARCH-->
<script src="/public/js/core/search.js?v={{ config('system.versioning') }}"></script>

<!--BILLING-->
<script src="/public/js/core/billing.js?v={{ config('system.versioning') }}"></script>

<!--project page charts-->
@if(@config('visibility.projects_d3_vendor'))
<script src="/public/vendor/js/d3/d3.min.js?v={{ config('system.versioning') }}"></script>
<script src="/public/vendor/js/c3-master/c3.min.js?v={{ config('system.versioning') }}"></script>
@endif

<!--form builder-->
@if(@config('visibility.web_form_builder'))
<script src="public/vendor/js/formbuilder/form-builder.min.js?v={{ config('system.versioning') }}"></script>
<script src="public/js/webforms/webforms.js?v={{ config('system.versioning') }}"></script>
@endif

<!--export js (https://github.com/hhurz/tableExport.jquery.plugin)-->
<script src="public/js/core/export.js?v={{ config('system.versioning') }}"></script>
<script type="text/javascript"
    src="public/vendor/js/exportjs/libs/FileSaver/FileSaver.min.js?v={{ config('system.versioning') }}"></script>
<script type="text/javascript"
    src="public/vendor/js/exportjs/libs/js-xlsx/xlsx.core.min.js?v={{ config('system.versioning') }}"></script>
<script type="text/javascript" src="public/vendor/js/exportjs/tableExport.min.js?v={{ config('system.versioning') }}">
</script>

<!--printing-->
<script type="text/javascript" src="public/vendor/js/printthis/printthis.js?v={{ config('system.versioning') }}">
</script>

<!--table sorter-->
<script type="text/javascript"
    src="public/vendor/js/tablesorter/js/jquery.tablesorter.min.js?v={{ config('system.versioning') }}"></script>

<!--bootstrap-timepicker-->
<script type="text/javascript"
    src="/public/vendor/js/bootstrap-timepicker/bootstrap-timepicker.js?v={{ config('system.versioning') }}">
</script>

<!--code mirror - css editor-->
<script type="text/javascript" src="/public/js/codemirror/codemirror.min.js?v={{ config('system.versioning') }}">
</script>
<script type="text/javascript" src="/public/js/codemirror/css.min.js?v={{ config('system.versioning') }}"></script>


<!--calendaerfull js [v6.1.13]-->
<script src="/public/vendor/js/fullcalendar/index.global.min.js?v={{ config('system.versioning') }}"></script>
<!--IMPORTANT NOTES (June 2024) - any new JS libraries added here that are booted/initiated in boot.js should also be added to the landlord footerjs.blade.js, for saas-->

<!--[modules] js includes-->
{!! config('js.modules') !!}