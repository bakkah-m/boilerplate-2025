<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
use Laravel\Octane\Facades\Octane;

class TransactionWrapper
{
    /**
     * Run a database transaction safely in Octane.
     *
     * @param callable $callback The DB operations
     * @param string $successMessage Success toast message
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function run(callable $callback, string $successMessage = 'Operation successful')
    {
        try {
            DB::transaction(function () use ($callback) {
                $callback();
            });

            Alert::toast($successMessage, 'success');
            return redirect()->back();
        } catch (Exception $e) {
            // Ensure connection is reset in Octane to prevent lingering transactions
            DB::rollBack(); // extra safety, in case transaction is open
            DB::disconnect(); 

            Alert::error('Error', 'Messages: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
