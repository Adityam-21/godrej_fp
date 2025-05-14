<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $contacts = [
            [
                'title' => 'Whatsapp Number',
                'text' => '+91 12 3678 8990',
                'link' => 'https://wa.me/912368890',
                'icon' => 'assets/images/whatsapp.svg',
            ],
            [
                'title' => 'Call Number',
                'text' => '+91 12 3678 8990',
                'link' => 'tel:+912368890',
                'icon' => 'assets/images/calling.svg',
            ],
            [
                'title' => 'SMS Number',
                'text' => '+91 12 3678 8990',
                'link' => 'sms:+912368890',
                'icon' => 'assets/images/message.svg',
            ],
            [
                'title' => 'Email',
                'text' => 'client.services@godrejinds.com',
                'link' => 'mailto:client.services@godrejinds.com',
                'icon' => 'assets/images/email.svg',
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
