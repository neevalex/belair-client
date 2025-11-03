<?php

namespace App\Filament\Resources\Invoices\Schemas;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //select
                Select::make('user_id')
                    ->label('Client')
                    ->relationship('user', 'name')
                    ->required(),
                
                TextInput::make('number')
                    ->label('Invoice Number')
                    ->required()
                    ->unique(ignorable: fn ($record) => $record),
                DatePicker::make('date')
                    ->label('Date')
                    ->required(),
                TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->numeric()
                    ->minValue(0),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'overdue' => 'Overdue',
                    ])
                    ->required(),
                Select::make('type')
                    ->label('Type')
                    ->options([
                        'client' => 'Client',
                        'commission' => 'Commission',
                    ])
                    ->required(),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->nullable(),
            ]);
    }
}
