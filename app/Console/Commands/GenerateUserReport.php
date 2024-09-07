<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class GenerateUserReport extends Command
{
    protected $signature = 'report:generate-users';
    protected $description = 'Generate a CSV report of new users registered in the last 7 days and send it via email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::where('created_at', '>=', Carbon::now()->subDays(7))->get();

        if ($users->isEmpty()) {
            $this->info('No new users registered in the last 7 days.');
            return;
        }

        $fileName = 'user_report_' . now()->format('Ymd_His') . '.csv';
        $filePath = storage_path('app/reports/' . $fileName);

        // Ensure the directory exists
        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }

        // Open a file for writing
        $file = fopen($filePath, 'w');

        // Add the CSV header
        fputcsv($file, ['ID', 'Name', 'Email', 'Created At']);

        foreach ($users as $user) {
            fputcsv($file, [$user->id, $user->name, $user->email, $user->created_at]);
        }

        fclose($file);

        $this->sendEmail($filePath);
        $this->info('User report generated and emailed successfully.');
    }

    protected function sendEmail($filePath)
    {
        $adminEmail = 'info@waliiftransport.com';

        $data = [
            'subject' => 'Weekly User Report',
            'body' => 'Please find attached the CSV report of users registered in the last 7 days.'
        ];

        Mail::send([], $data, function ($message) use ($adminEmail, $filePath) {
            $message->to($adminEmail)
                    ->subject('Weekly User Report')
                    ->attach($filePath, [
                        'as' => 'user_report.csv',
                        'mime' => 'text/csv',
                    ]);
        });
    }
}


