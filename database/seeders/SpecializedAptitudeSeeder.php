<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpecializedAptitudeQuestion;
use App\Models\SpecializedCourse;
use Illuminate\Support\Str;

class SpecializedAptitudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedQuestions();
        $this->seedCourses();
        (new SpecializedAptitudeExpansionSeeder())->run();
    }

    private function seedQuestions(): void
    {
        // 1. SPIRITUAL APTITUDE (20 Questions)
        $spiritualQuestions = [
            [
                'question_text' => 'When faced with a situation where a highly profitable choice conflicts with your moral principles, what is your instinctive response?',
                'option_a' => 'Choose the profit immediately; ethics are secondary in practical life.',
                'option_b' => 'Pause, evaluate the long-term impact on integrity, and choose ethical alignment even at personal cost.',
                'option_c' => 'Find a loophole to rationalize the unethical choice without feeling guilty.',
                'option_d' => 'Wait for someone else to make the difficult decision for you.',
                'correct_option' => 'B',
                'explanation' => 'High spiritual aptitude emphasizes moral integrity, conscience-driven decisions, and understanding that lasting peace outweighs transient material gain.'
            ],
            [
                'question_text' => 'During intense emotional distress or unexpected life setbacks, which coping mechanism do you naturally gravitate toward?',
                'option_a' => 'Venting aggressively and blaming external circumstances or people.',
                'option_b' => 'Mindful self-reflection, meditation, prayer, or seeking deeper philosophical perspective.',
                'option_c' => 'Escaping through endless distraction, social media doom-scrolling, or unhealthy habits.',
                'option_d' => 'Repressing all emotions and pretending nothing ever happened.',
                'correct_option' => 'B',
                'explanation' => 'Spiritual resilience involves conscious inward contemplation, equanimity (sthitaprajna), and transforming adversity into inner growth.'
            ],
            [
                'question_text' => 'How do you view the relationship between individual ambition and collective societal wellbeing?',
                'option_a' => 'Individual ambition is the only thing that matters; society can fend for itself.',
                'option_b' => 'True success harmonizes personal growth with service (Seva) and positive contribution to others.',
                'option_c' => 'Helping others is purely a transactional marketing tool to boost public reputation.',
                'option_d' => 'Individual effort is futile because human society cannot be improved.',
                'correct_option' => 'B',
                'explanation' => 'Spiritual awareness bridges the self and the cosmos, emphasizing compassion, interconnectedness, and selfless contribution.'
            ],
            [
                'question_text' => 'What role does daily reflection, meditation, or quiet stillness play in your ideal lifestyle?',
                'option_a' => 'None; silence makes me uncomfortable and is a waste of productive time.',
                'option_b' => 'It is an essential anchor that clarifies thoughts, restores energy, and aligns purpose.',
                'option_c' => 'I only do it when forced or as a superficial aesthetic photo opportunity.',
                'option_d' => 'I believe quiet stillness is only meant for retired elderly individuals.',
                'correct_option' => 'B',
                'explanation' => 'Regular contemplation cultivates metacognition, self-awareness, and emotional balance across all life phases.'
            ],
            [
                'question_text' => 'When two people in your team or family have an intense ethical disagreement, how do you seek resolution?',
                'option_a' => 'Take sides with whoever is more powerful or vocal.',
                'option_b' => 'Listen empathetically to both perspectives to identify core human values and guide them toward mutual understanding.',
                'option_c' => 'Fuel the argument secretly to see who wins.',
                'option_d' => 'Abandon the group completely to avoid discomfort.',
                'correct_option' => 'B',
                'explanation' => 'Spiritual aptitude excels in non-violent communication, empathy, and uncovering common ground beneath surface differences.'
            ],
            [
                'question_text' => 'Which concept of personal fulfillment resonates most deeply with you?',
                'option_a' => 'Having more luxury possessions and status symbols than everyone in my circle.',
                'option_b' => 'Cultivating wisdom, inner freedom, meaningful connections, and a life of purpose.',
                'option_c' => 'Achieving fame regardless of whether my actions harm or inspire people.',
                'option_d' => 'Living purely on autopilot without questioning why I do what I do.',
                'correct_option' => 'B',
                'explanation' => 'Inner contentment, self-actualization, and transcendental peace characterize authentic spiritual orientation.'
            ],
            [
                'question_text' => 'In ancient philosophy, what is the profound practical lesson behind recognizing impermanence (change)?',
                'option_a' => 'Everything ends, so effort is pointless.',
                'option_b' => 'Understanding change liberates us from obsessive attachment, anxiety, and fear of loss.',
                'option_c' => 'It means you should hoard as many resources as possible before time runs out.',
                'option_d' => 'It has no relevance to modern daily decision making.',
                'correct_option' => 'B',
                'explanation' => 'Recognizing impermanence fosters presence, gratitude, mental agility, and deep emotional stability.'
            ],
            [
                'question_text' => 'How do you respond when someone criticizes you constructively or when you make a genuine mistake?',
                'option_a' => 'Become defensive, hold a grudge, and plot revenge.',
                'option_b' => 'Reflect with humility, extract the learning lesson, and take responsibility without losing self-worth.',
                'option_c' => 'Deny that the mistake ever happened and forge excuses.',
                'option_d' => 'Spiral into toxic self-hatred and give up on everything.',
                'correct_option' => 'B',
                'explanation' => 'Humility and non-attachment to ego enable continuous evolutionary learning.'
            ],
            [
                'question_text' => 'When studying or exploring world spiritual traditions and philosophies, what is your primary interest?',
                'option_a' => 'Finding ammunition to prove why my culture or belief is superior to all others.',
                'option_b' => 'Discovering universal ethical truths, human psychological wisdom, and diverse paths to truth.',
                'option_c' => 'Memorizing superficial trivia just to impress people in casual conversations.',
                'option_d' => 'I have zero interest in human thought or cultural wisdom.',
                'correct_option' => 'B',
                'explanation' => 'Spiritual intelligence is broad-minded, inclusive, and seeks universal wisdom across civilizational heritages.'
            ],
            [
                'question_text' => 'In Indian philosophical ethics, what is the foundational essence of "Dharma"?',
                'option_a' => 'Blind ritualistic dogma that should never be reasoned with.',
                'option_b' => 'Righteous duty, universal order, and righteous conduct that sustains and uplifts all beings.',
                'option_c' => 'A set of rigid rules enforced to punish freedom of thought.',
                'option_d' => 'Accumulating personal wealth at all costs.',
                'correct_option' => 'B',
                'explanation' => 'Dharma represents the cosmic and moral order, righteous living, and duties aligned with universal welfare.'
            ],
            [
                'question_text' => 'What psychological and spiritual transformation is demonstrated by practicing genuine daily gratitude?',
                'option_a' => 'It tricks you into becoming lazy and satisfied with mediocrity.',
                'option_b' => 'It rewires neural pathways toward appreciation, dissolves scarcity mindset, and promotes abundance thinking.',
                'option_c' => 'It is just a modern social media trend with no real impact.',
                'option_d' => 'It makes people take advantage of your humility.',
                'correct_option' => 'B',
                'explanation' => 'Gratitude shifts cognitive focus from lack to abundance, enhancing happiness and spiritual connectivity.'
            ],
            [
                'question_text' => 'If an acquaintance repeatedly acts out of jealousy or hostility toward you, what is the most spiritually elevated response?',
                'option_a' => 'Retaliate with twice the hostility to establish dominance.',
                'option_b' => 'Maintain firm boundaries while understanding their insecurity with compassion, without absorbing their toxicity.',
                'option_c' => 'Completely surrender and allow them to abuse your boundaries.',
                'option_d' => 'Spread rumors behind their back to isolate them.',
                'correct_option' => 'B',
                'explanation' => 'Spiritual strength combines compassionate understanding with healthy, firm psychological boundaries.'
            ],
            [
                'question_text' => 'Which career path feels most meaningful for someone with profound spiritual aptitude?',
                'option_a' => 'High-pressure speculative gambling with no social purpose.',
                'option_b' => 'Spiritual counseling, mental health & wellness, philosophical education, yoga therapy, or value-driven leadership.',
                'option_c' => 'Exploitative consumer marketing that triggers insecurities in youth.',
                'option_d' => 'A routine bureaucratic job where conscience must be suspended.',
                'correct_option' => 'B',
                'explanation' => 'Fields in wellness, ethics, counseling, philosophy, and social upliftment match high spiritual aptitude.'
            ],
            [
                'question_text' => 'What does the practice of "Mindfulness" primarily train the mind to do?',
                'option_a' => 'Stop all thinking completely forever.',
                'option_b' => 'Observe the present moment without reactive judgment, fostering clarity and intentional action.',
                'option_c' => 'Daydream about future wealth while ignoring current obligations.',
                'option_d' => 'Zone out into deep sleep on command.',
                'correct_option' => 'B',
                'explanation' => 'Mindfulness cultivates non-judgmental present-moment awareness, breaking automated emotional reactivity.'
            ],
            [
                'question_text' => 'In leadership ethics, what distinguishes "Servant Leadership" from authoritarian leadership?',
                'option_a' => 'Servant leaders let everyone do whatever they want with zero accountability.',
                'option_b' => 'Servant leaders focus primarily on empowering, supporting, and developing the team rather than exercising egoistic control.',
                'option_c' => 'Servant leadership is an obsolete concept with no practical effectiveness in modern organizations.',
                'option_d' => 'It means the leader does all the menial work while subordinates rest.',
                'correct_option' => 'B',
                'explanation' => 'Servant leaders measure their greatness by the empowerment and wellbeing of the people they serve.'
            ],
            [
                'question_text' => 'How do empathy and compassion differ from mere sympathy in human relationships?',
                'option_a' => 'Sympathy solves problems, while empathy creates unnecessary drama.',
                'option_b' => 'Empathy genuinely feels with another from their frame of reference, and compassion moves one to alleviate their distress.',
                'option_c' => 'They are identical words with zero difference.',
                'option_d' => 'Empathy means pitying someone from a position of superiority.',
                'correct_option' => 'B',
                'explanation' => 'Empathy enters another\'s experiential reality, and compassion activates benevolent supportive action.'
            ],
            [
                'question_text' => 'In yogic science and holistic physiology, what is the purpose of conscious breathwork (Pranayama)?',
                'option_a' => 'To test how long you can hold your breath until fainting.',
                'option_b' => 'To regulate the autonomic nervous system, balance vital life force (Prana), and calm mental turbulence.',
                'option_c' => 'It only serves as a vocal warmup for singers.',
                'option_d' => 'It has no measurable effect on heart rate variability or brainwaves.',
                'correct_option' => 'B',
                'explanation' => 'Pranayama bridges somatic physiology and mental clarity through autonomic regulation.'
            ],
            [
                'question_text' => 'When contemplating grand existential mysteries (e.g., origin of consciousness, the universe, life purpose), you feel:',
                'option_a' => 'Deep wonder, reverent curiosity, and inspiration to live more meaningfully.',
                'option_b' => 'Irritated because existential questions cannot be monetized immediately.',
                'option_c' => 'Indifferent because only gossip and short-term trends matter.',
                'option_d' => 'Bored and anxious to change the subject.',
                'correct_option' => 'A',
                'explanation' => 'Existential and metaphysical curiosity is a hallmark of philosophical and spiritual maturity.'
            ],
            [
                'question_text' => 'What is the fundamental difference between intrinsic and extrinsic motivation in pursuing a life vocation?',
                'option_a' => 'Intrinsic motivation relies on trophies; extrinsic motivation relies on inner joy.',
                'option_b' => 'Intrinsic motivation comes from internal fulfillment, passion, and values; extrinsic is driven by outside rewards and validation.',
                'option_c' => 'Both are identical and cannot be distinguished.',
                'option_d' => 'Extrinsic motivation produces longer-lasting happiness than intrinsic motivation.',
                'correct_option' => 'B',
                'explanation' => 'Spiritual strength relies on intrinsic values, making an individual autonomous and resilient against external turbulence.'
            ],
            [
                'question_text' => 'In moments of profound personal grief or existential loss, what provides the deepest source of renewal?',
                'option_a' => 'Denying your feelings and shopping compulsively.',
                'option_b' => 'Connecting to timeless values, community support, acceptance, and trusting life\'s larger evolutionary arc.',
                'option_c' => 'Isolating yourself and fostering bitter cynicism toward the world.',
                'option_d' => 'Blaming innocent people around you.',
                'correct_option' => 'B',
                'explanation' => 'Spiritual equanimity enables post-traumatic growth through acceptance, grace, and meaningful connection.'
            ]
        ];

        // 2. ARTISTIC APTITUDE (20 Questions)
        $artisticQuestions = [
            [
                'question_text' => 'In visual arts and color theory, what visual effect is created when complementary colors (e.g., cobalt blue & vibrant orange) are placed side-by-side?',
                'option_a' => 'They cancel each other out into a muddy grey color.',
                'option_b' => 'They maximize visual contrast and make each other appear more vibrant and energetic.',
                'option_c' => 'They create complete visual invisibility.',
                'option_d' => 'They only appeal to young children.',
                'correct_option' => 'B',
                'explanation' => 'Complementary colors placed adjacently create maximum visual vibration and dynamic contrast.'
            ],
            [
                'question_text' => 'What is the primary aesthetic purpose of the "Rule of Thirds" in photography, painting, and cinematographic framing?',
                'option_a' => 'To guarantee that the subject is locked dead in the center of the frame.',
                'option_b' => 'To create balanced, natural, and engaging visual tension by placing focal points along intersecting grid lines.',
                'option_c' => 'To make sure exactly one-third of the image is left completely blank.',
                'option_d' => 'It is a mathematical formula only used for architectural engineering.',
                'correct_option' => 'B',
                'explanation' => 'The Rule of Thirds prevents static compositions by placing key visual elements off-center along natural lines of gaze.'
            ],
            [
                'question_text' => 'When designing a visual poster, webpage, or magazine cover, what principle guides what the viewer looks at first, second, and third?',
                'option_a' => 'Random luck.',
                'option_b' => 'Visual Hierarchy (established through scale, contrast, weight, and positioning).',
                'option_c' => 'Filling every millimeter of the canvas with equal-sized fonts.',
                'option_d' => 'Alphabetical ordering of text.',
                'correct_option' => 'B',
                'explanation' => 'Visual hierarchy deliberately leads the viewer\'s eye through intentional contrast, scale, and placement.'
            ],
            [
                'question_text' => 'In typography, why are serif typefaces (with small decorative feet) traditionally favored for long printed book texts?',
                'option_a' => 'Because sans-serif fonts are illegal to print on paper.',
                'option_b' => 'Serifs help guide the horizontal eye flow across lines of text, enhancing reading comfort and endurance.',
                'option_c' => 'Serif fonts take up less ink during mass printing.',
                'option_d' => 'There is no functional reason; it is pure nostalgia.',
                'correct_option' => 'B',
                'explanation' => 'Serif strokes create a subtle horizontal guideline that reduces eye strain in prolonged editorial reading.'
            ],
            [
                'question_text' => 'What crucial function does "Negative Space" (White Space) serve in fine art, logos, and UI layout?',
                'option_a' => 'It shows that the artist ran out of ideas or money to finish the canvas.',
                'option_b' => 'It gives elements breathing room, prevents visual clutter, and can create clever secondary figures.',
                'option_c' => 'It is only used when printing costs are too high.',
                'option_d' => 'It makes every design look identical.',
                'correct_option' => 'B',
                'explanation' => 'Negative space defines form, directs focus, and allows the composition to breathe with elegance.'
            ],
            [
                'question_text' => 'If an artwork or film sequence seeks to evoke solemn, contemplative, and mournful mood, which visual elements are most effective?',
                'option_a' => 'Saturated neon yellow with harsh strobe lighting.',
                'option_b' => 'Desaturated cool tones (blues/greys), soft diffused shadow, and deliberate minimalism.',
                'option_c' => 'Bright carnival colors with rapid chaotic camera transitions.',
                'option_d' => 'High-contrast rainbow gradients with glitter textures.',
                'correct_option' => 'B',
                'explanation' => 'Subdued color saturation, lower key values, and cool temperature visually mirror melancholic reflection.'
            ],
            [
                'question_text' => 'In narrative illustration, storyboarding, and comic art, how is sudden tension or danger visually conveyed?',
                'option_a' => 'Using only perfectly horizontal and symmetrical lines.',
                'option_b' => 'Using dynamic diagonal lines, Dutch tilt angles, and sharp dramatic shadows (chiaroscuro).',
                'option_c' => 'Making every character smile broadly in pastel pink.',
                'option_d' => 'Shrinking all characters to microscopic dots.',
                'correct_option' => 'B',
                'explanation' => 'Dynamic diagonals and unstable angles induce psychological tension and visual kinetics.'
            ],
            [
                'question_text' => 'What is the fundamental difference between Vector graphics (e.g., SVG, Illustrator) and Raster graphics (e.g., JPEG, PNG)?',
                'option_a' => 'Vector graphics are made of pixels and blur when enlarged; raster is made of mathematical paths.',
                'option_b' => 'Vector graphics are built from mathematical vectors that scale infinitely without pixelation; raster uses fixed pixel grids.',
                'option_c' => 'Raster graphics cannot display colors.',
                'option_d' => 'Vector graphics can only be viewed in black and white.',
                'correct_option' => 'B',
                'explanation' => 'Vectors use coordinate math and can scale infinitely, making them ideal for logos and typography.'
            ],
            [
                'question_text' => 'In musical composition and auditory design, what technique creates escalating suspense before a climactic reveal?',
                'option_a' => 'Lowering the volume to silence and staying there permanently.',
                'option_b' => 'Accelerating tempo (accelerando), building harmonic dissonance, and crescendos in dynamic volume.',
                'option_c' => 'Playing a single repetitive nursery rhyme on a glockenspiel.',
                'option_d' => 'Stopping all instruments and playing white noise.',
                'correct_option' => 'B',
                'explanation' => 'Crescendo, increasing rhythmic frequency, and harmonic dissonance generate instinctual auditory tension.'
            ],
            [
                'question_text' => 'In classical perspective drawing, what is the "Vanishing Point"?',
                'option_a' => 'The spot where an artist accidentally spilled ink.',
                'option_b' => 'The point on the horizon line where parallel lines receding into depth appear to converge.',
                'option_c' => 'The bottom edge of the drawing paper.',
                'option_d' => 'The center point where lighting always originates.',
                'correct_option' => 'B',
                'explanation' => 'The vanishing point creates realistic 3D depth and spatial illusion on a 2D flat plane.'
            ],
            [
                'question_text' => 'What makes an iconic logo (like Apple, Nike, or Olympic Rings) timeless and universally recognized?',
                'option_a' => 'Having 25 different gradients and tiny detailed text paragraphs.',
                'option_b' => 'Radical simplicity, distinct silhouette, memorability, and scalability across mediums.',
                'option_c' => 'Copying whatever design is trending this month on TikTok.',
                'option_d' => 'Using complex 3D photorealistic illustrations.',
                'correct_option' => 'B',
                'explanation' => 'Timeless design relies on clarity of silhouette, emotional resonance, and reproducible simplicity.'
            ],
            [
                'question_text' => 'How does strong directional side-lighting (Chiaroscuro) alter the perception of a sculpture or portrait?',
                'option_a' => 'It flattens the image into a 2D cartoon.',
                'option_b' => 'It accentuates physical texture, drama, sculptural depth, and emotional gravity through deep contrast.',
                'option_c' => 'It turns all colors into monochrome green.',
                'option_d' => 'It renders the subject unrecognizable.',
                'correct_option' => 'B',
                'explanation' => 'Chiaroscuro (light-dark play) enhances 3D dimensionality, tactile realism, and psychological depth.'
            ],
            [
                'question_text' => 'When you encounter a poorly designed physical tool (e.g., an awkward kettle or unreadable transit map), what is your reaction?',
                'option_a' => 'I never notice anything about design or how objects look and function.',
                'option_b' => 'I immediately deconstruct the ergonomic flaw and envision how to redesign it for beauty and effortless utility.',
                'option_c' => 'I assume bad design is inevitable and nobody should try to improve it.',
                'option_d' => 'I blame myself for not understanding the awkward object.',
                'correct_option' => 'B',
                'explanation' => 'Artistic and design aptitude instinctively blends aesthetics with human-centered functionality.'
            ],
            [
                'question_text' => 'In contemporary animation, video game production, and film pre-production, what is the role of "Concept Art"?',
                'option_a' => 'To print posters after the movie is already completely finished.',
                'option_b' => 'To visualize and explore the visual language, character looks, environments, and mood before technical production begins.',
                'option_c' => 'To write the legal contracts for voice actors.',
                'option_d' => 'To design the website cookie banner.',
                'correct_option' => 'B',
                'explanation' => 'Concept art establishes the aesthetic blueprint and visual identity of interactive and film worlds.'
            ],
            [
                'question_text' => 'In visual psychology, what feeling is instinctively evoked by soft, rounded, organic shapes compared to sharp, jagged angles?',
                'option_a' => 'Danger, aggression, and extreme alertness.',
                'option_b' => 'Warmth, friendliness, approachability, and safety.',
                'option_c' => 'Mathematical precision and industrial coldness.',
                'option_d' => 'Fear and apprehension.',
                'correct_option' => 'B',
                'explanation' => 'Human evolution associates sharp jagged angles with thorns and teeth, while round organic shapes signal safety.'
            ],
            [
                'question_text' => 'What is the strategic purpose of creating a "Mood Board" at the genesis of an artistic or branding campaign?',
                'option_a' => 'To copy someone else’s artwork pixel-for-pixel and claim it as your own.',
                'option_b' => 'To synthesize textures, color palettes, references, and emotional tone to align the creative vision.',
                'option_c' => 'To compute the final production budget spreadsheet.',
                'option_d' => 'To replace the need for any actual drawing or design work.',
                'correct_option' => 'B',
                'explanation' => 'Mood boards crystallize abstract creative concepts into a unified visual direction for collaborators.'
            ],
            [
                'question_text' => 'In dramatic storytelling and theatrical acting, what does "Subtext" mean?',
                'option_a' => 'The subtitles printed at the bottom of foreign films.',
                'option_b' => 'The underlying unspoken meaning, motivation, and emotion beneath the literal dialogue spoken by a character.',
                'option_c' => 'The fonts chosen on the script cover.',
                'option_d' => 'The stage directions for lighting technicians.',
                'correct_option' => 'B',
                'explanation' => 'Subtext is the emotional truth and hidden intention pulsating underneath spoken words.'
            ],
            [
                'question_text' => 'How does color temperature (Warm vs. Cool tones) influence atmospheric depth in landscape painting?',
                'option_a' => 'Cool tones always appear closest to the viewer; warm tones fade into the distance.',
                'option_b' => 'Warm tones advance forward toward the viewer, while cool desaturated tones recede into atmospheric distance.',
                'option_c' => 'Color temperature has no effect on perceived distance.',
                'option_d' => 'Everything in the distance must be painted pitch black.',
                'correct_option' => 'B',
                'explanation' => 'Atmospheric perspective causes distant objects to shift toward cool, low-contrast hazy tones.'
            ],
            [
                'question_text' => 'When reviewing and critiquing your own creative projects, what mindset produces the highest artistic growth?',
                'option_a' => 'Believing everything you create is absolute perfection that cannot be improved.',
                'option_b' => 'Objective detachment: ruthlessly analyzing composition, craft, and emotional impact without taking critique as personal failure.',
                'option_c' => 'Destroying all your artwork in shame whenever you spot a minor imperfection.',
                'option_d' => 'Asking only family members who always say "it looks nice".',
                'correct_option' => 'B',
                'explanation' => 'Artistic mastery requires combining intense creative passion with dispassionate objective editorial craft.'
            ],
            [
                'question_text' => 'In digital product design, what is the golden rule regarding aesthetics versus usability?',
                'option_a' => 'A design should look dazzling even if users cannot figure out how to click a button.',
                'option_b' => 'Form must follow function: intuitive usability and clarity elevate visual elegance into exceptional user experience.',
                'option_c' => 'Digital products should avoid visual beauty completely to save bandwidth.',
                'option_d' => 'Buttons should move unpredictably to keep users surprised.',
                'correct_option' => 'B',
                'explanation' => 'Great design marries intuitive functionality with breathtaking aesthetics seamlessly.'
            ]
        ];

        // 3. SPORTS APTITUDE (20 Questions)
        $sportsQuestions = [
            [
                'question_text' => 'In dynamic team sports (football, basketball, hockey), what is meant by an athlete’s "Spatial Awareness"?',
                'option_a' => 'Knowing how many people are sitting in the stadium stands.',
                'option_b' => 'Constantly scanning and predicting the positions, open spaces, and trajectories of teammates, opponents, and the ball.',
                'option_c' => 'Measuring the length of the boundary lines before the match.',
                'option_d' => 'Looking only down at one’s own shoes while running.',
                'correct_option' => 'B',
                'explanation' => 'Spatial intelligence in sports enables anticipation, tactical positioning, and rapid high-pressure decision making.'
            ],
            [
                'question_text' => 'What is the scientifically verified purpose of dynamic stretching during a pre-game warmup?',
                'option_a' => 'To completely relax the muscles and prepare the body for sleep.',
                'option_b' => 'To elevate core body temperature, lubricate joints with synovial fluid, and activate nervous motor pathways through active movement.',
                'option_c' => 'To exhaust the athlete so they don’t get overexcited.',
                'option_d' => 'It is purely a ceremonial tradition with no physiological benefits.',
                'correct_option' => 'B',
                'explanation' => 'Dynamic warmups prime neurological recruitment, blood flow, and elasticity without reducing muscle power.'
            ],
            [
                'question_text' => 'When a player experiences intense performance anxiety before taking a game-deciding penalty or free-throw, which sports psychology technique is most effective?',
                'option_a' => 'Panicking and telling themselves they are going to ruin their career.',
                'option_b' => 'Box breathing to lower heart rate, positive process-focused self-talk, and visualizing successful execution.',
                'option_c' => 'Closing their eyes and hoping for pure luck without aiming.',
                'option_d' => 'Faking an injury to let someone else take the pressure.',
                'correct_option' => 'B',
                'explanation' => 'Arousal regulation through physiological breath control and motor imagery restores executive focus.'
            ],
            [
                'question_text' => 'In human biomechanics, which kinetic chain segment provides the primary power transfer for explosive throwing, batting, and sprinting?',
                'option_a' => 'Only the wrist and fingers.',
                'option_b' => 'The posterior chain and core (glutes, hamstrings, hips, and abdominal obliques).',
                'option_c' => 'The neck and cervical vertebrae.',
                'option_d' => 'The earlobes.',
                'correct_option' => 'B',
                'explanation' => 'Power originates from ground-reaction forces channeled through the hips and core into upper-limb extremities.'
            ],
            [
                'question_text' => 'During intense summer tournaments, what physiological imbalance is the primary cause of acute muscle cramping and sudden fatigue?',
                'option_a' => 'Consuming too much water.',
                'option_b' => 'Depletion of essential electrolytes (sodium, potassium, magnesium) combined with dehydration and neuromuscular fatigue.',
                'option_c' => 'Wearing brightly colored sports jerseys.',
                'option_d' => 'Eating too many fresh fruits.',
                'correct_option' => 'B',
                'explanation' => 'Electrolyte depletion impairs neural signaling to muscle fibers, triggering involuntary painful spasms.'
            ],
            [
                'question_text' => 'What does "Periodization" refer to in elite athletic training and conditioning programs?',
                'option_a' => 'Training with identical maximum intensity every single day of the year without rest.',
                'option_b' => 'The systematic planning of progressive training phases (hypertrophy, strength, power, peaking, and active recovery) to peak for major championships.',
                'option_c' => 'Limiting training only to weekends.',
                'option_d' => 'Playing sports only during specific calendar holidays.',
                'correct_option' => 'B',
                'explanation' => 'Periodization prevents chronic overtraining, optimizes physiological adaptations, and ensures peak performance when it matters most.'
            ],
            [
                'question_text' => 'If an opposing sports team relies heavily on an aggressive, high-speed forward attack, what tactical adjustment is most effective?',
                'option_a' => 'Panic and abandon defensive structure entirely.',
                'option_b' => 'Maintain disciplined compact defensive lines, absorb pressure, and exploit exposed spaces behind their defense on fast counter-attacks.',
                'option_c' => 'Instruct all players to sit down on the turf.',
                'option_d' => 'Commit intentional fouls continuously to get players red-carded.',
                'correct_option' => 'B',
                'explanation' => 'Tactical sports intelligence neutralizes opponent strengths by exploiting the vulnerabilities created by their aggressive positioning.'
            ],
            [
                'question_text' => 'Why is the "Anabolic Recovery Window" (within 30–60 minutes post-match) critical for athletic longevity?',
                'option_a' => 'It is the only time an athlete is allowed to drink liquids.',
                'option_b' => 'Glycogen replenishment and rapid protein synthesis repair micro-tears in muscle fibers and mitigate cortisol elevation.',
                'option_c' => 'It has no real importance and can be skipped without consequence.',
                'option_d' => 'To immediately gain excessive body fat.',
                'correct_option' => 'B',
                'explanation' => 'Post-exercise nutrient timing expedites muscle fiber repair, immune restoration, and glycogen replenishment.'
            ],
            [
                'question_text' => 'In sports psychology, what characterizes an athlete operating in the state of "Flow" (the Zone)?',
                'option_a' => 'Overthinking every single muscle movement and feeling paralyzed by crowd noise.',
                'option_b' => 'Effortless immersion where time perception warps, instincts take over, and peak execution feels spontaneous and fluid.',
                'option_c' => 'Experiencing total exhaustion and wanting to quit immediately.',
                'option_d' => 'Arguing aggressively with referees over every call.',
                'correct_option' => 'B',
                'explanation' => 'Flow state represents optimal transient hypofrontality where instinctive muscle memory operates without cognitive friction.'
            ],
            [
                'question_text' => 'Following a sudden acute ligament sprain on the field, what is the recognized first-aid protocol (R.I.C.E)?',
                'option_a' => 'Run, Ignite, Cool, Eat.',
                'option_b' => 'Rest, Ice, Compression, Elevation.',
                'option_c' => 'Rub vigorously, Ignore, Continue playing, Exercise immediately.',
                'option_d' => 'Rest, Inflame, Cast, Exercise.',
                'correct_option' => 'B',
                'explanation' => 'R.I.C.E minimizes localized swelling, protects injured tissue, and limits internal capillary hemorrhage.'
            ],
            [
                'question_text' => 'How should an elite team captain address a teammate who just committed a costly error in the final minutes of a championship match?',
                'option_a' => 'Scream insults at them in front of the entire stadium to humiliate them.',
                'option_b' => 'Provide immediate encouraging reassurance, refocus their attention on the next immediate play, and rally collective spirit.',
                'option_c' => 'Demand that the coach substitute them off instantly.',
                'option_d' => 'Walk off the field in disgust.',
                'correct_option' => 'B',
                'explanation' => 'Elite athletic leadership protects teammate confidence under fire and channels energy toward the immediate task.'
            ],
            [
                'question_text' => 'What is the key physiological distinction between Aerobic and Anaerobic energy metabolism?',
                'option_a' => 'Aerobic burns zero calories; anaerobic burns all calories.',
                'option_b' => 'Aerobic utilizes oxygen for sustained endurance output; anaerobic operates without oxygen for short, explosive maximum-power bursts.',
                'option_c' => 'Anaerobic is only used while swimming underwater.',
                'option_d' => 'Aerobic is only used by elderly athletes.',
                'correct_option' => 'B',
                'explanation' => 'Aerobic metabolism fuels continuous endurance (marathons, cycling), while anaerobic fuels sprints, jumps, and heavy lifts.'
            ],
            [
                'question_text' => 'Why do modern professional sports franchises heavily invest in video analytics and biometric wearable trackers?',
                'option_a' => 'To spy on players’ personal social lives.',
                'option_b' => 'To identify micro-tactical patterns, monitor physical load to prevent soft-tissue injuries, and optimize tactical game plans with empirical data.',
                'option_c' => 'Because coaches have no understanding of sports and rely purely on robots.',
                'option_d' => 'To make training sessions unnecessarily stressful.',
                'correct_option' => 'B',
                'explanation' => 'Sports analytics transforms biometric loads and tactical telemetry into competitive edges and injury reduction.'
            ],
            [
                'question_text' => 'What is the single most common cause of non-contact ACL tears and chronic tendonitis in competitive athletes?',
                'option_a' => 'Drinking cold water after games.',
                'option_b' => 'Poor landing mechanics, muscular imbalances between quadriceps and hamstrings, and chronic unaddressed fatigue.',
                'option_c' => 'Wearing cleats that are one size too small.',
                'option_d' => 'Running on artificial turf on rainy days only.',
                'correct_option' => 'B',
                'explanation' => 'Valgus knee collapse, hamstring deficit, and neuromuscular fatigue under deceleration cause non-contact knee trauma.'
            ],
            [
                'question_text' => 'In the sports industry, what is the core responsibility of a Sports Manager or Athletic Director?',
                'option_a' => 'Cooking meals for the players every day.',
                'option_b' => 'Managing athlete contracts, endorsements, logistics, club branding, player welfare, and institutional growth.',
                'option_c' => 'Playing in the game if a player gets injured.',
                'option_d' => 'Selling tickets at the front gate.',
                'correct_option' => 'B',
                'explanation' => 'Sports managers orchestrate the business, commercial, and operational infrastructure of athletes and athletic teams.'
            ],
            [
                'question_text' => 'What does an athlete\'s VO2 Max metric quantify in sports performance physiology?',
                'option_a' => 'The maximum weight an athlete can bench-press in one repetition.',
                'option_b' => 'The maximum volume of oxygen the body can transport and utilize per minute during incremental exhaustive exercise.',
                'option_c' => 'The maximum speed an athlete can run downhill.',
                'option_d' => 'The lung capacity of an athlete when holding their breath underwater.',
                'correct_option' => 'B',
                'explanation' => 'VO2 Max is the gold standard measurement of cardiorespiratory fitness and aerobic capacity.'
            ],
            [
                'question_text' => 'When a coach notices their team is leading by a narrow margin with 5 minutes remaining, what game management strategy is prudent?',
                'option_a' => 'Instruct everyone to attack blindly and leave their goalkeeper alone.',
                'option_b' => 'Prioritize possession retention, minimize risky passes in dangerous zones, manage the clock, and maintain disciplined defensive compactness.',
                'option_c' => 'Stop playing and argue with the opposing manager.',
                'option_d' => 'Tell all players to run as fast as possible in circles.',
                'correct_option' => 'B',
                'explanation' => 'Game management requires risk minimization, tempo control, and tactical discipline in closing phases.'
            ],
            [
                'question_text' => 'How does deep sleep (Stages 3 & 4) and REM sleep directly affect an athlete’s reflexes and motor skill learning?',
                'option_a' => 'Sleep makes muscles shrink and reaction times slower.',
                'option_b' => 'Human Growth Hormone (HGH) is released for tissue repair, and the brain consolidates new motor patterns into long-term procedural memory.',
                'option_c' => 'Sleep has zero impact on physical athletic performance.',
                'option_d' => 'It only benefits bodybuilders, not sports athletes.',
                'correct_option' => 'B',
                'explanation' => 'Neurobiological consolidation of motor skills and physiological endocrine repair occur predominantly during deep sleep.'
            ],
            [
                'question_text' => 'What is the true definition of "Sportsmanship" in competitive athletics?',
                'option_a' => 'Pretending to be polite only when cameras are rolling.',
                'option_b' => 'Upholding fairness, ethics, respect for opponents and officials, and grace in both victory and defeat.',
                'option_c' => 'Letting the opponent win intentionally so they feel good.',
                'option_d' => 'Celebrating excessively in front of a losing opponent to mock them.',
                'correct_option' => 'B',
                'explanation' => 'Sportsmanship preserves the moral integrity of competition, demonstrating character beyond the scoreboard.'
            ],
            [
                'question_text' => 'Why is rotational core stability critical even in non-contact individual sports like golf, tennis, or archery?',
                'option_a' => 'It only looks aesthetic in fitness photographs.',
                'option_b' => 'It acts as the central kinetic anchor, allowing efficient torque generation and protecting the lumbar spine from rotational shear stresses.',
                'option_c' => 'It makes the athletic equipment feel lighter.',
                'option_d' => 'It prevents the athlete from sweating.',
                'correct_option' => 'B',
                'explanation' => 'Rotational power in striking and shooting sports requires a strong core cylinder to transfer torque without spinal injury.'
            ]
        ];

        // 4. BUSINESS APTITUDE (20 Questions)
        $businessQuestions = [
            [
                'question_text' => 'What does achieving "Product-Market Fit" (PMF) signify for an entrepreneurial venture?',
                'option_a' => 'Having a pretty logo and registering a trademark.',
                'option_b' => 'Building a product that satisfies strong market demand, proven by rapid organic user retention, willingness to pay, and word-of-mouth referral.',
                'option_c' => 'Spending your entire investment capital on celebrity endorsements before launching.',
                'option_d' => 'Hiring 50 employees before writing a single line of code or making one sale.',
                'correct_option' => 'B',
                'explanation' => 'Product-Market Fit occurs when a business identifies a desperate market demand and fulfills it with a product customers love and sustain.'
            ],
            [
                'question_text' => 'If a business shows strong accounting profits on paper but struggles every month to pay employee salaries and vendor invoices, what is the primary diagnosis?',
                'option_a' => 'The business is too wealthy.',
                'option_b' => 'A severe Cash Flow crisis (working capital is locked in unpaid receivables, delayed client payments, or unsold inventory).',
                'option_c' => 'The company’s computers are malfunctioning.',
                'option_d' => 'Sales are too high to handle.',
                'correct_option' => 'B',
                'explanation' => 'Profit is an accounting concept; cash is reality. Profitable companies often fail due to insolvent working capital cycles.'
            ],
            [
                'question_text' => 'In strategic business negotiations, what does the concept "BATNA" (Best Alternative to a Negotiated Agreement) empower you to do?',
                'option_a' => 'Threaten the other party with unlawful actions.',
                'option_b' => 'Know your strongest fallback option, giving you the leverage and confidence to walk away from an unfavorable deal.',
                'option_c' => 'Accept whatever terms the other party offers out of desperation.',
                'option_d' => 'Avoid talking directly to the other party.',
                'correct_option' => 'B',
                'explanation' => 'A strong BATNA provides negotiating power; if the counterparty’s offer is worse than your fallback, you comfortably decline.'
            ],
            [
                'question_text' => 'When launching a new business idea, why do lean startup methodologies insist on releasing a Minimum Viable Product (MVP)?',
                'option_a' => 'To sell defective products to unsuspecting consumers.',
                'option_b' => 'To test core hypotheses and gather real customer feedback with minimum time and capital before committing massive resources.',
                'option_c' => 'To show investors that you do not care about quality.',
                'option_d' => 'Because building a complete product is always impossible.',
                'correct_option' => 'B',
                'explanation' => 'An MVP tests foundational value propositions in the real market, preventing costly wasted development on unwanted features.'
            ],
            [
                'question_text' => 'What is the golden metric relationship between Customer Acquisition Cost (CAC) and Customer Lifetime Value (LTV) for a healthy business?',
                'option_a' => 'CAC should be at least 10 times higher than LTV.',
                'option_b' => 'LTV should comfortably exceed CAC (ideally 3x or higher), ensuring the gross profit generated per customer far outweighs the cost to acquire them.',
                'option_c' => 'CAC and LTV are completely unrelated to business profitability.',
                'option_d' => 'A business should aim to have zero customers to keep CAC at zero.',
                'correct_option' => 'B',
                'explanation' => 'An LTV:CAC ratio of 3:1 or higher represents a sustainable, scalable business model where unit economics are solidly profitable.'
            ],
            [
                'question_text' => 'In pricing strategy, how does "Value-Based Pricing" differ from simple "Cost-Plus Pricing"?',
                'option_a' => 'Cost-plus prices based on what customers value; value-based pricing ignores customer perceptions.',
                'option_b' => 'Value-based pricing sets prices based on the perceived economic value and return-on-investment delivered to the customer, rather than just production cost + markup.',
                'option_c' => 'Value-based pricing means offering everything completely free of charge.',
                'option_d' => 'Cost-plus pricing is only used by non-profit organizations.',
                'correct_option' => 'B',
                'explanation' => 'Value-based pricing captures the true economic transformation delivered to the buyer, unlocking significantly higher profit margins.'
            ],
            [
                'question_text' => 'In competitive business strategy, what is a "Moat" (sustainable competitive advantage)?',
                'option_a' => 'A physical water ditch dug around the company’s corporate office.',
                'option_b' => 'A durable defensive advantage (such as network effects, high switching costs, proprietary patents, or brand loyalty) that prevents competitors from eroding market share.',
                'option_c' => 'A temporary price discount that competitors can immediately match.',
                'option_d' => 'A government subsidy that expires in two weeks.',
                'correct_option' => 'B',
                'explanation' => 'An economic moat protects long-term market dominance and high return on capital against rival imitation.'
            ],
            [
                'question_text' => 'In consumer psychology and e-commerce conversion, what is the "Social Proof" phenomenon?',
                'option_a' => 'Proving that a customer has a valid social media account.',
                'option_b' => 'The psychological tendency where buyers look to the actions, verified reviews, testimonials, and endorsements of peers when making purchase decisions.',
                'option_c' => 'Forcing employees to attend social parties every weekend.',
                'option_d' => 'Giving products away exclusively to celebrities.',
                'correct_option' => 'B',
                'explanation' => 'Social proof reduces buyer skepticism and risk perception by validating quality through real user experiences.'
            ],
            [
                'question_text' => 'If a subscription software platform gains 10,000 new users in month one, but 85% of them cancel by month two (high churn rate), what must management prioritize?',
                'option_a' => 'Double the marketing budget to acquire another 20,000 users into the leaky bucket.',
                'option_b' => 'Halt aggressive ad spend, interview churned users, and fix onboarding friction and product value delivery to repair retention.',
                'option_c' => 'Blame the customers for not understanding the software.',
                'option_d' => 'Triple the subscription price on remaining users.',
                'correct_option' => 'B',
                'explanation' => 'Fixing retention (plugging the leaky bucket) is prerequisite to scalable growth; marketing spend on high churn burns capital.'
            ],
            [
                'question_text' => 'In corporate finance, what does the "Gross Profit Margin" measure?',
                'option_a' => 'Total revenue minus only the Direct Cost of Goods Sold (COGS), showing how efficiently products are produced before overhead expenses.',
                'option_b' => 'The amount of money left after paying corporate income taxes and shareholder dividends.',
                'option_c' => 'The personal salary drawn by the CEO.',
                'option_d' => 'The total valuation of the company on the stock exchange.',
                'correct_option' => 'A',
                'explanation' => 'Gross margin evaluates the raw profitability of core product delivery before administrative, sales, and tax deductions.'
            ],
            [
                'question_text' => 'When delegating a strategic initiative to a capable team member, what is the most effective managerial approach?',
                'option_a' => 'Micromanage every single keystroke and email they send.',
                'option_b' => 'Clearly define the desired outcome, objectives, and boundaries, and empower them with autonomy to execute while offering support and milestones.',
                'option_c' => 'Give zero instructions and blame them when things go wrong.',
                'option_d' => 'Take the project back after two days and do it yourself.',
                'correct_option' => 'B',
                'explanation' => 'Empowered delegation develops talent, scales operational velocity, and drives accountability.'
            ],
            [
                'question_text' => 'What does a "Pivot" represent in the lifecycle of an innovative business?',
                'option_a' => 'Filing for company bankruptcy and closing down.',
                'option_b' => 'Strategically shifting the business model, target customer, or core product direction based on market validation while keeping the overarching mission alive.',
                'option_c' => 'Changing the company logo colors once every quarter.',
                'option_d' => 'Firing the entire engineering team to hire accountants.',
                'correct_option' => 'B',
                'explanation' => 'A pivot is a disciplined change in strategy designed to test a new fundamental hypothesis about the product, business model, and engine of growth.'
            ],
            [
                'question_text' => 'When macroeconomic inflation rises significantly, which consumer segment typically experiences the sharpest decline in business demand?',
                'option_a' => 'Essential food staples and life-saving pharmaceuticals.',
                'option_b' => 'Non-essential luxury items, high-end dining, and discretionary recreational purchases.',
                'option_c' => 'Municipal water utilities.',
                'option_d' => 'Basic household electricity.',
                'correct_option' => 'B',
                'explanation' => 'Inflation squeezes disposable income, causing households to prioritize essentials over non-essential discretionary goods.'
            ],
            [
                'question_text' => 'What is the core structural difference between B2B (Business-to-Business) and B2C (Business-to-Consumer) sales?',
                'option_a' => 'B2B has instant impulse buying decisions; B2C takes 9 months of committee meetings.',
                'option_b' => 'B2B typically involves higher contract values, multiple stakeholder decision-makers, and longer evaluation cycles focused on ROI; B2C tends to be faster and emotionally driven.',
                'option_c' => 'B2B companies never make a profit.',
                'option_d' => 'B2C products are only sold through newspapers.',
                'correct_option' => 'B',
                'explanation' => 'B2B transactions require navigating multiple organizational stakeholders, formal procurement, and quantifiable business ROI.'
            ],
            [
                'question_text' => 'In startup equity financing, what is a "Cap Table" (Capitalization Table)?',
                'option_a' => 'A physical table placed in the boardroom where executives wear baseball caps.',
                'option_b' => 'A ledger detailing the ownership stakes, share classes, option pools, and equity percentages held by founders, employees, and investors.',
                'option_c' => 'A list of corporate office furniture expenses.',
                'option_d' => 'A table showing the maximum salary payable to interns.',
                'correct_option' => 'B',
                'explanation' => 'A capitalization table tracks equity dilution, share ownership, and investment rights across funding rounds.'
            ],
            [
                'question_text' => 'Why is client diversification critical for consulting firms, agencies, and manufacturers?',
                'option_a' => 'To make bookkeeping as complicated as possible.',
                'option_b' => 'To avoid catastrophic revenue collapse if a single dominant client (representing 50%+ of billings) unexpectedly leaves or renegotiates terms.',
                'option_c' => 'Because having multiple clients guarantees zero competition.',
                'option_d' => 'It has no real impact on corporate survival.',
                'correct_option' => 'B',
                'explanation' => 'High client concentration risk leaves a business vulnerable to sudden insolvency if a single account defects.'
            ],
            [
                'question_text' => 'What distinguishes "Transformational Leadership" from ordinary "Transactional Management"?',
                'option_a' => 'Transformational managers only punish mistakes, while transactional managers ignore all deadlines.',
                'option_b' => 'Transformational leaders inspire, cast vision, foster innovation, and develop people beyond mere compliance; transactional managers focus on basic task compliance and carrot-and-stick exchanges.',
                'option_c' => 'They are identical management styles with no practical difference.',
                'option_d' => 'Transactional leadership is only used in sports teams.',
                'correct_option' => 'B',
                'explanation' => 'Transformational leadership drives cultural alignment, creative problem-solving, and shared mission commitment.'
            ],
            [
                'question_text' => 'According to empirical business research, what is the single most common reason why new business ventures fail within the first 3 years?',
                'option_a' => 'The logo was not colorful enough.',
                'option_b' => 'Building something the market did not actually want or need (lack of market need) combined with running out of cash.',
                'option_c' => 'Having too many enthusiastic customers.',
                'option_d' => 'Pricing products too profitably.',
                'correct_option' => 'B',
                'explanation' => 'No market need is the #1 killer of startups; premature scaling without validated demand burns cash reserves.'
            ],
            [
                'question_text' => 'In digital marketing and conversion rate optimization (CRO), what is an "A/B Split Test"?',
                'option_a' => 'Testing whether employees prefer apples or bananas in the cafeteria.',
                'option_b' => 'Simultaneously displaying two variations of a webpage or ad to randomized segments of traffic to scientifically determine which drives higher conversion.',
                'option_c' => 'Splitting the company into two separate legal entities every month.',
                'option_d' => 'Asking only the CEO which design they personally like better.',
                'correct_option' => 'B',
                'explanation' => 'A/B testing removes subjective guesswork by measuring real consumer behavioral conversion data.'
            ],
            [
                'question_text' => 'When demand for a specialized, highly scarce technical or consulting service surges by 300% with fixed supply, what economic dynamic occurs?',
                'option_a' => 'The market clearing price and pricing power of the service provider increase substantially.',
                'option_b' => 'The service provider is legally forced to lower their fees to zero.',
                'option_c' => 'All customers will permanently stop buying the service.',
                'option_d' => 'The quality of the service will automatically decline overnight.',
                'correct_option' => 'A',
                'explanation' => 'Basic supply and demand elasticity dictates that surging demand against inelastic supply drastically expands pricing power.'
            ]
        ];

        // Seed to database
        foreach ($spiritualQuestions as $q) {
            SpecializedAptitudeQuestion::updateOrCreate(
                ['category' => 'spiritual', 'question_text' => $q['question_text']],
                array_merge($q, ['category' => 'spiritual'])
            );
        }

        foreach ($artisticQuestions as $q) {
            SpecializedAptitudeQuestion::updateOrCreate(
                ['category' => 'artistic', 'question_text' => $q['question_text']],
                array_merge($q, ['category' => 'artistic'])
            );
        }

        foreach ($sportsQuestions as $q) {
            SpecializedAptitudeQuestion::updateOrCreate(
                ['category' => 'sports', 'question_text' => $q['question_text']],
                array_merge($q, ['category' => 'sports'])
            );
        }

        foreach ($businessQuestions as $q) {
            SpecializedAptitudeQuestion::updateOrCreate(
                ['category' => 'business', 'question_text' => $q['question_text']],
                array_merge($q, ['category' => 'business'])
            );
        }
    }

    private function seedCourses(): void
    {
        $courses = [
            // ─── SPIRITUAL COURSES (6) ───
            [
                'category' => 'spiritual',
                'title' => 'B.A. in Philosophy, Applied Ethics & Mind Sciences',
                'slug' => 'ba-philosophy-ethics-mind-sciences',
                'duration' => '3 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 from any recognized board with minimum 50% aggregate marks.',
                'description' => 'A comprehensive interdisciplinary program exploring classical Indian philosophy, Western epistemology, cognitive science, applied bioethics, and philosophical counseling.',
                'key_skills' => ['Critical Thinking', 'Ethical Decision Making', 'Logical Dialectics', 'Philosophical Counseling', 'Moral Epistemology'],
                'top_colleges' => ['St. Stephen’s College, Delhi', 'Presidency College, Kolkata', 'Madras Christian College, Chennai', 'Fergusson College, Pune', 'Banaras Hindu University (BHU), Varanasi'],
                'career_roles' => ['Ethics Advisor & Consultant', 'Philosophical Counselor', 'Academic Professor & Researcher', 'Public Policy Analyst', 'Non-Profit Director'],
                'salary_range' => '₹4.5 - ₹12.0 LPA',
                'average_fees' => '₹30,000 - ₹1,20,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'spiritual',
                'title' => 'B.Sc. in Yogic Science & Holistic Integrative Health',
                'slug' => 'bsc-yogic-science-holistic-health',
                'duration' => '3 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 with Science preferred (or any stream with minimum 50%).',
                'description' => 'Integrates classical Patanjali yoga, human anatomy, autonomic physiology, therapeutic breathwork (Pranayama), nutrition, and preventative wellness methodologies.',
                'key_skills' => ['Yogic Therapy Protocols', 'Human Autonomic Physiology', 'Pranayama & Asana Alignment', 'Holistic Health Assessment', 'Stress Management Protocols'],
                'top_colleges' => ['SVYASA Yoga University, Bengaluru', 'Morarji Desai National Institute of Yoga, New Delhi', 'Dev Sanskriti Vishwavidyalaya, Haridwar', 'Kaivalyadhama Institute, Lonavala', 'Patanjali University, Haridwar'],
                'career_roles' => ['Clinical Yoga Therapist', 'Corporate Wellness Director', 'Holistic Health Coach', 'Yoga Studio Founder', 'Rehabilitation Specialist'],
                'salary_range' => '₹4.0 - ₹10.5 LPA',
                'average_fees' => '₹40,000 - ₹1,50,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'spiritual',
                'title' => 'Post-Graduate Diploma in Spiritual Counseling & Mindfulness Mentorship',
                'slug' => 'pg-diploma-spiritual-counseling-mindfulness',
                'duration' => '1 Year',
                'level' => 'Post-Graduate Diploma',
                'eligibility' => 'Graduation in Psychology, Philosophy, Social Work, or any allied discipline.',
                'description' => 'Prepares practitioners to deliver empathetic spiritual guidance, existential crisis counseling, palliative support, and secular mindfulness programs for corporate and healthcare institutions.',
                'key_skills' => ['Existential Counseling', 'Compassionate Listening', 'Mindfulness-Based Stress Reduction (MBSR)', 'Palliative Care Guidance', 'Trauma-Informed Presence'],
                'top_colleges' => ['Tata Institute of Social Sciences (TISS), Mumbai', 'NIMHANS, Bengaluru', 'Jamia Millia Islamia, New Delhi', 'University of Madras, Chennai', 'Amity Institute of Psychology & Allied Sciences'],
                'career_roles' => ['Spiritual Life Coach', 'Hospital Chaplain / Palliative Counselor', 'Corporate Mindfulness Trainer', 'Addiction Recovery Counselor', 'Wellness Center Mentor'],
                'salary_range' => '₹5.0 - ₹14.0 LPA',
                'average_fees' => '₹50,000 - ₹1,80,000 total',
                'is_featured' => true,
            ],
            [
                'category' => 'spiritual',
                'title' => 'M.A. in Comparative Religions, Vedic Studies & Interfaith Leadership',
                'slug' => 'ma-comparative-religions-vedic-studies',
                'duration' => '2 Years',
                'level' => 'Master Degree',
                'eligibility' => 'Bachelor’s Degree in any discipline with minimum 50% marks.',
                'description' => 'Explores universal mystical traditions across Hinduism, Buddhism, Christianity, Islam, Jainism, and Sikhism with a focus on peacebuilding, interfaith diplomacy, and civilizational harmony.',
                'key_skills' => ['Interfaith Mediation', 'Vedic Hermeneutics', 'Cross-Cultural Literacy', 'Conflict Resolution', 'Civilizational History'],
                'top_colleges' => ['Jawaharlal Nehru University (JNU), New Delhi', 'Banaras Hindu University (BHU), Varanasi', 'Savitribai Phule Pune University, Pune', 'University of Hyderabad, Hyderabad', 'Visva-Bharati University, Santiniketan'],
                'career_roles' => ['Interfaith Diplomat', 'Think-Tank Cultural Analyst', 'International NGO Coordinator', 'Heritage Preservation Officer', 'Author & Keynote Speaker'],
                'salary_range' => '₹4.5 - ₹11.0 LPA',
                'average_fees' => '₹25,000 - ₹90,000 / year',
                'is_featured' => false,
            ],
            [
                'category' => 'spiritual',
                'title' => 'Post-Graduate Certificate in Corporate Ethics & Value-Based Leadership',
                'slug' => 'pg-certificate-corporate-ethics-leadership',
                'duration' => '6 Months',
                'level' => 'Executive Certification',
                'eligibility' => 'Bachelor’s degree with professional or corporate interest.',
                'description' => 'Bridges ancient ethical frameworks with modern ESG (Environmental, Social & Governance), boardroom accountability, whistleblower policy, and integrity-driven executive leadership.',
                'key_skills' => ['ESG Governance', 'Corporate Moral Auditing', 'Value-Based Decision Modeling', 'Ethical Compliance', 'Culture Engineering'],
                'top_colleges' => ['Indian Institute of Management (IIM) Bangalore', 'XLRI - Xavier School of Management, Jamshedpur', 'SPJIMR, Mumbai', 'Indian Institute of Corporate Affairs (IICA), Manesar', 'NMIMS, Mumbai'],
                'career_roles' => ['Chief Ethics Officer (CEthO)', 'ESG Compliance Director', 'Corporate Culture Strategist', 'Boardroom Governance Advisor', 'Leadership Consultant'],
                'salary_range' => '₹8.0 - ₹25.0 LPA',
                'average_fees' => '₹75,000 - ₹2,50,000 total',
                'is_featured' => true,
            ],
            [
                'category' => 'spiritual',
                'title' => 'Advanced Diploma in Integrative Vedic Psychology & Mental Well-Being',
                'slug' => 'advanced-diploma-vedic-psychology',
                'duration' => '1 Year',
                'level' => 'Diploma',
                'eligibility' => '10+2 or Graduation in any discipline.',
                'description' => 'Studies Guna psychology (Sattva, Rajas, Tamas), Antahkarana models of consciousness, mental equanimity practices, and Ayurvedic lifestyle balancing for stress relief.',
                'key_skills' => ['Guna Analysis', 'Ayurvedic Lifestyle Counseling', 'Triguna Mental Profiling', 'Emotional Balance Coaching', 'Sattva Cultivation Protocol'],
                'top_colleges' => ['Chinmaya Vishwa Vidyapeeth, Ernakulam', 'Gujarat Ayurved University, Jamnagar', 'National Institute of Ayurveda, Jaipur', 'Rashtriya Sanskrit Sansthan, New Delhi', 'Tilak Maharashtra Vidyapeeth, Pune'],
                'career_roles' => ['Vedic Wellness Counselor', 'Ayurveda Lifestyle Coach', 'Integrative Wellness Director', 'Stress Relief Facilitator', 'Spiritual Retreat Guide'],
                'salary_range' => '₹3.8 - ₹9.0 LPA',
                'average_fees' => '₹35,000 - ₹1,10,000 total',
                'is_featured' => false,
            ],

            // ─── ARTISTIC COURSES (6) ───
            [
                'category' => 'artistic',
                'title' => 'B.Des in Visual Communication, Graphic Design & Digital Branding',
                'slug' => 'bdes-visual-communication-graphic-design',
                'duration' => '4 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 in any stream (Entrance exams: NID DAT, UCEED, or institute aptitude test).',
                'description' => 'A prestigious studio-based program covering typography, brand identity systems, publication design, digital UI/UX, packaging aesthetics, and strategic visual storytelling.',
                'key_skills' => ['Adobe Creative Suite & Figma', 'Brand Identity Systems', 'Typography & Layout', 'Visual Storytelling', 'Design Thinking & UX'],
                'top_colleges' => ['National Institute of Design (NID), Ahmedabad', 'IDC School of Design (IIT Bombay), Mumbai', 'Srishti Manipal Institute of Art & Design, Bengaluru', 'MIT Institute of Design, Pune', 'National Institute of Fashion Technology (NIFT), New Delhi'],
                'career_roles' => ['Creative Art Director', 'Senior Graphic Designer', 'Brand Identity Architect', 'UI/UX Visual Lead', 'Packaging Designer'],
                'salary_range' => '₹5.5 - ₹18.0 LPA',
                'average_fees' => '₹1,80,000 - ₹4,50,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'artistic',
                'title' => 'Bachelor of Fine Arts (B.F.A.) in Applied Arts & Illustration',
                'slug' => 'bfa-applied-arts-illustration',
                'duration' => '4 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 in any stream with creative aptitude test (MH-AAC-CET / College Portfolio).',
                'description' => 'Rigorous training in foundational drawing, digital illustration, commercial advertising art, conceptual painting, and creative campaign direction.',
                'key_skills' => ['Digital & Traditional Illustration', 'Concept Artistry', 'Visual Campaign Design', 'Anatomical & Figure Drawing', 'Color Harmony Mastery'],
                'top_colleges' => ['Sir J.J. Institute of Applied Art, Mumbai', 'College of Art, New Delhi', 'Faculty of Visual Arts (BHU), Varanasi', 'Kala Bhavana (Visva-Bharati), Santiniketan', 'Government College of Fine Arts, Chennai'],
                'career_roles' => ['Commercial Illustrator', 'Concept Artist', 'Advertising Creative Director', 'Storyboard Artist', 'Gallery Artist & Muralist'],
                'salary_range' => '₹4.5 - ₹14.0 LPA',
                'average_fees' => '₹25,000 - ₹1,40,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'artistic',
                'title' => 'B.Sc. in Animation, VFX & Interactive Game Art',
                'slug' => 'bsc-animation-vfx-game-art',
                'duration' => '3 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 in any stream with passion for animation, gaming, or visual effects.',
                'description' => 'Covers 3D character modeling, rigging, keyframe character animation, compositing (Nuke/After Effects), Unreal Engine game environments, and CGI visual effects.',
                'key_skills' => ['Maya, Blender & 3ds Max', 'Unreal Engine 5 & Unity', '3D Character Rigging & Animation', 'VFX Compositing & Simulation', 'Texture & Lighting Shading'],
                'top_colleges' => ['Arena Animation & MAAC Institutes', 'Whistling Woods International, Mumbai', 'Asian Academy of Film and Television (AAFT), Noida', 'St. Xavier’s College, Kolkata', 'Loyola College, Chennai'],
                'career_roles' => ['3D Character Animator', 'VFX Compositor', 'Game Environment Artist', 'Motion Graphics Designer', 'Technical Lighting Artist'],
                'salary_range' => '₹4.8 - ₹16.0 LPA',
                'average_fees' => '₹1,20,000 - ₹3,50,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'artistic',
                'title' => 'B.A. in Filmmaking, Cinematography & Screenplay Direction',
                'slug' => 'ba-filmmaking-cinematography-direction',
                'duration' => '3 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 in any stream with creative interview or portfolio.',
                'description' => 'Hands-on cinema production covering camera optics, lighting composition, narrative direction, sound design, and color grading on professional digital cinema rigs.',
                'key_skills' => ['Cinematographic Lighting', 'Camera Operation & Optics', 'Dramatic Screenplay Writing', 'Video Editing (Premiere / DaVinci Resolve)', 'Film Directing & Staging'],
                'top_colleges' => ['Film and Television Institute of India (FTII), Pune', 'Satyajit Ray Film & Television Institute (SRFTI), Kolkata', 'Whistling Woods International, Mumbai', 'Annapurna College of Film and Media, Hyderabad', 'LV Prasad Film & TV Academy, Chennai'],
                'career_roles' => ['Director of Photography (DoP)', 'Film Director', 'Post-Production Colorist', 'Documentary Producer', 'Commercial Film Video Editor'],
                'salary_range' => '₹5.0 - ₹22.0 LPA',
                'average_fees' => '₹1,50,000 - ₹5,00,000 / year',
                'is_featured' => false,
            ],
            [
                'category' => 'artistic',
                'title' => 'Bachelor of Interior Architecture & Spatial Experience Design',
                'slug' => 'bachelor-interior-spatial-design',
                'duration' => '4 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 in any stream with minimum 50% (Entrance test / NATA / UCEED).',
                'description' => 'Focuses on architectural interior planning, ergonomic furniture design, acoustic and lighting engineering, sustainable materials, and 3D spatial visualization.',
                'key_skills' => ['AutoCAD, SketchUp & V-Ray', 'Spatial Zoning & Ergonomics', 'Acoustic & Luminaire Design', 'Material Specification & Sourcing', 'Client Project Estimation'],
                'top_colleges' => ['CEPT University, Ahmedabad', 'Raffles Design Institute', 'Pearl Academy, New Delhi & Mumbai', 'School of Planning and Architecture (SPA), New Delhi', 'Symbiosis Institute of Design, Pune'],
                'career_roles' => ['Interior Architect', 'Exhibition & Set Designer', 'Commercial Hospitality Designer', 'Residential Spatial Consultant', '3D Architectural Visualizer'],
                'salary_range' => '₹5.0 - ₹15.0 LPA',
                'average_fees' => '₹1,50,000 - ₹4,20,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'artistic',
                'title' => 'Professional Diploma in Commercial Photography & Studio Media',
                'slug' => 'diploma-commercial-photography',
                'duration' => '1 Year',
                'level' => 'Diploma',
                'eligibility' => '10+2 in any stream.',
                'description' => 'Intensive technical and creative mastery of studio strobe lighting, fashion photography, e-commerce product styling, high-end digital retouching, and architectural photography.',
                'key_skills' => ['Studio Strobe Lighting Control', 'High-End Retouching (Photoshop/Capture One)', 'Fashion & Editorial Styling', 'E-commerce Macro Product Shoot', 'Visual Storyboarding'],
                'top_colleges' => ['Light & Life Academy, Ooty', 'Shari Academy of Professional Photography, Mumbai', 'Delhi College of Photography, New Delhi', 'National Institute of Design (NID), Gandhinagar', 'Crafting Image Film & Photography Academy'],
                'career_roles' => ['Commercial Fashion Photographer', 'E-commerce Product Photographer', 'Editorial Photojournalist', 'Digital Image Retoucher', 'Studio Production Lead'],
                'salary_range' => '₹3.6 - ₹12.0 LPA',
                'average_fees' => '₹80,000 - ₹2,80,000 total',
                'is_featured' => false,
            ],

            // ─── SPORTS COURSES (6) ───
            [
                'category' => 'sports',
                'title' => 'B.Sc. in Sports Science, Biomechanics & Exercise Physiology',
                'slug' => 'bsc-sports-science-biomechanics',
                'duration' => '3 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 with Science (Physics, Chemistry, Biology/Maths) with minimum 50%.',
                'description' => 'A scientific study of human athletic performance, VO2 max testing, force-plate kinematics, movement analysis, muscular hypertrophy, and physiological performance conditioning.',
                'key_skills' => ['Biomechanics Motion Capture', 'VO2 Max & Lactate Testing', 'Exercise Prescription Protocols', 'Kinesiology Analysis', 'Athlete Fatigue Monitoring'],
                'top_colleges' => ['National Sports University (NSU), Imphal', 'Lakshmibai National Institute of Physical Education (LNIPE), Gwalior', 'Sri Ramachandra Institute of Higher Education, Chennai', 'Manipal University, Manipal', 'Amity School of Physical Education & Sports Sciences, Noida'],
                'career_roles' => ['Sports Scientist', 'High-Performance Analyst', 'Biomechanics Specialist', 'Strength & Conditioning Coach', 'Olympic Sports Lab Coordinator'],
                'salary_range' => '₹5.0 - ₹16.0 LPA',
                'average_fees' => '₹60,000 - ₹2,20,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'sports',
                'title' => 'Bachelor of Physical Education (B.P.Ed) & Sports Coaching',
                'slug' => 'bped-physical-education-coaching',
                'duration' => '2-3 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => 'Graduation in any discipline with sports participation or 10+2 for 4-year integrated.',
                'description' => 'Recognized by NCTE for pedagogical physical education, sports tournament officiating, youth athletic development, track & field coaching, and school athletic directorship.',
                'key_skills' => ['Athletic Drill Pedagogy', 'Tournament Operations', 'Sports Officiating & Rules', 'Team Psychology & Morale', 'First-Aid & Injury Response'],
                'top_colleges' => ['LNIPE, Gwalior', 'Indira Gandhi Institute of Physical Education and Sports Sciences, New Delhi', 'University of Mumbai (BPEd)', 'Tamil Nadu Physical Education and Sports University, Chennai', 'Panjab University, Chandigarh'],
                'career_roles' => ['Physical Education Director (PED)', 'School & University Sports Head', 'Athletic Coach', 'District Sports Development Officer', 'Sports Referee & Official'],
                'salary_range' => '₹4.0 - ₹9.5 LPA',
                'average_fees' => '₹25,000 - ₹95,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'sports',
                'title' => 'BBA in Sports Management & Athletic Franchise Operations',
                'slug' => 'bba-sports-management-operations',
                'duration' => '3 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 from any stream with minimum 50% aggregate marks.',
                'description' => 'Blends business administration with commercial sports: IPL / ISL franchise management, sports broadcasting, ticketing, athlete endorsement contracts, and arena event operations.',
                'key_skills' => ['Sports Marketing & Sponsorship', 'Franchise Financial Modeling', 'Event & Stadium Logistics', 'Athlete Talent Management', 'Media Rights & Broadcasting'],
                'top_colleges' => ['International Institute of Sports & Management (IISM), Mumbai', 'Symbiosis School of Sports Sciences, Pune', 'National Academy of Sports Management (NASM), Mumbai', 'Deakin University Campus, GIFT City', 'Amity School of Sports Sciences'],
                'career_roles' => ['Sports Event Operations Lead', 'Athlete Agent & Talent Manager', 'Franchise Marketing Coordinator', 'Sports Sponsorship Sales Director', 'Brand Partnerships Manager'],
                'salary_range' => '₹5.5 - ₹18.0 LPA',
                'average_fees' => '₹1,50,000 - ₹4,00,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'sports',
                'title' => 'Post-Graduate Diploma in High-Performance Sports Coaching (SAI / NIS)',
                'slug' => 'pg-diploma-sports-coaching-nis',
                'duration' => '1 Year',
                'level' => 'Post-Graduate Diploma',
                'eligibility' => 'Graduation + National/State level sports medal or championship participation.',
                'description' => 'The premier coaching qualification in India from Netaji Subhas National Institute of Sports (NIS Patiala) specializing in specific sports (Cricket, Athletics, Badminton, Boxing, etc.).',
                'key_skills' => ['Elite Tactical Periodization', 'Sport-Specific Technical Coaching', 'Performance Telemetry & Video Feedback', 'Athlete Talent Scouting', 'Mental Conditioning'],
                'top_colleges' => ['Netaji Subhas National Institute of Sports (NIS), Patiala', 'Sports Authority of India (SAI) Regional Centers (Bengaluru, Kolkata, Gandhinagar)', 'LNIPE, Gwalior'],
                'career_roles' => ['National & State Team Coach', 'Professional Academy Head Coach', 'SAI Coach & Sports Officer', 'Franchise Assistant Coach', 'Talent Scout'],
                'salary_range' => '₹6.0 - ₹20.0 LPA',
                'average_fees' => '₹40,000 - ₹1,20,000 total',
                'is_featured' => true,
            ],
            [
                'category' => 'sports',
                'title' => 'Bachelor of Physiotherapy (B.P.T.) with Sports Medicine Focus',
                'slug' => 'bpt-sports-physiotherapy',
                'duration' => '4.5 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 with Physics, Chemistry, Biology (minimum 50% marks).',
                'description' => 'Comprehensive healthcare degree covering musculoskeletal anatomy, sports trauma rehabilitation, dry needling, taping, manual therapy, and on-field emergency trauma care.',
                'key_skills' => ['On-Field Emergency Triage', 'ACL & Musculoskeletal Rehab', 'Manual Therapy & Kinesio Taping', 'Concussion Protocols', 'Return-to-Play Testing'],
                'top_colleges' => ['Christian Medical College (CMC), Vellore', 'Kasturba Medical College (KMC), Manipal', 'King Edward Memorial (KEM) Hospital, Mumbai', 'Post Graduate Institute of Medical Education and Research (PGIMER), Chandigarh', 'Sri Ramachandra University, Chennai'],
                'career_roles' => ['Sports Team Physiotherapist', 'Orthopedic Rehabilitation Specialist', 'Sports Clinic Director', 'Olympic Team Medical Staff', 'High-Performance Physio'],
                'salary_range' => '₹5.5 - ₹15.0 LPA',
                'average_fees' => '₹80,000 - ₹2,50,000 / year',
                'is_featured' => false,
            ],
            [
                'category' => 'sports',
                'title' => 'Certificate in Athletic Nutrition & Peak Performance Fueling',
                'slug' => 'certificate-athletic-nutrition-performance',
                'duration' => '6 Months',
                'level' => 'Certification',
                'eligibility' => '10+2 or Bachelor’s in Nutrition, Sports Science, or Fitness Enthusiast.',
                'description' => 'Focuses on macronutrient periodization, hydration protocols, anti-doping (WADA guidelines) compliance, safe ergogenic aids, and competition weight-making strategies.',
                'key_skills' => ['Competition Day Fueling Strategies', 'WADA Anti-Doping Regulations', 'Body Composition Optimization', 'Electrolyte Balancing', 'Supplement Quality Auditing'],
                'top_colleges' => ['National Institute of Nutrition (NIN), Hyderabad', 'K11 School of Fitness Sciences', 'INFS (Institute of Nutrition and Fitness Sciences)', 'Amity University Online', 'SNDT Women’s University, Mumbai'],
                'career_roles' => ['Sports Nutritionist', 'Athlete Dietary Consultant', 'Fitness Center Nutrition Lead', 'Supplement Brand Advisor', 'Olympic Training Center Nutritionist'],
                'salary_range' => '₹4.0 - ₹12.0 LPA',
                'average_fees' => '₹30,000 - ₹90,000 total',
                'is_featured' => false,
            ],

            // ─── BUSINESS COURSES (6) ───
            [
                'category' => 'business',
                'title' => 'BBA in Entrepreneurship, Venture Strategy & Innovation',
                'slug' => 'bba-entrepreneurship-venture-strategy',
                'duration' => '3 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 from any recognized board with minimum 50% aggregate marks.',
                'description' => 'Designed for aspiring startup founders and business leaders: ideation, market validation, venture debt/equity fundraising, lean operations, and growth hacking.',
                'key_skills' => ['Startup Business Modeling', 'Pitch Deck & Investor Presentation', 'Financial Unit Economics', 'Growth Hacking & Digital Marketing', 'Customer Discovery & Validation'],
                'top_colleges' => ['Shaheed Sukhdev College of Business Studies (SSCBS), New Delhi', 'IIM Indore (IPM 5-Year Integrated)', 'NMIMS Anil Surendra Modi School of Commerce, Mumbai', 'Christ University, Bengaluru', 'Symbiosis Centre for Management Studies (SCMS), Pune'],
                'career_roles' => ['Startup Founder / Co-Founder', 'Venture Associate', 'Business Development Manager', 'Corporate Innovation Strategist', 'Growth Marketing Lead'],
                'salary_range' => '₹6.5 - ₹20.0 LPA',
                'average_fees' => '₹1,20,000 - ₹3,80,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'business',
                'title' => 'B.Com (Honours) in Financial Analytics, Markets & FinTech',
                'slug' => 'bcom-hons-financial-analytics-fintech',
                'duration' => '3 Years',
                'level' => 'Bachelor Degree',
                'eligibility' => '10+2 with Commerce / Mathematics with minimum 55% marks.',
                'description' => 'A rigorous finance degree focusing on corporate valuation, equity research, algorithmic trading, financial modeling (Excel/Python), and modern FinTech architectures.',
                'key_skills' => ['Financial Statement Analysis', 'Discounted Cash Flow (DCF) Modeling', 'Corporate Taxation & Auditing', 'Python for Finance & Algorithmic Models', 'Capital Markets & Derivatives'],
                'top_colleges' => ['Shri Ram College of Commerce (SRCC), New Delhi', 'Loyola College, Chennai', 'St. Xavier’s College, Mumbai', 'Lady Shri Ram College for Women (LSR), New Delhi', 'Hansraj College, New Delhi'],
                'career_roles' => ['Investment Banking Analyst', 'Equity Research Associate', 'Financial Risk Manager', 'Corporate Controller', 'Wealth Portfolio Advisor'],
                'salary_range' => '₹6.0 - ₹18.5 LPA',
                'average_fees' => '₹40,000 - ₹2,00,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'business',
                'title' => 'Integrated MBA (5-Year BBA + MBA Dual Degree)',
                'slug' => 'integrated-mba-dual-degree',
                'duration' => '5 Years',
                'level' => 'Integrated Master Degree',
                'eligibility' => '10+2 with minimum 60% marks (Entrance exam: IPMAT / JIPMAT / NPAT).',
                'description' => 'Direct pathway from high school to top management education without needing CAT after graduation. Comprehensive grounding in business strategy, operations, human resources, and marketing.',
                'key_skills' => ['Executive Strategy', 'P&L Management', 'Cross-Functional Leadership', 'Supply Chain Optimization', 'International Business Negotiations'],
                'top_colleges' => ['IIM Indore', 'IIM Rohtak', 'IIM Ranchi', 'IIM Bodh Gaya', 'IIM Jammu', 'Nirma University, Ahmedabad'],
                'career_roles' => ['Management Consultant', 'General Manager (Operations)', 'Product Operations Director', 'Strategy & Expansion Lead', 'Commercial Vice President'],
                'salary_range' => '₹12.0 - ₹32.0 LPA',
                'average_fees' => '₹3,50,000 - ₹7,00,000 / year',
                'is_featured' => true,
            ],
            [
                'category' => 'business',
                'title' => 'B.Voc in Digital E-Commerce Operations & Supply Chain',
                'slug' => 'bvoc-digital-ecommerce-supply-chain',
                'duration' => '3 Years',
                'level' => 'Bachelor of Vocation',
                'eligibility' => '10+2 in any stream with minimum 45-50% marks.',
                'description' => 'Practice-heavy industry degree in warehouse management, Amazon / Flipkart marketplace logistics, international drop-shipping, inventory control, and fulfillment analytics.',
                'key_skills' => ['Marketplace Seller Management', 'ERP & Inventory Software', 'Last-Mile Logistics Optimization', 'Performance Advertising for Retail', 'Customer Retention Systems'],
                'top_colleges' => ['Delhi Skill and Entrepreneurship University (DSEU), New Delhi', 'Tata Institute of Social Sciences (SVE), Mumbai', 'St. Xavier’s College, Ahmedabad', 'Ramanujan College, New Delhi', 'Loyola Academy, Secunderabad'],
                'career_roles' => ['E-commerce Operations Manager', 'Supply Chain Analyst', 'Warehouse Logistics Supervisor', 'Marketplace Category Specialist', 'Fulfillment Operations Lead'],
                'salary_range' => '₹4.5 - ₹11.0 LPA',
                'average_fees' => '₹30,000 - ₹95,000 / year',
                'is_featured' => false,
            ],
            [
                'category' => 'business',
                'title' => 'Post-Graduate Program in Product Management & Growth Strategy',
                'slug' => 'pgp-product-management-growth',
                'duration' => '1 Year',
                'level' => 'Executive Post-Graduate',
                'eligibility' => 'Bachelor’s degree in any field with analytical or business interest.',
                'description' => 'The hottest modern corporate role: leading tech product lifecycles, user journey mapping, feature prioritization, Agile roadmapping, and data-driven user monetization.',
                'key_skills' => ['Product Roadmapping (Jira / Linear)', 'Wireframing & User Journey Mapping', 'A/B Testing & Data Analytics (Mixpanel/Amplitude)', 'Go-To-Market (GTM) Strategy', 'Unit Economics Optimization'],
                'top_colleges' => ['Indian School of Business (ISB), Hyderabad', 'IIM Kozhikode', 'SPJIMR, Mumbai', 'MICA, Ahmedabad', 'Great Lakes Institute of Management, Chennai'],
                'career_roles' => ['Associate Product Manager (APM)', 'Product Manager', 'Growth Product Lead', 'Chief of Staff to CEO', 'Strategy & Monetization Lead'],
                'salary_range' => '₹12.0 - ₹28.0 LPA',
                'average_fees' => '₹1,80,000 - ₹5,50,000 total',
                'is_featured' => true,
            ],
            [
                'category' => 'business',
                'title' => 'Executive Certificate in Business Negotiation & High-Stakes Sales',
                'slug' => 'certificate-business-negotiation-sales',
                'duration' => '6 Months',
                'level' => 'Certification',
                'eligibility' => 'Graduates or working professionals seeking high-ticket revenue mastery.',
                'description' => 'Focuses on enterprise B2B sales pipelines, consultative deal-closing, psychological pricing, procurement defense, cross-cultural contracts, and high-stakes negotiation.',
                'key_skills' => ['Consultative Solution Selling', 'BATNA & Bargaining Tactics', 'Enterprise Contract Structuring', 'Objection Handling & Closing', 'C-Suite Executive Pitching'],
                'top_colleges' => ['IIM Ahmedabad Executive Education', 'IIM Calcutta', 'XLRI Jamshedpur', 'Harvard Business School Online', 'ISB Executive Education'],
                'career_roles' => ['Enterprise Sales Director', 'Strategic Account Executive', 'Global Procurement Negotiator', 'Commercial Partnerships Head', 'Deal Closing Consultant'],
                'salary_range' => '₹8.0 - ₹26.0 LPA',
                'average_fees' => '₹60,000 - ₹2,00,000 total',
                'is_featured' => false,
            ]
        ];

        foreach ($courses as $c) {
            SpecializedCourse::updateOrCreate(
                ['slug' => $c['slug']],
                $c
            );
        }
    }
}

