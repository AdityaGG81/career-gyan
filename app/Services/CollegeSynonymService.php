<?php

namespace App\Services;

class CollegeSynonymService
{
    /**
     * Comprehensive dictionary of college acronyms, short forms, old names,
     * and search synonyms mapped to their canonical full names & search terms.
     */
    protected static array $synonyms = [
        // ─── MAHARASHTRA ENGINEERING COLLEGES ───
        'coep' => [
            'COEP Technological University',
            'COEP',
        ],
        'coep tech' => [
            'COEP Technological University',
        ],
        'vjti' => [
            'Veermata Jijabai Technological Institute',
            'VJTI',
            'Victoria Jubilee Technical Institute',
            'Veermata Jijabai Technological Institute(VJTI), Matunga, Mumbai',
        ],
        'pict' => [
            'Pune Institute of Computer Technology',
            'PICT',
            'Society for Computer Technology & Research\'s Pune Institute of Computer Technology',
            'PICT School of Technology and Management',
        ],
        'spit' => [
            'Sardar Patel Institute of Technology',
            'SPIT',
            'Bharatiya Vidya Bhavan\'s Sardar Patel Institute of Technology',
        ],
        'spce' => [
            'Sardar Patel College of Engineering',
            'SPCE',
            'Bharatiya Vidya Bhavan\'s Sardar Patel College of Engineering',
        ],
        'pccoe' => [
            'Pimpri Chinchwad College of Engineering',
            'PCCOE',
            'Pimpri Chinchwad Education Trust, Pimpri Chinchwad College of Engineering, Pune',
            'PCET PCCOE',
        ],
        'pccoer' => [
            'Pimpri Chinchwad College of Engineering and Research',
            'PCCOER',
            'PCET Ravet',
            'Pimpri Chinchwad Education Trust\'s Pimpri Chinchwad College Of Engineering And Research, Ravet',
        ],
        'dj sanghvi' => [
            'Dwarkadas J. Sanghvi College of Engineering',
            'D. J. Sanghvi',
            'DJSCE',
            'Shri Vile Parle Kelvani Mandal\'s Dwarkadas J. Sanghvi College of Engineering',
        ],
        'djsce' => [
            'Dwarkadas J. Sanghvi College of Engineering',
            'DJSCE',
            'DJ Sanghvi',
            'Shri Vile Parle Kelvani Mandal\'s Dwarkadas J. Sanghvi College of Engineering',
        ],
        'vit pune' => [
            'Vishwakarma Institute of Technology',
            'VIT Pune',
            'Bansilal Ramnath Agarwal Charitable Trust\'s Vishwakarma Institute of Technology, Bibwewadi, Pune',
        ],
        'viit' => [
            'Vishwakarma Institute of Information Technology',
            'VIIT',
            'VIIT Pune',
            'Vishwakarma Institute of Information Technology, Kondhwa (Bk.), Pune',
        ],
        'viit pune' => [
            'Vishwakarma Institute of Information Technology',
            'VIIT',
            'Vishwakarma Institute of Information Technology, Kondhwa (Bk.), Pune',
        ],
        'walchand' => [
            'Walchand College of Engineering',
            'WCE',
            'Walchand College of Engineering, Sangli',
            'WCE Sangli',
        ],
        'wce' => [
            'Walchand College of Engineering',
            'WCE',
            'Walchand College of Engineering, Sangli',
            'WCE Sangli',
        ],
        'wce sangli' => [
            'Walchand College of Engineering',
            'Walchand College of Engineering, Sangli',
        ],
        'cummins' => [
            'Cummins College of Engineering for Women',
            'MKSSS Cummins College',
            'CCOEW',
            'MKSSS\'s Cummins College of Engineering for Women, Karvenagar,Pune',
        ],
        'ccoew' => [
            'Cummins College of Engineering for Women',
            'MKSSS\'s Cummins College of Engineering for Women, Karvenagar,Pune',
        ],
        'aissms' => [
            'All India Shri Shivaji Memorial Society',
            'AISSMS College of Engineering',
            'AISSMS Institute of Information Technology',
            'All India Shri Shivaji Memorial Society\'s College of Engineering, Pune',
        ],
        'aissms coe' => [
            'All India Shri Shivaji Memorial Society\'s College of Engineering, Pune',
            'AISSMS College of Engineering',
        ],
        'aissms ioit' => [
            'All India Shri Shivaji Memorial Society\'s Institute of Information Technology,Pune',
            'AISSMS Institute of Information Technology',
        ],
        'sinhgad' => [
            'Sinhgad College of Engineering',
            'Sinhgad Technical Education Society',
            'SCOE',
            'SKNCOE',
            'Sinhgad College of Engineering, Vadgaon (BK), Pune',
        ],
        'scoe' => [
            'Sinhgad College of Engineering',
            'SCOE',
            'Sinhgad College of Engineering, Vadgaon (BK), Pune',
        ],
        'skncoe' => [
            'Smt. Kashibai Navale College of Engineering',
            'SKNCOE',
            'Sinhgad Technical Education Society\'s Smt. Kashibai Navale College of Engineering,Vadgaon,Pune',
        ],
        'dy patil' => [
            'D.Y. Patil',
            'DY Patil',
            'Dr. D. Y. Patil College of Engineering',
            'Dr. D. Y. Patil Pratishthan\'s D.Y.Patil College of Engineering Akurdi, Pune',
            'Dr. D. Y. Patil Institute of Technology, Pimpri, Pune',
        ],
        'dypcoe' => [
            'Dr. D. Y. Patil Pratishthan\'s D.Y.Patil College of Engineering Akurdi, Pune',
            'DY Patil Akurdi',
            'D.Y.Patil College of Engineering Akurdi',
        ],
        'dypiet' => [
            'Dr. D. Y. Patil Institute of Technology, Pimpri, Pune',
            'DY Patil Pimpri',
            'Dr. D. Y. Patil Unitech Society\'s Dr. D. Y. Patil Institute of Technology',
        ],
        'dypiemr' => [
            'Dr. D. Y. Patil Institute of Engineering, Management & Reseach, Akurdi, Pune',
            'DYPIEMR',
        ],
        'rait' => [
            'Ramrao Adik Institute of Technology',
            'RAIT',
            'Ramrao Adik Education Society\'s Ramrao Adik Institute of Technology, Nerul, Navi Mumbai',
            'DY Patil Navi Mumbai',
        ],
        'vesit' => [
            'Vivekanand Education Society\'s Institute of Technology',
            'VESIT',
            'Vivekanand College of Engineering Mumbai',
            'Vivekanand Education Society\'s Institute of Technology, Chembur, Mumbai',
        ],
        'kj somaiya' => [
            'K. J. Somaiya College of Engineering',
            'KJ Somaiya',
            'KJSCE',
            'K.J. Somaiya College of Engineering, Vidyavihar, Mumbai',
        ],
        'kjsce' => [
            'K. J. Somaiya College of Engineering',
            'KJSCE',
            'KJ Somaiya',
            'K.J. Somaiya College of Engineering, Vidyavihar, Mumbai',
        ],
        'kjsieit' => [
            'K. J. Somaiya Institute of Engineering and Information Technology, Sion, Mumbai',
            'KJSIEIT',
            'Somaiya Sion',
        ],
        'fr agnel' => [
            'Father Agnel',
            'Fr. Conceicao Rodrigues College of Engineering',
            'Fr. Conceicao Rodrigues Institute of Technology',
            'CRCE Bandra',
            'FCRIT Vashi',
        ],
        'crce' => [
            'Fr. Conceicao Rodrigues College of Engineering, Bandra,Mumbai',
            'CRCE',
            'Fr Agnel Bandra',
        ],
        'fcrit' => [
            'Father Agnel College of Engineering, Vashi, Navi Mumbai',
            'FCRIT',
            'Fr Agnel Vashi',
        ],
        'tcet' => [
            'Thakur College of Engineering and Technology',
            'TCET',
            'TCET Mumbai',
            'Thakur College of Engineering and Technology, Kandivali, Mumbai',
        ],
        'thakur' => [
            'Thakur College of Engineering and Technology',
            'TCET',
            'Thakur College of Engineering and Technology, Kandivali, Mumbai',
        ],
        'dbit' => [
            'Don Bosco Institute of Technology',
            'DBIT',
            'Don Bosco Institute of Technology, Premier Automobiles Road, Kurla (w), Mumbai',
        ],
        'don bosco' => [
            'Don Bosco Institute of Technology',
            'DBIT',
            'Don Bosco Kurla',
        ],
        'atharva' => [
            'Atharva College of Engineering',
            'Atharva College of Engineering,Malad(West),Mumbai',
        ],
        'sakec' => [
            'Shah & Anchor Kutchhi Engineering College',
            'Shah and Anchor',
            'SAKEC',
            'Mahavir Education Trust\'s Shah & Anchor Kutchhi Engineering College, Chembur, Mumbai',
        ],
        'shah and anchor' => [
            'Shah & Anchor Kutchhi Engineering College',
            'SAKEC',
            'Mahavir Education Trust\'s Shah & Anchor Kutchhi Engineering College, Chembur, Mumbai',
        ],
        'sies gst' => [
            'SIES Graduate School of Technology',
            'SIES GST',
            'SIES Nerul',
            'SIES Graduate School of Technology, Nerul, Navi Mumbai',
        ],
        'sies' => [
            'SIES Graduate School of Technology',
            'SIES GST',
            'SIES College of Arts, Science and Commerce',
            'SIES Graduate School of Technology, Nerul, Navi Mumbai',
        ],
        'mit aoe' => [
            'MIT Academy of Engineering',
            'MIT AOE',
            'MIT Alandi',
            'MIT Academy of Engineering,Alandi, Pune',
        ],
        'mit alandi' => [
            'MIT Academy of Engineering,Alandi, Pune',
            'MIT AOE',
        ],
        'mit kothrud' => [
            'MAEER\'s M.I.T. College of Engineering , Kothrud, Pune',
            'MIT World Peace University',
            'MIT WPU',
        ],
        'mit wpu' => [
            'MIT World Peace University',
            'MIT WPU',
            'MAEER\'s M.I.T. College of Engineering , Kothrud, Pune',
        ],
        'pvg' => [
            'Pune Vidyarthi Griha\'s College of Engineering',
            'PVG',
            'PVGCOET',
            'Pune Vidyarthi Griha\'s College of Engineering and Technology, Pune',
        ],
        'pvgcoet' => [
            'Pune Vidyarthi Griha\'s College of Engineering and Technology, Pune',
            'PVG COET',
        ],
        'zeal' => [
            'Zeal College of Engineering & Research',
            'Zeal Education Society',
            'ZCOER',
            'Zeal Education Society\'s Zeal College of Engineering & Reserch, Narhe, Pune',
        ],
        'zcoer' => [
            'Zeal College of Engineering & Research',
            'ZCOER',
            'Zeal Education Society\'s Zeal College of Engineering & Reserch, Narhe, Pune',
        ],
        'jspm' => [
            'Jaywant Shikshan Prasarak Mandal',
            'JSPM Rajarshi Shahu College of Engineering',
            'JSPM Jaywantrao Sawant College of Engineering',
            'JSPM Imperial College of Engineering',
        ],
        'rscoe' => [
            'Rajarshi Shahu College of Engineering',
            'RSCOE',
            'Jaywant Shikshan Prasarak Mandal\'s,Rajarshi Shahu College of Engineering, Tathawade, Pune',
        ],
        'tssm' => [
            'TSSM\'s Bhivarabai Sawant College of Engineering and Research, Narhe, Pune',
            'BSCOER',
        ],
        'bscoer' => [
            'TSSM\'s Bhivarabai Sawant College of Engineering and Research, Narhe, Pune',
            'BSCOER',
        ],
        'alard' => [
            'Alard College of Engineering and Management',
            'Alard Charitable Trust\'s Alard College of Engineering and Management, Pune',
        ],
        'nutan' => [
            'Nutan Maharashtra Institute of Engineering & Technology',
            'Nutan College of Engineering and Research',
            'NMIET',
            'NCER',
        ],
        'ncer' => [
            'Nutan College of Engineering and Research',
            'NCER Talegaon',
        ],
        'nmiet' => [
            'Nutan Maharashtra Institute of Engineering &Technology, Talegaon station, Pune',
            'NMIET',
        ],
        'pes modern' => [
            'Progressive Education Society\'s Modern College of Engineering, Pune',
            'Modern College of Engineering',
            'PES MCOE',
        ],
        'mcoe' => [
            'Progressive Education Society\'s Modern College of Engineering, Pune',
            'Modern College of Engineering',
        ],
        'wadia' => [
            'Modern Education Society\'s Wadia College of Engineering, Pune',
            'MESCOE',
            'Wadia College Pune',
        ],
        'mescoe' => [
            'Modern Education Society\'s Wadia College of Engineering, Pune',
            'MESCOE',
        ],
        'kk wagh' => [
            'K. K. Wagh Institute of Engineering Education and Research',
            'KK Wagh Nashik',
            'KKWIEER',
        ],
        'kkwieer' => [
            'K. K. Wagh Institute of Engineering Education and Research',
            'KKWIEER',
        ],
        'sandip' => [
            'Sandip Institute of Technology and Research Centre',
            'Sandip Foundation',
            'SITRC Nashik',
        ],
        'sitrc' => [
            'Sandip Institute of Technology and Research Centre',
            'SITRC',
        ],
        'met bkc' => [
            'MET\'s Institute of Engineering, Bhujbal Knowledge City, Nashik',
            'MET Nashik',
        ],
        'gcek' => [
            'Government College of Engineering, Karad',
            'GCE Karad',
            'GCOEK',
        ],
        'gcoek' => [
            'Government College of Engineering, Karad',
            'GCE Karad',
        ],
        'gce karad' => [
            'Government College of Engineering, Karad',
            'GCOEK',
        ],
        'geca' => [
            'Government College of Engineering, Aurangabad',
            'GECA',
            'GCOEA',
            'GCE Sambhajinagar',
            'Government College of Engineering, Chhatrapati Sambhajinagar',
        ],
        'gcoea' => [
            'Government College of Engineering, Aurangabad',
            'Government College of Engineering, Amravati',
        ],
        'gce aurangabad' => [
            'Government College of Engineering, Aurangabad',
            'Government College of Engineering, Chhatrapati Sambhajinagar',
            'GECA',
        ],
        'gce amravati' => [
            'Government College of Engineering, Amravati',
            'GCOEA Amravati',
        ],
        'gcoej' => [
            'Government College of Engineering, Jalgaon',
            'GCE Jalgaon',
        ],
        'gce jalgaon' => [
            'Government College of Engineering, Jalgaon',
            'GCOEJ',
        ],
        'gcoec' => [
            'Government College of Engineering, Chandrapur',
            'GCE Chandrapur',
        ],
        'gce chandrapur' => [
            'Government College of Engineering, Chandrapur',
            'GCOEC',
        ],
        'gcoey' => [
            'Government College of Engineering, Yavatmal',
            'GCE Yavatmal',
        ],
        'gce yavatmal' => [
            'Government College of Engineering, Yavatmal',
            'GCOEY',
        ],
        'sggs' => [
            'Shri Guru Gobind Singhji Institute of Engineering and Technology, Nanded',
            'SGGS Nanded',
            'SGGSIE&T',
        ],
        'sggsie&t' => [
            'Shri Guru Gobind Singhji Institute of Engineering and Technology, Nanded',
            'SGGS Nanded',
        ],
        'rcoem' => [
            'Shri Ramdeobaba College of Engineering and Management, Nagpur',
            'Ramdeobaba University',
            'RCOEM Nagpur',
        ],
        'ramdeobaba' => [
            'Shri Ramdeobaba College of Engineering and Management, Nagpur',
            'RCOEM',
        ],
        'ycce' => [
            'Yeshwantrao Chavan College of Engineering, Nagpur',
            'YCCE',
            'YCCE Nagpur',
        ],
        'vnit' => [
            'Visvesvaraya National Institute of Technology, Nagpur',
            'VNIT',
            'VNIT Nagpur',
        ],
        'vnit nagpur' => [
            'Visvesvaraya National Institute of Technology, Nagpur',
            'VNIT',
        ],
        'iitb' => [
            'Indian Institute of Technology Bombay',
            'IIT Bombay',
            'IIT Powai',
        ],
        'iit bombay' => [
            'Indian Institute of Technology Bombay',
            'IIT Bombay',
            'IITB',
        ],
        'ict' => [
            'Institute of Chemical Technology, Matunga, Mumbai',
            'ICT Mumbai',
            'UDCT',
            'University Department of Chemical Technology',
        ],
        'ict mumbai' => [
            'Institute of Chemical Technology, Matunga, Mumbai',
            'UDCT',
        ],
        'udct' => [
            'Institute of Chemical Technology, Matunga, Mumbai',
            'ICT Mumbai',
        ],
        'tsec' => [
            'Thadomal Shahani Engineering College, Bandra, Mumbai',
            'TSEC',
            'Thadomal Shahani',
        ],
        'thadomal' => [
            'Thadomal Shahani Engineering College, Bandra, Mumbai',
            'TSEC',
        ],
        'vcet' => [
            'Vidyavardhini\'s College of Engineering and Technology, Vasai',
            'VCET Vasai',
            'Vartak College',
        ],
        'vartak' => [
            'Vidyavardhini\'s College of Engineering and Technology, Vasai',
            'VCET',
        ],
        'xie' => [
            'Xavier Institute of Engineering, Mahim, Mumbai',
            'XIE Mumbai',
            'Xavier Engineering',
        ],
        'dmce' => [
            'Datta Meghe College of Engineering, Airoli, Navi Mumbai',
            'DMCE',
        ],
        'datta meghe' => [
            'Datta Meghe College of Engineering, Airoli, Navi Mumbai',
            'DMCE',
            'Datta Meghe Institute of Engineering, Wardha',
        ],
        'terna' => [
            'Terna Engineering College, Nerul, Navi Mumbai',
        ],
        'pillai' => [
            'Pillai College of Engineering, New Panvel',
            'Mahatma Education Society\'s Pillai College of Engineering',
            'PCE Panvel',
        ],
        'pce panvel' => [
            'Pillai College of Engineering, New Panvel',
            'PCE',
        ],
        'gh raisoni' => [
            'G. H. Raisoni College of Engineering',
            'G.H.Raisoni College of Engineering & Management, Wagholi, Pune',
            'Ankush Shikshan Sanstha\'s G.H.Raisoni College of Engineering, Nagpur',
            'GHRCEM Pune',
            'GHRCE Nagpur',
        ],
        'raisoni' => [
            'G. H. Raisoni College of Engineering',
            'G.H.Raisoni College of Engineering & Management, Wagholi, Pune',
            'Ankush Shikshan Sanstha\'s G.H.Raisoni College of Engineering, Nagpur',
        ],
        'ghrcem' => [
            'G.H.Raisoni College of Engineering & Management, Wagholi, Pune',
            'GHRCEM',
        ],
        'dkte' => [
            'DKTE Society\'s Textile and Engineering Institute, Ichalkaranji',
            'DKTE Ichalkaranji',
        ],
        'kit kolhapur' => [
            'Kolhapur Institute of Technology\'s College of Engineering, Kolhapur',
            'KITCOEK',
        ],
        'rit islampur' => [
            'Kasegaon Education Society\'s Rajarambapu Institute of Technology, Rajaramnagar, Sangli',
            'RIT Rajaramnagar',
            'RIT Islampur',
        ],
        'adcet' => [
            'Annasaheb Dange College of Engineering and Technology, Ashta, Sangli',
            'ADCET Ashta',
        ],

        // ─── MEDICAL COLLEGES ───
        'aiims' => [
            'All India Institute of Medical Sciences',
            'AIIMS New Delhi',
            'AIIMS Nagpur',
            'AIIMS Bhopal',
            'AIIMS Rishikesh',
            'AIIMS Jodhpur',
        ],
        'aiims nagpur' => [
            'All India Institute of Medical Sciences Nagpur',
            'AIIMS Nagpur',
        ],
        'kem' => [
            'King Edward Memorial Hospital and Seth Gordhandas Sunderdas Medical College, Mumbai',
            'KEM Hospital',
            'GSMC Mumbai',
            'Seth GS Medical College',
        ],
        'gsmc' => [
            'Seth Gordhandas Sunderdas Medical College, Mumbai',
            'GSMC',
            'KEM Mumbai',
        ],
        'ltmmc' => [
            'Lokmanya Tilak Municipal Medical College, Sion, Mumbai',
            'LTMMC',
            'Sion Hospital',
        ],
        'sion hospital' => [
            'Lokmanya Tilak Municipal Medical College, Sion, Mumbai',
            'LTMMC',
        ],
        'tnmc' => [
            'Topiwala National Medical College and BYL Nair Charitable Hospital, Mumbai',
            'TNMC',
            'Nair Hospital',
        ],
        'nair hospital' => [
            'Topiwala National Medical College and BYL Nair Charitable Hospital, Mumbai',
            'TNMC',
        ],
        'grant medical' => [
            'Grant Government Medical College and Sir JJ Group of Hospitals, Mumbai',
            'Grant Medical College',
            'JJ Hospital',
        ],
        'jj hospital' => [
            'Grant Government Medical College and Sir JJ Group of Hospitals, Mumbai',
            'Grant Medical College',
        ],
        'bjmc' => [
            'B. J. Government Medical College, Pune',
            'BJMC Pune',
            'BJ Medical College',
            'Sassoon Hospital',
        ],
        'bj medical' => [
            'B. J. Government Medical College, Pune',
            'BJMC',
        ],
        'afmc' => [
            'Armed Forces Medical College, Pune',
            'AFMC',
            'AFMC Pune',
        ],
        'gmc nagpur' => [
            'Government Medical College, Nagpur',
            'GMC Nagpur',
        ],
        'gmc aurangabad' => [
            'Government Medical College, Aurangabad',
            'Government Medical College, Chhatrapati Sambhajinagar',
            'GMC Sambhajinagar',
        ],
        'gmc miraj' => [
            'Government Medical College, Miraj',
            'GMC Miraj',
        ],
        'gmc nanded' => [
            'Dr. Shankarrao Chavan Government Medical College, Nanded',
            'GMC Nanded',
        ],

        // ─── MANAGEMENT / MBA COLLEGES ───
        'jbims' => [
            'Jamnalal Bajaj Institute of Management Studies, Mumbai',
            'JBIMS',
            'Jamnalal Bajaj',
        ],
        'simsree' => [
            'Sydenham Institute of Management Studies, Research and Entrepreneurship Education, Mumbai',
            'SIMSREE',
            'Sydenham MBA',
        ],
        'pumba' => [
            'Department of Management Sciences, Savitribai Phule Pune University',
            'PUMBA',
            'Pune University MBA',
        ],
        'welingkar' => [
            'Prin. L. N. Welingkar Institute of Management Development & Research, Mumbai',
            'Welingkar',
            'WeSchool',
        ],
        'weschool' => [
            'Prin. L. N. Welingkar Institute of Management Development & Research, Mumbai',
            'Welingkar',
        ],
        'sibm' => [
            'Symbiosis Institute of Business Management, Pune',
            'SIBM Pune',
        ],
        'scmhrd' => [
            'Symbiosis Centre for Management and Human Resource Development, Pune',
            'SCMHRD Pune',
        ],
        'iim mumbai' => [
            'Indian Institute of Management Mumbai',
            'IIM Mumbai',
            'National Institute of Industrial Engineering',
            'NITIE Mumbai',
        ],
        'nitie' => [
            'Indian Institute of Management Mumbai',
            'NITIE',
            'National Institute of Industrial Engineering',
            'IIM Mumbai',
        ],
        'iim nagpur' => [
            'Indian Institute of Management Nagpur',
            'IIM Nagpur',
        ],

        // ─── LAW COLLEGES ───
        'glc mumbai' => [
            'Government Law College, Mumbai',
            'GLC Mumbai',
            'Government Law College Churchgate',
        ],
        'glc' => [
            'Government Law College, Mumbai',
            'GLC Mumbai',
        ],
        'ils' => [
            'ILS Law College, Pune',
            'Indian Law Society\'s Law College',
            'ILS Pune',
        ],
        'ils law' => [
            'ILS Law College, Pune',
            'ILS Pune',
        ],
        'mnlu mumbai' => [
            'Maharashtra National Law University Mumbai',
            'MNLU Mumbai',
        ],
        'mnlu nagpur' => [
            'Maharashtra National Law University Nagpur',
            'MNLU Nagpur',
        ],
        'mnlu aurangabad' => [
            'Maharashtra National Law University Aurangabad',
            'MNLU Aurangabad',
        ],

        // ─── COMMERCE, ARTS & SCIENCE COLLEGES ───
        'fergusson' => [
            'Fergusson College, Pune',
            'FC Pune',
            'Deccan Education Society\'s Fergusson College',
        ],
        'fc pune' => [
            'Fergusson College, Pune',
            'Fergusson',
        ],
        'bmcc' => [
            'Brihan Maharashtra College of Commerce, Pune',
            'BMCC',
            'BMCC Pune',
        ],
        'sp college' => [
            'Sir Parashurambhau College, Pune',
            'SP College Pune',
            'Shikshana Prasaraka Mandali\'s Sir Parashurambhau College',
        ],
        'ness wadia' => [
            'Ness Wadia College of Commerce, Pune',
            'Wadia Commerce',
        ],
        'st xavier' => [
            'St. Xavier\'s College, Mumbai',
            'St Xaviers Mumbai',
        ],
        'st xaviers' => [
            'St. Xavier\'s College, Mumbai',
            'St Xaviers Mumbai',
        ],
        'mithibai' => [
            'Mithibai College of Arts, Chauhan Institute of Science & Amrutben Jivanlal College of Commerce, Vile Parle, Mumbai',
            'Mithibai College',
        ],
        'nm college' => [
            'Narsee Monjee College of Commerce and Economics, Vile Parle, Mumbai',
            'NM College',
        ],
        'podar' => [
            'R. A. Podar College of Commerce and Economics, Matunga, Mumbai',
            'RA Podar College',
        ],
        'hr college' => [
            'H. R. College of Commerce and Economics, Churchgate, Mumbai',
            'HR College',
        ],
        'kc college' => [
            'Kishinchand Chellaram College, Churchgate, Mumbai',
            'KC College Mumbai',
        ],
        'jai hind' => [
            'Jai Hind College, Churchgate, Mumbai',
        ],
        'ruia' => [
            'Ramnarain Ruia Autonomous College, Matunga, Mumbai',
            'Ruia College',
        ],

        // ─── NATIONAL LEVEL INSTITUTES (IITs, NITs, IIITs, BITS, etc.) ───
        'iit delhi' => ['Indian Institute of Technology Delhi', 'IITD'],
        'iitd' => ['Indian Institute of Technology Delhi', 'IIT Delhi'],
        'iit madras' => ['Indian Institute of Technology Madras', 'IITM'],
        'iitm' => ['Indian Institute of Technology Madras', 'IIT Madras'],
        'iit kanpur' => ['Indian Institute of Technology Kanpur', 'IITK'],
        'iitk' => ['Indian Institute of Technology Kanpur', 'IIT Kanpur'],
        'iit kharagpur' => ['Indian Institute of Technology Kharagpur', 'IITKGP'],
        'iitkgp' => ['Indian Institute of Technology Kharagpur', 'IIT Kharagpur'],
        'iit roorkee' => ['Indian Institute of Technology Roorkee', 'IITR'],
        'iitr' => ['Indian Institute of Technology Roorkee', 'IIT Roorkee'],
        'iit guwahati' => ['Indian Institute of Technology Guwahati', 'IITG'],
        'iitg' => ['Indian Institute of Technology Guwahati', 'IIT Guwahati'],
        'iit hyderabad' => ['Indian Institute of Technology Hyderabad', 'IITH'],
        'iith' => ['Indian Institute of Technology Hyderabad', 'IIT Hyderabad'],
        'iit bhu' => ['Indian Institute of Technology (BHU) Varanasi', 'IIT BHU'],
        'iit indore' => ['Indian Institute of Technology Indore'],
        'iit gandhinagar' => ['Indian Institute of Technology Gandhinagar'],
        'bits pilani' => ['Birla Institute of Technology and Science, Pilani', 'BITS Pilani'],
        'bits' => ['Birla Institute of Technology and Science, Pilani', 'BITS Pilani', 'BITS Goa', 'BITS Hyderabad'],
        'dtu' => ['Delhi Technological University', 'Delhi College of Engineering', 'DCE Delhi'],
        'nsut' => ['Netaji Subhas University of Technology', 'Netaji Subhas Institute of Technology', 'NSIT Delhi'],
        'iiit hyderabad' => ['International Institute of Information Technology Hyderabad', 'IIITH'],
        'iiith' => ['International Institute of Information Technology Hyderabad', 'IIIT Hyderabad'],
        'iiit delhi' => ['Indraprastha Institute of Information Technology Delhi', 'IIITD'],
        'iiitd' => ['Indraprastha Institute of Information Technology Delhi', 'IIIT Delhi'],
        'iiit bangalore' => ['International Institute of Information Technology Bangalore', 'IIITB'],
        'iiitb' => ['International Institute of Information Technology Bangalore', 'IIIT Bangalore'],
        'iiit pune' => ['Indian Institute of Information Technology Pune', 'IIIT Pune'],
        'iiit nagpur' => ['Indian Institute of Information Technology Nagpur', 'IIIT Nagpur'],
        'rvce' => ['R.V. College of Engineering, Bengaluru', 'RV College of Engineering'],
        'bmsce' => ['B.M.S. College of Engineering, Bengaluru', 'BMS College of Engineering'],
        'msrit' => ['Ramaiah Institute of Technology, Bengaluru', 'MSRIT Bangalore', 'M. S. Ramaiah'],
        'srcc' => ['Shri Ram College of Commerce, Delhi University', 'SRCC'],
        'lsr' => ['Lady Shri Ram College for Women, Delhi', 'LSR Delhi'],
    ];

