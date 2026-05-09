<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GamingCareersSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'gaming-careers')->first();
        if (!$field) return;

        $careers = [
            ['name' => 'Esports Player', 'image' => 'images/career-path/gaming-esports/esports-player.svg'],
            ['name' => 'Esports Coach', 'image' => 'images/career-path/gaming-esports/esports-coach.svg'],
            ['name' => 'Game Developer', 'image' => 'images/career-path/gaming-esports/game-developer.svg'],
            ['name' => 'Game Designer', 'image' => 'images/career-path/gaming-esports/game-designer.svg'],
            ['name' => 'Game Tester', 'image' => 'images/career-path/gaming-esports/game-tester.svg'],
            ['name' => 'Game Artist', 'image' => 'images/career-path/gaming-esports/game-artist.svg'],
            ['name' => '3D Game Artist', 'image' => 'images/career-path/gaming-esports/3d-game-artist.svg'],
            ['name' => 'Game Animator', 'image' => 'images/career-path/gaming-esports/game-animator.svg'],
            ['name' => 'Level Designer', 'image' => 'images/career-path/gaming-esports/level-designer.svg'],
            ['name' => 'Game Writer', 'image' => 'images/career-path/gaming-esports/game-writer.svg'],
            ['name' => 'Game Sound Designer', 'image' => 'images/career-path/gaming-esports/game-sound-designer.svg'],
            ['name' => 'Game UI/UX Designer', 'image' => 'images/career-path/gaming-esports/game-ui-ux-designer.svg'],
            ['name' => 'Game Producer', 'image' => 'images/career-path/gaming-esports/game-producer.svg'],
            ['name' => 'Esports Manager', 'image' => 'images/career-path/gaming-esports/esports-manager.svg'],
            ['name' => 'Esports Analyst', 'image' => 'images/career-path/gaming-esports/esports-analyst.svg'],
            ['name' => 'Esports Commentator', 'image' => 'images/career-path/gaming-esports/esports-commentator.svg'],
            ['name' => 'Gaming Content Creator', 'image' => 'images/career-path/gaming-esports/gaming-content-creator.svg'],
            ['name' => 'Gaming YouTuber', 'image' => 'images/career-path/gaming-esports/gaming-youtuber.svg'],
            ['name' => 'Live Streamer', 'image' => 'images/career-path/gaming-esports/live-streamer.svg'],
            ['name' => 'Twitch Streamer', 'image' => 'images/career-path/gaming-esports/twitch-streamer.svg'],
            ['name' => 'Game Journalist', 'image' => 'images/career-path/gaming-esports/game-journalist.svg'],
            ['name' => 'Game Reviewer', 'image' => 'images/career-path/gaming-esports/game-reviewer.svg'],
            ['name' => 'Gaming Community Manager', 'image' => 'images/career-path/gaming-esports/gaming-community-manager.svg'],
            ['name' => 'Esports Event Manager', 'image' => 'images/career-path/gaming-esports/esports-event-manager.svg'],
            ['name' => 'Tournament Organizer', 'image' => 'images/career-path/gaming-esports/tournament-organizer.svg'],
            ['name' => 'Gaming Marketing Specialist', 'image' => 'images/career-path/gaming-esports/gaming-marketing-specialist.svg'],
            ['name' => 'Game Monetization Specialist', 'image' => 'images/career-path/gaming-esports/game-monetization-specialist.svg'],
            ['name' => 'Mobile Game Developer', 'image' => 'images/career-path/gaming-esports/mobile-game-developer.svg'],
            ['name' => 'PC Game Developer', 'image' => 'images/career-path/gaming-esports/pc-game-developer.svg'],
            ['name' => 'Console Game Developer', 'image' => 'images/career-path/gaming-esports/console-game-developer.svg'],
            ['name' => 'AR/VR Game Developer', 'image' => 'images/career-path/gaming-esports/ar-vr-game-developer.svg'],
            ['name' => 'Metaverse Game Developer', 'image' => 'images/career-path/gaming-esports/metaverse-game-developer.svg'],
            ['name' => 'Unity Developer', 'image' => 'images/career-path/gaming-esports/unity-developer.svg'],
            ['name' => 'Unreal Engine Developer', 'image' => 'images/career-path/gaming-esports/unreal-engine-developer.svg'],
            ['name' => 'Gameplay Programmer', 'image' => 'images/career-path/gaming-esports/gameplay-programmer.svg'],
            ['name' => 'AI Programmer for Games', 'image' => 'images/career-path/gaming-esports/ai-programmer-for-games.svg'],
            ['name' => 'Physics Programmer', 'image' => 'images/career-path/gaming-esports/physics-programmer.svg'],
            ['name' => 'Multiplayer Network Programmer', 'image' => 'images/career-path/gaming-esports/multiplayer-network-programmer.svg'],
            ['name' => 'Game Server Developer', 'image' => 'images/career-path/gaming-esports/game-server-developer.svg'],
            ['name' => 'Esports Team Owner', 'image' => 'images/career-path/gaming-esports/esports-team-owner.svg'],
            ['name' => 'Esports Referee', 'image' => 'images/career-path/gaming-esports/esports-referee.svg'],
            ['name' => 'Gaming Brand Manager', 'image' => 'images/career-path/gaming-esports/gaming-brand-manager.svg'],
            ['name' => 'Gaming Influencer', 'image' => 'images/career-path/gaming-esports/gaming-influencer.svg'],
            ['name' => 'Game Localization Specialist', 'image' => 'images/career-path/gaming-esports/game-localization-specialist.svg'],
            ['name' => 'Game Data Analyst', 'image' => 'images/career-path/gaming-esports/game-data-analyst.svg'],
            ['name' => 'Game Economy Designer', 'image' => 'images/career-path/gaming-esports/game-economy-designer.svg'],
            ['name' => 'Virtual Reality Designer', 'image' => 'images/career-path/gaming-esports/virtual-reality-designer.svg'],
            ['name' => 'Motion Capture Artist', 'image' => 'images/career-path/gaming-esports/motion-capture-artist.svg'],
            ['name' => 'Gaming Academy Trainer', 'image' => 'images/career-path/gaming-esports/gaming-academy-trainer.svg'],
            ['name' => 'Indie Game Developer', 'image' => 'images/career-path/gaming-esports/indie-game-developer.svg'],
        ];

        foreach ($careers as $c) {
            Career::updateOrCreate(
                ['slug' => Str::slug($c['name'])],
                [
                    'name'           => $c['name'],
                    'field_id'       => $field->id,
                    'description'    => $c['name'] . ' is an exciting career path in the booming gaming and esports industry, combining creativity, technology, and entertainment.',
                    'qualification'  => 'Varies (B.Tech for Devs, Portfolio for Artists, Skill for Esports)',
                    'stream'         => 'Any Stream (PCM preferred for Devs)',
                    'salary_range'   => '₹4L - ₹25L',
                    'demand_level'   => 'High',
                    'icon'           => 'fa-gamepad',
                    'image'          => $c['image'],
                    'roadmap'        => [
                        'Play and analyze games across different genres',
                        'Learn the necessary skills (C#/C++ for dev, Blender for art, mechanical skills for esports)',
                        'Build a portfolio (create indie games, stream, or climb ranked ladders)',
                        'Network in gaming communities (Discord, Reddit, Twitter)',
                        'Participate in game jams or amateur tournaments',
                        'Apply to game studios or esports orgs',
                    ],
                    'skills'         => ['Passion for Gaming', 'Problem Solving', 'Creativity', 'Teamwork', 'Quick Reflexes (for Esports)'],
                    'future_scope'   => 'The gaming industry generates more revenue than the movie and music industries combined. Esports is rapidly becoming mainstream.',
                    'entrance_exams' => ['None (Design/Engineering entrances depending on the degree)'],
                    'job_opportunities' => ['Game Studios (EA, Ubisoft, Tencent)', 'Esports Orgs', 'Streaming Platforms', 'Freelance/Indie'],
                    'related_careers' => ['Software Developer', 'Digital Artist', 'Content Creator'],
                ]
            );
        }
    }
}
