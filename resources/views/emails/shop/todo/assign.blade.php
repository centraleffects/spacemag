@component('mail::message')
# Assigned to you: {{ $task->description }}

{{ $current_user_name }} assigned you for the task: 
{{ $task->description }}

@component('mail::button', ['url' => url('/shop/tasks/'.$task->id), 'color' => 'green'])
View Task
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
