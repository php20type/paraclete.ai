<x-mail::message>
{!! $email->message !!}


<x-mail::panel>
# Total Available Words: @if ($words == -1) {{ __('Unlimited') }} @else {{ $words }} @endif
</x-mail::panel>

<x-mail::panel>
# Total Available Minutes: @if ($minutes == -1) {{ __('Unlimited') }} @else {{ $minutes }} @endif
</x-mail::panel>

<x-mail::panel>
# Total Available Characters: @if ($chars == -1) {{ __('Unlimited') }} @else {{ $chars }} @endif 
</x-mail::panel>

<x-mail::panel>
# Total Available Image Credits: @if ($images == -1) {{ __('Unlimited') }} @else {{ $images }} @endif
</x-mail::panel>




{!! $email->footer !!}
</x-mail::message>
