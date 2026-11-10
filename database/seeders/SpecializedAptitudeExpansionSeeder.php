<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpecializedAptitudeQuestion;

class SpecializedAptitudeExpansionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SPIRITUAL APTITUDE EXPANSION (20 Questions: Q21 - Q40)
        $spiritualQuestions = [
            [
                'question_text' => 'In yogic science and pranayama, how does deliberate slow rhythmic diaphragmatic breathing influence the autonomic nervous system?',
                'option_a' => 'It spikes adrenaline and forces the body into fight-or-flight panic.',
                'option_b' => 'It activates the vagus nerve and stimulates the parasympathetic nervous system, inducing somatic calmness and reducing cortisol.',
                'option_c' => 'It completely shuts down blood circulation to the brain.',
                'option_d' => 'It has no physiological effect beyond basic lung inflation.',
                'correct_option' => 'B',
                'explanation' => 'Slow deep breathing activates the vagus nerve, initiating parasympathetic dominance that down-regulates anxiety and fosters mental clarity.'
            ],
            [
                'question_text' => 'What is the foundational philosophy behind the principle of "Nishkama Karma" (desireless action) taught in classical Indian ethics?',
                'option_a' => 'Never doing any work and living in absolute laziness.',
                'option_b' => 'Focusing completely on the excellence and integrity of the action itself, free from obsessive anxiety over selfish fruits or outcomes.',
                'option_c' => 'Working only when offered exorbitant financial compensation upfront.',
                'option_d' => 'Pretending to work while letting others complete all tasks.',
                'correct_option' => 'B',
                'explanation' => 'Nishkama Karma frees human effort from outcome anxiety, anchoring psychological attention entirely in duty and mindful craftsmanship.'
            ],
            [
                'question_text' => 'When someone unfairly criticizes or insults you in public, which spiritual attitude reflects mature self-mastery?',
                'option_a' => 'Immediately retaliating with louder insults and physical aggression.',
                'option_b' => 'Observing the internal ego reaction with detachment, objectively assessing if any constructive truth exists, and responding with calm dignity.',
                'option_c' => 'Harboring deep resentment and plotting revenge for years.',
                'option_d' => 'Publicly breaking down and assuming you are completely worthless.',
                'correct_option' => 'B',
                'explanation' => 'Spiritual maturity recognizes that other peoples projections reflect their inner state, maintaining unshakeable inner composure (titiksha).'
            ],
            [
                'question_text' => 'How does the ancient Vedic aphorism "Vasudhaiva Kutumbakam" (The world is one family) inform environmental and social responsibility?',
                'option_a' => 'It encourages exploiting natural resources for short-term commercial gain.',
                'option_b' => 'It expands moral consideration beyond narrow tribal identity to embrace universal kinship with all beings and nature.',
                'option_c' => 'It suggests that international cooperation is impossible.',
                'option_d' => 'It only applies to blood relatives within a household.',
                'correct_option' => 'B',
                'explanation' => 'Vasudhaiva Kutumbakam dissolves artificial divisions, fostering ecological reverence and compassionate global citizenship.'
            ],
            [
                'question_text' => 'Why is genuine forgiveness considered a profound spiritual practice rather than a sign of weakness?',
                'option_a' => 'Because it excuses malicious harm and invites repeated abuse.',
                'option_b' => 'Because it liberates the injured mind from the toxic burden of ongoing resentment, severing the psychological cycle of vengeance.',
                'option_c' => 'Because it proves you are incapable of standing up for justice.',
                'option_d' => 'Because it automatically changes the past event.',
                'correct_option' => 'B',
                'explanation' => 'Forgiveness is primarily an act of internal liberation, releasing destructive emotional baggage so the soul can heal and progress.'
            ],
            [
                'question_text' => 'In philosophical counseling, what distinguishes "existential grief" from standard clinical depression?',
                'option_a' => 'Existential grief is completely imaginary and has no real symptoms.',
                'option_b' => 'It stems from confronting profound human realities like mortality, search for meaning, isolation, and moral purpose.',
                'option_c' => 'It can only happen to people who study ancient languages.',
                'option_d' => 'It only occurs after financial bankruptcy.',
                'correct_option' => 'B',
                'explanation' => 'Existential contemplation grapples with fundamental life conditions and purpose rather than purely neurochemical pathology.'
            ],
            [
                'question_text' => 'What is the primary spiritual hazard of unchecked "spiritual materialism" or spiritual ego?',
                'option_a' => 'Spending too little money on books.',
                'option_b' => 'Using spiritual practices, rituals, or titles as badges of superiority to inflate personal self-importance and look down on others.',
                'option_c' => 'Meditating for more than twenty minutes per day.',
                'option_d' => 'Eating balanced wholesome meals.',
                'correct_option' => 'B',
                'explanation' => 'Spiritual materialism occurs when the ego co-opts contemplative pursuits to assert moral or esoteric superiority over peers.'
            ],
            [
                'question_text' => 'How does a spiritually grounded leader approach power and authority within an organization?',
                'option_a' => 'As a weapon to intimidate subordinates and demand blind subservience.',
                'option_b' => 'As a sacred custodianship (Trusteeship) dedicated to uplifting team members, fostering justice, and serving the mission.',
                'option_c' => 'As a means to amass personal wealth through kickbacks.',
                'option_d' => 'By avoiding all decision-making responsibilities.',
                'correct_option' => 'B',
                'explanation' => 'Servant leadership views authority not as privilege, but as an ethical duty of care for the flourishing of all stakeholders.'
            ],
            [
                'question_text' => 'What does the practice of "Mindful Listening" demand during interpersonal conflict?',
                'option_a' => 'Silently rehearsing your counter-arguments while the other person is still speaking.',
                'option_b' => 'Giving wholehearted presence, hearing the underlying emotional needs without defensive interruption, and seeking mutual clarity.',
                'option_c' => 'Pretending to listen while checking smartphone notifications.',
                'option_d' => 'Agreeing insincerely to end the conversation as fast as possible.',
                'correct_option' => 'B',
                'explanation' => 'Mindful listening creates psychological safety, diffusing hostility by validating human dignity before problem-solving.'
            ],
            [
                'question_text' => 'In philosophical traditions across cultures, what is meant by "Socratic Humility" (knowing that you know nothing)?',
                'option_a' => 'Admitting intellectual incompetence and abandoning education.',
                'option_b' => 'An open, unpretentious posture of continuous inquiry that guards against dogmatism and intellectual hubris.',
                'option_c' => 'Refusing to answer questions on school examinations.',
                'option_d' => 'Believing that objective truth is completely non-existent.',
                'correct_option' => 'B',
                'explanation' => 'Recognizing the limits of current knowledge is the essential prerequisite for genuine wisdom and unbiased learning.'
            ],
            [
                'question_text' => 'How does intentional gratitude practice impact psychological equilibrium and neuroscience markers?',
                'option_a' => 'It shrinks the prefrontal cortex and decreases neural activity.',
                'option_b' => 'It enhances dopamine and serotonin release, strengthens emotional resilience, and counters hedonic adaptation.',
                'option_c' => 'It increases envy and competitive dissatisfaction with life.',
                'option_d' => 'It only works if you write down luxury items you wish to purchase.',
                'correct_option' => 'B',
                'explanation' => 'Neuroscientific studies confirm that deliberate gratitude fosters neural plasticity in circuits regulating contentment and prosocial empathy.'
            ],
            [
                'question_text' => 'What is the ethical principle of "Ahimsa" (Non-violence) as applied to modern digital communication?',
                'option_a' => 'Never typing words that contain the letter V.',
                'option_b' => 'Refraining from online cyber-bullying, character assassination, malicious trolling, and speech designed to dehumanize others.',
                'option_c' => 'Refusing to report illegal harassment to platform administrators.',
                'option_d' => 'Posting only automated bot replies on social networks.',
                'correct_option' => 'B',
                'explanation' => 'Ahimsa in communication recognizes that words carry somatic and psychological impact, requiring truth spoken with constructive benevolence.'
            ],
            [
                'question_text' => 'In existential crisis counseling, how can confronting one’s own mortality (Memento Mori) clarify life priorities?',
                'option_a' => 'It induces permanent hopelessness and leads to nihilistic despair.',
                'option_b' => 'It strips away trivial superficialities, urgent distractions, and petty disputes, focusing energy on what is truly enduring and meaningful.',
                'option_c' => 'It forces people to hoard material possessions.',
                'option_d' => 'It discourages all long-term educational goals.',
                'correct_option' => 'B',
                'explanation' => 'Contemplating the finite nature of life clarifies core values, inspiring purposeful action and intentional relationships.'
            ],
            [
                'question_text' => 'What is the role of ritual and sacred space across human civilizations from an anthropological perspective?',
                'option_a' => 'Purely superstitious waste without any psychological function.',
                'option_b' => 'To provide structured symbolic transitions, communal cohesion, psychological grounding, and spaces for reflective transcendence.',
                'option_c' => 'To prevent people from inventing modern tools.',
                'option_d' => 'To enforce architectural uniformity.',
                'correct_option' => 'B',
                'explanation' => 'Rituals mark life thresholds, anchor human emotion during transitions, and connect the individual to collective cultural identity.'
            ],
            [
                'question_text' => 'What constitutes "Compassion Fatigue" and how does spiritual discernment help caregivers prevent it?',
                'option_a' => 'Getting bored of helping people because it does not pay enough.',
                'option_b' => 'Emotional burnout from unbuffered secondary trauma, countered by equanimity, healthy boundary-setting, and renewal practices.',
                'option_c' => 'A physical allergy to healthcare clinics.',
                'option_d' => 'A legal condition that forbids charitable work.',
                'correct_option' => 'B',
                'explanation' => 'Sustainable empathy requires self-compassion, contemplative renewal, and distinguishing between caring action and enmeshed emotional distress.'
            ],
            [
                'question_text' => 'What is the contemplative discipline of "Mauna" (intentional silence or digital detox)?',
                'option_a' => 'Refusing to speak even in life-threatening emergencies.',
                'option_b' => 'Voluntarily suspending outward chatter and sensory bombardment to observe cognitive patterns and restore mental stillness.',
                'option_c' => 'A medical treatment for vocal cord inflammation.',
                'option_d' => 'Punishing family members by ignoring them.',
                'correct_option' => 'B',
                'explanation' => 'Intentional silence calms sensory overload, allowing subtle subconscious insights to surface and resting attentional faculties.'
            ],
            [
                'question_text' => 'How does the spiritual ideal of "Simple Living and High Thinking" challenge hyper-consumerist culture?',
                'option_a' => 'By forcing everyone into extreme deprivation and poverty.',
                'option_b' => 'By shifting the metric of human dignity from material accumulation to intellectual depth, ethical character, and contentment.',
                'option_c' => 'By prohibiting all technological innovation.',
                'option_d' => 'By making people feel guilty about having basic nutrition.',
                'correct_option' => 'B',
                'explanation' => 'Voluntary simplicity liberates mental bandwidth and environmental resources for creative, philosophical, and communal pursuits.'
            ],
            [
                'question_text' => 'When faced with systemic corruption in a professional setting, what is the conscience-driven course of action?',
                'option_a' => 'Participating eagerly to maximize personal illicit gains.',
                'option_b' => 'Courageously upholding professional ethics, documenting violations, seeking lawful whistleblowing remedies, and refusing complicity.',
                'option_c' => 'Blackmailing corrupt colleagues for personal advancement.',
                'option_d' => 'Silently accepting bribes while pretending to disagree.',
                'correct_option' => 'B',
                'explanation' => 'Moral courage (Satya) demands refusing complicity with institutional wrongdoing and bearing witness to ethical rectitude.'
            ],
            [
                'question_text' => 'What is the ultimate purpose of lifelong self-inquiry (Svadhyaya) in holistic wellbeing?',
                'option_a' => 'To memorize trivia to win televised game shows.',
                'option_b' => 'To dissolve limiting unconscious biases, discover one’s higher purpose, and live in authentic alignment with universal consciousness.',
                'option_c' => 'To write an autobiography to boast about personal accomplishments.',
                'option_d' => 'To isolate oneself permanently from human society.',
                'correct_option' => 'B',
                'explanation' => 'Svadhyaya is the continuous contemplative examination of thought, character, and universal wisdom leading to self-realization.'
            ],
            [
                'question_text' => 'How do diverse contemplative traditions define the concept of "Ego Dissolution" (Moksha / Nirvana / Kenosis)?',
                'option_a' => 'Physical destruction of the brain.',
                'option_b' => 'Transcendence of narrow, self-centered grasping into an expansive realization of unity with all life and truth.',
                'option_c' => 'Losing the ability to remember your legal name.',
                'option_d' => 'Becoming completely emotionless like a stone.',
                'correct_option' => 'B',
                'explanation' => 'Ego dissolution represents liberation from the illusion of separate, grasping individuality into boundless peace and universal love.'
            ]
        ];

        // 2. ARTISTIC APTITUDE EXPANSION (20 Questions: Q21 - Q40)
        $artisticQuestions = [
            [
                'question_text' => 'What makes the "Golden Ratio" (Phi approx 1.618) such a foundational concept in visual design and architecture?',
                'option_a' => 'It is the most expensive type of gold leafing used in framing.',
                'option_b' => 'It represents an organic proportion found throughout nature that human perception instinctively interprets as harmonious and balanced.',
                'option_c' => 'It is a mathematical formula that forbids using circular shapes.',
                'option_d' => 'It was invented strictly for digital cryptocurrency logos.',
                'correct_option' => 'B',
                'explanation' => 'The Golden Ratio mimics natural spiral growth (Fibonacci sequences), creating compositions that feel inherently organic and visually pleasing.'
            ],
            [
                'question_text' => 'According to Gestalt Psychology, what does the principle of "Closure" explain about visual perception?',
                'option_a' => 'How to close an art gallery at the end of the evening.',
                'option_b' => 'The human brain’s tendency to automatically complete fragmented or broken shapes into recognizable, whole objects.',
                'option_c' => 'Why artists must paint frames around all portraits.',
                'option_d' => 'The emotional closure experienced after finishing a painting.',
                'correct_option' => 'B',
                'explanation' => 'Gestalt closure demonstrates that human vision actively constructs complete forms even when presented with incomplete visual data.'
            ],
            [
                'question_text' => 'In cinematography and photography, what is the role of a "Three-Point Lighting" setup (Key, Fill, and Backlight)?',
                'option_a' => 'To blind the actor so they do not look at the camera.',
                'option_b' => 'To sculpt 3D depth, separate the subject cleanly from the background, and balance highlights and soft shadows.',
                'option_c' => 'To ensure the entire frame is uniformly bright without any shadows whatsoever.',
                'option_d' => 'To save electricity on movie sets.',
                'correct_option' => 'B',
                'explanation' => 'Three-point lighting provides cinematic dimensionality, using Key for illumination, Fill for shadow control, and Backlight (Rim) for separation.'
            ],
            [
                'question_text' => 'What is the key technical difference between Vector graphics (SVG) and Raster graphics (JPEG/PNG)?',
                'option_a' => 'Vector graphics can only display black and white; raster can display colors.',
                'option_b' => 'Vector graphics use mathematical curves and scale infinitely without quality loss; raster graphics use fixed pixel grids that pixelate when enlarged.',
                'option_c' => 'Raster graphics are only used on paper; vector graphics are only used on television.',
                'option_d' => 'Vector graphics require special glasses to view.',
                'correct_option' => 'B',
                'explanation' => 'Vector art relies on mathematical paths, making it resolution-independent and ideal for branding, typography, and iconography.'
            ],
            [
                'question_text' => 'In graphic design typography, what does "Kerning" refer to?',
                'option_a' => 'The thickness of paper used in printing brochures.',
                'option_b' => 'The delicate adjustment of proportional space between individual character pairs to ensure balanced visual harmony.',
                'option_c' => 'The slant of italic letters.',
                'option_d' => 'The total number of words on a page.',
                'correct_option' => 'B',
                'explanation' => 'Kerning corrects awkward visual spacing gaps between specific letter combinations (such as AV or To) for pristine typographic flow.'
            ],
            [
                'question_text' => 'What is the artistic purpose of intentionally incorporating "Negative Space" (White Space) in a poster or UI layout?',
                'option_a' => 'It represents lazy design where the artist ran out of ideas to fill the canvas.',
                'option_b' => 'It provides visual breathing room, directs the eye to the focal point, and establishes structural elegance and clarity.',
                'option_c' => 'To reduce the amount of printer ink needed.',
                'option_d' => 'To make the viewer feel uncomfortable.',
                'correct_option' => 'B',
                'explanation' => 'Negative space is an active design element that accentuates positive elements and prevents cognitive visual clutter.'
            ],
            [
                'question_text' => 'In game design and character animation, why is a character’s "Silhouette" test crucial?',
                'option_a' => 'To make sure the character can be hidden in dark shadows.',
                'option_b' => 'If a character is immediately identifiable and expressive in solid black silhouette alone, its visual design is readable and iconic.',
                'option_c' => 'To save money on 3D textures.',
                'option_d' => 'To prevent copyright infringement automatically.',
                'correct_option' => 'B',
                'explanation' => 'A distinct silhouette ensures quick visual recognition, clear body language, and strong character personality across fast-paced action.'
            ],
            [
                'question_text' => 'What emotional psychological association is typically triggered by deep saturated Navy Blue in corporate branding?',
                'option_a' => 'Extreme panic, hunger, and reckless excitement.',
                'option_b' => 'Trustworthiness, dependability, stability, competence, and professional security.',
                'option_c' => 'Childish humor and chaotic rebellion.',
                'option_d' => 'Aggressive physical confrontation.',
                'correct_option' => 'B',
                'explanation' => 'Color psychology universally associates deep blue tones with institutional trust, intellectual clarity, and calm stability.'
            ],
            [
                'question_text' => 'In film storyboarding, what does a "Dutch Angle" (canted shot) communicate visually to the audience?',
                'option_a' => 'That the scene takes place in the Netherlands.',
                'option_b' => 'Psychological unease, disorientation, impending crisis, or moral distortion through a tilted horizon line.',
                'option_c' => 'That the camera operator accidentally dropped the tripod.',
                'option_d' => 'Extreme peacefulness and romantic serenity.',
                'correct_option' => 'B',
                'explanation' => 'A canted Dutch angle tilts the camera relative to the horizon, subliminally signaling psychological instability or tension.'
            ],
            [
                'question_text' => 'How does "Biomimicry" inspire cutting-edge industrial and architectural design?',
                'option_a' => 'By forcing architects to build houses exclusively out of bird feathers.',
                'option_b' => 'By studying and emulating nature’s time-tested evolutionary blueprints and biological systems to solve complex human design challenges.',
                'option_c' => 'By painting all buildings green and brown.',
                'option_d' => 'By banning the use of glass and steel.',
                'correct_option' => 'B',
                'explanation' => 'Biomimicry abstracts biological engineering (e.g. kingfisher beaks inspiring bullet trains, lotus leaves inspiring self-cleaning surfaces) for sustainable design.'
            ],
            [
                'question_text' => 'In color harmonies, what is an "Analogous Color Scheme"?',
                'option_a' => 'Colors that are directly opposite each other on the color wheel.',
                'option_b' => 'Colors that sit immediately next to each other on the color wheel (e.g. yellow, yellow-green, and green), producing serene, unified palettes.',
                'option_c' => 'Mixing only black and white with no colors.',
                'option_d' => 'Using three colors spaced equally into a triangle on the wheel.',
                'correct_option' => 'B',
                'explanation' => 'Analogous colors share underlying pigments, creating gentle, naturally cohesive visual harmony without harsh chromatic tension.'
            ],
            [
                'question_text' => 'What is the role of "Focal Hierarchy" in UI/UX and web design?',
                'option_a' => 'Making every single button, heading, and image blink simultaneously.',
                'option_b' => 'Guiding the user’s eye sequentially through size, contrast, placement, and color from primary actions down to secondary information.',
                'option_c' => 'Hiding all text in transparent white on white.',
                'option_d' => 'Ensuring all text has the exact same font size and weight.',
                'correct_option' => 'B',
                'explanation' => 'Visual hierarchy minimizes cognitive load, enabling users to scan and comprehend interfaces effortlessly.'
            ],
            [
                'question_text' => 'In 3D digital sculpture and animation, what does "Topology" (or Retopology) refer to?',
                'option_a' => 'Studying geographical maps of mountains.',
                'option_b' => 'The geometric structure and edge-flow of polygons composing a 3D mesh, critical for clean deformation during movement.',
                'option_c' => 'Calculating the file size of an audio soundtrack.',
                'option_d' => 'The color of the computer monitor casing.',
                'correct_option' => 'B',
                'explanation' => 'Proper edge-flow and quad topology ensure a 3D character bends realistically at joints without mesh pinching or rendering artifacts.'
            ],
            [
                'question_text' => 'What distinguishes a "Serif" typeface from a "Sans-Serif" typeface?',
                'option_a' => 'Serif typefaces are illegible; sans-serif typefaces are artistic.',
                'option_b' => 'Serif typefaces have small decorative finishing strokes at the ends of character stems; sans-serif typefaces have clean, unadorned stroke terminals.',
                'option_c' => 'Serif typefaces only support numbers; sans-serif only supports alphabets.',
                'option_d' => 'There is no visual difference.',
                'correct_option' => 'B',
                'explanation' => 'Serif fonts (like Times or Garamond) convey classical heritage and literary cadence, while Sans-Serif fonts (like Helvetica or Inter) project modern minimalism.'
            ],
            [
                'question_text' => 'In printmaking and fine arts, what is the defining characteristic of "Monotype"?',
                'option_a' => 'Printing millions of identical copies on a digital press.',
                'option_b' => 'A unique printmaking process where an original image is painted onto a non-porous plate and transferred onto paper, creating a singular unique impression.',
                'option_c' => 'Typing with only one finger.',
                'option_d' => 'Using only monochromatic black ink.',
                'correct_option' => 'B',
                'explanation' => 'Monotype is prized as the painterly print process because each transferred impression is intrinsically unique and unrepeatable.'
            ],
            [
                'question_text' => 'What is the psychological impact of "Visual Rhythm" created through repetitive visual patterns in textile or architectural design?',
                'option_a' => 'It produces motion sickness in every viewer.',
                'option_b' => 'It creates a sense of organized movement, predictability, pacing, and dynamic cohesion across space.',
                'option_c' => 'It makes buildings collapse faster.',
                'option_d' => 'It forces people to listen to music.',
                'correct_option' => 'B',
                'explanation' => 'Repetition with rhythm directs ocular progression across surfaces, evoking cadence akin to musical phrases.'
            ],
            [
                'question_text' => 'What does "Color Grading" achieve in contemporary digital filmmaking and video editing?',
                'option_a' => 'Grading tests for film students.',
                'option_b' => 'Enhancing or stylizing the chromatic palette, contrast, and tone of captured footage to establish narrative mood and visual cohesion.',
                'option_c' => 'Removing all colors from the video permanently.',
                'option_d' => 'Compressing the video file into an MP3.',
                'correct_option' => 'B',
                'explanation' => 'Color grading shapes emotional subconscious tone—whether warm nostalgic sunset hues, cold dystopian greens, or desaturated gritty noir.'
            ],
            [
                'question_text' => 'How does an artist employ "Atmospheric Perspective" (Aerial Perspective) when depicting distant mountains?',
                'option_a' => 'By making distant mountains bright neon yellow with sharp crisp black outlines.',
                'option_b' => 'By reducing contrast, softening edges, and shifting colors toward cool desaturated blues to simulate light scattering through air.',
                'option_c' => 'By drawing clouds inside the mountains.',
                'option_d' => 'By painting distant mountains larger than foreground trees.',
                'correct_option' => 'B',
                'explanation' => 'Rayleigh scattering in Earth’s atmosphere washes out contrast and shifts distant landscape masses into cool, hazy silhouettes.'
            ],
            [
                'question_text' => 'When designing an exhibition space or museum gallery, what is the role of "Curatorial Narrative"?',
                'option_a' => 'Selling tickets at the entrance gate.',
                'option_b' => 'Arranging artworks, lighting, flow, and thematic context so visitors experience a deliberate journey of discovery and emotional resonance.',
                'option_c' => 'Polishing the wooden floorboards.',
                'option_d' => 'Alphabetizing paintings by the artist’s middle name.',
                'correct_option' => 'B',
                'explanation' => 'Curating is an artistic storytelling discipline, placing disparate works into dialogic spatial relationships that provoke new insight.'
            ],
            [
                'question_text' => 'What is the fundamental objective of "Design Thinking" as an artistic problem-solving methodology?',
                'option_a' => 'Making drawings look prettier without caring about who uses them.',
                'option_b' => 'A deeply empathetic, iterative process of empathizing with users, defining needs, ideating, prototyping, and testing creative solutions.',
                'option_c' => 'Writing computer code without planning.',
                'option_d' => 'Copying competing products without alteration.',
                'correct_option' => 'B',
                'explanation' => 'Design thinking combines creative imagination with user empathy and rigorous testing to solve complex, human-centered challenges.'
            ]
        ];

        // 3. SPORTS APTITUDE EXPANSION (20 Questions: Q21 - Q40)
        $sportsQuestions = [
            [
                'question_text' => 'In exercise physiology, what distinguishes the "Anaerobic Alactic" (ATP-CP) energy system from the "Aerobic" energy system?',
                'option_a' => 'Anaerobic systems require continuous oxygen; aerobic systems require zero breathing.',
                'option_b' => 'The ATP-CP system fuels explosive, maximum-intensity exertion for 0–10 seconds without oxygen; aerobic pathways sustain prolonged, submaximal exertion via oxygen.',
                'option_c' => 'ATP-CP is only found in amphibians, not human athletes.',
                'option_d' => 'Aerobic energy cannot sustain activity for more than 5 seconds.',
                'correct_option' => 'B',
                'explanation' => 'The phosphagen (ATP-CP) system powers instantaneous explosive bursts (like a 100m sprint start or heavy clean-and-jerk) before glycolytic and aerobic systems take over.'
            ],
            [
                'question_text' => 'What does an athlete’s "VO2 Max" test scientifically measure?',
                'option_a' => 'The volume of water drunk during a marathon.',
                'option_b' => 'The maximum volume of oxygen the body can transport and utilize per minute during incremental exhaustive exercise, benchmarking aerobic fitness.',
                'option_c' => 'The maximum number of pushups completed in 60 seconds.',
                'option_d' => 'The volume of sound generated when cheering for a teammate.',
                'correct_option' => 'B',
                'explanation' => 'VO2 max is the gold-standard metric of cardiorespiratory endurance and aerobic power, reflecting heart output and muscle oxygen extraction.'
            ],
            [
                'question_text' => 'In athletic conditioning, what is the primary biomechanical benefit of "Plyometric Training"?',
                'option_a' => 'Building bulky muscle that slows down running speed.',
                'option_b' => 'Training the neuromuscular system to rapidly utilize the Stretch-Shortening Cycle (SSC), translating stored elastic energy into explosive power.',
                'option_c' => 'Stretching while sitting completely motionless for an hour.',
                'option_d' => 'Replacing all gym weightlifting with swimming.',
                'correct_option' => 'B',
                'explanation' => 'Plyometrics exploits muscle spindle reflexes and elastic tendon recoil, dramatically enhancing vertical jump and acceleration velocity.'
            ],
            [
                'question_text' => 'In training periodization, what is the role of a "Tapering" phase before a championship competition?',
                'option_a' => 'Stopping all food intake for three days.',
                'option_b' => 'Strategically reducing training volume while maintaining high intensity to eliminate physiological fatigue and allow peak supercompensation.',
                'option_c' => 'Doubling the training load on the morning of the competition.',
                'option_d' => 'Skipping all warmups before competing.',
                'correct_option' => 'B',
                'explanation' => 'Tapering drops accumulated systemic fatigue while preserving neuromuscular adaptations, ensuring peak physical readiness on game day.'
            ],
            [
                'question_text' => 'Why are electrolytes (Sodium, Potassium, Magnesium) vital alongside water during intense endurance events in hot weather?',
                'option_a' => 'To make sweat taste sweet.',
                'option_b' => 'To maintain blood plasma osmolarity, prevent dangerous hyponatremia (water intoxication), and sustain neural action potentials for muscle contraction.',
                'option_c' => 'To increase body temperature to fever levels.',
                'option_d' => 'Electrolytes have no functional biological role in sports.',
                'correct_option' => 'B',
                'explanation' => 'Sweating depletes electrolytes; consuming water alone dilutes blood sodium, precipitating muscle cramps, confusion, and life-threatening hyponatremia.'
            ],
            [
                'question_text' => 'In basketball or football, what is the tactical trade-off between "Man-to-Man Marking" and "Zone Defense"?',
                'option_a' => 'Man-to-man allows players to leave the field; zone defense forbids running.',
                'option_b' => 'Man-to-man assigns individual accountability but is susceptible to screens/mismatches; zone protects key spatial corridors but can leave perimeter gaps.',
                'option_c' => 'Zone defense is illegal in all professional sports.',
                'option_d' => 'There is no strategic difference between the two systems.',
                'correct_option' => 'B',
                'explanation' => 'Tactical mastery involves choosing defensive schemes matching opponent strengths—clamping star individual scorers or crowding dangerous passing lanes.'
            ],
            [
                'question_text' => 'What causes "Delayed Onset Muscle Soreness" (DOMS) 24 to 48 hours following strenuous, unaccustomed resistance training?',
                'option_a' => 'Lactic acid permanently crystallizing into bone tissue.',
                'option_b' => 'Microscopic structural trauma to muscle myofibrils and connective tissue from eccentric loading, accompanied by inflammatory repair cascades.',
                'option_c' => 'Permanent nerve severance in the legs.',
                'option_d' => 'Dehydration alone.',
                'correct_option' => 'B',
                'explanation' => 'DOMS is initiated by microscopic mechanical tearing during eccentric contractions, driving muscular hypertrophy once repaired via protein synthesis.'
            ],
            [
                'question_text' => 'In high-performance sprinting, how do elite coaches balance "Stride Frequency" versus "Stride Length"?',
                'option_a' => 'By forcing the sprinter to take as few steps as possible by leaping in the air.',
                'option_b' => 'By optimizing the ratio where ground reaction force and turnover cadence are maximized without over-striding, which creates braking forces.',
                'option_c' => 'By looking down at their shoes during the entire race.',
                'option_d' => 'By running in zig-zag trajectories.',
                'correct_option' => 'B',
                'explanation' => 'Over-striding places the foot ahead of the center of mass, producing a braking force; elite speed demands vertical force application directly beneath the hips.'
            ],
            [
                'question_text' => 'What does "Proprioception" mean and why is proprioceptive training essential in sports rehabilitation?',
                'option_a' => 'The ability to calculate ticket prices in your head.',
                'option_b' => 'The subconscious neuromuscular awareness of body and joint position in 3D space, vital for dynamic balance and preventing ligament re-injury.',
                'option_c' => 'Developing 20/20 vision through eye drops.',
                'option_d' => 'The speed at which an athlete digests food.',
                'correct_option' => 'B',
                'explanation' => 'Mechanoreceptors in joints and tendons communicate body position to the cerebellum; restoring proprioception prevents recurrent sprains (like ACL or ankle tears).'
            ],
            [
                'question_text' => 'In sports psychology, how does "Mental Imagery / Visualization" improve motor skill execution?',
                'option_a' => 'It magically completes the physical training without any physical effort.',
                'option_b' => 'It activates the same motor cortices and neuromuscular pathways as physical execution, priming neural pathways and sharpening situational focus.',
                'option_c' => 'It puts the athlete into a deep sleep during competition.',
                'option_d' => 'It only works if you watch television cartoons.',
                'correct_option' => 'B',
                'explanation' => 'Functional brain imaging demonstrates that vivid mental rehearsal primes motor neuron firing patterns, enhancing movement economy and reducing competitive anxiety.'
            ],
            [
                'question_text' => 'According to medical concussion protocols (e.g. SCAT5), what must happen if an athlete sustains a suspected head impact with dizziness or confusion?',
                'option_a' => 'Give them an energy drink and immediately send them back onto the field.',
                'option_b' => 'Immediately remove the athlete from play for clinical evaluation, with zero return to play on the same day if concussive symptoms are present.',
                'option_c' => 'Tell them to shake their head vigorously to clear their vision.',
                'option_d' => 'Wait until halftime before checking on them.',
                'correct_option' => 'B',
                'explanation' => '"When in doubt, sit them out." Second-Impact Syndrome can cause catastrophic brain swelling if a concussed athlete suffers a second impact before recovery.'
            ],
            [
                'question_text' => 'What functional difference exists between Type I (Slow-Twitch) and Type IIx (Fast-Twitch) muscle fibers?',
                'option_a' => 'Type I fibers are exclusively in the arms; Type IIx are exclusively in the legs.',
                'option_b' => 'Type I fibers are mitochondria-dense and fatigue-resistant for endurance; Type IIx fibers contract with high velocity and force but fatigue rapidly.',
                'option_c' => 'Type IIx fibers have zero blood supply.',
                'option_d' => 'Type I fibers cannot generate any muscular tension.',
                'correct_option' => 'B',
                'explanation' => 'Distance runners possess predominantly oxidative Type I fibers, whereas Olympic sprinters and weightlifters recruit powerful glycolytic Type II fibers.'
            ],
            [
                'question_text' => 'What is the "Kinetic Chain" concept in athletic throwing (javelin, baseball, cricket bowling)?',
                'option_a' => 'Wearing a metal chain necklace during sports events.',
                'option_b' => 'The sequential transfer of mechanical energy generated from the legs through the pelvis, torso, shoulder, arm, and finally into the projectile.',
                'option_c' => 'Throwing exclusively with isolated wrist flicking.',
                'option_d' => 'Running backwards before releasing the ball.',
                'correct_option' => 'B',
                'explanation' => 'Over 50% of projectile velocity originates from leg drive and pelvic rotation; the arm merely acts as a whip delivering kinetic energy.'
            ],
            [
                'question_text' => 'What is the strategic purpose of a coach calling a "Tactical Timeout" when the opponent has scored 10 unanswered points?',
                'option_a' => 'To let the coach drink water in peace.',
                'option_b' => 'To disrupt the opponent’s psychological momentum, halt emotional panic in their own team, and execute tactical adjustments.',
                'option_c' => 'To surrender the game early.',
                'option_d' => 'To argue with fans in the audience.',
                'correct_option' => 'B',
                'explanation' => 'Timeouts interrupt psychological momentum flow, giving athletes mental resets to regain tactical discipline and emotional composure.'
            ],
            [
                'question_text' => 'In athletic sports nutrition, what is the significance of the "Post-Workout Anabolic Window"?',
                'option_a' => 'A physical window in the gymnasium wall.',
                'option_b' => 'A period following intense exercise where muscle glycogen replenishment and muscle protein synthesis are elevated, optimized by carbohydrates and protein.',
                'option_c' => 'A 24-hour fast where no water is permitted.',
                'option_d' => 'A time to eat heavy, greasy fast food.',
                'correct_option' => 'B',
                'explanation' => 'Consuming fast-digesting protein (like whey) and complex carbohydrates post-exercise accelerates glycogen storage and stops catabolic breakdown.'
            ],
            [
                'question_text' => 'What causes repetitive "Overuse Injuries" (like Shin Splints, Tennis Elbow, or Runner’s Knee)?',
                'option_a' => 'A single violent collision with a brick wall.',
                'option_b' => 'Repetitive submaximal stress on musculoskeletal tissues exceeding their adaptive repair capacity, often due to poor biomechanics or sudden volume spikes.',
                'option_c' => 'Drinking too much milk.',
                'option_d' => 'Wearing brand new running shoes.',
                'correct_option' => 'B',
                'explanation' => 'Overuse injuries develop insidiously when tissue microtrauma outpaces biological remodeling, demanding load management and technique correction.'
            ],
            [
                'question_text' => 'According to the "Inverted-U Hypothesis" in sports psychology, what is the relationship between psychological arousal and athletic performance?',
                'option_a' => 'The higher the panic and fear, the better the performance.',
                'option_b' => 'Performance increases with physiological/mental arousal up to an optimal midpoint; under-arousal (boredom) or over-arousal (panic) degrades performance.',
                'option_c' => 'Athletes perform best when they are completely asleep.',
                'option_d' => 'Arousal has zero correlation with athletic execution.',
                'correct_option' => 'B',
                'explanation' => 'Optimal performance occurs in the "Zone" where arousal matches task demands—fine motor sports (archery) require low arousal, gross power sports require higher arousal.'
            ],
            [
                'question_text' => 'Why do endurance athletes undergo "High-Altitude Training" (e.g. at 2,000+ meters above sea level)?',
                'option_a' => 'To enjoy scenic mountain photographs.',
                'option_b' => 'Hypoxic conditions trigger the kidneys to release Erythropoietin (EPO), stimulating red blood cell production and oxygen-carrying capacity.',
                'option_c' => 'Because gravity is zero at high altitudes.',
                'option_d' => 'To avoid running on paved roads.',
                'correct_option' => 'B',
                'explanation' => 'Hypoxia stimulates endogenous EPO release, expanding total hemoglobin mass so athletes have superior oxygen delivery upon returning to sea level.'
            ],
            [
                'question_text' => 'What constitutes an intentional violation of "WADA / NADA" Anti-Doping Regulations in professional sports?',
                'option_a' => 'Drinking filtered tap water before training.',
                'option_b' => 'Using prohibited performance-enhancing substances (like anabolic steroids or peptide hormones), blood doping, or tampering with drug-testing samples.',
                'option_c' => 'Eating bananas during halftime.',
                'option_d' => 'Wearing compression tights approved by the sports federation.',
                'correct_option' => 'B',
                'explanation' => 'Anti-doping codes preserve fair play and protect athlete health by strictly sanctioning synthetic physiological enhancement and masking agents.'
            ],
            [
                'question_text' => 'What leadership trait defines a truly exceptional team captain during a losing game?',
                'option_a' => 'Publicly screaming at teammates and blaming the goalkeeper for every error.',
                'option_b' => 'Exemplifying relentless defensive work-ethic, maintaining calm vocal communication, holding team accountability, and inspiring belief through action.',
                'option_c' => 'Walking off the field in disgust before the final whistle.',
                'option_d' => 'Faking an injury to avoid playing the rest of the match.',
                'correct_option' => 'B',
                'explanation' => 'True athletic leadership shines under adversity; great captains galvanize teammates through emotional composure and uncompromising physical effort.'
            ]
        ];

        // 4. BUSINESS APTITUDE EXPANSION (20 Questions: Q21 - Q40)
        $businessQuestions = [
            [
                'question_text' => 'In SaaS (Software-as-a-Service) and subscription businesses, what does "Customer Churn Rate" calculate?',
                'option_a' => 'The speed at which dairy products spoil in the company cafeteria.',
                'option_b' => 'The percentage of existing customers who cancel or do not renew their subscriptions over a specific time window.',
                'option_c' => 'The total number of job applications received for engineering roles.',
                'option_d' => 'The frequency of computer software updates.',
                'correct_option' => 'B',
                'explanation' => 'High churn destroys enterprise value like a leaky bucket; sustainable SaaS businesses must retain customers and achieve net negative revenue churn.'
            ],
            [
                'question_text' => 'What is the critical distinction between "Gross Margin" and "Net Profit Margin"?',
                'option_a' => 'Gross margin is for gross revenue; net margin is only for international companies.',
                'option_b' => 'Gross margin measures revenue minus direct Cost of Goods Sold (COGS); net margin deducts all operational expenses, overhead, taxes, and interest.',
                'option_c' => 'Net margin is always higher than gross margin.',
                'option_d' => 'Gross margin is only calculated once every ten years.',
                'correct_option' => 'B',
                'explanation' => 'Gross margin shows raw unit production profitability; net margin shows the final bottom-line profitability after all corporate overheads are paid.'
            ],
            [
                'question_text' => 'According to strategic management, what represents a "Network Effect" as a competitive moat?',
                'option_a' => 'Having strong Wi-Fi signals in all company offices.',
                'option_b' => 'A dynamic where a product or platform becomes increasingly valuable to each user as more people join and utilize it (e.g. WhatsApp, eBay).',
                'option_c' => 'Hiring computer network engineers.',
                'option_d' => 'Spending heavily on television commercials.',
                'correct_option' => 'B',
                'explanation' => 'Network effects create massive winner-take-all moats because moving to a competitor requires abandoning the existing ecosystem of connected users.'
            ],
            [
                'question_text' => 'What is the core thesis of "Blue Ocean Strategy" pioneered by W. Chan Kim and Renée Mauborgne?',
                'option_a' => 'Investing exclusively in deep-sea fishing businesses.',
                'option_b' => 'Creating uncontested market space and new customer demand through value innovation, rather than bloody head-to-head competition in overcrowded red oceans.',
                'option_c' => 'Painting all company office walls deep blue.',
                'option_d' => 'Engaging in aggressive price wars until all competitors go bankrupt.',
                'correct_option' => 'B',
                'explanation' => 'Blue Ocean strategy breaks the value-cost trade-off, creating completely new market spaces (like Cirque du Soleil or Uber in early days).'
            ],
            [
                'question_text' => 'What is meant by "Startup Runway" when managing early-stage venture capital?',
                'option_a' => 'A fashion catwalk built for marketing events.',
                'option_b' => 'The number of months a startup can continue operating before running out of cash, calculated by Cash Balance divided by Monthly Net Burn Rate.',
                'option_c' => 'The physical length of the airport strip near the company headquarters.',
                'option_d' => 'The total number of features on the software roadmap.',
                'correct_option' => 'B',
                'explanation' => 'If a company has $600,000 cash and burns $50,000 net per month, it has 12 months of runway before it must reach profitability or raise capital.'
            ],
            [
                'question_text' => 'In venture capital financing, what happens to founders’ ownership percentage during an equity "Dilution" event?',
                'option_a' => 'Their percentage ownership increases to 100%.',
                'option_b' => 'Their percentage ownership decreases as new shares are issued to incoming investors, though the total dollar valuation of their stake may increase.',
                'option_c' => 'Founders are immediately removed from the company register.',
                'option_d' => 'The company is automatically dissolved.',
                'correct_option' => 'B',
                'explanation' => 'Dilution is the mathematical reality of issuing new equity; owning 60% of a $50M business is far more valuable than owning 100% of a $100K business.'
            ],
            [
                'question_text' => 'What is the fundamental vulnerability of a "Just-In-Time" (JIT) manufacturing supply chain during geopolitical crises or pandemics?',
                'option_a' => 'Too much warehouse space is wasted on excess inventory.',
                'option_b' => 'Minimal safety stock leaves the company defenseless against single-point transport bottlenecks or factory shutdowns, halting production completely.',
                'option_c' => 'Products are delivered too quickly to customers.',
                'option_d' => 'Suppliers refuse to accept digital currency.',
                'correct_option' => 'B',
                'explanation' => 'JIT prioritizes zero-inventory efficiency over resilience; unexpected supply disruptions instantly paralyze operations.'
            ],
            [
                'question_text' => 'In pricing strategy, how does "The Decoy Effect" (asymmetrical dominance) influence customer selection?',
                'option_a' => 'By lying about the product ingredients.',
                'option_b' => 'By introducing a third pricing option that is deliberately priced close to the premium option but offers noticeably less value, nudging customers to buy premium.',
                'option_c' => 'By charging different prices based on the customer’s age.',
                'option_d' => 'By offering all products for free forever.',
                'correct_option' => 'B',
                'explanation' => 'Behavioral economics shows a decoy option changes relative perception, making the higher-tier target product appear overwhelmingly sensible.'
            ],
            [
                'question_text' => 'What constitutes a company’s "Defensible Moat" according to legendary investor Warren Buffett?',
                'option_a' => 'Digging a literal water trench around the corporate headquarters.',
                'option_b' => 'A structural competitive advantage (like brand power, patents, high switching costs, or network effects) that protects sustained high return on capital.',
                'option_c' => 'Employing the largest security guard force in the city.',
                'option_d' => 'Relying exclusively on government subsidies.',
                'correct_option' => 'B',
                'explanation' => 'An economic moat prevents rivals from easily eroding profitability through price-cutting imitation, ensuring enduring shareholder returns.'
            ],
            [
                'question_text' => 'What is the purpose of conducting a "SWOT Analysis" (Strengths, Weaknesses, Opportunities, Threats) during corporate strategy reviews?',
                'option_a' => 'To evaluate employee fashion choices.',
                'option_b' => 'To objectively assess internal capabilities versus vulnerabilities, and map external market opportunities against environmental risks.',
                'option_c' => 'To design a new website header.',
                'option_d' => 'To compute income tax deductions.',
                'correct_option' => 'B',
                'explanation' => 'SWOT aligns internal organizational resources with dynamic external market realities to formulate actionable strategic plans.'
            ],
            [
                'question_text' => 'In corporate finance, what does "EBITDA" stand for?',
                'option_a' => 'Every Business In The Digital Age.',
                'option_b' => 'Earnings Before Interest, Taxes, Depreciation, and Amortization—measuring pure operational cash generation capacity.',
                'option_c' => 'Equity Built In The Domestic Account.',
                'option_d' => 'Estimated Budget In Total Domestic Assets.',
                'correct_option' => 'B',
                'explanation' => 'EBITDA removes non-operational capital structure (interest), tax jurisdiction variations, and non-cash accounting items to compare operating performance.'
            ],
            [
                'question_text' => 'What is "Omni-Channel Retailing" and why does it outperform single-channel distribution?',
                'option_a' => 'Selling products only on one specific television channel.',
                'option_b' => 'Seamlessly integrating customer experiences across physical stores, mobile apps, social commerce, and web platforms with synchronized inventory and loyalty.',
                'option_c' => 'Opening 500 physical stores on the same street.',
                'option_d' => 'Banning all in-person shopping.',
                'correct_option' => 'B',
                'explanation' => 'Omni-channel allows customers to research online, purchase in-app, pick up in-store, or return anywhere, maximizing customer lifetime loyalty.'
            ],
            [
                'question_text' => 'What is the primary commercial difference between a "Patent" and a "Trade Secret"?',
                'option_a' => 'Patents are free; trade secrets cost millions to file with the government.',
                'option_b' => 'A patent grants a 20-year public legal monopoly in exchange for full disclosure; a trade secret remains protected indefinitely as long as secrecy is maintained.',
                'option_c' => 'Trade secrets are illegal; patents are mandatory.',
                'option_d' => 'Patents are only for computer games.',
                'correct_option' => 'B',
                'explanation' => 'Patents expire after 20 years and require public publishing; trade secrets (like Coca-Colas formula) never expire if rigorously guarded.'
            ],
            [
                'question_text' => 'What is the strategic objective of "Up-Selling" versus "Cross-Selling"?',
                'option_a' => 'Up-selling is illegal; cross-selling is standard retail.',
                'option_b' => 'Up-selling encourages the customer to purchase a higher-end, premium version; cross-selling invites them to buy complementary companion products.',
                'option_c' => 'Both terms refer exclusively to refunding dissatisfied customers.',
                'option_d' => 'Up-selling is only performed by cashiers on elevators.',
                'correct_option' => 'B',
                'explanation' => 'Up-selling upgrades the primary purchase (e.g. buying a 512GB laptop over a 256GB); cross-selling adds peripheral accessories (e.g. laptop bag and mouse).'
            ],
            [
                'question_text' => 'In B2B Enterprise Sales, why is the sales cycle typically much longer (3 to 12 months) than in B2C transactions?',
                'option_a' => 'Because B2B salespeople are unmotivated to close deals.',
                'option_b' => 'Multiple decision-makers (stakeholders, procurement, legal, security, IT) must review compliance, ROI validation, and contractual terms.',
                'option_c' => 'Because B2B companies are prohibited from using digital signatures.',
                'option_d' => 'Because B2B software is always delivered by postal mail.',
                'correct_option' => 'B',
                'explanation' => 'High contract values demand consensus across technical architects, CFO approval, risk mitigation, and security compliance verification.'
            ],
            [
                'question_text' => 'In Agile project management, what occurs during a "Sprint Retrospective"?',
                'option_a' => 'The software engineers run a footrace in the parking lot.',
                'option_b' => 'The team reflects on the completed iteration to inspect workflows, identify bottlenecks, celebrate wins, and commit to process improvements.',
                'option_c' => 'The client cancels the software contract.',
                'option_d' => 'Writing the company annual financial report.',
                'correct_option' => 'B',
                'explanation' => 'Retrospectives embody continuous improvement (Kaizen), refining team collaboration and engineering throughput sprint after sprint.'
            ],
            [
                'question_text' => 'What is "Contribution Margin" in unit economics analysis?',
                'option_a' => 'The amount of money employees donate to charity.',
                'option_b' => 'Selling price per unit minus variable costs per unit, representing the incremental cash available to cover fixed costs and generate operating profit.',
                'option_c' => 'The percentage of discount coupons redeemed by shoppers.',
                'option_d' => 'The annual bonus paid to the board of directors.',
                'correct_option' => 'B',
                'explanation' => 'Positive contribution margin is essential; if each sale loses variable cash, expanding sales volume simply accelerates corporate bankruptcy.'
            ],
            [
                'question_text' => 'Why do high-growth startups prioritize "Retention Cohort Analysis" over aggregate daily active user graphs?',
                'option_a' => 'Cohort graphs are prettier and easier to print.',
                'option_b' => 'Cohort analysis isolates user groups by signup date to reveal whether product enhancements actually improve true long-term user stickiness over time.',
                'option_c' => 'Aggregate numbers are forbidden by corporate law.',
                'option_d' => 'Cohort analysis only counts paid corporate accounts.',
                'correct_option' => 'B',
                'explanation' => 'Top-line vanity user growth can disguise a dying product; cohort curves prove whether product changes create sticky, loyal customer habits.'
            ],
            [
                'question_text' => 'When managing a severe PR crisis involving product recalls or security breaches, what communication principle preserves corporate reputation?',
                'option_a' => 'Denying everything, attacking investigative journalists, and concealing evidence.',
                'option_b' => 'Radical transparency, swift empathetic acknowledgment of harm, taking accountability, and outlining concrete remediation and prevention steps.',
                'option_c' => 'Deleting the company website and changing the business name overnight.',
                'option_d' => 'Blaming the junior summer interns.',
                'correct_option' => 'B',
                'explanation' => 'Cover-ups amplify damage exponentially; prompt, ethical transparency paired with swift restitution preserves long-term brand equity.'
            ],
            [
                'question_text' => 'What is the psychological definition of "Founder Resilience" in early-stage company building?',
                'option_a' => 'Never listening to any customer feedback or market signals.',
                'option_b' => 'The cognitive capacity to withstand relentless ambiguity, repeated rejections, operational crises, and pivots without losing mission conviction.',
                'option_c' => 'Refusing to hire any employees for ten years.',
                'option_d' => 'Working 24 hours a day without sleeping.',
                'correct_option' => 'B',
                'explanation' => 'Startups are marathons of emotional volatility; resilient founders balance stubborn long-term vision with flexible tactical adaptability.'
            ]
        ];

        // Seed Expansion Questions into Database
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
}
