<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Payment;

class UserShowPayment extends DataTableComponent
{
    protected $model = Payment::class;

    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Invoice", "invoice")
                ->sortable()
                ->searchable(),
            Column::make("User", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Package", "billing.package_name")
                ->sortable()
                ->searchable(),
            Column::make("Price" . __(' (') . config('app.currency') . __(')'), "billing.package_price")
                ->sortable()
                ->searchable(),
            Column::make("Method", "payment_method")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
        ];
    }

    public function builder(): Builder
    {
        return Payment::query()->where('user_id', $this->user);
    }
}
