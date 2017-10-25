<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class ClientsPage extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/clients';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@create-client' => '.create-client'
        ];
    }

    /**
     * Create a new client
     *
     * @param Browser $browser
     * @param $attributes
     */
    public function createClient(Browser $browser, $attributes)
    {
        $browser->click('@create-client')
            ->whenAvailable('#modal-create-client', function ($modal) use ($attributes) {
                $modal->type('title', $attributes['title'])
                    ->type('email', $attributes['email'])
                    ->type('address_1', $attributes['address_1'])
                    ->type('address_2', $attributes['address_2'])
                    ->type('city', $attributes['city'])
                    ->type('state', $attributes['state'])
                    ->type('zip', $attributes['zip'])
                    ->type('phone', $attributes['phone'])
                    ->press('Save')
                    ->click('.uk-modal-close');
            });
    }
}
