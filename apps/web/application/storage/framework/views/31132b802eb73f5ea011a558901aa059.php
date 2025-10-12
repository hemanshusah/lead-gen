<!-- right-sidebar (reusable)-->
<div class="right-sidebar right-sidepanel-with-menu sidebar-md" id="sidepanel-notifications">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <div class="x-top">
                    <i class="sl-icon-bell"></i><?php echo e(cleanLang(__('lang.notifications'))); ?>

                    <span>
                        <i class="ti-close js-close-side-panels" data-target="sidepanel-notifications"></i>
                    </span>
                </div>
                <div class="x-top-nav">
                    <a class="right-sidepanel-menu active ajax-request" href="javascript:void(0);"
                        id="right-sidepanel-menu-unread"
                        data-url="<?php echo e(url('events/topnav?eventtracking_status=unread')); ?>"
                        data-loading-target="sidepanel-notifications-body" data-target="sidepanel-notifications"
                        data-progress-bar='hidden'><?php echo app('translator')->get('lang.unread'); ?></a>
                    <span class="x-spacer">|</span>
                    <a class="right-sidepanel-menu ajax-request" href="javascript:void(0);"
                        data-url="<?php echo e(url('events/topnav')); ?>" data-loading-target="sidepanel-notifications-body"
                        data-target="sidepanel-notifications" data-progress-bar='hidden'><?php echo app('translator')->get('lang.all'); ?></a>
                </div>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body p-t-40" id="sidepanel-notifications-body">
                <!--mark all read-->
                <div class="sidepanel-notifications-mark-all-read hidden" id="sidepanel-notifications-mark-all-read">
                    <a href="javascript:void(0);" id="topnav-notification-mark-all-read"
                    data-url="<?php echo e(url('events/mark-allread-my-events')); ?>" data-progress-bar='hidden'><?php echo app('translator')->get('lang.dismiss_notifications'); ?></button>
                </div>

                <div id="sidepanel-notifications-events">
                    <!--dynamic content-->
                </div>

                <!--load more button-->
                <div class="autoload" id="events-panel-loadmore-button-container">
                    <a data-url="<?php echo e($page['url'] ?? ''); ?>" data-loading-target="<?php echo e($page['loading_target'] ?? ''); ?>"
                        href="javascript:void(0)" class="btn btn-rounded btn-secondary js-ajax-ux-request"
                        id="events-panel-load-more-button"><?php echo e(cleanLang(__('lang.show_more'))); ?></a>
                </div>
                <!--load more button-->
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar--><?php /**PATH /www/wwwroot/backend3/crm/mycrm/application/resources/views/nav/notifications-panel.blade.php ENDPATH**/ ?>