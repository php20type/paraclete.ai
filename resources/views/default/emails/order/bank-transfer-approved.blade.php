<x-mail::message>

Thank you for subscribing to our subscription/prepaid plans at {{ config('app.name') }}.  

We are glad to confirm you that your payment has been successfully processed. 

Credits have been already applied to your account and you are ready to get started. 

<a href="{{ config('app.url') }}">Visit {{ config('app.name') }}</a>

In case if you will have any questions, do not hesitate to contact us as any time. 


Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
