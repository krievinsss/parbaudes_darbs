<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'customer_id' => null,
            ]
        );

        $companies = [
            [
                'name' => 'SIA Riga Tech Solutions',
                'email' => 'info@rigatech.lv',
                'phone' => '+371 20000001',
                'address' => 'Brīvības iela 101, Rīga',
            ],
            [
                'name' => 'SIA Baltic Logistics Group',
                'email' => 'info@balticlogistics.lv',
                'phone' => '+371 20000002',
                'address' => 'Dzelzavas iela 45, Rīga',
            ],
            [
                'name' => 'SIA Vidzeme Manufacturing',
                'email' => 'info@vidzememanufacturing.lv',
                'phone' => '+371 20000003',
                'address' => 'Rūpniecības iela 8, Valmiera',
            ],
            [
                'name' => 'SIA Kurzemes Būve',
                'email' => 'info@kurzemesbuve.lv',
                'phone' => '+371 20000004',
                'address' => 'Lielā iela 12, Liepāja',
            ],
            [
                'name' => 'SIA Zemgales Agro Serviss',
                'email' => 'info@zemgalesagro.lv',
                'phone' => '+371 20000005',
                'address' => 'Pasta iela 4, Jelgava',
            ],
            [
                'name' => 'SIA Daugava Retail',
                'email' => 'info@daugavaretail.lv',
                'phone' => '+371 20000006',
                'address' => 'Rīgas iela 22, Daugavpils',
            ],
            [
                'name' => 'SIA Latgales Medicīnas Centrs',
                'email' => 'info@latgalesmed.lv',
                'phone' => '+371 20000007',
                'address' => 'Slimnīcas iela 7, Rēzekne',
            ],
            [
                'name' => 'SIA Northern Support Services',
                'email' => 'info@northernsupport.lv',
                'phone' => '+371 20000008',
                'address' => 'Ganību dambis 30, Rīga',
            ],
            [
                'name' => 'SIA Green Energy Latvia',
                'email' => 'info@greenenergy.lv',
                'phone' => '+371 20000009',
                'address' => 'Saules iela 5, Ogre',
            ],
            [
                'name' => 'SIA Smart Finance Hub',
                'email' => 'info@smartfinance.lv',
                'phone' => '+371 20000010',
                'address' => 'Krišjāņa Valdemāra iela 15, Rīga',
            ],
            [
                'name' => 'SIA Food Production Factory',
                'email' => 'info@foodfactory.lv',
                'phone' => '+371 20000011',
                'address' => 'Eksporta iela 3, Tukums',
            ],
            [
                'name' => 'SIA Education and Training Center',
                'email' => 'info@edutrain.lv',
                'phone' => '+371 20000012',
                'address' => 'Skolas iela 10, Cēsis',
            ],
        ];

        $positionTemplates = [
            [
                'title' => 'Programmēšanas tehniķis',
                'employment_type' => 'full_time',
                'salary_from' => 1400,
                'salary_to' => 2200,
                'description' => 'Uzņēmums meklē programmēšanas tehniķi darbam ar iekšējām informācijas sistēmām, datu apstrādi un lietotāju atbalstu. Nepieciešamas pamatzināšanas PHP, SQL un web izstrādē.',
            ],
            [
                'title' => 'PHP programmētājs',
                'employment_type' => 'full_time',
                'salary_from' => 1800,
                'salary_to' => 3000,
                'description' => 'Darbs ar Laravel projektiem, REST API, datubāzēm un biznesa procesu automatizāciju. Nepieciešama pieredze backend izstrādē un prasme rakstīt uzturamu kodu.',
            ],
            [
                'title' => 'Klientu apkalpošanas speciālists',
                'employment_type' => 'full_time',
                'salary_from' => 900,
                'salary_to' => 1400,
                'description' => 'Klientu apkalpošana, pieprasījumu apstrāde, saziņa pa tālruni un e-pastu, kā arī datu ievade sistēmā. Nepieciešamas labas komunikācijas prasmes.',
            ],
            [
                'title' => 'Projektu koordinators',
                'employment_type' => 'full_time',
                'salary_from' => 1300,
                'salary_to' => 1900,
                'description' => 'Projektu plānošana, dokumentācijas uzturēšana, sadarbība ar komandām un termiņu kontrole. Pieredze projektu koordinēšanā tiks uzskatīta par priekšrocību.',
            ],
            [
                'title' => 'Grāmatvedis',
                'employment_type' => 'full_time',
                'salary_from' => 1200,
                'salary_to' => 1800,
                'description' => 'Ienākošo un izejošo dokumentu uzskaite, algu aprēķins, atskaišu sagatavošana un sadarbība ar valsts iestādēm. Nepieciešama pieredze grāmatvedībā.',
            ],
            [
                'title' => 'Noliktavas darbinieks',
                'employment_type' => 'full_time',
                'salary_from' => 850,
                'salary_to' => 1200,
                'description' => 'Preču pieņemšana, komplektēšana, uzskaite un inventarizācija. Vēlama pieredze noliktavas procesos un atbildīga attieksme pret darbu.',
            ],
            [
                'title' => 'Metinātājs',
                'employment_type' => 'full_time',
                'salary_from' => 1400,
                'salary_to' => 2400,
                'description' => 'Metāla konstrukciju izgatavošana un metināšanas darbu veikšana ražošanas vidē. Nepieciešama attiecīga kvalifikācija un praktiskā pieredze.',
            ],
            [
                'title' => 'Būvniecības projektu vadītājs',
                'employment_type' => 'full_time',
                'salary_from' => 1800,
                'salary_to' => 3200,
                'description' => 'Būvniecības projektu vadība, resursu plānošana, termiņu kontrole un sadarbība ar apakšuzņēmējiem. Nepieciešama pieredze projektu vadībā.',
            ],
            [
                'title' => 'Pārdošanas speciālists',
                'employment_type' => 'full_time',
                'salary_from' => 1000,
                'salary_to' => 1700,
                'description' => 'Aktīva klientu piesaiste, piedāvājumu sagatavošana, līgumu slēgšana un attiecību uzturēšana ar klientiem. Nepieciešamas labas pārdošanas prasmes.',
            ],
            [
                'title' => 'Datu ievades operators',
                'employment_type' => 'part_time',
                'salary_from' => 700,
                'salary_to' => 1000,
                'description' => 'Dokumentu un informācijas ievade sistēmā, datu kvalitātes pārbaude un atskaišu sagatavošana. Nepieciešama precizitāte un prasme strādāt ar datoru.',
            ],
            [
                'title' => 'Elektriķis',
                'employment_type' => 'full_time',
                'salary_from' => 1200,
                'salary_to' => 2100,
                'description' => 'Elektroinstalāciju ierīkošana, uzturēšana un bojājumu diagnostika. Nepieciešama atbilstoša kvalifikācija un drošības prasību ievērošana.',
            ],
            [
                'title' => 'Māsu palīgs',
                'employment_type' => 'full_time',
                'salary_from' => 900,
                'salary_to' => 1300,
                'description' => 'Atbalsts medicīnas personālam, pacientu aprūpe un ikdienas uzdevumu veikšana ārstniecības iestādē. Nepieciešama empātija un atbildīga attieksme.',
            ],
        ];

        $locations = [
            'Rīga',
            'Jelgava',
            'Liepāja',
            'Ventspils',
            'Valmiera',
            'Daugavpils',
            'Rēzekne',
            'Ogre',
            'Cēsis',
            'Jūrmala',
            'Tukums',
            'Saldus',
        ];

        $customers = collect();

        foreach ($companies as $company) {
            $customer = Customer::updateOrCreate(
                ['email' => $company['email']],
                [
                    'name' => $company['name'],
                    'phone' => $company['phone'],
                    'address' => $company['address'],
                ]
            );

            User::updateOrCreate(
                ['email' => $company['email']],
                [
                    'name' => $company['name'],
                    'password' => Hash::make('password'),
                    'is_admin' => false,
                    'customer_id' => $customer->id,
                ]
            );

            $customers->push($customer);
        }

        $vacancyCounter = 1;

        foreach ($customers as $customer) {
            $customerUser = $customer->user;

            for ($i = 0; $i < 10; $i++) {
                $template = $positionTemplates[array_rand($positionTemplates)];
                $salaryFrom = $template['salary_from'] + rand(-100, 250);
                $salaryTo = max($salaryFrom + 200, $template['salary_to'] + rand(-100, 400));

                Order::create([
                    'customer_id' => $customer->id,
                    'user_id' => $customerUser->id,
                    'request_number' => 'REQ-' . str_pad((string) $vacancyCounter, 5, '0', STR_PAD_LEFT),
                    'service_type' => 'vacancy_registration',
                    'status' => collect(['approved', 'completed', 'submitted', 'in_review'])->random(),
                    'position_title' => $template['title'],
                    'vacancies_count' => rand(1, 6),
                    'employment_type' => $template['employment_type'],
                    'location' => $locations[array_rand($locations)],
                    'salary_from' => $salaryFrom,
                    'salary_to' => $salaryTo,
                    'description' => $template['description'] . "\n\nDarba pienākumi:\n- Ikdienas uzdevumu veikšana atbilstoši amatam\n- Sadarbība ar kolēģiem un vadību\n- Kvalitatīva darba izpilde noteiktajos termiņos\n\nPrasības kandidātiem:\n- Atbildības sajūta\n- Labas komunikācijas prasmes\n- Vēlama iepriekšēja pieredze līdzīgā amatā",
                    'notes' => 'Publiski pieejama vakance darba meklētājiem.',
                    'submitted_at' => now()->subDays(rand(5, 60)),
                    'processed_at' => now()->subDays(rand(1, 30)),
                ]);

                $vacancyCounter++;
            }
        }

        $extraServiceTypes = [
            'candidate_selection',
            'training_request',
            'employment_support',
            'layoff_support',
        ];

        foreach ($customers as $customer) {
            $customerUser = $customer->user;

            for ($i = 0; $i < 2; $i++) {
                $serviceType = $extraServiceTypes[array_rand($extraServiceTypes)];

                Order::create([
                    'customer_id' => $customer->id,
                    'user_id' => $customerUser->id,
                    'request_number' => 'REQ-' . str_pad((string) $vacancyCounter, 5, '0', STR_PAD_LEFT),
                    'service_type' => $serviceType,
                    'status' => collect(['submitted', 'in_review', 'approved'])->random(),
                    'position_title' => match ($serviceType) {
                        'candidate_selection' => 'Kandidātu atlases pieprasījums',
                        'training_request' => 'Darbinieku apmācību pieprasījums',
                        'employment_support' => 'Nodarbinātības atbalsta pieprasījums',
                        'layoff_support' => 'Atbalsta pieprasījums kolektīvās atlaišanas gadījumā',
                        default => 'Pakalpojuma pieprasījums',
                    },
                    'vacancies_count' => rand(1, 4),
                    'employment_type' => collect(Order::EMPLOYMENT_TYPES)->random(),
                    'location' => $locations[array_rand($locations)],
                    'salary_from' => rand(900, 1800),
                    'salary_to' => rand(1800, 3200),
                    'description' => 'Uzņēmums iesniedz pakalpojuma pieprasījumu sadarbībai ar nodarbinātības aģentūru. Nepieciešams atbalsts personāla piesaistei, apmācībām vai nodarbinātības pasākumiem.',
                    'notes' => 'Iekšējs pieprasījums sistēmā.',
                    'submitted_at' => now()->subDays(rand(3, 20)),
                    'processed_at' => now()->subDays(rand(1, 10)),
                ]);

                $vacancyCounter++;
            }
        }

        if ($customers->isNotEmpty()) {
            $firstCustomer = $customers->first();

            for ($i = 0; $i < 5; $i++) {
                $template = $positionTemplates[array_rand($positionTemplates)];

                Order::create([
                    'customer_id' => $firstCustomer->id,
                    'user_id' => $admin->id,
                    'request_number' => 'REQ-' . str_pad((string) $vacancyCounter, 5, '0', STR_PAD_LEFT),
                    'service_type' => 'vacancy_registration',
                    'status' => 'approved',
                    'position_title' => $template['title'] . ' (administratora ievade)',
                    'vacancies_count' => rand(1, 3),
                    'employment_type' => $template['employment_type'],
                    'location' => $locations[array_rand($locations)],
                    'salary_from' => $template['salary_from'],
                    'salary_to' => $template['salary_to'],
                    'description' => $template['description'] . "\n\nŠis ir administrācijas izveidots sludinājums demonstrācijas nolūkiem.",
                    'notes' => 'Izveidots administrators.',
                    'submitted_at' => now()->subDays(rand(2, 15)),
                    'processed_at' => now()->subDays(rand(1, 7)),
                ]);

                $vacancyCounter++;
            }
        }
    }
}