<?php

namespace MedanWeb\Tools\Filament\Filters;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Str;

class DateRangeFilter extends Filter
{
    protected string $rangeColumn;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rangeColumn = $this->name;

        $this->label = Str::headline($this->name);

        $this->form([
            Grid::make()
                ->schema([
                    DatePicker::make('range_from')
                        ->label(fn() => $this->label . " From")
                        ->native(false)
                        ->displayFormat('d F Y')
                        ->afterStateUpdated(function (Set $set, $state) {
                            if (blank($state)) {
                                $set('range_to', null);
                            }
                        }),

                    DatePicker::make('range_to')
                        ->label(fn () => $this->label . " To")
                        ->native(false)
                        ->displayFormat('d F Y')
                        ->hidden(fn (Get $get) => blank($get('range_from')))
                        ->after('range_from')
                        ->afterStateUpdated(function (Get $get, Set $set, $state) {
                            $rangeFrom = Carbon::make($get('range_from'));
                            $rangeTo = Carbon::make($state);

                            if ($rangeTo && $rangeTo->lt($rangeFrom)) {
                                $set('range_to', null);
                            }
                        }),
                ])
        ])
        ->columnSpanFull();

        $this->query(function ($query, $data) {
            return $query
                ->when(
                    $data['range_from'],
                    fn ($query, $joinFrom) => $query->whereDate($this->getRangeColumn(), '>=', $joinFrom)
                )
                ->when(
                    $data['range_to'],
                    fn ($query, $joinUntil) => $query->whereDate($this->getRangeColumn(), '<=', $joinUntil)
                );
        });

        $this->indicateUsing(function ($data) {
            if ($this->isEmptyDateRange($data['range_from'], $data['range_to'])) return null;

            $indicator = $this->getIndicator() . ":";

            if (! blank($data['range_from'])) $indicator .= " " . Carbon::make($data['range_from'])->format('d F Y');

            if (! blank($data['range_to'])) $indicator .= " ~ " . Carbon::make($data['range_to'])->format('d F Y');

            return $indicator;
        });
    }

    public function setRangeColumn(string $column): static
    {
        $this->rangeColumn = $column;

        return $this;
    }

    public function getRangeColumn(): string
    {
        return $this->rangeColumn;
    }

    private function isEmptyDateRange($rangeFrom, $rangeTo): bool
    {
        return (blank($rangeFrom) && blank($rangeTo));
    }
}
