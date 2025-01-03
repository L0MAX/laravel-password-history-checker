<?php

namespace L0MAX\PasswordHistoryChecker;

use Illuminate\Support\ServiceProvider;

class PasswordHistoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish migration
        $this->publishes([
            __DIR__ . '/../migrations/password_history_migration.php' => database_path('migrations/' . date('Y_m_d_His') . '_create_password_histories_table.php'),
        ], 'migrations');
    }

    public function register()
    {
        // Register any necessary bindings
    }
}
