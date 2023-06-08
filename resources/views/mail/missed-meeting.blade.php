<x-mail::message>

# Hi Simran, it's {{ auth()->check() ? auth()->user()->name : 'me' }}.

## Looks like you bailed on, yet another, meeting!  Here is your punishment quote from Quan...

<div style="text-align: center;">
<img src="{{ url('/img/quan.png') }}" style="max-width: 300px; margin-top: 10px; margin-bottom: 20px; margin-left: auto; margin-right: auto;">
</div>

# "{{ $quote }}"

~Pretend Quan

<x-mail::button :url="url('shame-log')" :color="'success'">
Visit the Shame Log
</x-mail::button>

Please stop cancelling meetings, Simran
</x-mail::message>
