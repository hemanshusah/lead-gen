<!--export excel-->
<button type="button"
    class="list-actions-button btn-text btn btn-page-actions waves-effect waves-dark js-export-table-excel"
    data-button-loading-annimation="yes"
    data-table="report-results-table">
    Excel
</button>

<!--export cvs-->
<button type="button"
    class="list-actions-button btn-text btn btn-page-actions waves-effect waves-dark js-export-table-csv"
    data-table="report-results-table">
    CSV
</button>

<!--print-->
<button type="button" 
    class="list-actions-button btn-text btn btn-page-actions waves-effect waves-dark js-print-table"
    data-table="report-results-table">
    <?php echo app('translator')->get('lang.print'); ?>
</button><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/reports/invoices/components/actions.blade.php ENDPATH**/ ?>