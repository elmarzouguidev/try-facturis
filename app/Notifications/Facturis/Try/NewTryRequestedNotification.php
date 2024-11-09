<?php

namespace App\Notifications\Facturis\Try;

use App\Models\Facturis\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class NewTryRequestedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $client;

    /**
     * @return void
     */
    public function __construct(
        Client $client,
    ) {
        $this->client = $client;
    }

    /**
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from(config('try.from.email'), 'Facturis APP')
            ->greeting("Bonjour $notifiable->name")
            ->subject(Lang::get("Nouvelle Demande d'essai FACTURIS"))
            ->line(Lang::get('Les détails de la demande :'))
            ->line('***********************************************************')
            ->line(Lang::get('Nom complet : ' . $this->client->full_name))
            ->line(Lang::get('E-mail : ' . $this->client->email))
            ->line(Lang::get('Téléphone : ' . $this->client->telephone))
            ->line(Lang::get('Pay : ' . $this->client->country?->name))
            ->line(Lang::get('Ville : ' . $this->client->city))
            ->line(Lang::get('Adresse : ' . $this->client->address))
            ->line(Lang::get("Nom de l'entreprise : " . $this->client->business_name))
            ->line($this->client->ice ? Lang::get('I.C.E : ' . $this->client->ice) : '')
            ->line($this->client->website ? Lang::get('Site web : ' . $this->client->website) : '')
            ->line('***********************************************************')
            ->line($this->client->plan?->name ? Lang::get('Pack : ' . $this->client->plan?->name) : '');
    }

    /**
     * @param  mixed  $notifiable
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
