<?php

namespace App\Filament\Resources;

use App\Enums\InquirySource;
use App\Enums\InquiryStatus;
use App\Filament\Resources\InquiryResource\Pages;
use App\Models\Inquiry;
use App\Models\Service;
use App\Models\Vehicle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?string $navigationGroup = 'Leads';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static ?string $pluralModelLabel = 'Inquiries';

    public static function getNavigationBadge(): ?string
    {
        return (string) Inquiry::where('status', InquiryStatus::New_->value)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string
    {
        return 'info';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Contact')->schema([
                Grid::make(3)->schema([
                    TextInput::make('full_name')->disabled(),
                    TextInput::make('email')->disabled(),
                    TextInput::make('phone')->disabled(),
                ]),
            ]),

            Section::make('Trip Details')->schema([
                Grid::make(2)->schema([
                    TextInput::make('pickup_location')->disabled(),
                    TextInput::make('destination')->disabled(),
                ]),
                Grid::make(3)->schema([
                    DatePicker::make('travel_date_start')->disabled(),
                    DatePicker::make('travel_date_end')->disabled(),
                    TextInput::make('passenger_count')->disabled(),
                ]),
                Grid::make(2)->schema([
                    Select::make('vehicle_id')
                        ->label('Vehicle')
                        ->options(fn () => Vehicle::orderBy('name')->pluck('name', 'id'))
                        ->disabled()
                        ->placeholder('—'),
                    Select::make('service_id')
                        ->label('Service')
                        ->options(fn () => Service::orderBy('name')->pluck('name', 'id'))
                        ->disabled()
                        ->placeholder('—'),
                ]),
            ]),

            Section::make('Management')->schema([
                Grid::make(2)->schema([
                    Select::make('status')
                        ->options(InquiryStatus::options())
                        ->required(),
                    Select::make('source')
                        ->options(InquirySource::options())
                        ->disabled(),
                ]),
                Textarea::make('notes')->rows(4)->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Received')->since()->sortable(),
                TextColumn::make('full_name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->toggleable(),
                TextColumn::make('phone')->searchable()->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (InquiryStatus $state) => $state->color()),
                TextColumn::make('source')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn (InquirySource $state) => $state->label()),
                TextColumn::make('vehicle.name')->label('Vehicle')->toggleable(),
                TextColumn::make('service.name')->label('Service')->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options(InquiryStatus::options()),
                SelectFilter::make('source')->options(InquirySource::options()),
            ])
            ->actions([EditAction::make()->label('Manage')])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInquiries::route('/'),
            'edit'  => Pages\EditInquiry::route('/{record}/edit'),
        ];
    }
}
