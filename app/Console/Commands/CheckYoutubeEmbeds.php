<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Video;
use Illuminate\Support\Str;

class CheckYoutubeEmbeds extends Command
{
    protected $signature = 'check:youtube-embeds';
    protected $description = 'Scan videos table and report YouTube embed URLs';

    public function handle()
    {
        $this->info('🔍 Checking videos in the database...');

        $videos = Video::all();

        if ($videos->isEmpty()) {
            $this->warn('No videos found in the database.');
            return;
        }

        foreach ($videos as $video) {
            $originalUrl = $video->video_url;
            $youtubeId = $this->extractYoutubeId($originalUrl);
            $embedUrl = $youtubeId ? "https://www.youtube.com/embed/{$youtubeId}" : '❗ Invalid YouTube ID';

            $this->line("------------");
            $this->line("ID: {$video->id}");
            $this->line("Title: {$video->title}");
            $this->line("Original URL: {$originalUrl}");
            $this->line("Extracted ID: {$youtubeId}");
            $this->line("Embed URL: {$embedUrl}");

            if (!$youtubeId) {
                $this->error('❗ Warning: Failed to extract a valid YouTube ID.');
            }
        }

        $this->info('✅ Finished checking all videos.');
    }

    private function extractYoutubeId($url)
    {
        if (Str::contains($url, 'youtu.be/')) {
            $id = Str::after($url, 'youtu.be/');
        } elseif (Str::contains($url, 'watch?v=')) {
            $id = Str::after($url, 'v=');
        } else {
            return null;
        }

        // Strip off any query parameters like ?si=...
        return Str::before($id, '?');
    }
}
