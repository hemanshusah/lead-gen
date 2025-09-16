<?php

/** -------------------------------------------------------------------------------------------------
 * TEMPLATE
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 * @package    Grow CRM
 * @author     NextLoop
 *---------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs;
use App\Repositories\ContractRepository;
use App\Repositories\ProposalRepository;
use App\Repositories\PublishEstimateRepository;
use App\Repositories\PublishInvoiceRepository;
use Log;

class ScheduledCron {

    public function __invoke(
        PublishInvoiceRepository $publishinvoicerepo,
        PublishEstimateRepository $publishestimaterepo,
        ProposalRepository $proposalrepo,
        ContractRepository $contractrepo
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

        //publish scheduled invoices
        $this->publishScheduledInvoices($publishinvoicerepo);

        //publish scheduled estimate
        $this->publishScheduledEstimates($publishestimaterepo);

        //publish scheduled proposal
        $this->publishScheduledProposals($proposalrepo);

        //publish scheduled contract
        $this->publishScheduledContracts($contractrepo);

        //reset last cron run data
        \App\Models\Settings::where('settings_id', 1)
            ->update([
                'settings_cronjob_has_run' => 'yes',
                'settings_cronjob_last_run' => now(),
            ]);

    }

    /**
     * Publish all invoices scheduled for today
     *  @return null
     */
    public function publishScheduledInvoices($publishinvoicerepo) {

        $today = \Carbon\Carbon::now()->format('Y-m-d');

        //get pending invoices (10 at a time)
        if (!$invoices = \App\Models\Invoice::Where('bill_publishing_scheduled_date', '<=', $today)
            ->where('bill_publishing_type', 'scheduled')
            ->where('bill_publishing_scheduled_status', 'pending')
            ->take(10)->get()) {

            //none found
            return;
        }

        Log::info("Found (" . count($invoices) . ") invoices that are scheduled for publishing", ['process' => '[scheduled-cron][invoices]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //publish each invoice
        foreach ($invoices as $invoice) {

            if ($publishinvoicerepo->publishInvoice($invoice->bill_invoiceid)) {

                //mark as poublished
                $invoice->bill_publishing_scheduled_status = 'published';
                $invoice->save();

                Log::info("Invoice (" . $invoice->bill_invoiceid . ") was published", ['process' => '[scheduled-cron][invoices]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            } else {
                Log::error("Invoice (" . $invoice->bill_invoiceid . ") could not be published", ['process' => '[scheduled-cron][invoices]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            }

        }
    }

    /**
     * Publish all estimates scheduled for today
     *  @return null
     */
    public function publishScheduledEstimates($publishestimaterepo) {

        $today = \Carbon\Carbon::now()->format('Y-m-d');

        //get pending estimates (10 at a time)
        if (!$estimates = \App\Models\Estimate::Where('bill_publishing_scheduled_date', '<=', $today)
            ->where('bill_publishing_type', 'scheduled')
            ->where('bill_publishing_scheduled_status', 'pending')
            ->take(10)->get()) {

            //none found
            return;
        }

        Log::info("Found (" . count($estimates) . ") estimates that are scheduled for publishing", ['process' => '[scheduled-cron][estimates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //publish each estimate
        foreach ($estimates as $estimate) {

            if ($publishestimaterepo->publishEstimate($estimate->bill_estimateid)) {

                //mark as poublished
                $estimate->bill_publishing_scheduled_status = 'published';
                $estimate->save();

                Log::info("Estimate (" . $estimate->bill_estimateid . ") was published", ['process' => '[scheduled-cron][estimates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            } else {
                Log::error("Estimate (" . $estimate->bill_estimateid . ") could not be published", ['process' => '[scheduled-cron][estimates]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            }

        }
    }

    /**
     * Publish all proposal scheduled for today
     *  @return null
     */
    public function publishScheduledProposals($proposalrepo) {

        $today = \Carbon\Carbon::now()->format('Y-m-d');

        //get pending proposals (10 at a time)
        if (!$proposals = \App\Models\Proposal::Where('doc_publishing_scheduled_date', '<=', $today)
            ->where('doc_publishing_type', 'scheduled')
            ->where('doc_publishing_scheduled_status', 'pending')
            ->take(10)->get()) {

            //none found
            return;
        }

        Log::info("Found (" . count($proposals) . ") proposals that are scheduled for publishing", ['process' => '[scheduled-cron][proposals]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //publish each proposal
        foreach ($proposals as $proposal) {

            if ($proposalrepo->publish($proposal->doc_id)) {

                //mark as poublished
                $proposal->doc_publishing_scheduled_status = 'published';
                $proposal->save();

                Log::info("Proposal (" . $proposal->doc_id . ") was published", ['process' => '[scheduled-cron][proposals]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            } else {
                Log::error("Proposal (" . $proposal->doc_id . ") could not be published", ['process' => '[scheduled-cron][proposals]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            }
        }
    }

    /**
     * Publish all contract scheduled for today
     *  @return null
     */
    public function publishScheduledContracts($contractrepo) {

        $today = \Carbon\Carbon::now()->format('Y-m-d');

        //get pending contracts (10 at a time)
        if (!$contracts = \App\Models\Contract::Where('doc_publishing_scheduled_date', '<=', $today)
            ->where('doc_publishing_type', 'scheduled')
            ->where('doc_publishing_scheduled_status', 'pending')
            ->take(10)->get()) {

            //none found
            return;
        }

        Log::info("Found (" . count($contracts) . ") contracts that are scheduled for publishing", ['process' => '[scheduled-cron][contracts]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //publish each contract
        foreach ($contracts as $contract) {

            if ($contractrepo->publish($contract->doc_id)) {

                //mark as poublished
                $contract->doc_publishing_scheduled_status = 'published';
                $contract->save();

                Log::info("Contract (" . $contract->doc_id . ") was published", ['process' => '[scheduled-cron][contracts]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            } else {
                Log::error("Contract (" . $contract->doc_id . ") could not be published", ['process' => '[scheduled-cron][contracts]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            }
        }
    }

}