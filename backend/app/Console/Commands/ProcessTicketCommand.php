<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Ticket;

class ProcessTicketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process a single ticket every five minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ticket = Ticket::where('status', false)->orderBy('created_at')->first();

        if ($ticket) {
            $ticket->status = true;
            $ticket->save();
            $this->info('Ticket processed successfully.');
        } else {
            $this->info('No unprocessed tickets found.');
        }
    }
}
