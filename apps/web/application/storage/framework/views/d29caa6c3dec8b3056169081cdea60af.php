
<!--totals-->
<tr class="report-results-table-totals">
    <td colspan="1"><?php echo app('translator')->get('lang.page_totals'); ?></td>
    <td><?php echo e($totals['sum_invoice_count'] ?? 0); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_before_tax'] ?? 0)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_tax'] ?? 0)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_discount'] ?? 0)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_adjustment'] ?? 0)); ?></td>
    <td class="data-type-money" data-tableexport-xlsxformatid="4"><?php echo e(runtimeMoneyFormat($totals['sum_final_amount'] ?? 0)); ?>

    </td>
</tr>

<!--pagination-->
<tr>
    <td class="pagination-container" data-tableexport-display="none" colspan="11">
        <div class="pagination">
            <?php echo e($invoices->links('pages.reports.components.misc.pagination')); ?>

        </div>
    </td>
</tr><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/reports/invoices/category/footer.blade.php ENDPATH**/ ?>