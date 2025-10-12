<!-- right-sidebar (reusable)-->
<div class="right-sidebar right-sidepanel-with-menu sidebar-xl" id="sidepanel-starred">
    <form>
        <div class="slimscrollright">
            <!--title-->
            <div class="rpanel-title">
                <div class="x-top">
                    <i class="sl-icon-star"></i>Starred
                    <span>
                        <i class="ti-close js-close-side-panels" data-target="sidepanel-starred"></i>
                    </span>
                </div>
                <div class="x-top-nav">

                    <!--clients-->
                    <a class="right-sidepanel-menu ajax-request" href="javascript:void(0);" id="starred-clients"
                        data-url="{{ url('/starred/view/clients?orderby=client_company_name&sortorder=asc') }}"
                        data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                        data-progress-bar='hidden'>@lang('lang.clients')</a>
                    <span class="x-spacer">|</span>

                    <!--projects-->
                    <a class="right-sidepanel-menu ajax-request" href="javascript:void(0);" id="starred-projects"
                        data-url="{{ url('/starred/view/projects?orderby=project_title&sortorder=asc') }}"
                        data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                        data-progress-bar='hidden'>@lang('lang.projects')</a>
                    <span class="x-spacer">|</span>

                    <!--tasks-->
                    <a class="right-sidepanel-menu ajax-request" href="javascript:void(0);" id="starred-tasks"
                        data-url="{{ url('/starred/view/tasks?orderby=task_title&sortorder=asc') }}"
                        data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                        data-progress-bar='hidden'>@lang('lang.tasks')</a>
                    <span class="x-spacer">|</span>

                    <!--project comments-->
                    <a class="right-sidepanel-menu ajax-request" id="starred-project-comment" href="javascript:void(0);"
                        data-url="{{ url('starred/view/project-comments?orderby=project_title&sortorder=asc') }}"
                        data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                        data-progress-bar='hidden'>@lang('lang.project_comments')</a>
                    <span class="x-spacer">|</span>

                    <!--notes-->
                    <a class="right-sidepanel-menu ajax-request" href="javascript:void(0);" id="starred-notes"
                        data-url="{{ url('/starred/view/notes?orderby=last_updated&sortorder=desc') }}"
                        data-loading-target="sidepanel-starred-container" data-target="sidepanel-starred-container"
                        data-progress-bar='hidden'>Notes</a>

                </div>
            </div>
            <!--title-->
            <!--body-->
            <div class="r-panel-body p-t-40" id="sidepanel-starred-body">
                <div class="message-center topnav-reminders-container" id="sidepanel-starred-container">
                    <!--dynamic content-->
                </div>
            </div>
            <!--body-->
        </div>
    </form>
</div>
<!--sidebar-->