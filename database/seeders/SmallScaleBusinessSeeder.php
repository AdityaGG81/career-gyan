<?php

namespace Database\Seeders;

use App\Models\BusinessIdea;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SmallScaleBusinessSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'small-scale')->firstOrFail();

        $businessCategories = [
            [
                'title' => 'Food & Catering',
                'ideas' => [
                    ['name' => 'Homemade Cloud Kitchen', 'invest' => '₹20K - 50K', 'profit' => '20-40%', 'risk' => 'Low', 'desc' => 'Start a food delivery business from your own home kitchen using Zomato/Swiggy.'],
                    ['name' => 'Stall / Food Truck', 'invest' => '₹1L - 3L', 'profit' => '30-50%', 'risk' => 'Medium', 'desc' => 'Sell specialized snacks (Momo, Burgers, Chai) in high-traffic areas.'],
                ]
            ],
            [
                'title' => 'Digital & Online',
                'ideas' => [
                    ['name' => 'E-Commerce Reselling', 'invest' => '₹5K - 20K', 'profit' => '15-30%', 'risk' => 'Low', 'desc' => 'Sell products via Instagram or WhatsApp Business by sourcing from wholesalers.'],
                    ['name' => 'Content Creation Studio', 'invest' => '₹50K - 1L', 'profit' => 'High', 'risk' => 'Low', 'desc' => 'Offer video editing or social media management services to local brands.'],
                ]
            ],
            [
                'title' => 'Fashion & Clothing',
                'ideas' => [
                    ['name' => 'Custom Embroidery/Tailoring', 'invest' => '₹10K - 30K', 'profit' => '40-60%', 'risk' => 'Low', 'desc' => 'Offer personalized boutique services or alterations from an at-home studio.'],
                    ['name' => 'Print-on-Demand Store', 'invest' => '₹15K - 40K', 'profit' => '20-30%', 'risk' => 'Low', 'desc' => 'Design custom t-shirts or hoodies and sell them via your own online brand.'],
                ]
            ],
            [
                'title' => 'Education & Services',
                'ideas' => [
                    ['name' => 'Tutoring Center', 'invest' => '₹5K - 15K', 'profit' => 'High', 'risk' => 'Low', 'desc' => 'Start teaching school subjects or specialized skills like coding from home.'],
                    ['name' => 'Event Planning', 'invest' => '₹20K - 50K', 'profit' => '25-40%', 'risk' => 'Medium', 'desc' => 'Manage birthdays, small weddings, or corporate meetups in your city.'],
                ]
            ]
        ];

        foreach ($businessCategories as $cat) {
            foreach ($cat['ideas'] as $idea) {
                BusinessIdea::updateOrCreate(
                    ['slug' => Str::slug($idea['name'])],
                    [
                        'name' => $idea['name'],
                        'field_id' => $field->id,
                        'description' => $idea['desc'],
                        'investment' => $idea['invest'],
                        'profit_margin' => $idea['profit'],
                        'risk_level' => $idea['risk'],
                        'start_time' => '2-4 Weeks'
                    ]
                );
            }
        }
    }
}
