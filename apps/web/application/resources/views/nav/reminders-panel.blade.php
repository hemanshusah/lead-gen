<!-- right-sidebar (reusable)-->
<div class="right-sidebar right-sidepanel-with-menu sidebar-md" id="sidepanel-reminders">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <div class="x-top">
                    <i class="ti-alarm-clock"></i>@lang('lang.reminders')
                    <span>
                        <i class="ti-close js-close-side-panels" data-target="sidepanel-reminders"></i>
                    </span>
                </div>
                <div class="x-top-nav">
                    <a class="right-sidepanel-menu right-sidepanel-reminders-menu ajax-request" href="javascript:void(0);"
                        id="right-sidepanel-reminders-menu-due" data-url="{{ url('reminders/topnav-feed?status=due') }}"
                        data-loading-target="sidepanel-reminders-container" data-target="sidepanel-reminders-container"
                        data-progress-bar='hidden'>@lang('lang.due_reminders')</a>
                    <span class="x-spacer">|</span>
                    <a class="right-sidepanel-menu right-sidepanel-reminders-menu ajax-request" href="javascript:void(0);" id="right-sidepanel-reminders-menu-active"
                        data-url="{{ url('reminders/topnav-feed?status=active') }}"
                        data-loading-target="sidepanel-reminders-container" data-target="sidepanel-reminders-container"
                        data-progress-bar='hidden'>@lang('lang.pending_reminders')</a>
                </div>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body p-t-40" id="sidepanel-reminders-body">
                <div class="message-center topnav-reminders-container" id="sidepanel-reminders-container">
                    <!--dynamic content-->
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar-->