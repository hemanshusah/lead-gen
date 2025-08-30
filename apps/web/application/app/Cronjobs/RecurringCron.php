<?php

/** -------------------------------------------------------------------------------------------------
 * RECURRING CROM - Process various recurring items
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 * @package    Grow CRM
 * @author     NextLoop
 *---------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs;
use App\Repositories\ExpenseRepository;
use App\Repositories\RecurringInvoiceRepository;

class RecurringCron {

    public function __invoke(
        ExpenseRepository $expenserepo,
        RecurringInvoiceRepository $invoiceserepo
    ) {
        //[MT] - tenants only
        if (env('MT_TPYE')) {
            if (\Spatie\Multitenancy\Models\Tenant::current() == null) {
                return;
            }
        }

        //boot system settings
        middlewareBootSettings();

        //[MT] boot mail settings
        env('MT_TPYE') ? middlewareSaaSBootMail() : middlewareBootMail();

        middlewareBootTheme();

        //log that its run
        //Log::info("Cronjob has started", ['process' => '[RecurringInvoicesCron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //RECURRINGE EXPENSES
        $this->recurringExpenses($expenserepo);

        //RECURRINGE INVOICES
        $this->recurringInvoices($invoiceserepo);
    }

    /**
     * recurring expenses
     *
     * @return bool
     */
    public function recurringExpenses($expenserepo) {

        //recur expenses that are due today
        $expenserepo->recurringExpenses(10);

    }

    /**
     * recurring invoices
     *
     * @return bool
     */
    public function recurringInvoices($invoiceserepo) {

        //recur invoices that are due today
        $invoiceserepo->processInvoices(1);

    }

}