    /**
     * Resolve a user search query into an array of search candidates / expanded queries.
     * E.g. "COEP" => ["COEP", "COEP Technological University", "College of Engineering Pune", "College of Engineering, Pune"]
     */
    public static function resolveQuery(string $query): array
    {
        $cleaned = trim(strtolower($query));
        if (empty($cleaned)) {
            return [];
        }

        $results = [$query];

        // 1. Direct exact match in dictionary
        if (isset(self::$synonyms[$cleaned])) {
            foreach (self::$synonyms[$cleaned] as $syn) {
                if (!in_array($syn, $results, true)) {
                    $results[] = $syn;
                }
            }
        }

        // 2. Normalize punctuation (e.g. "d.y. patil" -> "dy patil", "coep." -> "coep")
        $normalized = preg_replace('/[^\w\s]/', '', $cleaned);
        $normalized = preg_replace('/\s+/', ' ', trim($normalized));
        if ($normalized !== $cleaned && isset(self::$synonyms[$normalized])) {
            foreach (self::$synonyms[$normalized] as $syn) {
                if (!in_array($syn, $results, true)) {
                    $results[] = $syn;
                }
            }
        }

        // 3. Check if query contains any dictionary keys as whole words
        // E.g. "coep pune", "pict cut off", "vjti computer"
        foreach (self::$synonyms as $acronym => $expansions) {
            // Check word boundary
            if (preg_match('/\b' . preg_quote($acronym, '/') . '\b/i', $cleaned)) {
                foreach ($expansions as $exp) {
                    if (!in_array($exp, $results, true)) {
                        $results[] = $exp;
                    }
                }
            }
        }

        // 4. City Name Conversions (e.g. Aurangabad -> Chhatrapati Sambhajinagar, Osmanabad -> Dharashiv)
        $cityMappings = [
            'aurangabad' => 'Chhatrapati Sambhajinagar',
            'chhatrapati sambhajinagar' => 'Aurangabad',
            'osmanabad' => 'Dharashiv',
            'dharashiv' => 'Osmanabad',
            'ahmednagar' => 'Ahilyanagar',
            'ahilyanagar' => 'Ahmednagar',
            'bombay' => 'Mumbai',
            'poona' => 'Pune',
            'calcutta' => 'Kolkata',
            'madras' => 'Chennai',
            'bangalore' => 'Bengaluru',
        ];

        foreach ($cityMappings as $oldCity => $newCity) {
            if (str_contains($cleaned, $oldCity)) {
                $converted = str_ireplace($oldCity, $newCity, $query);
                if (!in_array($converted, $results, true)) {
                    $results[] = $converted;
                }
            }
        }

        return array_values(array_unique($results));
    }

