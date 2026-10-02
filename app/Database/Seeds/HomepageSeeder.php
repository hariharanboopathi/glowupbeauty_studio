<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HomepageSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        // 1. Seed homepage_sections
        $sections = [
            [
                'section_key' => 'hero',
                'title'       => "Reveal Your\nNatural Radiance",
                'subtitle'    => 'Premium beauty treatments designed to help you look and feel your best, curated within an architectural Academy of stillness.',
                'content'     => null,
                'meta_data'   => json_encode([
                    'pill_text'          => 'BEAUTY • WELLNESS • SELF CARE',
                    'primary_btn_text'   => 'Book an Appointment',
                    'primary_btn_url'    => 'booking',
                    'secondary_btn_text' => 'Explore Services',
                    'secondary_btn_url'  => 'services.html',
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'updated_at'  => $now,
            ],
            [
                'section_key' => 'philosophy',
                'title'       => 'Beauty, Care & Confidence',
                'subtitle'    => 'The Glowup Philosophy',
                'content'     => 'Experience personalized beauty treatments delivered with care, expertise and attention to every detail. We believe self-renewal is an essential discipline, not an indulgence.',
                'meta_data'   => json_encode([
                    'secondary_content' => 'Step through arched colonnades sculpted in travertine and warm lavender limestone. Each visit begins with an intimate diagnostic consultation analyzing your hair porosity and dermis health before pairing with organic cold-pressed serums and clinically calibrated therapies.',
                    'stat1_value'       => '100%',
                    'stat1_label'       => 'Bespoke Formulas',
                    'stat2_value'       => '14+',
                    'stat2_label'       => 'Master Artists',
                    'stat3_value'       => '4.98',
                    'stat3_label'       => 'Academy Score',
                    'btn_text'          => 'Discover Our Story',
                    'btn_url'           => 'about.html',
                    'image_url'         => 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=900&q=80',
                    'award_title'       => 'Vogue Wellness',
                    'award_desc'        => 'Best Luxury Wellness Academy 2024',
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'updated_at'  => $now,
            ],
        ];

        foreach ($sections as $section) {
            $existing = $db->table('homepage_sections')->where('section_key', $section['section_key'])->get()->getRow();
            if ($existing) {
                $db->table('homepage_sections')->where('section_key', $section['section_key'])->update($section);
            } else {
                $db->table('homepage_sections')->insert($section);
            }
        }

        // 2. Seed homepage_slides
        if ($db->table('homepage_slides')->countAllResults() === 0) {
            $slides = [
                [
                    'chapter_title' => 'Chapter I: The Architecture of Radiance',
                    'badge_text'    => 'Academy Sanctum',
                    'time_text'     => '00:02 / 00:08',
                    'image_url'     => 'images/academy-tour.jpg',
                    'display_order' => 1,
                    'is_active'     => 1,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'chapter_title' => 'Chapter II: Clinical Glass-Skin Radiance',
                    'badge_text'    => 'Aesthetic Facial',
                    'time_text'     => '00:04 / 00:08',
                    'image_url'     => 'images/slide-facial.jpg',
                    'display_order' => 2,
                    'is_active'     => 1,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'chapter_title' => 'Chapter III: Molecular Hair Alchemy',
                    'badge_text'    => 'Hair Alchemy',
                    'time_text'     => '00:06 / 00:08',
                    'image_url'     => 'images/slide-hair.jpg',
                    'display_order' => 3,
                    'is_active'     => 1,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'chapter_title' => 'Chapter IV: Haute Royal Bridal Artistry',
                    'badge_text'    => 'Bridal Couture',
                    'time_text'     => '00:08 / 00:08',
                    'image_url'     => 'images/slide-bridal.jpg',
                    'display_order' => 4,
                    'is_active'     => 1,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
            ];
            $db->table('homepage_slides')->insertBatch($slides);
        }

        // 3. Seed homepage_services
        if ($db->table('homepage_services')->countAllResults() === 0) {
            $services = [
                [
                    'title'         => 'Hydra Facial Ritual',
                    'category'      => 'Aesthetic Facial',
                    'price'         => '₹3,500',
                    'duration'      => '75 Minutes',
                    'description'   => 'Multi-step resurfacing treatment infusing patented peptides and botanical hydration for an instant, dewy glass-skin luminosity.',
                    'image_url'     => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800&q=80',
                    'button_text'   => 'Book Now',
                    'button_url'    => 'booking',
                    'display_order' => 1,
                    'is_active'     => 1,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'title'         => 'Keratin Treatment',
                    'category'      => 'Hair Alchemy',
                    'price'         => '₹3,500',
                    'duration'      => '120 Minutes',
                    'description'   => 'Intensive botanical protein smoothing infusion that eliminates frizz, restores molecular bonds, and locks in mirror shine.',
                    'image_url'     => 'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?w=800&q=80',
                    'button_text'   => 'Book Now',
                    'button_url'    => 'booking',
                    'display_order' => 2,
                    'is_active'     => 1,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'title'         => 'Botox Treatment',
                    'category'      => 'Deep Repair',
                    'price'         => '₹3,500',
                    'duration'      => '90 Minutes',
                    'description'   => 'Deep-conditioning capillary hair botox formula packed with hyaluronic acid and caviar extract to resurrect damaged strands.',
                    'image_url'     => 'https://images.unsplash.com/photo-1519699047748-de8e457a634e?w=800&q=80',
                    'button_text'   => 'Book Now',
                    'button_url'    => 'booking',
                    'display_order' => 3,
                    'is_active'     => 1,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'title'         => 'Hair Straightening',
                    'category'      => 'Thermal Styling',
                    'price'         => '₹3,500',
                    'duration'      => '150 Minutes',
                    'description'   => 'Japanese-inspired precision thermal reconditioning for impeccably sleek, pin-straight hair with silky featherlight movement.',
                    'image_url'     => 'https://images.unsplash.com/photo-1560869713-7d0a29430803?w=800&q=80',
                    'button_text'   => 'Book Now',
                    'button_url'    => 'booking',
                    'display_order' => 4,
                    'is_active'     => 1,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'title'         => 'Hair Smoothing',
                    'category'      => 'Cysteine Ritual',
                    'price'         => '₹3,500',
                    'duration'      => '120 Minutes',
                    'description'   => 'Gentle organic cysteine treatment relaxing unruly curls into effortless, manageable, touchably soft satin waves.',
                    'image_url'     => 'https://images.unsplash.com/photo-1522336572468-97b06e8ef143?w=800&q=80',
                    'button_text'   => 'Book Now',
                    'button_url'    => 'booking',
                    'display_order' => 5,
                    'is_active'     => 1,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
            ];
            $db->table('homepage_services')->insertBatch($services);
        }
    }
}
