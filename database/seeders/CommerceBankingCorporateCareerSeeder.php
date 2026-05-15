<?php

namespace Database\Seeders;

use App\Models\Career;
use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommerceBankingCorporateCareerSeeder extends Seeder
{
    public function run(): void
    {
        $field = Field::where('slug', 'commerce')->first();
        if (!$field) return;

        $careers = [
            [
                'title' => 'Business Development Executive',
                'domain' => 'Sales & Business Development',
                'short_info' => 'Business Development Executives identify new clients, build partnerships, generate leads, and help companies increase revenue.',
                'salary' => '₹3L – ₹9L',
                'demand' => 'High',
                'qualification' => 'BBA / B.Com / MBA preferred',
                'stream' => 'Commerce / Management',
                'exams' => ['CUET UG', 'CAT', 'MAT', 'CMAT for MBA'],
                'skills' => ['Communication', 'Sales', 'Negotiation', 'Market Research', 'Relationship Building'],
                'employers' => ['Startups', 'IT Companies', 'EdTech', 'Real Estate', 'Financial Services'],
                'image' => 'business-development-executive.svg'
            ],
            [
                'title' => 'Marketing Research Analyst',
                'domain' => 'Market Research & Analytics',
                'short_info' => 'Marketing Research Analysts study customer behavior, competitors, market trends, and business data to support marketing decisions.',
                'salary' => '₹4L – ₹12L',
                'demand' => 'High',
                'qualification' => 'BBA / B.Com / BA Economics / MBA Marketing',
                'stream' => 'Commerce / Arts / Management',
                'exams' => ['CUET UG', 'CAT', 'XAT', 'MAT', 'CMAT'],
                'skills' => ['Data Analysis', 'Survey Design', 'Consumer Research', 'Excel', 'Presentation'],
                'employers' => ['Market Research Firms', 'FMCG', 'Consulting Firms', 'Advertising Agencies'],
                'image' => 'marketing-research-analyst.svg'
            ],
            [
                'title' => 'Credit Analyst',
                'domain' => 'Banking & Credit',
                'short_info' => 'Credit Analysts assess loan applications, borrower risk, financial statements, and repayment capacity for banks and NBFCs.',
                'salary' => '₹4L – ₹12L',
                'demand' => 'High',
                'qualification' => 'B.Com / BBA / MBA Finance',
                'stream' => 'Commerce',
                'exams' => ['CUET UG', 'CAT/MBA exams', 'Banking exams'],
                'skills' => ['Financial Analysis', 'Risk Assessment', 'Accounting', 'Banking', 'Report Writing'],
                'employers' => ['Banks', 'NBFCs', 'Credit Rating Agencies', 'FinTech Companies'],
                'image' => 'credit-analyst.svg'
            ],
            [
                'title' => 'Wealth Manager',
                'domain' => 'Wealth, Investment & Insurance',
                'short_info' => 'Wealth Managers guide clients on investments, retirement planning, tax planning, insurance, and long-term wealth creation.',
                'salary' => '₹5L – ₹18L',
                'demand' => 'High',
                'qualification' => 'B.Com / BBA / MBA Finance',
                'stream' => 'Commerce / Management',
                'exams' => ['NISM certifications', 'MBA entrance exams'],
                'skills' => ['Investment Planning', 'Client Handling', 'Financial Products', 'Communication', 'Risk Profiling'],
                'employers' => ['Banks', 'Wealth Firms', 'Broking Firms', 'Private Banking', 'FinTech'],
                'image' => 'wealth-manager.svg'
            ],
            [
                'title' => 'Mutual Fund Advisor',
                'domain' => 'Wealth, Investment & Insurance',
                'short_info' => 'Mutual Fund Advisors help clients choose suitable mutual fund schemes based on goals, risk level, and investment horizon.',
                'salary' => '₹3L – ₹10L',
                'demand' => 'High',
                'qualification' => 'Graduation preferred',
                'stream' => 'Commerce / Any Stream',
                'exams' => ['NISM Mutual Fund Distributor Certification'],
                'skills' => ['Investment Knowledge', 'Client Counselling', 'Financial Planning', 'Communication', 'Ethics'],
                'employers' => ['AMCs', 'Banks', 'Financial Advisory Firms', 'Independent Practice'],
                'image' => 'mutual-fund-advisor.svg'
            ],
            [
                'title' => 'Insurance Underwriter',
                'domain' => 'Wealth, Investment & Insurance',
                'short_info' => 'Insurance Underwriters evaluate insurance applications and decide policy approval, premium, and risk coverage.',
                'salary' => '₹4L – ₹12L',
                'demand' => 'Stable',
                'qualification' => 'B.Com / BBA / MBA / Insurance certifications',
                'stream' => 'Commerce / Management',
                'exams' => ['IRDAI-related certifications', 'Insurance institute exams'],
                'skills' => ['Risk Analysis', 'Insurance Products', 'Documentation', 'Decision Making', 'Analytical Thinking'],
                'employers' => ['Insurance Companies', 'Reinsurance Firms', 'Banks', 'FinTech'],
                'image' => 'insurance-underwriter.svg'
            ],
            [
                'title' => 'Claims Adjuster',
                'domain' => 'Wealth, Investment & Insurance',
                'short_info' => 'Claims Adjusters investigate insurance claims, verify documents, assess loss, and recommend settlement amounts.',
                'salary' => '₹3L – ₹9L',
                'demand' => 'Stable',
                'qualification' => 'Graduation preferred',
                'stream' => 'Commerce / Any Stream',
                'exams' => ['Insurance certifications preferred'],
                'skills' => ['Investigation', 'Documentation', 'Customer Handling', 'Insurance Rules', 'Negotiation'],
                'employers' => ['Insurance Companies', 'Surveyor Firms', 'Third Party Administrators'],
                'image' => 'claims-adjuster.svg'
            ],
            [
                'title' => 'Internal Auditor',
                'domain' => 'Accounting, Audit & Taxation',
                'short_info' => 'Internal Auditors review company processes, financial controls, compliance, and risk systems to prevent errors and fraud.',
                'salary' => '₹4L – ₹14L',
                'demand' => 'High',
                'qualification' => 'B.Com / M.Com / CA Inter / MBA Finance',
                'stream' => 'Commerce',
                'exams' => ['CA Foundation', 'CMA', 'CIA certification optional'],
                'skills' => ['Auditing', 'Compliance', 'Accounting', 'Risk Control', 'Reporting'],
                'employers' => ['Corporates', 'Banks', 'Audit Firms', 'Consulting Firms', 'Manufacturing Companies'],
                'image' => 'internal-auditor.svg'
            ],
            [
                'title' => 'Forensic Accountant',
                'domain' => 'Accounting, Audit & Taxation',
                'short_info' => 'Forensic Accountants investigate financial fraud, accounting manipulation, money trails, and legal financial evidence.',
                'salary' => '₹5L – ₹18L',
                'demand' => 'Growing',
                'qualification' => 'B.Com / CA / CPA / Forensic Accounting certification',
                'stream' => 'Commerce',
                'exams' => ['CA Foundation', 'CPA', 'Forensic Accounting certifications'],
                'skills' => ['Fraud Investigation', 'Accounting', 'Legal Awareness', 'Data Analysis', 'Attention to Detail'],
                'employers' => ['Audit Firms', 'Investigation Agencies', 'Banks', 'Consulting Firms', 'Corporates'],
                'image' => 'forensic-accountant.svg'
            ],
            [
                'title' => 'Cost Accountant',
                'domain' => 'Accounting, Audit & Taxation',
                'short_info' => 'Cost Accountants analyse production costs, budgeting, pricing, cost control, and profitability for organizations.',
                'salary' => '₹4L – ₹15L',
                'demand' => 'High',
                'qualification' => 'B.Com / CMA',
                'stream' => 'Commerce',
                'exams' => ['CMA Foundation / Intermediate / Final'],
                'skills' => ['Costing', 'Budgeting', 'Accounting', 'Manufacturing Finance', 'Excel'],
                'employers' => ['Manufacturing', 'FMCG', 'Automobile', 'Pharma', 'Consulting Firms'],
                'image' => 'cost-accountant.svg'
            ],
            [
                'title' => 'Management Accountant',
                'domain' => 'Accounting, Audit & Taxation',
                'short_info' => 'Management Accountants prepare financial reports, budgets, forecasts, and performance analysis for business decisions.',
                'salary' => '₹5L – ₹16L',
                'demand' => 'High',
                'qualification' => 'B.Com / M.Com / CMA / MBA Finance',
                'stream' => 'Commerce',
                'exams' => ['CMA', 'MBA entrance exams'],
                'skills' => ['Budgeting', 'MIS Reporting', 'Cost Analysis', 'Forecasting', 'Business Strategy'],
                'employers' => ['Corporates', 'Manufacturing', 'IT Companies', 'Consulting Firms'],
                'image' => 'management-accountant.svg'
            ],
            [
                'title' => 'Payroll Manager',
                'domain' => 'Accounting, Audit & Taxation',
                'short_info' => 'Payroll Managers handle employee salary processing, statutory deductions, tax compliance, benefits, and payroll records.',
                'salary' => '₹4L – ₹12L',
                'demand' => 'Stable',
                'qualification' => 'B.Com / BBA / HR or Finance background',
                'stream' => 'Commerce / Management',
                'exams' => ['No mandatory entrance exam'],
                'skills' => ['Payroll Software', 'Tax Rules', 'Compliance', 'Excel', 'Accuracy'],
                'employers' => ['Corporates', 'HR Firms', 'Payroll Outsourcing Companies', 'IT Companies'],
                'image' => 'payroll-manager.svg'
            ],
            [
                'title' => 'Accounts Executive',
                'domain' => 'Accounting, Audit & Taxation',
                'short_info' => 'Accounts Executives maintain daily accounting records, invoices, payments, GST entries, and basic financial reports.',
                'salary' => '₹2.5L – ₹7L',
                'demand' => 'High',
                'qualification' => 'B.Com / M.Com / Tally / GST training',
                'stream' => 'Commerce',
                'exams' => ['No mandatory entrance exam'],
                'skills' => ['Accounting', 'Tally', 'GST', 'Excel', 'Invoice Management'],
                'employers' => ['SMEs', 'Corporates', 'CA Firms', 'Retail', 'Manufacturing'],
                'image' => 'accounts-executive.svg'
            ],
            [
                'title' => 'GST Consultant',
                'domain' => 'Accounting, Audit & Taxation',
                'short_info' => 'GST Consultants help businesses with GST registration, return filing, compliance, input tax credit, and notices.',
                'salary' => '₹3L – ₹12L',
                'demand' => 'High',
                'qualification' => 'B.Com / CA Inter / Taxation course',
                'stream' => 'Commerce',
                'exams' => ['GST certification courses', 'CA Foundation optional'],
                'skills' => ['GST Law', 'Tax Filing', 'Accounting', 'Client Handling', 'Compliance'],
                'employers' => ['CA Firms', 'Tax Consulting Firms', 'SMEs', 'Independent Practice'],
                'image' => 'gst-consultant.svg'
            ],
            [
                'title' => 'Financial Planner',
                'domain' => 'Wealth, Investment & Insurance',
                'short_info' => 'Financial Planners help people manage savings, insurance, retirement, tax planning, and investments based on life goals.',
                'salary' => '₹4L – ₹15L',
                'demand' => 'High',
                'qualification' => 'Graduation / CFP preferred / MBA Finance',
                'stream' => 'Commerce / Management',
                'exams' => ['CFP certification', 'NISM certifications'],
                'skills' => ['Goal Planning', 'Investment Products', 'Insurance', 'Tax Planning', 'Communication'],
                'employers' => ['Financial Planning Firms', 'Banks', 'Wealth Firms', 'Independent Practice'],
                'image' => 'financial-planner.svg'
            ],
            [
                'title' => 'Corporate Treasurer',
                'domain' => 'Corporate Finance & Treasury',
                'short_info' => 'Corporate Treasurers manage company cash flow, banking relationships, funding, liquidity, and financial risk.',
                'salary' => '₹8L – ₹25L',
                'demand' => 'High',
                'qualification' => 'B.Com / MBA Finance / CA / CFA preferred',
                'stream' => 'Commerce',
                'exams' => ['CAT/MBA exams', 'CFA optional'],
                'skills' => ['Cash Management', 'Treasury', 'Risk Management', 'Banking', 'Financial Strategy'],
                'employers' => ['Large Corporates', 'MNCs', 'Banks', 'Manufacturing', 'IT Companies'],
                'image' => 'corporate-treasurer.svg'
            ],
            [
                'title' => 'Budget Analyst',
                'domain' => 'Corporate Finance & Treasury',
                'short_info' => 'Budget Analysts prepare budgets, compare expenses, track financial performance, and help management control costs.',
                'salary' => '₹4L – ₹13L',
                'demand' => 'Stable',
                'qualification' => 'B.Com / BBA / MBA Finance / Economics',
                'stream' => 'Commerce / Economics',
                'exams' => ['CUET UG', 'MBA entrance exams'],
                'skills' => ['Budgeting', 'Forecasting', 'Excel', 'Financial Analysis', 'Reporting'],
                'employers' => ['Corporates', 'Government Projects', 'NGOs', 'Educational Institutions'],
                'image' => 'budget-analyst.svg'
            ],
            [
                'title' => 'Portfolio Manager',
                'domain' => 'Wealth, Investment & Insurance',
                'short_info' => 'Portfolio Managers manage investment portfolios across stocks, bonds, mutual funds, and other financial instruments.',
                'salary' => '₹7L – ₹30L',
                'demand' => 'High',
                'qualification' => 'B.Com / MBA Finance / CFA preferred',
                'stream' => 'Commerce / Finance',
                'exams' => ['CFA', 'NISM', 'MBA entrance exams'],
                'skills' => ['Investment Analysis', 'Risk Management', 'Market Research', 'Portfolio Strategy', 'Decision Making'],
                'employers' => ['PMS Firms', 'AMCs', 'Wealth Management Firms', 'Broking Houses'],
                'image' => 'portfolio-manager.svg'
            ],
            [
                'title' => 'Forex Dealer',
                'domain' => 'Corporate Finance & Treasury',
                'short_info' => 'Forex Dealers buy and sell foreign currencies, monitor exchange rates, and support international trade and treasury operations.',
                'salary' => '₹5L – ₹18L',
                'demand' => 'Stable',
                'qualification' => 'B.Com / MBA Finance / Treasury certification preferred',
                'stream' => 'Commerce / Finance',
                'exams' => ['Banking certifications', 'Treasury/Forex certifications'],
                'skills' => ['Currency Markets', 'Risk Management', 'Quick Decision Making', 'Banking', 'Global Economics'],
                'employers' => ['Banks', 'Treasury Departments', 'Export-Import Firms', 'Financial Institutions'],
                'image' => 'forex-dealer.svg'
            ],
            [
                'title' => 'Commodity Trader',
                'domain' => 'Wealth, Investment & Insurance',
                'short_info' => 'Commodity Traders trade products such as gold, crude oil, metals, and agricultural commodities in regulated markets.',
                'salary' => '₹4L – ₹20L',
                'demand' => 'Growing',
                'qualification' => 'Graduation / Finance or Economics preferred',
                'stream' => 'Commerce / Economics',
                'exams' => ['NISM certifications preferred'],
                'skills' => ['Market Analysis', 'Risk Management', 'Trading Platforms', 'Economics', 'Decision Making'],
                'employers' => ['Broking Firms', 'Commodity Exchanges', 'Trading Firms', 'Agri Commodity Firms'],
                'image' => 'commodity-trader.svg'
            ],
            [
                'title' => 'Mergers and Acquisitions Analyst',
                'domain' => 'Corporate Finance & Treasury',
                'short_info' => 'M&A Analysts support company mergers, acquisitions, valuations, financial modelling, due diligence, and deal research.',
                'salary' => '₹8L – ₹30L',
                'demand' => 'High',
                'qualification' => 'B.Com / MBA Finance / CA / CFA preferred',
                'stream' => 'Commerce / Finance',
                'exams' => ['CAT', 'CFA', 'CA Foundation optional'],
                'skills' => ['Valuation', 'Financial Modelling', 'Due Diligence', 'Excel', 'Research'],
                'employers' => ['Investment Banks', 'Consulting Firms', 'Corporate Finance Teams', 'Private Equity'],
                'image' => 'mergers-and-acquisitions-analyst.svg'
            ],
            [
                'title' => 'Business Analyst',
                'domain' => 'Business Operations & Strategy',
                'short_info' => 'Business Analysts study business problems, gather requirements, analyse processes, and suggest improvements using data.',
                'salary' => '₹5L – ₹16L',
                'demand' => 'Very High',
                'qualification' => 'BBA / B.Com / Engineering / MBA / Analytics certification',
                'stream' => 'Commerce / Management / IT',
                'exams' => ['MBA entrance exams', 'Analytics certifications'],
                'skills' => ['Requirement Analysis', 'Data Analysis', 'Communication', 'Problem Solving', 'Documentation'],
                'employers' => ['IT Companies', 'Consulting Firms', 'Banks', 'Startups', 'Product Companies'],
                'image' => 'business-analyst.svg'
            ],
            [
                'title' => 'Operations Analyst',
                'domain' => 'Business Operations & Strategy',
                'short_info' => 'Operations Analysts examine workflows, productivity, costs, and service quality to improve business operations.',
                'salary' => '₹4L – ₹12L',
                'demand' => 'High',
                'qualification' => 'BBA / B.Com / MBA Operations',
                'stream' => 'Commerce / Management',
                'exams' => ['CAT', 'MAT', 'CMAT for MBA'],
                'skills' => ['Process Analysis', 'Excel', 'Reporting', 'Problem Solving', 'Operations Management'],
                'employers' => ['E-commerce', 'Logistics', 'Banks', 'IT Services', 'Manufacturing'],
                'image' => 'operations-analyst.svg'
            ],
            [
                'title' => 'Customer Success Manager',
                'domain' => 'E-commerce & Customer Growth',
                'short_info' => 'Customer Success Managers help customers get value from a product or service and improve retention and satisfaction.',
                'salary' => '₹5L – ₹18L',
                'demand' => 'High',
                'qualification' => 'BBA / B.Com / MBA preferred',
                'stream' => 'Commerce / Management',
                'exams' => ['No mandatory entrance exam'],
                'skills' => ['Communication', 'Relationship Management', 'Product Knowledge', 'Problem Solving', 'Customer Support'],
                'employers' => ['SaaS Companies', 'EdTech', 'FinTech', 'IT Products', 'Startups'],
                'image' => 'customer-success-manager.svg'
            ],
            [
                'title' => 'E-commerce Manager',
                'domain' => 'E-commerce & Customer Growth',
                'short_info' => 'E-commerce Managers handle online sales, product listings, digital campaigns, marketplace operations, and customer experience.',
                'salary' => '₹4L – ₹15L',
                'demand' => 'Very High',
                'qualification' => 'BBA / B.Com / MBA / Digital Marketing course',
                'stream' => 'Commerce / Management',
                'exams' => ['Digital marketing certifications', 'MBA entrance exams'],
                'skills' => ['Online Selling', 'Digital Marketing', 'Marketplace Management', 'Analytics', 'Inventory Coordination'],
                'employers' => ['E-commerce Companies', 'D2C Brands', 'Retail', 'Startups'],
                'image' => 'e-commerce-manager.svg'
            ],
            [
                'title' => 'Product Manager',
                'domain' => 'Product, Project & Procurement',
                'short_info' => 'Product Managers define product vision, user needs, business goals, features, and coordinate teams to build successful products.',
                'salary' => '₹8L – ₹30L',
                'demand' => 'Very High',
                'qualification' => 'BBA / MBA / Engineering / Product Management certification',
                'stream' => 'Management / Commerce / IT',
                'exams' => ['CAT', 'GMAT', 'Product certifications'],
                'skills' => ['Product Strategy', 'User Research', 'Business Thinking', 'Communication', 'Analytics'],
                'employers' => ['IT Product Companies', 'FinTech', 'EdTech', 'E-commerce', 'Startups'],
                'image' => 'product-manager.svg'
            ],
            [
                'title' => 'Project Manager',
                'domain' => 'Product, Project & Procurement',
                'short_info' => 'Project Managers plan, execute, monitor, and deliver projects on time, within budget, and according to business goals.',
                'salary' => '₹7L – ₹25L',
                'demand' => 'High',
                'qualification' => 'Graduation + project management experience / MBA preferred',
                'stream' => 'Any Stream / Management',
                'exams' => ['PMP', 'PRINCE2', 'MBA entrance exams optional'],
                'skills' => ['Planning', 'Team Management', 'Risk Management', 'Communication', 'Budget Control'],
                'employers' => ['IT', 'Construction', 'Consulting', 'Manufacturing', 'Startups', 'NGOs'],
                'image' => 'project-manager.svg'
            ],
            [
                'title' => 'Procurement Manager',
                'domain' => 'Product, Project & Procurement',
                'short_info' => 'Procurement Managers source goods and services, negotiate with vendors, control purchase costs, and manage supplier relationships.',
                'salary' => '₹5L – ₹18L',
                'demand' => 'High',
                'qualification' => 'B.Com / BBA / MBA Supply Chain',
                'stream' => 'Commerce / Management',
                'exams' => ['MBA entrance exams', 'Supply chain certifications'],
                'skills' => ['Negotiation', 'Vendor Management', 'Cost Control', 'Supply Chain', 'Documentation'],
                'employers' => ['Manufacturing', 'Retail', 'E-commerce', 'Pharma', 'Automobile'],
                'image' => 'procurement-manager.svg'
            ],
            [
                'title' => 'Export Import Manager',
                'domain' => 'International Trade & Supply Chain Finance',
                'short_info' => 'Export Import Managers handle international trade documentation, customs coordination, logistics, payments, and compliance.',
                'salary' => '₹4L – ₹16L',
                'demand' => 'High',
                'qualification' => 'B.Com / BBA / MBA International Business',
                'stream' => 'Commerce / Management',
                'exams' => ['MBA entrance exams', 'Export-import certification courses'],
                'skills' => ['International Trade', 'Documentation', 'Customs Knowledge', 'Logistics', 'Communication'],
                'employers' => ['Export Houses', 'Import Firms', 'Logistics Companies', 'Manufacturing', 'Trading Firms'],
                'image' => 'export-import-manager.svg'
            ],
            [
                'title' => 'Supply Chain Finance Analyst',
                'domain' => 'International Trade & Supply Chain Finance',
                'short_info' => 'Supply Chain Finance Analysts manage vendor payments, working capital, inventory finance, cost tracking, and supply-chain financial data.',
                'salary' => '₹5L – ₹18L',
                'demand' => 'Growing',
                'qualification' => 'B.Com / MBA Finance / Supply Chain certification',
                'stream' => 'Commerce / Finance / Management',
                'exams' => ['MBA entrance exams', 'Finance certifications'],
                'skills' => ['Financial Analysis', 'Supply Chain', 'Working Capital', 'Excel', 'Vendor Finance'],
                'employers' => ['Banks', 'NBFCs', 'Manufacturing', 'E-commerce', 'Logistics', 'FinTech'],
                'image' => 'supply-chain-finance-analyst.svg'
            ],
        ];

        foreach ($careers as $c) {
            $slug = Str::slug($c['title']);
            
            Career::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $c['title'],
                    'field_id' => $field->id,
                    'sub_domain' => $c['domain'],
                    'description' => $c['short_info'],
                    'salary_range' => $c['salary'],
                    'demand_level' => $c['demand'],
                    'qualification' => $c['qualification'],
                    'stream' => $c['stream'],
                    'skills' => $c['skills'],
                    'entrance_exams' => $c['exams'],
                    'image' => '/images/careers/commerce-banking-corporate/' . $c['image'],
                    'roadmap' => [
                        'Step 1: Complete 10+2 preferably in Commerce, Arts, or relevant stream',
                        'Step 2: Pursue B.Com / BBA / BA Economics / relevant graduation',
                        'Step 3: Learn Excel, communication, finance basics, accounting, analytics, or sales skills based on the career',
                        'Step 4: Complete relevant certification or entrance exam if required',
                        'Step 5: Gain practical experience through internship, trainee role, project work, or freelancing',
                        'Step 6: Grow into senior analyst, manager, consultant, or leadership roles'
                    ],
                    'future_scope' => 'The future for ' . $c['title'] . ' is very promising with the growth of corporate sectors and global trade.',
                    'job_opportunities' => $c['employers'],
                    'related_careers' => ['Financial Analyst', 'Business Consultant', 'Manager'],
                    'icon' => 'fa-briefcase'
                ]
            );
        }
    }
}
