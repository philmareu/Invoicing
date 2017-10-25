<?php

namespace Tests\Browser;

use Invoicing\User;
use Tests\Browser\Pages\DashboardPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function dashboard_page_loads()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(factory(User::class)->create())
                ->visit(new DashboardPage)
                ->assertVisible('test');
        });
    }
}
