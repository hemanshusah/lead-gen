<!--user-->
@foreach($assigned as $user)
<span class="x-assigned-user {{ runtimePermissions('task-assign-users', $task->permission_assign_users) }} card-task-assigned card-assigned-listed-user"
        tabindex="0" data-user-id="{{ $user->id }}" data-popover-content="card-task-team"
        data-title="{{ cleanLang(__('lang.assign_users')) }}">
        <span class="data-toggle-tooltip" title="{{ $user->first_name }} {{ $user->last_name }}">
                <img src="{{ getUsersAvatar($user->avatar_directory, $user->avatar_filename) }}"
                        alt="{{ $user->first_name }}" class="img-circle avatar-xsmall"
                        data-original-title="{{ $user->first_name }}">
        </span>
</span>
@endforeach