<?php declare(strict_types = 1);
return [
    'fields' => [
        'adresse'=> 'Address',
        'names'=>"First & Last names",
        'first_name'=>'First name',
        'last_name'=>'Last name',
        'message'=>'Message',
        'subject'=>'Subject',
        'subject_ext'=>'Subject of your inquiry',
        'city'=>'Locality',
        'region'=>'Region',
        'zip'=>'Postal code',
        'country'=>'Country',
        'phone'=>"Phone number",
        'company'=>"Company",
        'function'=>"Corporate function",
    ],
    'buttons'=> [
        'send'=>'Send',
        'save'=>'Save'
    ],
    'validation_messages'=> [
        'email_required'=>"The e-mail address is mandatory",
        'email_format'=>"The e-mail address is not a valid one",
        'message_required'=>"Please enter your message",
        'last_name_required'=>'Please enter your last name',
        'first_name_required'=>'Please enter your first name',
        'subject_required'=>"Please enter the subject of your demand",
        'zip_required'=>"Please enter your postal code",
    ],
    'coords'=>'Contact info',
    'confirmation'=>"Thank you ! Your message has been sent.",
    'required'=>'Requis',
    'choose'=>'Choose',
    'optionChoose'=>'--- choose ---',
    'select_file'=>'Select file ...'
];
