<?php

namespace App\Filament\Resources;

use App\Enums\VehicleStatus;
use App\Filament\Resources\VehicleResource\Pages;
use App\Models\Feature;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Fleet';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make()->tabs([

                Tabs\Tab::make('Basic')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(120)
                            ->live(debounce: 500)
                            ->afterStateUpdated(function (string $operation, ?string $state, Set $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', Str::slug($state ?? ''));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(140)
                            ->unique(Vehicle::class, 'slug', ignoreRecord: true),
                    ]),
                    Grid::make(2)->schema([
                        Select::make('vehicle_category_id')
                            ->label('Category')
                            ->options(fn () => VehicleCategory::ordered()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('status')
                            ->options(VehicleStatus::options())
                            ->default(VehicleStatus::Available->value)
                            ->required(),
                    ]),
                    Grid::make(4)->schema([
                        TextInput::make('passenger_count')->label('Passengers')->numeric()->default(4)->required(),
                        TextInput::make('luggage_count')->label('Luggage')->numeric()->default(2)->required(),
                        TextInput::make('sort_order')->numeric()->default(0),
                        Toggle::make('is_featured')->inline(false),
                    ]),
                    DateTimePicker::make('published_at')->label('Publish at')->native(false),
                ]),

                Tabs\Tab::make('Content')->schema([
                    Textarea::make('short_description')
                        ->rows(3)
                        ->maxLength(300)
                        ->helperText('Shown on listing cards — keep under 300 chars.')
                        ->columnSpanFull(),
                    RichEditor::make('description')
                        ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList', 'h2', 'h3', 'blockquote', 'undo', 'redo'])
                        ->columnSpanFull(),
                    Select::make('features')
                        ->relationship('features', 'name')
                        ->multiple()
                        ->preload()
                        ->label('Amenities & Features')
                        ->columnSpanFull(),
                ]),

                Tabs\Tab::make('SEO')->schema([
                    TextInput::make('meta_title')
                        ->maxLength(160)
                        ->helperText('Ideal: 50–60 characters')
                        ->columnSpanFull(),
                    Textarea::make('meta_description')
                        ->rows(3)
                        ->maxLength(320)
                        ->helperText('Ideal: 150–160 characters')
                        ->columnSpanFull(),
                ]),

                Tabs\Tab::make('Images')->schema([
                    SpatieMediaLibraryFileUpload::make('hero')
                        ->collection('hero')
                        ->image()
                        ->imageEditor()
                        ->responsiveImages()
                        ->label('Hero image (single)')
                        ->columnSpanFull(),
                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->collection('gallery')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->label('Gallery')
                        ->columnSpanFull(),
                ]),

            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable()->width(50),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Category')->sortable()->badge()->color('gray'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (VehicleStatus $state) => match ($state) {
                        VehicleStatus::Available  => 'success',
                        VehicleStatus::Unavailable => 'danger',
                        VehicleStatus::ComingSoon => 'warning',
                    })
                    ->formatStateUsing(fn (VehicleStatus $state) => $state->label()),
                TextColumn::make('passenger_count')->label('Pax')->sortable(),
                ToggleColumn::make('is_featured')->label('Featured'),
                TextColumn::make('published_at')->label('Published')->since()->sortable()->toggleable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                SelectFilter::make('vehicle_category_id')
                    ->label('Category')
                    ->options(fn () => VehicleCategory::ordered()->pluck('name', 'id')),
                SelectFilter::make('status')->options(VehicleStatus::options()),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit'   => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
