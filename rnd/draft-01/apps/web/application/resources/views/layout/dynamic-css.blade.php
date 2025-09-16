<!-- This file must NOT be formatted -->
<style>
    :root {
        --calendar-type-event-background: {{ config('system.settings2_calendar_events_colour') }};

        --calendar-type-project-background: {{ config('system.settings2_calendar_projects_colour') }};

        --calendar-type-task-background: {{ config('system.settings2_calendar_tasks_colour') }};

        --calendar-fc-daygrid-dot-event-background: {{ config('system.settings2_calendar_events_colour') }};
        
        --calendar-fc-daygrid-dot-event-contrast: color-mix(in srgb, var(--calendar-fc-daygrid-dot-event-background) 70%, black);
    }
</style>

