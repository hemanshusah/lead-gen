<!--tasks table-->
<div class="table-responsive" id="tasks-table-wrapper">
    @if(@count($tasks) > 0)

    <table class="table table-hover no-wrap" id="tasks-list-table">
        <thead>
            <tr>
                <!--checkbox select all-->
                <th class="list-checkbox-wrapper p-l-5">
                    <span class="list-checkboxes display-inline-block w-px-20">
                        <input type="checkbox" id="select-all-tasks" name="select-all-tasks"
                            class="filled-in chk-col-light-blue">
                        <label for="select-all-tasks"></label>
                    </span>
                </th>
                <!--task title-->
                <th class="tasks_col_title">
                    @lang('lang.task')
                </th>
                <!--task status-->
                <th class="tasks_col_status">
                    @lang('lang.status')
                </th>
                <!--time logged-->
                <th class="tasks_col_time_logged">
                    @lang('lang.time_logged')
                </th>
                <!--billed time-->
                <th class="tasks_col_time_billed">
                    @lang('lang.billed_time')
                </th>
                <!--unbilled time-->
                <th class="tasks_col_time_unbilled">
                    @lang('lang.unbilled_time')
                </th>
                <!--date completed-->
                <th class="tasks_col_completed">
                    @lang('lang.date_completed')
                </th>
            </tr>
        </thead>
        <tbody id="tasks-list-table-body">
            @foreach($tasks as $task)
            <tr id="task_{{ $task->task_uniqueid }}" data-task-status="{{ $task->task_status }}"
                data-unbilled-time="{{ $task->timeUnbilled > 0 ? 'yes' : 'no' }}">
                <!--checkbox-->
                <td class="tasks_col_checkbox checkitem p-l-5">
                    <span class="list-checkboxes display-inline-block w-px-20">
                        <input type="checkbox" id="listcheckbox-tasks-{{ $task->task_id }}"
                            name="tasks[{{ $task->task_id }}]"
                            class="listcheckbox listcheckbox-tasks filled-in chk-col-light-blue tasks-checkbox"
                            data-task-id="{{ $task->task_id }}" data-unit="@lang('lang.task')" data-quantity="1"
                            data-unit-time="@lang('lang.time')" data-description="{{ $task->task_title }}"
                            data-rate="{{ $task->project->project_billing_rate ?? 0 }}" data-linked-type="task"
                            data-linked-id="{{ $task->task_id }}"
                            data-hours="{{ runtimeSecondsWholeHours($task->timeUnbilled) }}"
                            data-minutes="{{ runtimeSecondsWholeMinutes($task->timeUnbilled) }}"
                            data-timers-list="{{ $task->timeUnbilledTimers }}">
                        <label for="listcheckbox-tasks-{{ $task->task_id }}"></label>
                    </span>
                </td>
                <!--task title-->
                <td class="tasks_col_title">
                    {{ str_limit($task->task_title, 50) }}
                </td>
                <!--task status-->
                <td class="tasks_col_status">
                    <span
                        class="label label-{{ $task->status->taskstatus_color }} label-md">{{ runtimeLang($task->status->taskstatus_title) }}</span>
                </td>
                <!--time logged-->
                <td class="tasks_col_time_logged">
                    @if(runtimeSecondsWholeHours($task->timeLogged) > 0)
                    {{ runtimeSecondsWholeHours($task->timeLogged) }} @lang('lang.hrs') 
                    @endif        
                    {{ runtimeSecondsWholeMinutes($task->timeLogged) }} @lang('lang.mins') 
                </td>
                <!--billed time-->
                <td class="tasks_col_time_billed">
                    @if(runtimeSecondsWholeHours($task->timeBilled) > 0)
                    {{ runtimeSecondsWholeHours($task->timeBilled) }} @lang('lang.hrs') 
                    @endif        
                    {{ runtimeSecondsWholeMinutes($task->timeBilled) }} @lang('lang.mins') 
                </td>
                <!--unbilled time-->
                <td class="tasks_col_time_unbilled">
                    @if(runtimeSecondsWholeHours($task->timeUnbilled) > 0)
                    {{ runtimeSecondsWholeHours($task->timeUnbilled) }} @lang('lang.hrs') 
                    @endif        
                    {{ runtimeSecondsWholeMinutes($task->timeUnbilled) }} @lang('lang.mins') 
                </td>
                <!--date completed-->
                <td class="tasks_col_completed">
                    @if($task->task_status == 2)
                    {{ runtimeDate($task->task_date_status_changed) }}
                    @else
                    ---
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!--task filter dropdown-->
    <div class="row m-r-0">
        <div class="col-6">
            <div class="form-group row">
                <label
                    class="col-sm-12 text-left control-label col-form-label">@lang('lang.filter_tasks')</label>
                <div class="col-sm-12">
                    <select class="select2-basic form-control form-control-sm select2-preselected"
                        id="task_filter_dropdown" name="task_filter_dropdown" data-preselected="show_all">
                        <option></option>
                        <option value="show_all">@lang('lang.show_all_tasks')</option>
                        <option value="show_completed">@lang('lang.show_only_completed_tasks')</option>
                        <option value="show_all_unbilled">@lang('lang.show_all_tasks_with_unbilled_time')</option>
                        <option value="show_completed_unbilled">@lang('lang.show_completed_tasks_with_unbilled_time')
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!--add selected tasks buttons-->
    <div class="text-right p-t-20 p-b-20 p-r-20">
        <!--fixed billing button-->
        <button type="button" class="btn btn-info btn-sm" id="tasksModalSelectButton" data-dismiss="modal">
            @lang('lang.add_tasks_fixed_billing')
        </button>
        <!--time billing button-->
        <button type="button" class="btn btn-success btn-sm" id="tasksModalSelectTimeButton" data-dismiss="modal">
            @lang('lang.add_tasks_time_billing')
        </button>
    </div>
    @else
    <!--no results-->
    @include('notifications.no-results-found')
    @endif
