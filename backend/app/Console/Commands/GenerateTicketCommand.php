<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Ticket;
use App\Models\User;

class GenerateTicketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a ticket with dummy data every minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ticket = new Ticket();
        $ticket->subject = fake()->words(2, true);
        $ticket->content = fake()->sentence();
        $ticket->user_id = User::inRandomOrder()->first()->id;
        $ticket->status = false; // Set the ticket status to false
        $ticket->save();

        $this->info('Ticket generated successfully.');
    }
}
