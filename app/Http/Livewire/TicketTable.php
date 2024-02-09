<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Ticket;

class TicketTable extends DataTableComponent
{
    protected $model = Ticket::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['tickets.id as id'])
            ->setTableRowUrl(function($row) {
                return route('ticket.show', $row);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Ticket ID", "number")
                ->sortable()
                ->searchable(),
            Column::make("Subject", "subject")
                ->sortable()
                ->searchable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Priority", "priority")
                ->sortable(),
            Column::make("Created by", "user.name")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
        ];
    }

    public function builder(): Builder
    {
        if (auth()->user()->isUser()) {
            return Ticket::query()->where('user_id', auth()->id());
        }

        return Ticket::query();
    }
}
