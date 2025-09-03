<?php

/** -------------------------------------------------------------------------------------------------------------------
 * @description
 * This cronjob is envoked by by the task scheduler which is in 'application/app/Console/Kernel.php'
 * It will fetch support tickets for each ticket category from an imap server.
 * 
 * Tickets 'Category' Table Column Mapping
 * These are additional columns in the [category] table that are used for support tickets imap email piping
 * 
 *    ------------------------------------------------
 *    imap_status              - category_meta_4
 *    email                    - category_meta_5
 *    username                 - category_meta_6
 *    password                 - category_meta_7
 *    host                     - category_meta_8
 *    port                     - category_meta_9
 *    encryption               - category_meta_10
 *    post_action              - category_meta_11
 *    mailbox_id               - category_meta_12
 *    last_fetched_mail_id     - category_meta_13
 *    fecthing_status          - category_meta_14
 *    last_fetched_date        - category_meta_22
 *    -----------------------------------------------
 * 
 * @package    Grow CRM
 * @author     NextLoop
 *
 *------------------------------------------------------------------------------------------------------------------------*/

namespace App\Cronjobs;
use App\Repositories\TicketsImapRepository;
use Log;

class ImapTicketsFetchCron {

    protected $imaprepo;

    public function __invoke(
        TicketsImapRepository $imaprepo
    ) {

        $this->imaprepo = $imaprepo;

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

        //fetch emails
        $this->fetchEmails();
    }

    /** -------------------------------------------------------------------------
     * fetch support ticket email from an imap server and process into tickets
     * -------------------------------------------------------------------------*/
    public function fetchEmails() {

        Log::info("IMAP - cronjob for fetching support tickets via imap email - started", ['process' => '[imap-ticket-fetch-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //get just one category. the one with the oldest 'last_fetched_date'
        if (!$category = \App\Models\Category::where('category_type', 'ticket')
            ->where('category_meta_4', 'enabled')
            ->where(function ($query) {
                $query->whereNull('category_meta_14')
                ->orWhere('category_meta_14', 'completed')
                ->orWhere('category_meta_14', '');
            })
            ->orderBy('category_meta_22', 'asc')
            ->first()) {
            return;
        }

        //the payload
        $data = [
            'limit' => config('system.settings2_tweak_imap_tickets_import_limit'),
            'email' => $category->category_meta_5,
            'host' => $category->category_meta_8,
            'port' => $category->category_meta_9,
            'encryption' => $category->category_meta_10,
            'username' => $category->category_meta_6,
            'password' => $category->category_meta_7,
            'post_action' => $category->category_meta_11,
            'mailbox_id' => $category->category_meta_12,
            'last_fetched_mail_id' => $category->category_meta_13,
            'last_fetched_date' => $category->category_meta_22,
            'timeout' => config('system.settings2_tweak_imap_connection_timeout'), //seconds
        ];

        //fetch the emails
        $this->imaprepo->fetchEmails($data, $category);

        Log::info("IMAP - cronjob for fetching support tickets via imap email - ended", ['process' => '[imap-ticket-fetch-cron]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

        //reset last cron run data
        \App\Models\Settings::where('settings_id', 1)
            ->update([
                'settings_cronjob_has_run' => 'yes',
                'settings_cronjob_last_run' => now(),
            ]);

    }

}