</div>

<!--check all tasks script-->
<script>
    $(document).ready(function () {

        //reset select all checkbox
        $('#select-all-tasks').prop('checked', false);

        //select all tasks
        $('#select-all-tasks').on('click', function () {
            if ($(this).is(':checked')) {
                $('.tasks-checkbox:visible').prop('checked', true);
            } else {
                $('.tasks-checkbox').prop('checked', false);
            }
        });

        //if any individual checkbox is unchecked, uncheck the select all
        $('.tasks-checkbox').on('click', function () {
            if (!$(this).is(':checked')) {
                $('#select-all-tasks').prop('checked', false);
            }
        });

        //task filter dropdown
        $('#task_filter_dropdown').on('select2:select', function (e) {
            var selected_value = e.params.data.id;

            //show all rows first
            $('tr[data-task-status]').show();

            switch (selected_value) {
                case 'show_all':
                    //show all tasks (default)
                    $('tr[data-task-status]').show();
                    break;

                case 'show_completed':
                    //show only completed tasks
                    $('tr[data-task-status]').each(function () {
                        if ($(this).attr('data-task-status') != '2') {
                            $(this).hide();
                        }
                    });
                    break;

                case 'show_all_unbilled':
                    //show all tasks with unbilled time
                    $('tr[data-task-status]').each(function () {
                        if ($(this).attr('data-unbilled-time') != 'yes') {
                            $(this).hide();
                        }
                    });
                    break;

                case 'show_completed_unbilled':
                    //show completed tasks with unbilled time
                    $('tr[data-task-status]').each(function () {
                        if ($(this).attr('data-task-status') != '2' || $(this).attr(
                                'data-unbilled-time') != 'yes') {
                            $(this).hide();
                        }
                    });
                    break;
            }
        });
    });
</script>