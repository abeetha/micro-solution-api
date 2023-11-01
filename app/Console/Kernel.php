<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Device;
use App\Http\Controllers\mailController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {

            $startDate = Carbon::now()->format('Y-m-d');
            $devices = Device::all();

            foreach ($devices as $device) {
                $date = $device->ms_support_endDate;
                $carbonDate = Carbon::createFromFormat('Y-m-d', $date);
                $endDate = $carbonDate->subMonth(1)->format('Y-m-d');
                if ($endDate == $startDate) {
                    $customerDetails = DB::table('customer')
                        ->join('orders', 'customer.cust_id', '=', 'orders.cust_id')
                        ->join('devices', 'orders.order_id', '=', 'devices.order_id')
                        ->select('customer.email')
                        ->get();

                    $emailAddress = $customerDetails;
                    $mail = new mailController();
                    $mail->sendMail($emailAddress);
                    sleep(1);
                }
            }
        })->daily();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
