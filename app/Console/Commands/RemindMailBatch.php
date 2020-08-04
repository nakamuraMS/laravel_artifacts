<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Models\RemindMail;
use App\Mail\sendRemindMail;

class RemindMailBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remind_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '送信日時に合致するメールを送信する';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now        = Carbon::now();
        // $RemindMail = RemindMail::query()->where('datetime', "2020-08-04 17:25")->get();
        
        $RemindMail = RemindMail::query()->where('datetime', $now->format('Y-m-d H:i'))->get();
dd(!empty($RemindMail));
        if ($RemindMail) {
            Mail::send(new sendRemindMail($RemindMail));
            \Log::info('送信完了');
        } else {
            \Log::info('送信対象メールなし');
        }
    }
}
