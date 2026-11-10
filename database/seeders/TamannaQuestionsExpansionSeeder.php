<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dimension;
use App\Models\Question;

class TamannaQuestionsExpansionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dimensionMap = [
            'language-aptitude' => Dimension::where('slug', 'language-aptitude')->first()->id ?? 1,
            'abstract-reasoning' => Dimension::where('slug', 'abstract-reasoning')->first()->id ?? 2,
            'verbal-reasoning' => Dimension::where('slug', 'verbal-reasoning')->first()->id ?? 3,
            'mechanical-reasoning' => Dimension::where('slug', 'mechanical-reasoning')->first()->id ?? 4,
            'numerical-aptitude' => Dimension::where('slug', 'numerical-aptitude')->first()->id ?? 5,
            'spatial-aptitude' => Dimension::where('slug', 'spatial-aptitude')->first()->id ?? 6,
            'perceptual-aptitude' => Dimension::where('slug', 'perceptual-aptitude')->first()->id ?? 7,
        ];

        $questions = [
            // ==========================================
            // 1. LANGUAGE APTITUDE (Synonyms, Spellings, Idioms)
            // ==========================================
            [
                'dim' => 'language-aptitude',
                'q' => 'ACRIMONIOUS',
                'options' => ['Caustic', 'Blithe', 'Jolly', 'Lucky'],
                'ans' => 'Caustic'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'DOGMATIC',
                'options' => ['Opinionated', 'Indefinite', 'Dubious', 'Uncertain'],
                'ans' => 'Opinionated'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'GULLIBLE',
                'options' => ['Credulous', 'Wise', 'Knowledgeable', 'Perceptive'],
                'ans' => 'Credulous'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'REPUDIATE',
                'options' => ['Reject', 'Grant', 'Enforce', 'Welcome'],
                'ans' => 'Reject'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'POIGNANT',
                'options' => ['Pitiful', 'Blunt', 'Cheerful', 'Indifferent'],
                'ans' => 'Pitiful'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'NAIVE',
                'options' => ['Childlike', 'Experienced', 'Alien', 'Leery'],
                'ans' => 'Childlike'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'MALLEABLE',
                'options' => ['Supple', 'Static', 'Severe', 'Exact'],
                'ans' => 'Supple'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'REDUNDANT',
                'options' => ['Excessive', 'Concise', 'Revise', 'Curtailed'],
                'ans' => 'Excessive'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'STRINGENT',
                'options' => ['Rigid', 'Pliant', 'Lenient', 'Calm'],
                'ans' => 'Rigid'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'INQUISITIVE',
                'options' => ['Prying', 'Haughty', 'Aloof', 'Listless'],
                'ans' => 'Prying'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'LUCID',
                'options' => ['Clear', 'Foggy', 'Murky', 'Cloudy'],
                'ans' => 'Clear'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'ODIOUS',
                'options' => ['Repulsive', 'Cordial', 'Genial', 'Gracious'],
                'ans' => 'Repulsive'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'MOROSE',
                'options' => ['Sulky', 'Happy', 'Churlish', 'Gentle'],
                'ans' => 'Sulky'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'PRECARIOUS',
                'options' => ['Insecure', 'Stable', 'Protected', 'Popular'],
                'ans' => 'Insecure'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'EMANCIPATE',
                'options' => ['Liberate', 'Detain', 'Close', 'Keep'],
                'ans' => 'Liberate'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'PROPENSITY',
                'options' => ['Bias', 'Antipathy', 'Dislike', 'Contented'],
                'ans' => 'Bias'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'HEINOUS',
                'options' => ['Vicious', 'Honourable', 'Glorious', 'Divine'],
                'ans' => 'Vicious'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'IMPEDIMENT',
                'options' => ['Deterrent', 'Clearance', 'Aid', 'Benefit'],
                'ans' => 'Deterrent'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'INSOLENT',
                'options' => ['Abusive', 'Respectful', 'Trickster', 'Servile'],
                'ans' => 'Abusive'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'REVERENCE',
                'options' => ['Esteem', 'Scorn', 'Disdain', 'Censure'],
                'ans' => 'Esteem'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'SPURIOUS',
                'options' => ['Artificial', 'Legit', 'Valid', 'Original'],
                'ans' => 'Artificial'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'CAJOLE',
                'options' => ['Entice', 'Bully', 'Scold', 'Repel'],
                'ans' => 'Entice'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'EPHEMERAL',
                'options' => ['Transitory', 'Enduring', 'Eternal', 'Transparent'],
                'ans' => 'Transitory'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'IMPERTINENT',
                'options' => ['Brash', 'Civilised', 'Urbane', 'Courtly'],
                'ans' => 'Brash'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'OBSOLETE',
                'options' => ['Archaic', 'Current', 'Unique', 'Topical'],
                'ans' => 'Archaic'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'PENSIVE',
                'options' => ['Contemplative', 'Slovenly', 'Careless', 'Sloppy'],
                'ans' => 'Contemplative'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'SUCCINCT',
                'options' => ['Brief', 'Soft', 'Lengthy', 'Supple'],
                'ans' => 'Brief'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'TRANQUIL',
                'options' => ['Calm', 'Agitated', 'Fierce', 'Enrich'],
                'ans' => 'Calm'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'ACUMEN',
                'options' => ['Brilliance', 'Accommodate', 'Accumulate', 'Inability'],
                'ans' => 'Brilliance'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'ASTUTE',
                'options' => ['Insightful', 'Obtuse', 'Imbecile', 'Idiotic'],
                'ans' => 'Insightful'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'Select the correctly spelt word:',
                'options' => ['Meticulous', 'Matteculous', 'Maticolous', 'Meticolus'],
                'ans' => 'Meticulous'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'Select the correctly spelt word:',
                'options' => ['Omniscient', 'Omicsient', 'Onmeisient', 'Ominicient'],
                'ans' => 'Omniscient'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'Select the correctly spelt word:',
                'options' => ['Miscellaneous', 'Misscelanous', 'Miscalenous', 'Miscallenenous'],
                'ans' => 'Miscellaneous'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'Select the correctly spelt word:',
                'options' => ['Altruistic', 'Altrustic', 'Altruestic', 'Alturesitic'],
                'ans' => 'Altruistic'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'Select the correctly spelt word:',
                'options' => ['Bureaucracy', 'Beuracracy', 'Buroucarcy', 'Buerocrecy'],
                'ans' => 'Bureaucracy'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'Select the correctly spelt word:',
                'options' => ['Entrepreneur', 'Enatrprenur', 'Entraprinur', 'Entrupreuere'],
                'ans' => 'Entrepreneur'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'Select the correctly spelt word:',
                'options' => ['Psychiatrist', 'Syhaitrist', 'Phychairtist', 'Pshychaitrist'],
                'ans' => 'Psychiatrist'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => 'Select the correctly spelt word:',
                'options' => ['Perseverance', 'Presrevrance', 'Presrvrence', 'Persrevreance'],
                'ans' => 'Perseverance'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => "Meaning of idiom: 'To fly off the handle'",
                'options' => ["To lose one's temper suddenly", 'To dislocate', 'To take off', 'To be indifferent'],
                'ans' => "To lose one's temper suddenly"
            ],
            [
                'dim' => 'language-aptitude',
                'q' => "Meaning of idiom: 'To keep the ball rolling'",
                'options' => ['To maintain the momentum of an activity', 'To make the best use of', 'To earn more and more', 'To work courageously'],
                'ans' => 'To maintain the momentum of an activity'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => "Meaning of idiom: 'To take the bull by the horns'",
                'options' => ['To grapple courageously with a difficulty', 'To handle it by fierce attack', 'To bypass legal process', 'To punish severely'],
                'ans' => 'To grapple courageously with a difficulty'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => "Meaning of idiom: 'Hobson\'s choice'",
                'options' => ['A choice of taking whatever available or nothing at all', 'Feeling of strength', 'Excellent choice', 'Feeling of insecurity'],
                'ans' => 'A choice of taking whatever available or nothing at all'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => "Meaning of idiom: 'Through thick and thin'",
                'options' => ['Under all conditions, undaunted by anything', 'Through happy days', 'Within all difficulties', 'Always or never'],
                'ans' => 'Under all conditions, undaunted by anything'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => "Meaning of idiom: 'Gift of the gab'",
                'options' => ['A talent for speaking', 'An interest in discipline', 'A good personality', 'A talent for acting'],
                'ans' => 'A talent for speaking'
            ],
            [
                'dim' => 'language-aptitude',
                'q' => "Meaning of idiom: 'To turn over a new leaf'",
                'options' => ["To change one's behaviour in a positive way", "To cover up one's faults", 'To read another chapter', 'To start a new business'],
                'ans' => "To change one's behaviour in a positive way"
            ],

            // ==========================================
            // 2. VERBAL REASONING (Series, Analogies, Operations, Rankings)
            // ==========================================
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: 2, 6, 14, 26, ?, 62',
                'options' => ['42', '40', '48', '52'],
                'ans' => '42'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: 10, 18, 34, 66, 130, ?',
                'options' => ['258', '230', '260', '300'],
                'ans' => '258'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: 3, 12, 48, 192, 768, ?',
                'options' => ['3072', '900', '1250', '1352'],
                'ans' => '3072'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: 6, 11, 18, 27, 38, 51, ?',
                'options' => ['66', '60', '72', '81'],
                'ans' => '66'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: 3, 7, 15, 27, 43, ?',
                'options' => ['63', '52', '61', '71'],
                'ans' => '63'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: 198, 194, 185, 169, ?',
                'options' => ['144', '92', '112', '136'],
                'ans' => '144'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: 2, 3, 5, 7, 11, 13, ?',
                'options' => ['17', '15', '12', '19'],
                'ans' => '17'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: 10, 100, 200, 310, ?',
                'options' => ['430', '400', '410', '420'],
                'ans' => '430'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: C7, G11, K15, O19, ?',
                'options' => ['S23', 'Q23', 'T23', 'R23'],
                'ans' => 'S23'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: A, D, G, J, M, P, ?',
                'options' => ['S', 'Q', 'T', 'U'],
                'ans' => 'S'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: AM, BN, CO, DP, EQ, ?',
                'options' => ['FR', 'DT', 'GS', 'GL'],
                'ans' => 'FR'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: ABC, EFG, IJK, ?, QRS',
                'options' => ['MNO', 'OPR', 'PQR', 'OPQ'],
                'ans' => 'MNO'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Series: CBA, IHG, ONM, ?',
                'options' => ['UTS', 'VUT', 'TSR', 'UST'],
                'ans' => 'UTS'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Plant is to Tree as Girl is to _____',
                'options' => ['Lady', 'Friend', 'Sister', 'Baby'],
                'ans' => 'Lady'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Carpenter is to Wood as Tailor is to _____',
                'options' => ['Cloth', 'Scissors', 'Sewing', 'Textile'],
                'ans' => 'Cloth'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Good is to Bad as Roof is to _____',
                'options' => ['Floor', 'Wall', 'Terrace', 'Door'],
                'ans' => 'Floor'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Sound is to Waves as Light is to _____',
                'options' => ['Rays', 'Tunes', 'Orbits', 'Electricity'],
                'ans' => 'Rays'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Liberty is to Slavery as Danger is to _____',
                'options' => ['Safety', 'Calamity', 'Enmity', 'War'],
                'ans' => 'Safety'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Face is to Expression as Hand is to _____',
                'options' => ['Gesture', 'Labour', 'Hand Shake', 'Work'],
                'ans' => 'Gesture'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Cushion is to Sofa as Shelf is to _____',
                'options' => ['Bookcase', 'Ledge', 'Storage', 'Frame'],
                'ans' => 'Bookcase'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Doze is to Sleep as Tiptoe is to _____',
                'options' => ['Walk', 'Flat', 'Swim', 'Lay'],
                'ans' => 'Walk'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Cow is to Herd as Dolphin is to _____',
                'options' => ['Pod', 'Ocean', 'Cattle', 'Leap'],
                'ans' => 'Pod'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Chatter is to Talk as Flutter is to _____',
                'options' => ['Flap', 'Dance', 'Wobble', 'Sing'],
                'ans' => 'Flap'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Cub is to Bear as Joey is to _____',
                'options' => ['Kangaroo', 'Doll', 'Truch', 'Swarm'],
                'ans' => 'Kangaroo'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Dog is to Kennel as Bird is to _____',
                'options' => ['Aerie', 'Fly', 'Feather', 'Fledgling'],
                'ans' => 'Aerie'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Novel is to Epilogue as Meal is to _____',
                'options' => ['Dessert', 'Lunch', 'Appetizer', 'Plate'],
                'ans' => 'Dessert'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Lion is to Courage as Dove is to _____',
                'options' => ['Peace', 'War', 'Timidity', 'Fly'],
                'ans' => 'Peace'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Batter is to Pancake as Dough is to _____',
                'options' => ['Bread', 'Soup', 'Ice cream', 'Lunch'],
                'ans' => 'Bread'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Fan is to Wings as Wheel is to _____',
                'options' => ['Spokes', 'Move', 'Cars', 'Engine'],
                'ans' => 'Spokes'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Oval is to Circle as Rectangle is to _____',
                'options' => ['Square', 'Triangle', 'Hexagon', 'Pentagon'],
                'ans' => 'Square'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Flower is to Bouquet as Player is to _____',
                'options' => ['Team', 'Captain', 'Match', 'Playground'],
                'ans' => 'Team'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: Blood is to Vein as Oil is to _____',
                'options' => ['Pipeline', 'Garage', 'Pump', 'Petrol'],
                'ans' => 'Pipeline'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: _____ is to Tall as Light is to _____',
                'options' => ['Short...Heavy', 'Long...Heavy', 'Dark...Big', 'Short...Small'],
                'ans' => 'Short...Heavy'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Analogy: _____ is to Grapes as Coffee is to _____',
                'options' => ['Wine...Beans', 'Flower...Maize', 'Fruit...Husk', 'Wine...Maize'],
                'ans' => 'Wine...Beans'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'Select the odd term out:',
                'options' => ['Moon', 'Earth', 'Venus', 'Saturn'],
                'ans' => 'Moon'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'In a row at a bus stop, A is 7th from left and B is 9th from right. If they interchange positions and A becomes 11th from left, how many people are in the row?',
                'options' => ['19', '18', '20', '21'],
                'ans' => '19'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => "If 'N' means 'x', 'M' means '/', 'P' means '+', and 'Q' means '-', what is 16 P 24 M 8 Q 6 M 2 N 3 ?",
                'options' => ['10', '13', '17', '21'],
                'ans' => '10'
            ],
            [
                'dim' => 'verbal-reasoning',
                'q' => 'In a certain code, BRAND is written as YIZMW. How will VALUE be written in that code?',
                'options' => ['EZOFV', 'EZKTD', 'FZNEV', 'EBMSF'],
                'ans' => 'EZOFV'
            ],

            // ==========================================
            // 3. NUMERICAL APTITUDE (Percentages, Ratios, Speed, Algebra)
            // ==========================================
            [
                'dim' => 'numerical-aptitude',
                'q' => 'If 10^(2x) = 25, then 10^(-x) equals:',
                'options' => ['1/5', '-1/25', '5', '25'],
                'ans' => '1/5'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'If on subtracting 28 from a number, the remainder is one-third of the number. What is 50% of the number?',
                'options' => ['21', '23', '-24', '22'],
                'ans' => '21'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'What least number must be assigned to * so that the number 84705*2 is divisible by 9?',
                'options' => ['1', '2', '3', '4'],
                'ans' => '1'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'The product of two numbers is 720. If their H.C.F. is 12, then the two numbers are:',
                'options' => ['12, 60', '12, 48', '36, 60', '24, 30'],
                'ans' => '12, 60'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'The L.C.M. of two numbers is 2310 and their H.C.F. is 30. If one of these numbers is 210, the second number is:',
                'options' => ['330', '1470', '2100', '16170'],
                'ans' => '330'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => "The average age of a class of 25 students is 16 years. When the teacher's age is included, the average age becomes 17 years. What is the teacher's age?",
                'options' => ['42 years', '25 years', '51 years', '26 years'],
                'ans' => '42 years'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'How many turns will a wheel of a car rotate in a journey of 88 km, if the radius of the wheel is 56 cm?',
                'options' => ['25,000', '60,000', '50,000', '30,000'],
                'ans' => '25,000'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'If a : b = c : d = e : f = 1 : 2, then (3a + 5c + 7e) : (3b + 5d + 7f) is equal to:',
                'options' => ['1 : 2', '1 : 4', '2 : 1', '8 : 7'],
                'ans' => '1 : 2'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'The speeds of three cars are in the ratio 2 : 3 : 4. The ratio of the time taken by these cars to travel the same distance is:',
                'options' => ['6 : 4 : 3', '2 : 3 : 4', '4 : 3 : 2', '4 : 3 : 6'],
                'ans' => '6 : 4 : 3'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'If the length of a rectangular field is 8 m and a man walked 10 m diagonally across it, what is the area of the field?',
                'options' => ['48 m²', '40 m²', '60 m²', '75 m²'],
                'ans' => '48 m²'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'A group of classmates collected as many rupees from each classmate as their total count. If the total collection is Rs 3481, how many classmates are there?',
                'options' => ['59', '51', '61', '69'],
                'ans' => '59'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'It is required to get 40% marks to qualify an exam. A candidate scored 260 marks and failed by 28 marks. What are the maximum marks?',
                'options' => ['720', '520', '620', 'None of these'],
                'ans' => '720'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'A bag contains 50p, 25p, and 10p coins in the ratio 5 : 9 : 4 amounting to Rs 206. Find the number of coins of each type:',
                'options' => ['200, 360, 160', '100, 80, 120', '40, 80, 160', '222, 322, 440'],
                'ans' => '200, 360, 160'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'A car covers its journey at 80 km/hr in 10 hours. To cover the same distance in 8 hours, by how much must its speed increase?',
                'options' => ['20 km/hr', '8 km/hr', '12 km/hr', '16 km/hr'],
                'ans' => '20 km/hr'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'By selling an item for Rs 950, a shopkeeper loses 5%. What percent profit will he gain by selling it for Rs 1040?',
                'options' => ['4%', '4.5%', '5%', '9%'],
                'ans' => '4%'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'The average age of 10 students is 20. When a new student joins, the average age increases by 1. What is the new student\'s age?',
                'options' => ['31 years', '21 years', '30 years', '40 years'],
                'ans' => '31 years'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'The average of seven numbers is 18. If 17 is replaced by 31, what is the new average?',
                'options' => ['20', '19.5', '21', '21.5'],
                'ans' => '20'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'If the cost of 12 belts and 30 wallets is Rs 8940, what is the cost of 4 belts and 10 wallets?',
                'options' => ['Rs 2980', 'Rs 2890', 'Rs 2780', 'Rs 2870'],
                'ans' => 'Rs 2980'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'What is the largest number that divides 210, 315, 147, and 168 exactly?',
                'options' => ['21', '3', '7', '4410'],
                'ans' => '21'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'The product of one-third of a number and 150% of another number is what percent of the product of the original numbers?',
                'options' => ['50%', '80%', '75%', '120%'],
                'ans' => '50%'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'Three pipes A, B and C can fill a cistern in 20 min, 15 min and 12 min respectively. How long will all three take together?',
                'options' => ['5 minutes', '10 minutes', '12 minutes', '15 minutes'],
                'ans' => '5 minutes'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'If a^x = b, b^y = c and c^z = a, what is the value of xyz?',
                'options' => ['1', '2', '0', '4'],
                'ans' => '1'
            ],
            [
                'dim' => 'numerical-aptitude',
                'q' => 'If 8% of P equals 4% of Q, then 20% of P is what percentage of Q?',
                'options' => ['10% of Q', '15% of Q', '20% of Q', '25% of Q'],
                'ans' => '10% of Q'
            ],

            // ==========================================
            // 4. MECHANICAL REASONING (Forces, Levers, Pulleys, Circuits)
            // ==========================================
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'Which type of lever has the fulcrum between the effort and the load?',
                'options' => ['First Class Lever', 'Second Class Lever', 'Third Class Lever', 'Fourth Class Lever'],
                'ans' => 'First Class Lever'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'In a first class lever, if the distance from fulcrum to load is 1 m and fulcrum to effort is 2 m, what effort is needed to balance a 10 kg load?',
                'options' => ['5 kg', '10 kg', '20 kg', '2.5 kg'],
                'ans' => '5 kg'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'A single movable pulley supporting a load requires what fraction of effort compared to lifting the load directly?',
                'options' => ['Half the effort', 'Equal effort', 'Twice the effort', 'One fourth effort'],
                'ans' => 'Half the effort'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'Two spheres of equal volume but different masses (1 kg and 5 kg) are dropped from the same height in a vacuum. Which hits the ground first?',
                'options' => ['Both hit at the same time', '5 kg sphere', '1 kg sphere', 'Cannot be determined'],
                'ans' => 'Both hit at the same time'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'Pressure exerted on a surface is defined as:',
                'options' => ['Force per unit area', 'Force times area', 'Mass per unit volume', 'Work per unit time'],
                'ans' => 'Force per unit area'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'A sharp knife cuts better than a blunt knife because:',
                'options' => ['Smaller contact area exerts higher pressure', 'Larger area exerts greater force', 'Less momentum is required', 'Friction is completely eliminated'],
                'ans' => 'Smaller contact area exerts higher pressure'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'If two gears are meshed together, Gear A has 10 teeth and Gear B has 30 teeth. When Gear A completes 3 full rotations, how many rotations does Gear B complete?',
                'options' => ['1 rotation', '3 rotations', '9 rotations', '0.33 rotations'],
                'ans' => '1 rotation'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'When two meshed gears turn, in what direction do they rotate relative to each other?',
                'options' => ['Opposite directions', 'Same direction', 'Perpendicular directions', 'They do not rotate together'],
                'ans' => 'Opposite directions'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => "According to Ohm's Law, when electrical resistance in a circuit is doubled while voltage remains constant, the current:",
                'options' => ['Is halved', 'Is doubled', 'Remains unchanged', 'Becomes zero'],
                'ans' => 'Is halved'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'In a parallel electrical circuit, if one light bulb burns out, what happens to the remaining bulbs?',
                'options' => ['They remain lit with normal brightness', 'They all turn off', 'They flicker and short circuit', 'Their current drops to zero'],
                'ans' => 'They remain lit with normal brightness'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'Which machine component is used to redirect the direction of pulling force without changing its magnitude?',
                'options' => ['Fixed Pulley', 'Compound Gear', 'Second Class Lever', 'Hydraulic Jack'],
                'ans' => 'Fixed Pulley'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'A uniform rod is balanced at its midpoint. If a 40 N weight is placed 30 cm left of the fulcrum, where must a 60 N weight be placed to maintain equilibrium?',
                'options' => ['20 cm to the right', '30 cm to the right', '15 cm to the right', '25 cm to the right'],
                'ans' => '20 cm to the right'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'Which of the following materials has the lowest electrical resistance at room temperature?',
                'options' => ['Silver', 'Copper', 'Iron', 'Wood'],
                'ans' => 'Silver'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'What happens to the pressure at the bottom of a water tank when the depth of the water is doubled?',
                'options' => ['Pressure is doubled', 'Pressure is halved', 'Pressure increases fourfold', 'Pressure remains unchanged'],
                'ans' => 'Pressure is doubled'
            ],
            [
                'dim' => 'mechanical-reasoning',
                'q' => 'A car travels around a circular track at constant speed. What is true about its acceleration?',
                'options' => ['It has centripetal acceleration directed toward the center', 'It has zero acceleration since speed is constant', 'Its acceleration is tangential to the circle', 'Its acceleration points outward due to centrifugal force'],
                'ans' => 'It has centripetal acceleration directed toward the center'
            ],

            // ==========================================
            // 5. ABSTRACT REASONING (Patterns, Matrices, Series Logic)
            // ==========================================
            [
                'dim' => 'abstract-reasoning',
                'q' => 'In a 3x3 pattern matrix where each row shifts symbols rightward by one cell: Top row: [* # @], Middle row: [@ * #], Bottom row: [# @ ?]. What replaces the question mark?',
                'options' => ['*', '#', '@', '$'],
                'ans' => '*'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'A sequence of regular polygons has side counts: 3, 4, 5, 6, ?. Which figure comes next?',
                'options' => ['Heptagon (7 sides)', 'Octagon (8 sides)', 'Nonagon (9 sides)', 'Pentagon (5 sides)'],
                'ans' => 'Heptagon (7 sides)'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'An arrow rotates clockwise by 45° at each step: pointing Up (0°), Up-Right (45°), Right (90°), Down-Right (135°). What is the next position?',
                'options' => ['Down (180°)', 'Down-Left (225°)', 'Left (270°)', 'Up-Left (315°)'],
                'ans' => 'Down (180°)'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'Consider shapes with inscribed dots: Circle with 1 dot, Square with 4 dots, Triangle with 3 dots, Pentagon with 5 dots, Hexagon with ?. How many dots should the hexagon contain?',
                'options' => ['6 dots', '5 dots', '7 dots', '8 dots'],
                'ans' => '6 dots'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'In a sequence, each figure alternates color between Black and White while incrementing internal partitions: [1 partition Black], [2 partitions White], [3 partitions Black], [4 partitions White]. What is the 5th figure?',
                'options' => ['5 partitions Black', '5 partitions White', '6 partitions Black', '4 partitions Black'],
                'ans' => '5 partitions Black'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'Which geometric rule relates a circle to a sphere as a square relates to:',
                'options' => ['Cube', 'Pyramid', 'Rectangle', 'Cylinder'],
                'ans' => 'Cube'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'A clock face hand starts at 12:00 and moves forward 2.5 hours on step 1, 3.5 hours on step 2, 4.5 hours on step 3. Where is it after step 3?',
                'options' => ['10:30', '9:30', '11:30', '8:30'],
                'ans' => '10:30'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'Pattern progression: 1 circle, 2 intersecting circles, 3 intersecting circles in a line. What represents the 4th state?',
                'options' => ['4 intersecting circles in a chain', '4 non-intersecting circles', '3 concentric circles', '1 large circle with 4 dots'],
                'ans' => '4 intersecting circles in a chain'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'If a solid black square has its top-right quarter turned white in step 1, bottom-right quarter turned white in step 2, bottom-left quarter turned white in step 3, what remains black in step 4?',
                'options' => ['Top-left quarter', 'None (completely white)', 'Top-right quarter', 'Center circle'],
                'ans' => 'Top-left quarter'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'Find the odd figure rule out: Four shapes have line symmetry except one:',
                'options' => ['Scalene triangle', 'Isosceles triangle', 'Equilateral triangle', 'Square'],
                'ans' => 'Scalene triangle'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'In a matrix of numbers, the top row is [2, 3, 5], middle row is [7, 11, 13], bottom row is [17, 19, ?]. What is the missing number?',
                'options' => ['23', '21', '25', '27'],
                'ans' => '23'
            ],
            [
                'dim' => 'abstract-reasoning',
                'q' => 'A line segment doubles in length and rotates 90° clockwise at each step: Step 1 (Length 1, Vertical), Step 2 (Length 2, Horizontal), Step 3 (Length 4, Vertical). What is Step 4?',
                'options' => ['Length 8, Horizontal', 'Length 6, Horizontal', 'Length 8, Vertical', 'Length 4, Diagonal'],
                'ans' => 'Length 8, Horizontal'
            ],

            // ==========================================
            // 6. SPATIAL APTITUDE (Reflections, Folding, 3D Projections)
            // ==========================================
            [
                'dim' => 'spatial-aptitude',
                'q' => "If the word 'MISSION' is placed in front of a vertical plane mirror, what is its correct mirror image?",
                'options' => ['NOISSIM (with reversed letters)', 'MISSION', 'WOISSIN', 'NOISSIW'],
                'ans' => 'NOISSIM (with reversed letters)'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'When looking at a standard six-sided die, opposite faces always sum to 7. If the top face is 3 and the front face is 2, what is the bottom face?',
                'options' => ['4', '5', '1', '6'],
                'ans' => '4'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'A square sheet of paper is folded in half from left to right, then folded from top to bottom, and a circular hole is punched in the center. When completely unfolded, how many holes appear on the sheet?',
                'options' => ['4 holes', '2 holes', '1 hole', '8 holes'],
                'ans' => '4 holes'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'Which 3D shape is formed by folding a cross-shaped net made of 6 identical squares?',
                'options' => ['Cube', 'Cuboid', 'Triangular Prism', 'Tetrahedron'],
                'ans' => 'Cube'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'If a clock shows 3:15, what time does its image show in a plane mirror?',
                'options' => ['8:45', '9:15', '8:15', '9:45'],
                'ans' => '8:45'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => "An asymmetric 'F' shape is rotated 90° clockwise, then 180° counter-clockwise. What is its net rotation from the original position?",
                'options' => ['90° counter-clockwise', '90° clockwise', '180° inverted', '360° original'],
                'ans' => '90° counter-clockwise'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'A solid cylinder is cut horizontally parallel to its base. What is the shape of the exposed cross-section?',
                'options' => ['Circle', 'Rectangle', 'Ellipse', 'Triangle'],
                'ans' => 'Circle'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'A solid cylinder is cut vertically through its axis perpendicular to its base. What is the shape of the exposed cross-section?',
                'options' => ['Rectangle', 'Circle', 'Oval', 'Parabola'],
                'ans' => 'Rectangle'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'How many triangular faces does a standard regular tetrahedron possess?',
                'options' => ['4', '6', '8', '3'],
                'ans' => '4'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'If an object moves 5 km North, turns right and moves 3 km East, then turns right and moves 5 km South, how far and in what direction is it from the starting point?',
                'options' => ['3 km East', '3 km West', '5 km North', '0 km (at origin)'],
                'ans' => '3 km East'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'How many vertices (corners) does a rectangular cuboid have?',
                'options' => ['8', '6', '12', '10'],
                'ans' => '8'
            ],
            [
                'dim' => 'spatial-aptitude',
                'q' => 'How many edges does a standard triangular prism have?',
                'options' => ['9', '6', '8', '12'],
                'ans' => '9'
            ],

            // ==========================================
            // 7. PERCEPTUAL APTITUDE (Exact Alphanumeric Matching)
            // ==========================================
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: QRTUZMNOP',
                'options' => ['QRTUZMNOP', 'QRUTMZNOP', 'QRTTUZNOP', 'QRTUZMONP'],
                'ans' => 'QRTUZMNOP'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 569824ab',
                'options' => ['569824ab', '568924aB', '569842ba', '568942ab'],
                'ans' => '569824ab'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: p8q37a45c',
                'options' => ['p8q37a45c', 'p8q374a5c', 'p8q37A45C', 'p8q73a45C'],
                'ans' => 'p8q37a45c'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: mnLU1258',
                'options' => ['mnLU1258', 'mNlu2158', 'mnLu1285', 'mnLu1258'],
                'ans' => 'mnLU1258'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 725143008',
                'options' => ['725143008', '725143080', '721534008', '721534080'],
                'ans' => '725143008'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: TaPLEbKuN',
                'options' => ['TaPLEbKuN', 'TAPLeBKuN', 'TApLEBKuN', 'TaPLEBKUN'],
                'ans' => 'TaPLEbKuN'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 91HhQq73',
                'options' => ['91HhQq73', '91HhqQ37', '91Hhqq73', '91HHQq73'],
                'ans' => '91HhQq73'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: rAcE2019',
                'options' => ['rAcE2019', 'RAcE2019', 'race2019', 'RaCe2019'],
                'ans' => 'rAcE2019'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: ConNecTIoN',
                'options' => ['ConNecTIoN', 'ConnecTIon', 'ConNectIoN', 'ConnectIoN'],
                'ans' => 'ConNecTIoN'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: ZMNOXYKLV',
                'options' => ['ZMNOXYKLV', 'ZMNOXKYLV', 'ZMNOXVKLY', 'ZMNXOYKLV'],
                'ans' => 'ZMNOXYKLV'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: WinNeR50',
                'options' => ['WinNeR50', 'WinNeR05', 'winner50', 'winNeR05'],
                'ans' => 'WinNeR50'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 4025987132',
                'options' => ['4025987132', '4052981732', '4029587132', '4025981723'],
                'ans' => '4025987132'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 8542WwXx',
                'options' => ['8542WwXx', '8245WwXx', '8524WwXx', '8524WWxx'],
                'ans' => '8542WwXx'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: DR24a31Ma91',
                'options' => ['DR24a31Ma91', 'DR2431aMa91', 'DR42a31Ma91', 'Dr24A31Ma91'],
                'ans' => 'DR24a31Ma91'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 2090708050',
                'options' => ['2090708050', '2090700850', '2009708050', '2090078050'],
                'ans' => '2090708050'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: Vr9212nD',
                'options' => ['Vr9212nD', 'VR9221nD', 'Vr9212nd', 'Vr2912nD'],
                'ans' => 'Vr9212nD'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: OrDinaRy',
                'options' => ['OrDinaRy', 'OrdINary', 'Ordinart', 'OrDInaRy'],
                'ans' => 'OrDinaRy'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: US91Q4M5W3',
                'options' => ['US91Q4M5W3', 'US91q4M5W3', 'US19Q4M5w3', 'Us91Q4M5W3'],
                'ans' => 'US91Q4M5W3'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: GRA9214PhS0',
                'options' => ['GRA9214PhS0', 'GrA9214PhS0', 'GrAP9214hS0', 'GRAP9214hS0'],
                'ans' => 'GRA9214PhS0'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 991182510031',
                'options' => ['991182510031', '991182550031', '991128150031', '991182150031'],
                'ans' => '991182510031'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: JuDgEmENT',
                'options' => ['JuDgEmENT', 'juDgEmENT', 'JUDgEmENT', 'JudgEmenT'],
                'ans' => 'JuDgEmENT'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: KkSsPpRrTt',
                'options' => ['KkSsPpRrTt', 'KkssppRrTt', 'KKssPpRrTt', 'KkSsPpRrTT'],
                'ans' => 'KkSsPpRrTt'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: INdIa100415',
                'options' => ['INdIa100415', 'INdIa100414', 'INdIa001415', 'INdIA104015'],
                'ans' => 'INdIa100415'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: nAjD810913',
                'options' => ['nAjD810913', 'nAjd801913', 'Najd810913', 'najd810913'],
                'ans' => 'nAjD810913'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: NoVEmbEr',
                'options' => ['NoVEmbEr', 'NoVEmbER', 'noVEmbEr', 'NoVEbmEr'],
                'ans' => 'NoVEmbEr'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: PeRcePtUaL',
                'options' => ['PeRcePtUaL', 'PeRcePtuaL', 'PeRcepTuaL', 'PeRcePtUal'],
                'ans' => 'PeRcePtUaL'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: Air209FoRcE',
                'options' => ['Air209FoRcE', 'AiR209FoRcE', 'AIR209FoRcE', 'Ari209FoRcE'],
                'ans' => 'Air209FoRcE'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: WinCheStER',
                'options' => ['WinCheStER', 'WiNCheStER', 'WincehStER', 'wiNhceStER'],
                'ans' => 'WinCheStER'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 777285991322',
                'options' => ['777285991322', '777285911322', '777228591322', '772855991322'],
                'ans' => '777285991322'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: AbCdEfgHij',
                'options' => ['AbCdEfgHij', 'AbcdeFgHij', 'ABCDEFGhIj', 'AbCdeFgHij'],
                'ans' => 'AbCdEfgHij'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: PQ8aF5bPZ9',
                'options' => ['PQ8aF5bPZ9', 'PQ8Fab5PZ9', 'PQ8A5FbPZ9', 'Pq8af5bPZ9'],
                'ans' => 'PQ8aF5bPZ9'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: jKLmNoQXY',
                'options' => ['jKLmNoQXY', 'jKLnMOQXY', 'jKLmNOQXY', 'JkLmNoQXY'],
                'ans' => 'jKLmNoQXY'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: HiKlmNToUvW',
                'options' => ['HiKlmNToUvW', 'HiklmNoTuvW', 'hiKlmNtoUvW', 'HilKmNoTuVW'],
                'ans' => 'HiKlmNToUvW'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 880022137400',
                'options' => ['880022137400', '808822137400', '880202147300', '880022173400'],
                'ans' => '880022137400'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 55QUT91UB41',
                'options' => ['55QUT91UB41', '55Qut91bU41', '55QUT91ub41', '55qUT19UB41'],
                'ans' => '55QUT91UB41'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: LinGuisTiC',
                'options' => ['LinGuisTiC', 'LinGuiTsiC', 'LinguiSTC', 'LingGiusTiC'],
                'ans' => 'LinGuisTiC'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: FuRiOuS1972',
                'options' => ['FuRiOuS1972', 'FURiOuS1972', 'FuRiOuS9172', 'FuriOuS1972'],
                'ans' => 'FuRiOuS1972'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: GEoGRaPhY',
                'options' => ['GEoGRaPhY', 'GEoRGahPY', 'GeoGraPhy', 'GeoGRaPhY'],
                'ans' => 'GEoGRaPhY'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: cBsEKlumO',
                'options' => ['cBsEKlumO', 'cbSeKlmUO', 'CbSeklUmO', 'CBsEKlUmO'],
                'ans' => 'cBsEKlumO'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: DER0094TXK',
                'options' => ['DER0094TXK', 'DER009T4XK', 'DRE0094XTK', 'DER0049XTK'],
                'ans' => 'DER0094TXK'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 720012413391',
                'options' => ['720012413391', '720011243391', '721200413319', '720014213319'],
                'ans' => '720012413391'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: AY65rpM5W3',
                'options' => ['AY65rpM5W3', 'Ay65rpM5W3', 'AY6rp5MW3', 'AY65rPM5W3'],
                'ans' => 'AY65rpM5W3'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: PeRFcTIoN',
                'options' => ['PeRFcTIoN', 'PerFCetloN', 'PeRfeCtIoN', 'PeRfeClton'],
                'ans' => 'PeRFcTIoN'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: N8N88NN888',
                'options' => ['N8N88NN888', 'N8N88N8N88', 'NN8N8NN888', 'N8N8N8N888'],
                'ans' => 'N8N88NN888'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: OvErBRiDgE',
                'options' => ['OvErBRiDgE', 'OvErBRiDGE', 'OvErBrIDgE', 'OvErBRidGe'],
                'ans' => 'OvErBRiDgE'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: MdkRRjLNO',
                'options' => ['MdkRRjLNO', 'MdkRJRNLO', 'mdKrRjLNO', 'MdkRrjlNO'],
                'ans' => 'MdkRRjLNO'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: bEaUTiFuL',
                'options' => ['bEaUTiFuL', 'bEaUTiFul', 'BeaUtIful', 'bEaUTIFUL'],
                'ans' => 'bEaUTiFuL'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: KImNoPsT',
                'options' => ['KImNoPsT', 'KlmnOpsT', 'klmNopSt', 'KLMnopST'],
                'ans' => 'KImNoPsT'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 144112112',
                'options' => ['144112112', '14111212', '114112212', '114112122'],
                'ans' => '144112112'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: ZzZzzzZzZ',
                'options' => ['ZzZzzzZzZ', 'ZzZzzZzzZ', 'ZZzzZZzzZ', 'ZzZzzZzZ'],
                'ans' => 'ZzZzzzZzZ'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: Vu87Tm10',
                'options' => ['Vu87Tm10', 'VU87tM10', 'Vu87T1m0', 'Vu87mT10'],
                'ans' => 'Vu87Tm10'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 989999888',
                'options' => ['989999888', '998899888', '998889888', '989998888'],
                'ans' => '989999888'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: ThEaTrE',
                'options' => ['ThEaTrE', 'thEatRe', 'THeAtRE', 'ThEatRe'],
                'ans' => 'ThEaTrE'
            ],
            [
                'dim' => 'perceptual-aptitude',
                'q' => 'Select the combination identical to: 10001001000',
                'options' => ['10001001000', '10010010000', '10010001000', '10001000100'],
                'ans' => '10001001000'
            ],
        ];

        $inserted = 0;
        foreach ($questions as $q) {
            $dimId = $dimensionMap[$q['dim']] ?? 1;

            $exists = Question::where('dimension_id', $dimId)
                ->where('question_text', $q['q'])
                ->exists();

            if (!$exists) {
                Question::create([
                    'dimension_id' => $dimId,
                    'question_type' => 'text_only',
                    'question_text' => $q['q'],
                    'question_images' => null,
                    'options_type' => 'text',
                    'options' => $q['options'],
                    'correct_answer' => $q['ans'],
                ]);
                $inserted++;
            }
        }

        $this->command->info("Seeded {$inserted} new TAMANNA test questions into the database!");
    }
}

