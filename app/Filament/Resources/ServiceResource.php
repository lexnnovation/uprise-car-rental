<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
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
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make()->tabs([
                Tabs\Tab::make('Details')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(100)
                            ->live(debounce: 500)
                            ->afterStateUpdated(function (string $operation, ?string $state, Set $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', Str::slug($state ?? ''));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(120)
                            ->unique(Service::class, 'slug', ignoreRecord: true),
                    ]),
                    Textarea::make('short_description')
                        ->rows(3)
                        ->maxLength(300)
                        ->helperText('Shown on listing cards — keep under 300 chars.')
                        ->columnSpanFull(),
                    Grid::make(3)->schema([
                        TextInput::make('icon')
                            ->placeholder('e.g. paper-airplane')
                            ->helperText('Heroicons v2 outline name'),
                        TextInput::make('sort_order')->numeric()->default(0),
                        Toggle::make('is_active')->default(true)->inline(false),
                    ]),
                ]),

                Tabs\Tab::make('Content')->schema([
                    RichEditor::make('description')
                        ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList', 'h2', 'h3', 'blockquote', 'undo', 'redo'])
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
                        ->label('Hero image')
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
                TextColumn::make('icon'),
                TextColumn::make('inquiries_count')
                    ->label('Inquiries')
                    ->counts('inquiries')
                    ->sortable(),
                ToggleColumn::make('is_active')->label('Active'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
