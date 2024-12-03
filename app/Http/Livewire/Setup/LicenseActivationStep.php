<?php

namespace App\Http\Livewire\Setup;

use App\Settings\GeneralSetting;
use Spatie\LivewireWizard\Components\StepComponent;

class LicenseActivationStep extends StepComponent
{
    public $item_id = '38755184';

    public $state = [
        'license_key' => 'pqtbg-h81w6-pm2r3-ck0tz-o436d-rke82-er5wi',
        'license_user' => 'tom-jerry',
        'license_vendor' => 'Envato',
        'license_active' => false,
    ];

    public function mount()
    {
        $this->state['license_key'] = $this->general_settings->license_key;

        $this->state['license_user'] = $this->general_settings->license_user;

        $this->state['license_vendor'] = $this->general_settings->license_vendor;

        $this->state['license_active'] = $this->general_settings->license_active;
    }

    public function skip()
    {
        $this->nextStep();
    }

    public function save()
    {
        $this->general_settings->license_key = $this->state['license_key'];

        $this->general_settings->license_vendor = $this->state['license_vendor'];

        $this->general_settings->license_active = true;

        $this->general_settings->save();

        $this->nextStep();
    }

    public function getGeneralSettingsProperty()
    {
        return app(GeneralSetting::class);
    }

    public function render()
    {
        return view('livewire.setup.license-activation-step');
    }
}
