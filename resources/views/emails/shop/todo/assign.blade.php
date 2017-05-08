@component('mail::message')
# Assigned to you: {{ $task->description }}

{{ ucfirst($user->first_name).' '.ucfirst($user->last_name) }} assigned you for the task: 
{{ $task->description }}

@component('mail::button', ['url' => url('/shop/tasks', 'color' => 'green')])
View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
