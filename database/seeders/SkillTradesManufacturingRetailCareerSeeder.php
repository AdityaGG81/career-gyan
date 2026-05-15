<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use App\Models\Field;

class SkillTradesManufacturingRetailCareerSeeder extends Seeder
{
    public function run(): void
    {
        $fieldSlug = 'skill-trades-manufacturing-retail';
        $field = Field::where('slug', $fieldSlug)->first();

        if (!$field) {
            $this->command->error("Field '$fieldSlug' not found. Please run FieldsSeeder first.");
            return;
        }

        $careers = [
            [
                'slug' => 'assistant-electrician',
                'name' => 'Assistant Electrician',
                'sub_domain' => 'Electrical & Wiring Trades',
                'description' => 'Assistant Electricians support senior electricians in installing, repairing, and maintaining electrical wiring, fixtures, meters, panels, and basic electrical systems.',
                'salary_range' => '₹1.8L – ₹5L',
                'demand_level' => 'High',
                'qualification' => '10th / ITI Electrician / Electrical Skill Training',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Skill Certifications'],
                'skills' => ['Electrical Wiring', 'Safety Rules', 'Tool Handling', 'Fault Finding', 'Basic Circuit Knowledge'],
                'job_opportunities' => ['Electrical Contractors', 'Construction Sites', 'Factories', 'Maintenance Firms'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/assistant-electrician.svg'
            ],
            [
                'slug' => 'wireman',
                'name' => 'Wireman',
                'sub_domain' => 'Electrical & Wiring Trades',
                'description' => 'Wiremen install and maintain electrical wiring systems in homes, offices, buildings, factories, and industrial units.',
                'salary_range' => '₹2L – ₹6L',
                'demand_level' => 'High',
                'qualification' => '10th / ITI Wireman / Electrical Trade Training',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Skill Certifications'],
                'skills' => ['Wiring Layouts', 'Circuit Testing', 'Safety Practice', 'Electrical Tools', 'Troubleshooting'],
                'job_opportunities' => ['Electrical Contractors', 'Construction Companies', 'Factories', 'Real Estate Projects'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/wireman.svg'
            ],
            [
                'slug' => 'fitter',
                'name' => 'Fitter',
                'sub_domain' => 'Mechanical & Industrial Trades',
                'description' => 'Fitters assemble, repair, and maintain mechanical parts, machines, pipelines, metal structures, and industrial equipment.',
                'salary_range' => '₹2L – ₹7L',
                'demand_level' => 'High',
                'qualification' => '10th / ITI Fitter',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Trade Tests'],
                'skills' => ['Machine Fitting', 'Measurement', 'Blueprint Reading', 'Hand Tools', 'Maintenance Work'],
                'job_opportunities' => ['Manufacturing Units', 'Engineering Workshops', 'Railways', 'Factories'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/fitter.svg'
            ],
            [
                'slug' => 'turner',
                'name' => 'Turner',
                'sub_domain' => 'Mechanical & Industrial Trades',
                'description' => 'Turners operate lathe machines to shape metal parts, shafts, rods, threads, and precision mechanical components.',
                'salary_range' => '₹2L – ₹7L',
                'demand_level' => 'High',
                'qualification' => '10th / ITI Turner',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Skill Certifications'],
                'skills' => ['Lathe Operation', 'Measurement', 'Drawing Reading', 'Metal Cutting', 'Precision Work'],
                'job_opportunities' => ['Machine Shops', 'Manufacturing Units', 'Tool Rooms', 'Automobile Industries'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/turner.svg'
            ],
            [
                'slug' => 'machinist',
                'name' => 'Machinist',
                'sub_domain' => 'Mechanical & Industrial Trades',
                'description' => 'Machinists operate machines such as lathe, milling, drilling, and grinding machines to produce accurate metal components.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'High',
                'qualification' => '10th / ITI Machinist',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Skill Certifications'],
                'skills' => ['Machine Operation', 'Precision Measurement', 'Tool Setting', 'Metal Cutting', 'Technical Drawing'],
                'job_opportunities' => ['Manufacturing Companies', 'Tool Rooms', 'Automobile Firms', 'Aerospace Suppliers'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/machinist.svg'
            ],
            [
                'slug' => 'welder',
                'name' => 'Welder',
                'sub_domain' => 'Welding, Fabrication & Metal Work',
                'description' => 'Welders join metal parts using welding techniques such as arc welding, gas welding, MIG welding, and TIG welding.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'High',
                'qualification' => '8th / 10th / ITI Welder / Welding Certification',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Skill Certifications'],
                'skills' => ['Welding Techniques', 'Safety Gear Use', 'Metal Joining', 'Blueprint Reading', 'Heat Control'],
                'job_opportunities' => ['Fabrication Units', 'Construction Sites', 'Automobile Companies', 'Shipyards'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/welder.svg'
            ],
            [
                'slug' => 'fabricator',
                'name' => 'Fabricator',
                'sub_domain' => 'Welding, Fabrication & Metal Work',
                'description' => 'Fabricators cut, bend, assemble, and weld metal sheets, frames, structures, gates, tanks, and industrial components.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'High',
                'qualification' => '10th / ITI Welder, Fitter, or Fabrication Training',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Skill Certifications'],
                'skills' => ['Metal Cutting', 'Welding', 'Measurement', 'Drawing Reading', 'Assembly Work'],
                'job_opportunities' => ['Fabrication Workshops', 'Construction Companies', 'Engineering Firms', 'Industrial Units'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/fabricator.svg'
            ],
            [
                'slug' => 'carpenter',
                'name' => 'Carpenter',
                'sub_domain' => 'Woodwork & Furniture Making',
                'description' => 'Carpenters build, repair, and install wooden structures, doors, windows, furniture, partitions, and interior fittings.',
                'salary_range' => '₹2L – ₹7L',
                'demand_level' => 'High',
                'qualification' => '8th / 10th / ITI Carpenter / Woodwork Training',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Skill Certifications'],
                'skills' => ['Wood Cutting', 'Measurement', 'Furniture Assembly', 'Tool Handling', 'Finishing Work'],
                'job_opportunities' => ['Furniture Workshops', 'Construction Sites', 'Interior Design Firms', 'Real Estate Projects'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/carpenter.svg'
            ],
            [
                'slug' => 'painter',
                'name' => 'Painter',
                'sub_domain' => 'Construction & Interior Trades',
                'description' => 'Painters apply paint, polish, texture, and finishing materials to walls, buildings, furniture, machines, and surfaces.',
                'salary_range' => '₹1.8L – ₹6L',
                'demand_level' => 'High',
                'qualification' => '8th / 10th / Painting Skill Training',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Surface Preparation', 'Paint Mixing', 'Wall Finishing', 'Spray Painting', 'Safety Practice'],
                'job_opportunities' => ['Construction Companies', 'Interior Firms', 'Automobile Workshops', 'Maintenance Contractors'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/painter.svg'
            ],
            [
                'slug' => 'mason',
                'name' => 'Mason',
                'sub_domain' => 'Construction & Interior Trades',
                'description' => 'Masons construct walls, foundations, plastering work, concrete structures, brickwork, and stonework in building projects.',
                'salary_range' => '₹2L – ₹7L',
                'demand_level' => 'High',
                'qualification' => '8th / 10th / Construction Skill Training',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Brickwork', 'Cement Mixing', 'Plastering', 'Measurement', 'Construction Safety'],
                'job_opportunities' => ['Construction Sites', 'Real Estate Projects', 'Contractors', 'Infrastructure Companies'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/mason.svg'
            ],
            [
                'slug' => 'tile-setter',
                'name' => 'Tile Setter',
                'sub_domain' => 'Construction & Interior Trades',
                'description' => 'Tile Setters install floor tiles, wall tiles, marble, granite, ceramic, and decorative surface materials in buildings.',
                'salary_range' => '₹2L – ₹7L',
                'demand_level' => 'High',
                'qualification' => '8th / 10th / Tiling Skill Training',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Tile Cutting', 'Alignment', 'Surface Preparation', 'Adhesive Application', 'Finishing'],
                'job_opportunities' => ['Construction Firms', 'Interior Contractors', 'Real Estate Projects', 'Renovation Companies'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/tile-setter.svg'
            ],
            [
                'slug' => 'furniture-maker',
                'name' => 'Furniture Maker',
                'sub_domain' => 'Woodwork & Furniture Making',
                'description' => 'Furniture Makers design, build, assemble, and repair wooden or modular furniture for homes, offices, hotels, and commercial spaces.',
                'salary_range' => '₹2L – ₹9L',
                'demand_level' => 'High',
                'qualification' => '10th / ITI Carpenter / Furniture Making Training',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Skill Certifications'],
                'skills' => ['Woodwork', 'Modular Furniture Assembly', 'Measurement', 'Finishing', 'Design Understanding'],
                'job_opportunities' => ['Furniture Brands', 'Interior Firms', 'Carpentry Workshops', 'Modular Furniture Companies'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/furniture-maker.svg'
            ],
            [
                'slug' => 'tailor',
                'name' => 'Tailor',
                'sub_domain' => 'Tailoring, Fashion & Boutique Business',
                'description' => 'Tailors stitch, alter, repair, and customize garments according to body measurements, design requirements, and customer preferences.',
                'salary_range' => '₹1.8L – ₹6L',
                'demand_level' => 'High',
                'qualification' => '8th / 10th / ITI Sewing Technology / Tailoring Course',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Stitching', 'Measurement', 'Pattern Cutting', 'Alteration', 'Fabric Knowledge'],
                'job_opportunities' => ['Tailoring Shops', 'Garment Units', 'Boutiques', 'Fashion Designers'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/tailor.svg'
            ],
            [
                'slug' => 'fashion-boutique-owner',
                'name' => 'Fashion Boutique Owner',
                'sub_domain' => 'Tailoring, Fashion & Boutique Business',
                'description' => 'Fashion Boutique Owners run small fashion businesses by selling customized garments, ethnic wear, designer outfits, and accessories.',
                'salary_range' => '₹2L – ₹15L+',
                'demand_level' => 'Moderate',
                'qualification' => 'Tailoring Course / Fashion Design Diploma / Business Skills',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Fashion Sense', 'Customer Handling', 'Stitching Knowledge', 'Sales', 'Business Management'],
                'job_opportunities' => ['Self-Employment', 'Boutique Business', 'Online Fashion Stores', 'Designer Studios'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/fashion-boutique-owner.svg'
            ],
            [
                'slug' => 'beautician',
                'name' => 'Beautician',
                'sub_domain' => 'Beauty, Hair & Wellness Services',
                'description' => 'Beauticians provide skincare, facial, makeup, grooming, manicure, pedicure, and beauty treatment services to clients.',
                'salary_range' => '₹1.8L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'Beautician Course / Cosmetology Diploma / Beauty & Wellness Certification',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Skincare', 'Makeup', 'Hygiene', 'Client Handling', 'Beauty Product Knowledge'],
                'job_opportunities' => ['Salons', 'Beauty Parlours', 'Spas', 'Bridal Studios', 'Beauty Brands'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/beautician.svg'
            ],
            [
                'slug' => 'hair-stylist',
                'name' => 'Hair Stylist',
                'sub_domain' => 'Beauty, Hair & Wellness Services',
                'description' => 'Hair Stylists cut, color, style, treat, and maintain hair for clients based on fashion trends, face shape, and personal preferences.',
                'salary_range' => '₹2L – ₹10L',
                'demand_level' => 'High',
                'qualification' => 'Hair Styling Course / Cosmetology Diploma / Salon Training',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Hair Cutting', 'Hair Coloring', 'Styling', 'Client Consultation', 'Hygiene', 'Trend Awareness'],
                'job_opportunities' => ['Salons', 'Beauty Studios', 'Fashion Industry', 'Film Industry'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/hair-stylist.svg'
            ],
            [
                'slug' => 'barber',
                'name' => 'Barber',
                'sub_domain' => 'Beauty, Hair & Wellness Services',
                'description' => 'Barbers provide haircuts, beard trimming, shaving, grooming, scalp care, and basic men’s styling services.',
                'salary_range' => '₹1.8L – ₹7L',
                'demand_level' => 'High',
                'qualification' => 'Barbering Course / Salon Training / Skill Certification',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Haircutting', 'Beard Styling', 'Grooming', 'Hygiene', 'Customer Service'],
                'job_opportunities' => ['Barber Shops', 'Salons', 'Grooming Studios', 'Hotels'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/barber.svg'
            ],
            [
                'slug' => 'spa-manager',
                'name' => 'Spa Manager',
                'sub_domain' => 'Beauty, Hair & Wellness Services',
                'description' => 'Spa Managers supervise spa operations, staff, bookings, customer service, therapy rooms, hygiene standards, and wellness service quality.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'Moderate',
                'qualification' => 'Spa Therapy / Hospitality / Wellness Management Course',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Spa Operations', 'Client Service', 'Staff Management', 'Wellness Knowledge', 'Scheduling', 'Hygiene Standards'],
                'job_opportunities' => ['Spas', 'Resorts', 'Hotels', 'Wellness Centres', 'Beauty & Wellness Chains'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/spa-manager.svg'
            ],
            [
                'slug' => 'housekeeping-attendant',
                'name' => 'Housekeeping Attendant',
                'sub_domain' => 'Hospitality & Housekeeping Services',
                'description' => 'Housekeeping Attendants clean rooms, maintain hygiene, arrange supplies, support guest comfort, and follow housekeeping standards.',
                'salary_range' => '₹1.5L – ₹5L',
                'demand_level' => 'High',
                'qualification' => '8th / 10th / Housekeeping Training / Hospitality Skill Course',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Cleaning Standards', 'Time Management', 'Hygiene', 'Attention to Detail', 'Guest Service'],
                'job_opportunities' => ['Hotels', 'Hospitals', 'Resorts', 'Corporate Offices', 'Facility Management Companies'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/housekeeping-attendant.svg'
            ],
            [
                'slug' => 'retail-sales-associate',
                'name' => 'Retail Sales Associate',
                'sub_domain' => 'Retail Store Operations',
                'description' => 'Retail Sales Associates assist customers, explain products, manage displays, support billing, and help increase store sales.',
                'salary_range' => '₹2L – ₹6L',
                'demand_level' => 'High',
                'qualification' => '10th / 12th / Retail Sales Training',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Customer Service', 'Product Knowledge', 'Sales', 'Communication', 'Store Display'],
                'job_opportunities' => ['Retail Stores', 'Shopping Malls', 'Supermarkets', 'Fashion Stores', 'Electronics Stores'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/retail-sales-associate.svg'
            ],
            [
                'slug' => 'store-supervisor',
                'name' => 'Store Supervisor',
                'sub_domain' => 'Retail Store Operations',
                'description' => 'Store Supervisors manage store staff, sales targets, stock movement, displays, customer service, and daily retail operations.',
                'salary_range' => '₹2.5L – ₹8L',
                'demand_level' => 'High',
                'qualification' => '12th / Graduation / Retail Management Course',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Team Supervision', 'Sales Tracking', 'Inventory Control', 'Customer Handling', 'Store Operations'],
                'job_opportunities' => ['Retail Chains', 'Supermarkets', 'Fashion Stores', 'Electronics Stores', 'Department Stores'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/store-supervisor.svg'
            ],
            [
                'slug' => 'cashier',
                'name' => 'Cashier',
                'sub_domain' => 'Retail Store Operations',
                'description' => 'Cashiers handle billing, payment collection, receipts, refunds, cash records, card transactions, and customer checkout support.',
                'salary_range' => '₹1.8L – ₹5L',
                'demand_level' => 'High',
                'qualification' => '10th / 12th / Basic Computer and Billing Training',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Billing Software', 'Cash Handling', 'Accuracy', 'Customer Service', 'Basic Accounting'],
                'job_opportunities' => ['Retail Stores', 'Supermarkets', 'Malls', 'Restaurants', 'Petrol Pumps'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/cashier.svg'
            ],
            [
                'slug' => 'delivery-executive',
                'name' => 'Delivery Executive',
                'sub_domain' => 'Delivery, Courier & Logistics Support',
                'description' => 'Delivery Executives pick up and deliver food, parcels, groceries, documents, and e-commerce orders to customers safely and on time.',
                'salary_range' => '₹2L – ₹6L',
                'demand_level' => 'Very High',
                'qualification' => '10th / 12th, Driving Licence required',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Route Knowledge', 'Time Management', 'Customer Service', 'Mobile App Usage', 'Safe Driving'],
                'job_opportunities' => ['E-commerce Companies', 'Food Delivery Platforms', 'Courier Firms', 'Logistics Companies'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/delivery-executive.svg'
            ],
            [
                'slug' => 'courier-executive',
                'name' => 'Courier Executive',
                'sub_domain' => 'Delivery, Courier & Logistics Support',
                'description' => 'Courier Executives collect, sort, track, and deliver parcels, documents, business packages, and shipments.',
                'salary_range' => '₹2L – ₹6L',
                'demand_level' => 'High',
                'qualification' => '10th / 12th, Driving Licence preferred',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Parcel Handling', 'Route Planning', 'Customer Interaction', 'Tracking Systems', 'Time Management'],
                'job_opportunities' => ['Courier Companies', 'Logistics Firms', 'E-commerce Companies', 'Postal Services'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/courier-executive.svg'
            ],
            [
                'slug' => 'warehouse-picker',
                'name' => 'Warehouse Picker',
                'sub_domain' => 'Warehouse & Inventory Operations',
                'description' => 'Warehouse Pickers select products from storage shelves, scan items, prepare orders, and support fast warehouse dispatch operations.',
                'salary_range' => '₹1.8L – ₹5L',
                'demand_level' => 'High',
                'qualification' => '10th / 12th / Warehouse Operations Training',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Picking Accuracy', 'Barcode Scanning', 'Physical Stamina', 'Order Processing', 'Safety Awareness'],
                'job_opportunities' => ['Warehouses', 'E-commerce Fulfilment Centres', 'Retail Supply Chains', 'Logistics Companies'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/warehouse-picker.svg'
            ],
            [
                'slug' => 'forklift-operator',
                'name' => 'Forklift Operator',
                'sub_domain' => 'Warehouse & Inventory Operations',
                'description' => 'Forklift Operators move heavy goods, pallets, cartons, and materials inside warehouses, factories, ports, and logistics centres.',
                'salary_range' => '₹2L – ₹7L',
                'demand_level' => 'High',
                'qualification' => '10th / Forklift Operation Training / Safety Certification',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Forklift Driving', 'Load Handling', 'Warehouse Safety', 'Material Movement', 'Equipment Inspection'],
                'job_opportunities' => ['Warehouses', 'Manufacturing Units', 'Ports', 'Logistics Companies'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/forklift-operator.svg'
            ],
            [
                'slug' => 'packaging-operator',
                'name' => 'Packaging Operator',
                'sub_domain' => 'Packaging & Production Operations',
                'description' => 'Packaging Operators run packaging machines, pack products, label items, check quality, and prepare goods for dispatch.',
                'salary_range' => '₹1.8L – ₹6L',
                'demand_level' => 'High',
                'qualification' => '10th / 12th / Packaging or Production Training',
                'stream' => 'Any Stream',
                'entrance_exams' => ['None'],
                'skills' => ['Machine Handling', 'Packing Quality', 'Labelling', 'Safety Rules', 'Production Discipline'],
                'job_opportunities' => ['FMCG Companies', 'Food Processing Units', 'Pharma Companies', 'Manufacturing Units'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/packaging-operator.svg'
            ],
            [
                'slug' => 'cnc-programmer',
                'name' => 'CNC Programmer',
                'sub_domain' => 'CNC, 3D Printing & Advanced Manufacturing',
                'description' => 'CNC Programmers create machine instructions for CNC machines to produce accurate components using computer-controlled manufacturing.',
                'salary_range' => '₹3L – ₹12L',
                'demand_level' => 'High',
                'qualification' => 'ITI Machinist / Diploma Mechanical / CNC Programming Course',
                'stream' => 'ITI / Engineering / Science',
                'entrance_exams' => ['ITI Admission', 'Polytechnic Entrance', 'CNC Certifications'],
                'skills' => ['CNC Programming', 'G-code', 'CAM Software', 'Drawing Reading', 'Precision Manufacturing'],
                'job_opportunities' => ['Tool Rooms', 'Automobile Companies', 'Aerospace Suppliers', 'Manufacturing Units'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/cnc-programmer.svg'
            ],
            [
                'slug' => '3d-printing-technician',
                'name' => '3D Printing Technician',
                'sub_domain' => 'CNC, 3D Printing & Advanced Manufacturing',
                'description' => '3D Printing Technicians operate 3D printers, prepare digital models, manage materials, check print quality, and support prototype manufacturing.',
                'salary_range' => '₹2.5L – ₹9L',
                'demand_level' => 'High',
                'qualification' => 'Diploma / ITI / Certificate in Additive Manufacturing or 3D Printing',
                'stream' => 'Science / Engineering / ITI',
                'entrance_exams' => ['Polytechnic Entrance', 'Skill Certifications'],
                'skills' => ['3D Printing', 'CAD Basics', 'Material Handling', 'Machine Calibration', 'Quality Checking'],
                'job_opportunities' => ['Manufacturing Firms', 'Product Design Studios', 'Medical Device Firms', 'Prototype Labs'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/3d-printing-technician.svg'
            ],
            [
                'slug' => 'electronics-repair-technician',
                'name' => 'Electronics Repair Technician',
                'sub_domain' => 'Electronics, Mobile & Appliance Repair',
                'description' => 'Electronics Repair Technicians diagnose and repair electronic devices, circuit boards, power supplies, small appliances, and electronic systems.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'ITI Electronics Mechanic / Diploma Electronics / Repair Training',
                'stream' => 'Science / ITI / Engineering',
                'entrance_exams' => ['ITI Admission', 'Polytechnic Entrance', 'Skill Certifications'],
                'skills' => ['Circuit Testing', 'Soldering', 'Multimeter Use', 'Fault Diagnosis', 'Component Replacement'],
                'job_opportunities' => ['Electronics Service Centres', 'Manufacturing Units', 'Repair Shops', 'Appliance Companies'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/electronics-repair-technician.svg'
            ],
            [
                'slug' => 'ac-technician',
                'name' => 'AC Technician',
                'sub_domain' => 'Electronics, Mobile & Appliance Repair',
                'description' => 'AC Technicians install, service, repair, and maintain air conditioners, cooling systems, compressors, and HVAC units.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'Very High',
                'qualification' => 'ITI Refrigeration & AC Technician / HVAC Training',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Skill Certifications'],
                'skills' => ['AC Installation', 'Gas Charging', 'Compressor Testing', 'Fault Diagnosis', 'Safety Handling'],
                'job_opportunities' => ['HVAC Companies', 'Appliance Service Centres', 'Hotels', 'Malls', 'Hospitals'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/ac-technician.svg'
            ],
            [
                'slug' => 'refrigerator-technician',
                'name' => 'Refrigerator Technician',
                'sub_domain' => 'Electronics, Mobile & Appliance Repair',
                'description' => 'Refrigerator Technicians repair and maintain refrigerators, freezers, cooling systems, compressors, gas lines, and electrical controls.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'High',
                'qualification' => 'ITI Refrigeration & AC Technician / Appliance Repair Training',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['ITI Admission', 'Apprenticeship Training', 'Skill Certifications'],
                'skills' => ['Refrigeration Systems', 'Compressor Repair', 'Gas Charging', 'Electrical Testing', 'Customer Service'],
                'job_opportunities' => ['Appliance Service Centres', 'Electronics Companies', 'Cold Storage Units', 'Hotels'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/refrigerator-technician.svg'
            ],
            [
                'slug' => 'mobile-repair-technician',
                'name' => 'Mobile Repair Technician',
                'sub_domain' => 'Electronics, Mobile & Appliance Repair',
                'description' => 'Mobile Repair Technicians diagnose and repair smartphones, replace screens, batteries, charging ports, cameras, software issues, and circuit faults.',
                'salary_range' => '₹2L – ₹8L',
                'demand_level' => 'Very High',
                'qualification' => 'Mobile Repairing Course / Electronics Repair Training / ITI Electronics',
                'stream' => 'Any Stream / ITI',
                'entrance_exams' => ['Skill Certification Programs'],
                'skills' => ['Mobile Hardware Repair', 'Software Flashing', 'Soldering', 'Diagnosis', 'Customer Handling'],
                'job_opportunities' => ['Mobile Service Centres', 'Electronics Shops', 'Smartphone Brands', 'Repair Businesses'],
                'image' => 'images/careers/skill-trades-manufacturing-retail/mobile-repair-technician.svg'
            ]
        ];

        $futureScopeCommon = "Skill Trades, Manufacturing & Retail sectors are the backbone of any economy, offering stable careers with hands-on expertise and growing demand in infrastructure, automation, and consumer services.";

        foreach ($careers as $careerData) {
            $roadmap = [
                "Step 1: Complete basic schooling (8th/10th/12th) based on the trade.",
                "Step 2: Enroll in an ITI course, Diploma, or specialized Skill Training Program.",
                "Step 3: Clear trade tests or obtain mandatory skill certifications (e.g., AME, FSSAI, Skill India).",
                "Step 4: Gain practical experience through apprenticeships or entry-level roles in workshops or retail stores.",
                "Step 5: Master specialized tools and technologies (CNC, 3D printing, advanced diagnostic tools).",
                "Step 6: Advance to senior technician, supervisor, or entrepreneur by starting your own service center or boutique."
            ];

            Career::updateOrCreate(
                ['slug' => $careerData['slug']],
                array_merge($careerData, [
                    'field_id' => $field->id,
                    'roadmap' => $roadmap,
                    'future_scope' => $futureScopeCommon . "\n\nNote: This sector rewards practical expertise, reliability, and continuous skill upgrading."
                ])
            );
        }

        $this->command->info('Skill Trades, Manufacturing & Retail careers seeded successfully.');
    }
}
