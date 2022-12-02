<x-mail::message>
# Hi Simran, it's {{ auth()->check() ? auth()->user()->name : 'me' }}.

## Looks like you bailed on, yet another, meeting!  Here is your punishment quote from Quan...

<img src="{{ url('/img/quan.png') }}" style="max-width: 300px; margin-top: 10px; margin-bottom: 20px;">

# "{{ $quote }}"

~Pretend Quan

<x-mail::button :url="'https://www.simranhatesmeetings.com/shame-log'" :color="'success'">
Visit the Shame Log
</x-mail::button>

Please stop cancelling meetings, Simran
</x-mail::message>
