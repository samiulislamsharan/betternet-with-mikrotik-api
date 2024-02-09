<?php

namespace App\Http\Livewire;


use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;


class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['users.id as id'])
            ->setTableRowUrl(function($row) {
                return route('users.show', $row);
            });;
        $this->setEagerLoadAllRelationsEnabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->sortable()
            ->searchable(),
            Column::make("Email", "email")
                ->sortable()
            ->searchable(),
            Column::make("Package", "detail.package_name")
                ->sortable()
            ->searchable(),
            Column::make("Started", "detail.package_start")
                ->sortable()
                ->searchable(),
            Column::make("Status", "detail.status")
                ->sortable(),
            Column::make("Due" . __(' (') . config('app.currency') . __(')'))
                ->sortable()
                ->label(function ($row){
                    return $row->due_amount($row->id);
                }),
            Column::make("Member Since", "created_at")
                ->format(function ($value) {
                    return Carbon::parse($value)->format('Y-m-d');
                }),
        ];
    }

    public function builder(): Builder
    {
        return User::query()->where('role', 'user')->select();
    }
}
