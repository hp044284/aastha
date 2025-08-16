<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnquirySubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $subjects = [
            'CCTV Cameras',
            'Biometric Systems',
            'Video Door Phone',
            'Intercom Systems',
            'Computer Networking',
            'Ncomputing',
            'Fire Alarms',
        ];

        foreach ($subjects as $subject) {
            DB::table('enquiry_subjects')->insert([
                'name' => $subject,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
