@if(session()->has('flash_message'))

<?php $flash_message = session()->get('flash_message'); ?>

    @component('layouts._partials.alert')
        @slot('alert_type') 
            {{ $flash_message['type'] }}
        @endslot

        @if( is_array($flash_message) && isset($flash_message['is_important']) !== null )
            @slot('is_important') alert-important @endslot
        @endif

        @if( is_array($flash_message) && isset($flash_message['custom_class']) !== null )
            @slot('custom_class') session->get('flash_message')['custom_class'] @endslot
        @endif
        
        {{ $flash_message['msg'] }}
    @endcomponent
@endif