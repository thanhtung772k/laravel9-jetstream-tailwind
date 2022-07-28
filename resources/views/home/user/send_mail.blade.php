@component('mail::message')
# Introduction

Dear <span style="font-weight: 700">{{$details['name']}}</span>

We have reviewed your information. Here is the password for the account <span style="font-weight: 700">{{$details['email']}}</span>

Please do not share your password with anyone: <span style="font-weight: 700">{{$details['random']}}</span>

@component('mail::button', ['url' => route('dashboard'),'color' => 'green'])
Click here
@endcomponent

Thanks,<br>
Tung dz
@endcomponent