    /**
     * Clean and normalize a college name for comparison / fuzzy matching.
     * Strips society/trust prefixes, legal forms, punctuation, and extra whitespace.
     */
    public static function normalizeName(string $name): string
    {
        $str = strtolower(trim($name));
        
        // Remove content in brackets or IDs like (Id: C-41687)
        $str = preg_replace('/\(id:[^\)]+\)/i', '', $str);
        $str = preg_replace('/\([^\)]+\)/', '', $str);
        
        // Remove common trust/society noise words
        $noiseWords = [
            'shri', 'smt', 'dr', 'prof', 'trust', 'trusts', 'society', 'societys',
            'mandal', 'mandals', 'shikshan', 'prasarak', 'sanstha', 'sansthas',
            'education', 'educational', 'foundation', 'charitable', 'autonomous',
            'institute of technology', 'college of engineering', 'polytechnic',
        ];
        
        // Remove punctuation
        $str = preg_replace('/[^\w\s]/', ' ', $str);
        $str = preg_replace('/\s+/', ' ', trim($str));
        
        return $str;
    }

    /**
     * Check if a college name or code matches an acronym or target name.
     */
    public static function matches(string $sourceName, string $targetQuery): bool
    {
        $expansions = self::resolveQuery($targetQuery);
        $srcNorm = self::normalizeName($sourceName);

        foreach ($expansions as $term) {
            $termNorm = self::normalizeName($term);
            if (str_contains($srcNorm, $termNorm) || str_contains($termNorm, $srcNorm)) {
                return true;
            }
            if (stripos($sourceName, $term) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get all known acronym aliases for suggestion tags / badges.
     */
    public static function getPopularAcronyms(): array
    {
        return [
            'COEP' => 'COEP Technological University, Pune',
            'VJTI' => 'Veermata Jijabai Technological Institute, Mumbai',
            'PICT' => 'Pune Institute of Computer Technology',
            'SPIT' => 'Sardar Patel Institute of Technology, Mumbai',
            'PCCOE' => 'Pimpri Chinchwad College of Engineering, Pune',
            'Walchand (WCE)' => 'Walchand College of Engineering, Sangli',
            'VIT Pune' => 'Vishwakarma Institute of Technology, Pune',
            'Cummins' => 'MKSSS Cummins College of Engineering for Women',
            'DJ Sanghvi' => 'Dwarkadas J. Sanghvi College of Engineering',
            'KJ Somaiya' => 'K. J. Somaiya College of Engineering, Mumbai',
            'AISSMS' => 'AISSMS College of Engineering, Pune',
            'RAIT' => 'Ramrao Adik Institute of Technology, Navi Mumbai',
            'VESIT' => 'Vivekanand Education Society Institute of Tech',
            'TCET' => 'Thakur College of Engineering, Mumbai',
            'MIT AOE' => 'MIT Academy of Engineering, Alandi',
            'GCE Karad' => 'Government College of Engineering, Karad',
            'GECA' => 'Government College of Engineering, Aurangabad',
            'SGGS' => 'SGGSIE&T Nanded',
            'RCOEM' => 'Shri Ramdeobaba College, Nagpur',
            'VNIT' => 'VNIT Nagpur',
            'IIT Bombay' => 'Indian Institute of Technology Bombay',
            'ICT Mumbai' => 'Institute of Chemical Technology Mumbai',
            'JBIMS' => 'Jamnalal Bajaj Institute of Management, Mumbai',
            'KEM Hospital' => 'Seth GS Medical College & KEM Hospital, Mumbai',
            'BJMC' => 'BJ Government Medical College, Pune',
            'AFMC' => 'Armed Forces Medical College, Pune',
            'ILS Law' => 'ILS Law College, Pune',
            'Fergusson' => 'Fergusson College, Pune',
            'BMCC' => 'Brihan Maharashtra College of Commerce, Pune',
        ];
    }
}
