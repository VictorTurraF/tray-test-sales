<?php

namespace App\Mail;

use App\DTOs\SellerReportDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailySalesReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected SellerReportDTO $sellerReport
    )
    {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('victor.t.florencio@gmail.com', 'Victor Turra'),
            subject: 'Relátorio de vendas diário (Vendedor)',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.seller-report',
            with: [
                'date' => $this->sellerReport->date,
                'sellerName' => $this->sellerReport->sellerName,
                'totalSales' => $this->formatCurrency($this->sellerReport->totalSales),
                'totalCommissions' => $this->formatCurrency($this->sellerReport->totalCommissions),
            ]
        );
    }

    private function formatCurrency($value)
    {
        return 'R$' . number_format($value / 100, 2);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
