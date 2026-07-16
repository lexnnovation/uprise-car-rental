<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class DiagnosePostMedia extends Command
{
    protected $signature = 'diagnose:post {slug}';

    protected $description = 'Check whether a blog post\'s featured image and conversions actually exist on disk.';

    public function handle(): int
    {
        $post = Post::where('slug', $this->argument('slug'))->first();

        if (! $post) {
            $this->error('No post found with that slug.');

            return self::FAILURE;
        }

        $this->info("Post: {$post->title}");
        $this->line('Has featured media: ' . ($post->hasMedia('featured') ? 'yes' : 'no'));

        if (! $post->hasMedia('featured')) {
            return self::SUCCESS;
        }

        $media = $post->getFirstMedia('featured');
        $this->line('Original file: ' . $media->getPath());
        $this->line('Original exists on disk: ' . (file_exists($media->getPath()) ? 'yes' : 'no'));
        $this->line('Card conversion exists: ' . (file_exists($media->getPath('card')) ? 'yes' : 'no'));
        $this->line('Hero conversion exists: ' . (file_exists($media->getPath('hero')) ? 'yes' : 'no'));
        $this->line('Card URL: ' . $post->getFirstMediaUrl('featured', 'card'));
        $this->line('Hero URL: ' . $post->getFirstMediaUrl('featured', 'hero'));

        $this->newLine();
        preg_match_all('/<img[^>]+src="([^"]+)"/', $post->body, $matches);
        $this->line('Inline <img> tags found in body: ' . count($matches[1]));
        foreach ($matches[1] as $src) {
            $this->line('  - ' . $src);
        }

        $this->newLine();
        $this->line('--- Raw body ---');
        $this->line($post->body);

        return self::SUCCESS;
    }
}
