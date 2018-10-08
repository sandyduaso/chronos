@component('mail::main')
# Verify Email

Your order has been shipped

@component('mail::panel')
Oh yeah!!
@endcomponent
@component('mail::button', ['url' => 'ad'])
View Order
@endcomponent

@component('mail::table')
| Email              | Full Name             | Balance |
| ------------------ |:---------------------:| -------:|
| {{ $user->email }} | {{ $user->fullname }} | PHP1000 |
@endcomponent

@endcomponent
