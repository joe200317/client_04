<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Book;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\UpcomingEvent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@mindtrainer.in'],
            [
                'name' => 'Mind Trainer Admin',
                'password' => 'password',
                'is_admin' => true,
            ],
        );

        $services = [
            ['Memory Mastery', 'Programs', '8 Weeks', 'Learn techniques to retain, recall and apply information with confidence.'],
            ['Focus & Concentration', 'Programs', '6 Weeks', 'Train attention control for deep work and fewer distractions.'],
            ['Logic & Problem Solving', 'Programs', '6 Weeks', 'Sharpen analytical thinking for complex decisions.'],
            ['Mental Agility', 'Programs', '5 Weeks', 'Build speed, flexibility and creative response under pressure.'],
            ['Vision & Values', 'Programs', '4 Weeks', 'Align personal purpose with clear professional direction.'],
            ['Leadership & Performance', 'Programs', '8 Weeks', 'Lead teams with clarity, calm and consistent excellence.'],
        ];

        foreach ($services as $index => [$title, $group, $duration, $description]) {
            Service::query()->updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'group_name' => $group,
                    'duration_label' => $duration,
                    'description' => $description,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }

        $books = [
            ['The Focus Code', 'A practical guide to reclaiming attention in a distracted world.', 'gold'],
            ['Memory at Work', 'Techniques to retain and retrieve knowledge when it matters most.', 'rose'],
            ['Calm Under Pressure', 'Mental tools for composure, clarity and decisive action.', 'lavender'],
            ['Vision & Values', 'Build a personal compass for career and leadership choices.', 'peach'],
            ['Team Mindset', 'How groups think better together and sustain peak output.', 'cream'],
            ['Daily Mind Training', 'Short exercises that compound into lasting mental strength.', 'amber'],
        ];

        foreach ($books as $index => [$title, $description, $tone]) {
            Book::query()->updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'description' => $description,
                    'cover_tone' => $tone,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }

        $posts = [
            ['Focus', '5 Daily Habits That Rebuild Deep Focus', 'Small rituals that protect attention and compound into stronger concentration.', '12 min read'],
            ['Memory', 'How Leaders Remember What Matters', 'Simple memory systems for meetings, strategy and everyday recall.', '9 min read'],
            ['Leadership', 'Presence Under Pressure', 'A calm mind supports clearer choices when decisions must be made quickly.', '11 min read'],
        ];

        foreach ($posts as $index => [$tag, $title, $excerpt, $read]) {
            BlogPost::query()->updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'tag' => $tag,
                    'excerpt' => $excerpt,
                    'body' => $excerpt,
                    'read_time' => $read,
                    'is_published' => true,
                    'published_at' => now()->subDays($index + 1),
                    'sort_order' => $index + 1,
                ],
            );
        }

        $events = [
            ['Focus Intensive Workshop', 'Corporate Program', 'Pune', 'A half-day session on attention control for teams.', 14],
            ['Memory Mastery Live', 'Open Workshop', 'Online', 'Practical recall tools for students and professionals.', 28],
            ['Leadership Presence Lab', 'Leadership Series', 'Mumbai', 'Train calm communication and decision clarity under pressure.', 42],
        ];

        foreach ($events as $index => [$title, $subtitle, $location, $description, $days]) {
            UpcomingEvent::query()->updateOrCreate(
                ['title' => $title],
                [
                    'subtitle' => $subtitle,
                    'event_date' => now()->addDays($days)->toDateString(),
                    'location' => $location,
                    'description' => $description,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }

        Testimonial::query()->updateOrCreate(
            ['name' => 'Asha Verma', 'quote' => 'This training helped me stay focused and believe in my ability to learn better every day.'],
            ['role' => 'Student Workshop', 'is_published' => true, 'sort_order' => 1],
        );

        Testimonial::query()->updateOrCreate(
            ['name' => 'Rohit Mehta', 'quote' => 'Practical methods, calm guidance and clear tools for memory and concentration.'],
            ['role' => 'Corporate Professional', 'is_published' => true, 'sort_order' => 2],
        );
    }
}
