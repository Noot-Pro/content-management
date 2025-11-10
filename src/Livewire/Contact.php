<?php

namespace NootPro\ContentManagement\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Contact extends Component
{
    public $name = '';

    public $email = '';

    public $phone = '';

    public $subject = '';

    public $message = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
    ];

    protected $messages = [
        'name.required' => 'الاسم مطلوب',
        'name.min' => 'الاسم يجب أن يكون على الأقل 3 أحرف',
        'email.required' => 'البريد الإلكتروني مطلوب',
        'email.email' => 'البريد الإلكتروني غير صحيح',
        'subject.required' => 'الموضوع مطلوب',
        'subject.min' => 'الموضوع يجب أن يكون على الأقل 5 أحرف',
        'message.required' => 'الرسالة مطلوبة',
        'message.min' => 'الرسالة يجب أن تكون على الأقل 10 أحرف',
    ];

    public function submit()
    {
        $this->validate();

        // Here you can add logic to send email or save to database
        // For now, we'll just show a success message
        session()->flash('message', 'تم إرسال رسالتك بنجاح! سنتواصل معك قريبًا.');

        // Reset form
        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
    }

    public function render(): View
    {
        seo()
            ->site(config('zeus.site_title', 'Laravel'))
            ->title(__('Contact Us') . ' - ' . config('zeus.site_title', 'Laravel'))
            ->description(__('Contact Us') . ' - ' . config('zeus.site_description', '') . ' ' . config('zeus.site_title', 'Laravel'))
            ->rawTag('favicon', '<link rel="icon" type="image/x-icon" href="' . asset('favicon/favicon.ico') . '">')
            ->rawTag('<meta name="theme-color" content="' . config('zeus.site_color') . '" />')
            ->withUrl()
            ->twitter();

        return view(app('themePath') . '.contact')
            ->layout(config('noot-pro-content-management.layout'));
    }
}
