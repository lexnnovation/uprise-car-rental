<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make()->tabs([

                Tabs\Tab::make('Basic')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(160)
                            ->live(debounce: 500)
                            ->afterStateUpdated(function (string $operation, ?string $state, Set $set) {
                                if ($operation !== 'create') {
                                    return;
                                }
                                $set('slug', Str::slug($state ?? ''));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(180)
                            ->unique(Post::class, 'slug', ignoreRecord: true),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('author_name')->maxLength(120),
                        TextInput::make('author_role')->maxLength(120),
                    ]),
                    Grid::make(2)->schema([
                        DateTimePicker::make('published_at')->label('Publish at')->native(false),
                        Toggle::make('is_featured')->inline(false),
                    ]),
                ]),

                Tabs\Tab::make('Content')->schema([
                    Textarea::make('excerpt')
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('Shown on listing cards and used as a fallback meta description — keep under 500 chars.')
                        ->columnSpanFull(),
                    RichEditor::make('body')
                        ->required()
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
                    SpatieMediaLibraryFileUpload::make('featured')
                        ->collection('featured')
                        ->image()
                        ->imageEditor()
                        ->responsiveImages()
                        ->label('Featured image')
                        ->helperText('Used as the post hero and card thumbnail.')
                        ->columnSpanFull(),
                    SpatieMediaLibraryFileUpload::make('og')
                        ->collection('og')
                        ->image()
                        ->label('Social share image (optional)')
                        ->helperText('Falls back to the featured image if left empty.')
                        ->columnSpanFull(),
                ]),

            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('author_name')->label('Author')->toggleable(),
                ToggleColumn::make('is_featured')->label('Featured'),
                TextColumn::make('published_at')->label('Published')->since()->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
