<!--existing & new reminder-->
<div id="reminders-existing-new">
    <!--title-->
    <div class="filter-block">
        <div class="fields">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control form-control-sm" autocomplete="off" id="reminder_title"
                        name="reminder_title" placeholder="<?php echo app('translator')->get('lang.reminder_title'); ?>"
                        value="<?php echo e($payload['reminder_title'] ?? ''); ?>">
                </div>
            </div>
        </div>
    </div>

    <!--date and time picker-->
    <div class="overflow-hidden">
        <div class="form-group  m-b-0">
            <div class="row">
                <div class="col-12">
                    <div id="reminders-datetimepicker" data-preset-date="<?php echo e($payload['preset_date']); ?>"></div>
                </div>
            </div>
        </div>
    </div>

    <!--title-->
    <div class="filter-block m-b-0 x-reminder-notes">
        <div class="fields">
            <div class="row">
                <div class="col-md-12">
                    <textarea class="form-control form-control-sm " rows="3" name="reminder_notes" id="reminder_notes"
                        placeholder="<?php echo app('translator')->get('lang.reminder_notes'); ?>"><?php echo e($payload['reminder_notes']?? ''); ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <!--data-->
    <input type="hidden" name="reminder_datetime" id="reminder_datetime" value="<?php echo e($payload['preset_date']); ?>">
    <input type="hidden" name="reminder_action" id="reminder_action">

    <!--buttons-->
    <div class="buttons-block  p-b-0 p-t-0">
        <!--close button (task/lead cards only-->
        <?php if(request('ref') =='card'): ?>
        <button type="button" class="btn btn-rounded-x btn-default btn-sm ajax-request" id="close_reminder_button" data-loading-class="loading-before-centre"
            data-loading-target="reminders-datetimepicker"
            data-url="<?php echo e(url('reminders/close?resource_type='.$payload['resource_type'].'&resource_id='.$payload['resource_id'].'&ref='.request('ref'))); ?>"><?php echo e(cleanLang(__('lang.close'))); ?></button>
        <?php endif; ?>
        <!--delete button-->
        <?php if($payload['show_delete_button']): ?>
        <button type="button" class="btn btn-rounded-x btn-danger btn-sm js-ajax-ux-request" name="delete_reminder" id="delete_reminder"
            data-url="<?php echo e(url('reminders/delete?resource_type='.$payload['resource_type'].'&resource_id='.$payload['resource_id'].'&ref='.request('ref').'&reminder_id='.$reminder->reminder_id)); ?>"
            data-loading-class="loading-before"
            ><?php echo e(cleanLang(__('lang.delete'))); ?></button>
        <?php endif; ?>
        <!--save button-->
        <button type="button" class="btn btn-rounded-x btn-info btn-sm js-ajax-ux-request"
            data-url="<?php echo e(url('reminders/new?resource_type='.$payload['resource_type'].'&resource_id='.$payload['resource_id'].'&ref='.request('ref'))); ?>"
            data-type="form" data-form-id="reminders-existing-new" data-loading-class="loading-before"
            data-loading-target="<?php echo e($payload['reminder_ajax_loading_target']); ?>"
            data-ajax-type="post"><?php echo e(cleanLang(__('lang.save'))); ?></button>
    </div>

</div><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/pages/reminders/misc/reminder.blade.php ENDPATH**/ ?>