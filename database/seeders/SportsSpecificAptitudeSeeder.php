<?php

namespace Database\Seeders;

use App\Models\SpecializedAptitudeQuestion;
use Illuminate\Database\Seeder;

class SportsSpecificAptitudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure existing sports questions have sport = 'general' if null
        SpecializedAptitudeQuestion::where('category', 'sports')
            ->whereNull('sport')
            ->update(['sport' => 'general']);

        // 2. Questions for all 15 individual sports (10 questions each)
        $sportsData = $this->getSportsQuestions();

        foreach ($sportsData as $sportSlug => $questions) {
            foreach ($questions as $q) {
                SpecializedAptitudeQuestion::updateOrCreate(
                    [
                        'category' => 'sports',
                        'sport' => $sportSlug,
                        'question_text' => $q['question_text']
                    ],
                    [
                        'option_a' => $q['option_a'],
                        'option_b' => $q['option_b'],
                        'option_c' => $q['option_c'],
                        'option_d' => $q['option_d'],
                        'correct_option' => $q['correct_option'],
                        'explanation' => $q['explanation'],
                    ]
                );
            }
        }
    }

    private function getSportsQuestions(): array
    {
        return [
            // ==================== 1. CRICKET ====================
            'cricket' => [
                [
                    'question_text' => 'In cricket, what condition must be satisfied for a batsman to be given out LBW (Leg Before Wicket) if no shot was offered?',
                    'option_a' => 'The ball must pitch strictly on middle stump only.',
                    'option_b' => 'The ball can pitch outside off stump or in line, impact outside off or in line, and would have hit the stumps.',
                    'option_c' => 'The batsman must be standing entirely inside the bowling crease.',
                    'option_d' => 'The ball must pitch outside leg stump and spin inwards.',
                    'correct_option' => 'B',
                    'explanation' => 'Under MCC Law 36, when no shot is offered, the impact does not need to be in line with the stumps, provided the ball pitched in line or outside off and would have hit the wicket.'
                ],
                [
                    'question_text' => 'What physical aerodynamic principle explains conventional swing bowling with a new leather cricket ball?',
                    'option_a' => 'Rough surface creates turbulence on one side while smooth laminar flow on the other creates lower pressure toward the rough side.',
                    'option_b' => 'The magnetic field of the pitch grass repels the seam.',
                    'option_c' => 'Air pressure inside the hollow core of the cricket ball expands.',
                    'option_d' => 'Coriolis force pushes the ball strictly towards the batsman’s body.',
                    'correct_option' => 'A',
                    'explanation' => 'Conventional swing relies on an angled seam creating a turbulent boundary layer on the angled side while laminar flow separates earlier on the opposite side, generating lateral Magnus/Bernoulli force.'
                ],
                [
                    'question_text' => 'When batting against high-pace reverse swing bowling, where should a batsman ideally make contact with the ball?',
                    'option_a' => 'Far behind the body, right on top of the bails.',
                    'option_b' => 'As late as possible with an open bat face while reaching outside off.',
                    'option_c' => 'Straight under the eyes, playing late close to the pad with soft hands.',
                    'option_d' => 'Lunging forward blindly with hard hands on the front foot.',
                    'correct_option' => 'C',
                    'explanation' => 'Playing late directly under the eyes with soft hands counters late reverse movement and prevents inside edges onto stumps.'
                ],
                [
                    'question_text' => 'In ODI/T20 cricket, what is the key tactical objective of setting a "Deep Point" and "Deep Third Man" against an aggressive opening batsman?',
                    'option_a' => 'To encourage the batsman to hit overhead sixes over long-on.',
                    'option_b' => 'To choke the batsman’s primary square-cut and late-glide boundaries, forcing them to play straight against tight lengths.',
                    'option_c' => 'To prepare for a run-out chance at the non-striker’s end.',
                    'option_d' => 'It is a mandatory rule that fielders must stand there during powerplays.',
                    'correct_option' => 'B',
                    'explanation' => 'Deep point and third man patrol the cut and edge zones, preventing easy four-runs on back-foot square shots.'
                ],
                [
                    'question_text' => 'Under the Duckworth-Lewis-Stern (DLS) method in rain-affected limited overs matches, what two resources determine a team’s revised target?',
                    'option_a' => 'Total dot balls and boundary count.',
                    'option_b' => 'Overs remaining and wickets in hand.',
                    'option_c' => 'Pitch moisture and atmospheric humidity percentage.',
                    'option_d' => 'Current run rate and historical head-to-head records.',
                    'correct_option' => 'B',
                    'explanation' => 'The DLS mathematical model evaluates a team’s capability based on remaining resources: the combination of remaining overs and wickets in hand.'
                ],
                [
                    'question_text' => 'Which finger-spin bowling delivery turns from leg to off for a right-handed batsman when bowled by a right-arm orthodox bowler?',
                    'option_a' => 'Standard Off-Break',
                    'option_b' => 'Doosra',
                    'option_c' => 'Carrom Ball / Leg-cutter variation',
                    'option_d' => 'Arm Ball',
                    'correct_option' => 'C',
                    'explanation' => 'A right-arm finger spinner’s standard ball turns off-to-leg; a ball turning away from the right-hander (leg to off) is a variation such as a carrom ball or doosra.'
                ],
                [
                    'question_text' => 'On a deteriorating Day 4/5 subcontinental Test pitch with rough patches outside a right-hander’s off stump, what is a left-arm spinner’s primary lethal line?',
                    'option_a' => 'Landing the ball into the rough outside off stump to sharply spin back into the stumps or pads.',
                    'option_b' => 'Bowling wide down the leg side.',
                    'option_c' => 'Bouncing bouncers over the batsman’s helmet.',
                    'option_d' => 'Bowling slow full tosses onto the pads.',
                    'correct_option' => 'A',
                    'explanation' => 'Left-arm orthodox spinners exploit the footmark rough outside off stump to turn sharply back into the right-hander, bringing bowled, LBW, and bat-pad catches into play.'
                ],
                [
                    'question_text' => 'What is the "Powerplay 1" fielding restriction rule in modern Men’s ICC One Day Internationals (ODIs)?',
                    'option_a' => 'Overs 1 to 10: Maximum of 2 fielders outside the 30-yard inner circle.',
                    'option_b' => 'Overs 1 to 15: No fielders allowed inside the circle.',
                    'option_c' => 'Overs 1 to 10: Maximum of 5 fielders outside the circle.',
                    'option_d' => 'Overs 40 to 50: Mandatory powerplay for bowling team only.',
                    'correct_option' => 'A',
                    'explanation' => 'In standard 50-over ODIs, Powerplay 1 (overs 1–10) permits only 2 fielders outside the 30-yard fielding circle.'
                ],
                [
                    'question_text' => 'In fast bowling biomechanics, why is maintaining a braced (straight) front leg at the point of ball release essential?',
                    'option_a' => 'It prevents the bowler from overstepping the popping crease.',
                    'option_b' => 'It acts as an immovable brake, transferring linear run-up kinetic energy into explosive rotational torque through the trunk and arm.',
                    'option_c' => 'It softens ground impact on the ankles to reduce shoe spikes wear.',
                    'option_d' => 'It allows the bowler to spin the ball like a leg-break.',
                    'correct_option' => 'B',
                    'explanation' => 'A stiff, braced front knee acts as a kinetic lever, converting linear forward momentum into angular whip velocity for maximum bowling speed.'
                ],
                [
                    'question_text' => 'Under Decision Review System (DRS) ball tracking rules, what constitutes an "Umpire’s Call" on the impact point?',
                    'option_a' => 'The ball passed more than 5 meters above the stumps.',
                    'option_b' => 'More than 50% of the ball was outside the outer edge of the stumps when hitting the pad.',
                    'option_c' => 'The on-field umpire forgot to make a decision.',
                    'option_d' => 'The ball was touching the bat and pad simultaneously.',
                    'correct_option' => 'B',
                    'explanation' => 'If less than 50% of the ball is impacting within the projected zone of the stumps (or wicket impact), the on-field umpire’s original call is upheld.'
                ],
            ],

            // ==================== 2. FOOTBALL (SOCCER) ====================
            'football' => [
                [
                    'question_text' => 'According to IFAB Law 11, under which of the following game restarts can an attacking player NEVER be called offside?',
                    'option_a' => 'Direct Free Kick',
                    'option_b' => 'Corner Kick, Throw-in, and Goal Kick',
                    'option_c' => 'Indirect Free Kick inside the penalty box',
                    'option_d' => 'Penalty Kick rebound off the crossbar',
                    'correct_option' => 'B',
                    'explanation' => 'There is strictly no offside offense directly from a Throw-in, Corner Kick, or Goal Kick under IFAB Law 11.'
                ],
                [
                    'question_text' => 'In tactical football, what is the primary objective of "Gegenpressing" (Counter-pressing) pioneered by modern managers?',
                    'option_a' => 'Immediately retreating all 11 players into a 10-man deep defensive low block.',
                    'option_b' => 'Aggressively swarming the opponent within 5–8 seconds of losing possession while they are disorganized and transitioning.',
                    'option_c' => 'Passing the ball backwards to the goalkeeper to waste time.',
                    'option_d' => 'Kicking the ball out of play intentionally for a throw-in.',
                    'correct_option' => 'B',
                    'explanation' => 'Gegenpressing capitalizes on the opponent’s vulnerability in the immediate transition seconds when their players expand for counter-attack.'
                ],
                [
                    'question_text' => 'What is the role of an "Inverted Full-back" in modern tactical systems like 3-2-4-1 or 4-3-3?',
                    'option_a' => 'To overlap along the touchline and swing crosses into the 6-yard box.',
                    'option_b' => 'To step inside into central midfield during possession, creating numerical superiority in the center of the pitch.',
                    'option_c' => 'To play as a traditional center-back marking the striker exclusively.',
                    'option_d' => 'To stand near the corner flag to take all set pieces.',
                    'correct_option' => 'B',
                    'explanation' => 'Inverted fullbacks tuck into central defensive midfield alongside the pivot, preventing central counters and aiding ball progression.'
                ],
                [
                    'question_text' => 'When defending in a "Zonal Marking" system on corner kicks, what is a defender responsible for?',
                    'option_a' => 'Following one designated opponent wherever they run across the box.',
                    'option_b' => 'Guarding and clearing any ball entering a designated spatial sector of the penalty box, regardless of which opponent enters it.',
                    'option_c' => 'Standing behind the goalkeeper on the goal line.',
                    'option_d' => 'Only tackling the player taking the corner kick.',
                    'correct_option' => 'B',
                    'explanation' => 'Zonal marking allocates sectors of space in the box (front post, center 6-yard, back post) rather than tracking individual attackers.'
                ],
                [
                    'question_text' => 'In sports analytics, what does the metric Expected Goals (xG) measure?',
                    'option_a' => 'The total number of shots on target a team took during 90 minutes.',
                    'option_b' => 'The statistical probability (0 to 1) that a shot will result in a goal based on historical shot location, angle, assist type, and defensive pressure.',
                    'option_c' => 'How many goals the manager expects the team to score over an entire season.',
                    'option_d' => 'The speed of the ball when it crossed the goal line.',
                    'correct_option' => 'B',
                    'explanation' => 'xG quantifies chance quality by assigning a value between 0.00 and 1.00 based on historical likelihood of a shot being converted.'
                ],
                [
                    'question_text' => 'What tactical scenario triggers a "Professional Last-Man Foul" red card under DOGSO (Denial of an Obvious Goal-Scoring Opportunity)?',
                    'option_a' => 'Any foul committed anywhere on the pitch in the 90th minute.',
                    'option_b' => 'Denying a clear goal opportunity when distance to goal, general direction of play, likelihood of keeping/gaining control, and location of defenders are met outside the box.',
                    'option_c' => 'A goalkeeper catching the ball inside the penalty area.',
                    'option_d' => 'A player shouting loudly at their own teammate.',
                    'correct_option' => 'B',
                    'explanation' => 'DOGSO criteria evaluate distance to goal, direction, likelihood of controlling ball, and position/number of defenders.'
                ],
                [
                    'question_text' => 'What is the "Double Jeopardy" rule change regarding penalties and red cards for fouls inside the box?',
                    'option_a' => 'Players can never be sent off inside the penalty box.',
                    'option_b' => 'If a defender makes a genuine attempt to play the ball inside the box and commits a DOGSO foul, a penalty is awarded but the card is downgraded to yellow.',
                    'option_c' => 'Both teams are awarded a penalty simultaneously.',
                    'option_d' => 'The referee must award two yellow cards instead of one.',
                    'correct_option' => 'B',
                    'explanation' => 'To avoid triple punishment (penalty + red card + match suspension), genuine attempts to play the ball leading to DOGSO inside the box receive a yellow card instead of red.'
                ],
                [
                    'question_text' => 'Which passing technique generates sharp backspin, allowing the ball to land softly and stop without skidding over the opponent’s touchline?',
                    'option_a' => 'Instep knuckleball strike',
                    'option_b' => 'Chipped pass struck underneath the ball with ankle locked and minimal follow-through',
                    'option_c' => 'Outside-of-the-foot trivela drive',
                    'option_d' => 'Toe-poke with loose ankle',
                    'correct_option' => 'B',
                    'explanation' => 'Striking cleanly underneath the ball with an open, locked blade produces reverse Magnus rotation (backspin) that checks the ball upon bounce.'
                ],
                [
                    'question_text' => 'In a 4-2-3-1 formation, what is the tactical distinction between the "Number 6" and the "Number 10"?',
                    'option_a' => 'No. 6 is the deep-lying defensive anchor/regista; No. 10 is the advanced playmaker operating in the half-spaces behind the striker.',
                    'option_b' => 'No. 6 plays striker; No. 10 plays goalkeeper.',
                    'option_c' => 'No. 6 is strictly a substitute player.',
                    'option_d' => 'Both players have identical positions on the left wing.',
                    'correct_option' => 'A',
                    'explanation' => 'The #6 protects the defense and initiates build-up from deep, while the #10 threads decisive passes in the attacking final third.'
                ],
                [
                    'question_text' => 'When a team transitions from defense to attack, what is a "Third-Man Run"?',
                    'option_a' => 'When the referee runs alongside the ball carrier.',
                    'option_b' => 'Player A passes to Player B, drawing defenders, while un-marked Player C makes an explosive blindside run to receive the next pass from Player B.',
                    'option_c' => 'When three players sprint toward the corner flag simultaneously.',
                    'option_d' => 'A substitution where the third substitute enters early.',
                    'correct_option' => 'B',
                    'explanation' => 'The third-man concept is virtually indefensible because opponents focus on the ball carrier (A) and initial receiver (B), leaving the third runner (C) untracked.'
                ],
            ],

            // ==================== 3. BADMINTON ====================
            'badminton' => [
                [
                    'question_text' => 'According to BWF regulations, what is the maximum legal height of the shuttlecock at the instant of being hit during a service?',
                    'option_a' => 'Must be below the server’s chin.',
                    'option_b' => '1.15 meters from the surface of the court.',
                    'option_c' => 'Exactly at the height of the net cord (1.55m).',
                    'option_d' => 'Must be below the server’s ribcage only.',
                    'correct_option' => 'B',
                    'explanation' => 'Under modern BWF experimental and current fixed-height service laws, the entire shuttle must be below 1.15m at the instant of racket impact.'
                ],
                [
                    'question_text' => 'What anatomical forearm movement is critical to generating explosive snap and power in an overhead badminton smash?',
                    'option_a' => 'Strict elbow locking with no wrist involvement',
                    'option_b' => 'Internal forearm pronation ending with rapid wrist flexion',
                    'option_c' => 'External forearm supination with relaxed grip throughout',
                    'option_d' => 'Bending the back backwards at a 90-degree angle',
                    'correct_option' => 'B',
                    'explanation' => 'Overhead power in badminton is generated primarily through internal rotation (pronation) of the forearm, accelerating the racket head like a whip.'
                ],
                [
                    'question_text' => 'In singles badminton, where should a player’s base recovery position generally be between rallies?',
                    'option_a' => 'Pinned flat on the rear backline boundary',
                    'option_b' => 'Right beside the net tape on the right sideline',
                    'option_c' => 'Slightly behind the exact center of the court (T-junction area), on the balls of the feet with knees flexed',
                    'option_d' => 'Sitting down on the court bench to catch breath',
                    'correct_option' => 'C',
                    'explanation' => 'The central recovery base gives equidistant access to all four corners (two forecourt net corners and two rear court corners).'
                ],
                [
                    'question_text' => 'What is the tactical difference between a "Fast Attacking Clear" and a "High Defensive Clear"?',
                    'option_a' => 'Attacking clear has a flatter trajectory designed to push the opponent deep and deny recovery time; defensive clear arcs high to give the defender time to reset.',
                    'option_b' => 'Defensive clear is only played with the backhand.',
                    'option_c' => 'Attacking clear must always land inside the service box.',
                    'option_d' => 'There is no difference; they are identical shots.',
                    'correct_option' => 'A',
                    'explanation' => 'Attacking clears travel with high speed just out of the opponent’s reach to rush them, while high clears drop vertically at the baseline, allowing recovery.'
                ],
                [
                    'question_text' => 'Why does high string tension (e.g., 28–32 lbs) benefit advanced players but harm beginners?',
                    'option_a' => 'High tension creates a larger sweet spot that automatically fixes off-center hits.',
                    'option_b' => 'High tension provides pinpoint control and feel but requires high swing speed to generate power, offering virtually zero trampoline effect.',
                    'option_c' => 'High tension makes the racket indestructible.',
                    'option_d' => 'Low tension is illegal in competitive badminton.',
                    'correct_option' => 'B',
                    'explanation' => 'Tighter strings reduce the trampoline sweet spot, punishing off-center hits and risking arm injury if the player lacks elite swing speed and technique.'
                ],
                [
                    'question_text' => 'In competitive badminton scoring, what happens when the score reaches 29-all in a game?',
                    'option_a' => 'The game ends in a tie.',
                    'option_b' => 'The side scoring the 30th point wins the game (sudden death at 30).',
                    'option_c' => 'The game is replayed from 0-0.',
                    'option_d' => 'Players must play until one side leads by 3 clear points.',
                    'correct_option' => 'B',
                    'explanation' => 'Under BWF 21-point rally scoring, if the score reaches 29–29, the side scoring the 30th point wins the game outright without requiring a 2-point lead.'
                ],
                [
                    'question_text' => 'Which footwork technique enables rapid lateral and diagonal coverage without crossing legs and losing balance?',
                    'option_a' => 'Long heavy lunges with flat heels',
                    'option_b' => 'Chassé steps (glide/slide steps) followed by a final stable lunge on the racket leg',
                    'option_c' => 'Hopping on one foot only',
                    'option_d' => 'Walking heel-to-toe like on a balance beam',
                    'correct_option' => 'B',
                    'explanation' => 'Chassé footwork preserves hip alignment and center of gravity, allowing quick explosive directional changes into corner lunges.'
                ],
                [
                    'question_text' => 'What is the primary tactical objective of a "Slice Drop Shot" compared to a straight drop shot?',
                    'option_a' => 'To make the shuttle travel faster than a smash.',
                    'option_b' => 'To disguise racket angle and speed, imparting spin on the cork to make the shuttle tumble sharply and drop steep close to the net.',
                    'option_c' => 'To hit the umpire’s chair intentionally.',
                    'option_d' => 'To break the opponent’s racket strings.',
                    'correct_option' => 'B',
                    'explanation' => 'Slicing across the feathers/cork creates deceptive speed deceleration and aerodynamic tumbling, causing the shuttle to drop steeply.'
                ],
                [
                    'question_text' => 'In mixed doubles, what is the standard attacking formation adopted by high-level pairs?',
                    'option_a' => 'Both players standing side-by-side on the back boundary line.',
                    'option_b' => 'Front-and-Back formation: Female partner intercepts at the net tape; male partner covers rear court smashes and drops.',
                    'option_c' => 'Both players standing at the net with rear court completely empty.',
                    'option_d' => 'Female player plays singles while male player sits out.',
                    'correct_option' => 'B',
                    'explanation' => 'Classic mixed doubles attacking structure places the female player dominating the net (kills, tap downs) and male player patrolling mid-to-rear court.'
                ],
                [
                    'question_text' => 'What is a "Net Kill" in badminton?',
                    'option_a' => 'Cutting the net cord with scissors.',
                    'option_b' => 'A steep downward strike played from right above the net tape on a loose, high shuttlecock with a short compact brush/tap.',
                    'option_c' => 'Hitting the shuttle into the bottom of the net.',
                    'option_d' => 'A high defensive lob from the baseline.',
                    'correct_option' => 'B',
                    'explanation' => 'A net kill requires rapid wrist interception right at the net tape to hammer a loose reply downward before the opponent can react.'
                ],
            ],

            // ==================== 4. ATHLETICS ====================
            'athletics' => [
                [
                    'question_text' => 'In sprint starts (100m/200m), what is the optimal front knee angle inside the starting blocks in the "Set" position?',
                    'option_a' => '45 degrees',
                    'option_b' => 'Approximately 90 degrees for front leg, and 120–135 degrees for rear leg',
                    'option_c' => '180 degrees (completely locked knees)',
                    'option_d' => 'Zero degrees (sitting flat on the track)',
                    'correct_option' => 'B',
                    'explanation' => 'Biomechanics studies establish ~90° front knee and ~120° rear knee angles maximize explosive horizontal impulse against the block pads.'
                ],
                [
                    'question_text' => 'According to World Athletics rules, when is an athlete charged with a False Start in sprint events?',
                    'option_a' => 'If they take a deep breath before the gun.',
                    'option_b' => 'If pressure sensors on the starting blocks detect movement reaction in less than 0.100 seconds after the starter’s gun fires.',
                    'option_c' => 'If they look at the runner in the adjacent lane.',
                    'option_d' => 'Only if they run more than 10 meters past the line.',
                    'correct_option' => 'B',
                    'explanation' => 'Human physiological auditory-motor processing takes at least 100 milliseconds; reaction times below 0.100s are deemed premature anticipation (false start).'
                ],
                [
                    'question_text' => 'In a 100-meter sprint, what is the "Drive Phase" and how long does it typically last in elite sprinters?',
                    'option_a' => 'The final 10 meters where runners celebrate.',
                    'option_b' => 'The initial 25–35 meters where the torso remains angled low, pushing forcefully into the ground to accelerate to maximum velocity.',
                    'option_c' => 'The entire race from start to finish.',
                    'option_d' => 'The jog back to the locker room after the race.',
                    'correct_option' => 'B',
                    'explanation' => 'The drive phase (0–35m) features an acute forward lean and piston-like hip extension to ramp up horizontal velocity before transitioning to upright mechanics.'
                ],
                [
                    'question_text' => 'In middle-distance racing (800m/1500m), what physiological phenomenon causes intense muscular burning during the final 200-meter kick?',
                    'option_a' => 'Accumulation of hydrogen ions (H+) leading to cellular acidosis and inhibition of glycolytic muscle contraction.',
                    'option_b' => 'Total disappearance of bone density.',
                    'option_c' => 'Excessive amounts of oxygen in the bloodstream.',
                    'option_d' => 'Lack of sunlight on the running track.',
                    'correct_option' => 'A',
                    'explanation' => 'Anaerobic lactic energy production causes H+ ion buildup, lowering muscle pH (acidosis) which interferes with calcium binding and contractile enzymes.'
                ],
                [
                    'question_text' => 'In the High Jump, what revolutionary technique introduced in 1968 allows an athlete’s center of mass to pass BELOW the bar while clearing it?',
                    'option_a' => 'The Scissor Kick',
                    'option_b' => 'The Fosbury Flop (arching backward over the bar)',
                    'option_c' => 'The Western Roll',
                    'option_d' => 'The Straddle Technique',
                    'correct_option' => 'B',
                    'explanation' => 'Dick Fosbury’s backward arch technique positions the body such that the jumper’s center of mass actually travels beneath the crossbar, maximizing clearance height.'
                ],
                [
                    'question_text' => 'In 4x100m relay racing, what is the length of the official "Takeover Zone" in modern World Athletics rules?',
                    'option_a' => '10 meters',
                    'option_b' => '30 meters (combining the previous acceleration and handover zones)',
                    'option_c' => '50 meters',
                    'option_d' => '100 meters',
                    'correct_option' => 'B',
                    'explanation' => 'Under updated World Athletics rules, the takeover zone is a unified 30 meters, within which the baton must be completely exchanged.'
                ],
                [
                    'question_text' => 'In Long Jump, what is the primary determinant of jump distance once the athlete leaves the takeoff board?',
                    'option_a' => 'How violently they wave their arms in mid-air',
                    'option_b' => 'Horizontal velocity at takeoff combined with vertical takeoff impulse and flight trajectory angle (approx. 20–22°)',
                    'option_c' => 'The color of their spikes',
                    'option_d' => 'Shouting loudly upon landing in the sand',
                    'correct_option' => 'B',
                    'explanation' => 'Once airborne, flight path is determined solely by projectile physics: takeoff velocity vector and angle. In-flight mechanics only optimize landing efficiency.'
                ],
                [
                    'question_text' => 'In Javelin throw, what aerodynamic modification was mandated by World Athletics in 1986 for Men’s javelins?',
                    'option_a' => 'Making the javelin twice as heavy.',
                    'option_b' => 'Moving the center of gravity 4 cm forward to induce earlier nose-down pitch and reduce dangerous over-100m throws.',
                    'option_c' => 'Banning metal tips and requiring plastic foam.',
                    'option_d' => 'Shortening the javelin to 50 cm.',
                    'correct_option' => 'B',
                    'explanation' => 'Uwe Hohn threw 104.80m in 1984, threatening stadium safety. World Athletics moved the center of gravity forward, causing earlier downward flight and shorter distances.'
                ],
                [
                    'question_text' => 'In Marathon running (42.195 km), what is commonly referred to by runners as "Hitting the Wall" around km 30–35?',
                    'option_a' => 'Literally colliding with a concrete stadium wall.',
                    'option_b' => 'Complete depletion of liver and skeletal muscle glycogen stores, forcing the body to rely on slow, oxygen-intensive fat oxidation.',
                    'option_c' => 'Drinking too much electrolyte water at aid stations.',
                    'option_d' => 'Running out of shoe grip on road tarmac.',
                    'correct_option' => 'B',
                    'explanation' => 'The human body stores ~2,000 kcal of glycogen. At km 32, glycogen runs out; fat oxidation produces ATP at a slower rate, causing acute physical and mental exhaustion.'
                ],
                [
                    'question_text' => 'In Pole Vault, what physical material property of fiberglass/carbon-composite poles enables clearing heights over 6 meters?',
                    'option_a' => 'Ability to store elastic potential energy during bend and release it as vertical kinetic thrust during unbend.',
                    'option_b' => 'Inflatable helium gas inside the pole.',
                    'option_c' => 'Magnetic attraction to the crossbar.',
                    'option_d' => 'Rigidity that refuses to bend under any weight.',
                    'correct_option' => 'A',
                    'explanation' => 'The vaulter converts horizontal kinetic energy into bending elastic potential energy, which recoils upward to catapult the vaulter vertically.'
                ],
            ],

            // ==================== 5. KABADDI ====================
            'kabaddi' => [
                [
                    'question_text' => 'In standard Pro Kabaddi rules, what is the maximum duration permitted for a single raid?',
                    'option_a' => '15 seconds',
                    'option_b' => '30 seconds',
                    'option_c' => '45 seconds',
                    'option_d' => '60 seconds',
                    'correct_option' => 'B',
                    'explanation' => 'A raid must be completed within an official shot-clock of 30 seconds; failure to cross the mid-line results in an out.'
                ],
                [
                    'question_text' => 'What is the mandatory physiological requirement known as the "Cant" in traditional and competitive Kabaddi?',
                    'option_a' => 'Holding your arms behind your back while running.',
                    'option_b' => 'Continuous, clear vocal chanting of the word "Kabaddi" in one single un-interrupted expiration of breath.',
                    'option_c' => 'Closing both eyes while crossing the midline.',
                    'option_d' => 'Counting from 1 to 30 backwards in English.',
                    'correct_option' => 'B',
                    'explanation' => 'Cant is the continuous recitation of "Kabaddi" without pause or inhalation, proving single-breath stamina.'
                ],
                [
                    'question_text' => 'Under what defensive condition is a "Super Tackle" activated in professional Kabaddi, and how many points does it award?',
                    'option_a' => 'When all 7 defenders tackle the raider; awards 1 point.',
                    'option_b' => 'When a defense with 3 or fewer players successfully tackles an active raider; awards 2 points.',
                    'option_c' => 'When the raider steps out of bounds willingly; awards 3 points.',
                    'option_d' => 'When the coach tackles the raider from the sideline.',
                    'correct_option' => 'B',
                    'explanation' => 'A Super Tackle occurs when 3, 2, or 1 defenders stop the raider, earning 2 points for the defending team instead of 1.'
                ],
                [
                    'question_text' => 'What is the rule regarding the "Bonus Line" in Kabaddi?',
                    'option_a' => 'It can be scored only if there are 6 or 7 active defenders on court, by placing one foot in the bonus zone with the trailing foot off the ground.',
                    'option_b' => 'It gives 5 bonus points directly.',
                    'option_c' => 'It is active only in the first 5 minutes of each half.',
                    'option_d' => 'The raider can touch the bonus line with both hands while lying down.',
                    'correct_option' => 'A',
                    'explanation' => 'Bonus line requires at least 6 defenders on court, with the raider placing one foot over the line while the other foot is completely airborne.'
                ],
                [
                    'question_text' => 'What is a "Do-or-Die Raid" in Kabaddi?',
                    'option_a' => 'A raid where the raider is legally allowed to wrestle the referee.',
                    'option_b' => 'When a team commits two consecutive empty raids, their 3rd raid must score a point (touch or bonus), or the raider is declared out.',
                    'option_c' => 'The very first raid of the match.',
                    'option_d' => 'A raid taken during medical timeouts.',
                    'correct_option' => 'B',
                    'explanation' => 'Two consecutive scoreless empty raids trigger a Do-or-Die raid on the 3rd turn, mandating a score or automatic concession of an out.'
                ],
                [
                    'question_text' => 'When do the side "Lobbies" become legally active during a Kabaddi raid?',
                    'option_a' => 'They are always open and active from the start of every raid.',
                    'option_b' => 'Only after a physical touch (struggle) has taken place between the raider and at least one defender.',
                    'option_c' => 'Only during the last two minutes of the match.',
                    'option_d' => 'Only when the raider asks permission from the table umpire.',
                    'correct_option' => 'B',
                    'explanation' => 'The lobbies expand the court width by 1 meter on each side, but stepping into them before a touch is an immediate self-out.'
                ],
                [
                    'question_text' => 'Which signature raiding move involves the raider ducking down low and escaping beneath an oncoming chain of defenders?',
                    'option_a' => 'Dubki',
                    'option_b' => 'Frog Jump',
                    'option_c' => 'Toe Touch',
                    'option_d' => 'Scorpion Kick',
                    'correct_option' => 'A',
                    'explanation' => 'The Dubki (popularized by Pardeep Narwal) involves sudden explosive knee bending, sliding under the defender chain, and rising past their reach to safety.'
                ],
                [
                    'question_text' => 'What is the defensive technique "Ankle Hold" primarily dependent on for success?',
                    'option_a' => 'Pulling the raider’s jersey vigorously.',
                    'option_b' => 'Precise timing gripping the raider’s plant foot ankle tightly at the Achilles tendon while lifting upward to destroy their balance.',
                    'option_c' => 'Pushing the raider into the spectators.',
                    'option_d' => 'Tripping the raider with an illegal leg sweep.',
                    'correct_option' => 'B',
                    'explanation' => 'A firm two-handed lock around the Achilles/ankle coupled with upward lift prevents the raider from generating driving traction off the mat.'
                ],
                [
                    'question_text' => 'What constitutes an "All-Out" in Kabaddi, and what bonus points are awarded?',
                    'option_a' => 'When all 7 players of one team are put out; 2 additional bonus points are awarded to the opposition, and all 7 players are revived.',
                    'option_b' => 'When both teams agree to end the match early.',
                    'option_c' => 'When all referees walk off the mat; awards 10 points.',
                    'option_d' => 'When a team commits 5 yellow card fouls.',
                    'correct_option' => 'A',
                    'explanation' => 'Eliminating all opposing players yields an All-Out (+2 bonus points), resetting the eliminated team back to full 7-player strength.'
                ],
                [
                    'question_text' => 'In defensive positioning, what are the two corner positions (Right Corner & Left Corner) responsible for?',
                    'option_a' => 'Singing the national anthem before the match.',
                    'option_b' => 'Anchor defensive leadership, controlling the depth of the arc, initiating ankle holds, and coordinating chain rushes.',
                    'option_c' => 'They only stand near the sideline with hands in pockets.',
                    'option_d' => 'They are strictly backup raiders who never participate in tackles.',
                    'correct_option' => 'B',
                    'explanation' => 'Corner defenders are the strategic anchors who control the arc width, initiate primary holds, and trigger team support chains.'
                ],
            ],

            // ==================== 6. BASKETBALL ====================
            'basketball' => [
                [
                    'question_text' => 'In FIBA and NBA basketball, what is the "24-Second Shot Clock" violation rule?',
                    'option_a' => 'A team must make at least 24 passes before shooting.',
                    'option_b' => 'A team must attempt a field goal that releases before 24 seconds expire and contacts the rim or enters the basket.',
                    'option_c' => 'A player can only hold the ball for 24 milliseconds.',
                    'option_d' => 'The match ends automatically after 24 seconds.',
                    'correct_option' => 'B',
                    'explanation' => 'The offensive team must attempt a field goal within 24 seconds of gaining control; the ball must contact the rim or go in.'
                ],
                [
                    'question_text' => 'What is the "Pick-and-Roll" offensive action in basketball?',
                    'option_a' => 'A player picks up the ball and rolls it across the floor like bowling.',
                    'option_b' => 'An offensive player sets a legal screen (pick) on their teammate’s defender, then cuts (rolls) toward the basket to receive a pass.',
                    'option_c' => 'A defensive player stealing the ball and running out of bounds.',
                    'option_d' => 'Dribbling with two hands simultaneously.',
                    'correct_option' => 'B',
                    'explanation' => 'The pick-and-roll creates mismatches or open driving/passing lanes by screening the ball handler’s defender and rolling to the rim.'
                ],
                [
                    'question_text' => 'What constitutes a "Three-Second Violation" in basketball?',
                    'option_a' => 'Shooting a three-pointer in under 3 seconds.',
                    'option_b' => 'An offensive player remaining in the restricted key area (paint) for more than 3 consecutive seconds without attempting a shot.',
                    'option_c' => 'Taking 3 steps without dribbling.',
                    'option_d' => 'Calling 3 timeouts in a row.',
                    'correct_option' => 'B',
                    'explanation' => 'Offensive players cannot camp inside the paint for more than 3 consecutive seconds; doing so forfeits possession.'
                ],
                [
                    'question_text' => 'In shooting mechanics, what does the coaching acronym "B.E.E.F." represent?',
                    'option_a' => 'Ball, Energy, Endurance, Finish',
                    'option_b' => 'Balance, Eyes, Elbow, Follow-through',
                    'option_c' => 'Bounce, Effort, Elevation, Foul',
                    'option_d' => 'Backboard, Entry, Extension, Force',
                    'correct_option' => 'B',
                    'explanation' => 'BEEF is the universal foundational shooting cue: Balance base, Eyes focused on rim, Elbow under the ball at 90°, and high wrist Follow-through.'
                ],
                [
                    'question_text' => 'What is the tactical trade-off of running a "2-3 Zone Defense" compared to Man-to-Man defense?',
                    'option_a' => '2-3 zone leaves the key open but locks down the three-point line.',
                    'option_b' => '2-3 zone clogs the paint and stops inside drives/rebounds, but leaves the perimeter corners and wings vulnerable to outside three-point shooting.',
                    'option_c' => '2-3 zone eliminates all personal fouls entirely.',
                    'option_d' => '2-3 zone can only be played with 2 players on court.',
                    'correct_option' => 'B',
                    'explanation' => 'Zone defenses congest interior driving lanes at the expense of giving up perimeter spacing and spot-up corner threes.'
                ],
                [
                    'question_text' => 'What is a "Double Dribble" violation?',
                    'option_a' => 'Scoring two baskets in a row.',
                    'option_b' => 'Dribbling with both hands simultaneously, or stopping a dribble (holding the ball) and then beginning to dribble again.',
                    'option_c' => 'Dribbling between the legs twice.',
                    'option_d' => 'Passing to a teammate who is also dribbling.',
                    'correct_option' => 'B',
                    'explanation' => 'Once a dribble has been concluded by bringing two hands onto the ball or resting the ball, restarting a dribble is illegal.'
                ],
                [
                    'question_text' => 'In fast-break transition offense, what is the role of the "Trailer"?',
                    'option_a' => 'A vehicle parked outside the arena.',
                    'option_b' => 'A big man or shooter running behind the initial fast break pack who receives a kick-back pass for an uncontested rhythm jump shot.',
                    'option_c' => 'A player who walks back slowly on defense.',
                    'option_d' => 'The player responsible for fouling the point guard.',
                    'correct_option' => 'B',
                    'explanation' => 'As the defense collapses to protect the rim on a break, the trailing player arrives late into wide-open space at the top of the key.'
                ],
                [
                    'question_text' => 'What is the "Backcourt Violation" rule in basketball?',
                    'option_a' => 'Shooting from your own half.',
                    'option_b' => 'Once an offensive team advances the ball across the midcourt line, they cannot legally return the ball across into their backcourt.',
                    'option_c' => 'Falling down on the court surface.',
                    'option_d' => 'Passing the ball over the backboard.',
                    'correct_option' => 'B',
                    'explanation' => 'Crossing the mid-court establishes frontcourt status; passing or dribbling back across midcourt is a turnover.'
                ],
                [
                    'question_text' => 'How many personal fouls result in a player being fouled out (disqualified) in standard FIBA basketball rules?',
                    'option_a' => '3 fouls',
                    'option_b' => '5 fouls (in FIBA/Olympics; 6 in NBA)',
                    'option_c' => '10 fouls',
                    'option_d' => 'Fouls are unlimited.',
                    'correct_option' => 'B',
                    'explanation' => 'Under international FIBA regulations, a player is disqualified upon committing their 5th personal or technical foul (NBA permits 6).'
                ],
                [
                    'question_text' => 'What is the "Euro-Step" offensive move popularized by Manu Ginobili and Giannis Antetokounmpo?',
                    'option_a' => 'Stepping across the European continent by plane.',
                    'option_b' => 'Picking up the dribble and taking the first step in one direction, followed by an abrupt, lateral second step in the opposite direction to evade a rim defender.',
                    'option_c' => 'Kicking the ball into the hoop with a soccer kick.',
                    'option_d' => 'Shooting a half-court hook shot.',
                    'correct_option' => 'B',
                    'explanation' => 'The Euro-step utilizes the two allowed gathering steps to fake momentum one way and pivot horizontally across the defender’s balance plane.'
                ],
            ],

            // ==================== 7. TENNIS ====================
            'tennis' => [
                [
                    'question_text' => 'In tennis aerodynamics, how does heavy "Topspin" affect the flight trajectory and bounce of the ball (Magnus Effect)?',
                    'option_a' => 'Causes the ball to float upwards and bounce with zero friction.',
                    'option_b' => 'Creates downward aerodynamic pressure that dips the ball sharply into the court, producing an explosive, high forward kick on the bounce.',
                    'option_c' => 'Makes the ball stop completely on the baseline like backspin.',
                    'option_d' => 'Decreases the speed of the ball by 90% in mid-air.',
                    'correct_option' => 'B',
                    'explanation' => 'Topspin creates higher air velocity above the ball and downward Magnus force, allowing players to hit hard with high net clearance and steep dip.'
                ],
                [
                    'question_text' => 'What is the key physical characteristic of playing on a Clay Court (e.g. Roland Garros) compared to Grass (Wimbledon)?',
                    'option_a' => 'Clay produces high friction, slowing ball speed and producing high, heavy bounces that favor patient baseline grinders.',
                    'option_b' => 'Clay is the fastest surface in tennis with zero bounce.',
                    'option_c' => 'Players are not allowed to slide on clay.',
                    'option_d' => 'Matches on clay are limited to 30 minutes.',
                    'correct_option' => 'A',
                    'explanation' => 'Clay courts grip the ball on impact, taking off horizontal velocity and rewarding endurance, topspin, and controlled sliding.'
                ],
                [
                    'question_text' => 'What is the scoring condition required to win a standard 7-Point Tiebreak in tennis?',
                    'option_a' => 'First player to reach exactly 7 points, regardless of margin.',
                    'option_b' => 'First player to reach at least 7 points with a margin of at least 2 clear points over the opponent.',
                    'option_c' => 'First player to win 10 consecutive rallies.',
                    'option_d' => 'First player to hit an ace on match point.',
                    'correct_option' => 'B',
                    'explanation' => 'A tiebreak is won at 7 points, but if the score reaches 6–6, play continues until one player achieves a 2-point lead (e.g. 8–6, 9–7).'
                ],
                [
                    'question_text' => 'What is a "Western Forehand Grip" primarily engineered to accomplish?',
                    'option_a' => 'Hitting flat slices on low grass-court skids.',
                    'option_b' => 'Generating extreme topspin and driving shoulder-height balls above the opponent’s strike zone.',
                    'option_c' => 'Serving kick serves with the back of the hand.',
                    'option_d' => 'Playing drop volleys at the net.',
                    'correct_option' => 'B',
                    'explanation' => 'The Western grip places the heel pad on bevel 5 underneath the handle, naturally closing the racket face and favoring extreme heavy topspin.'
                ],
                [
                    'question_text' => 'In service execution, what is the difference between a "Flat Serve", "Slice Serve", and "Kick Serve"?',
                    'option_a' => 'Flat has maximum velocity with little spin; slice curves laterally away from receiver; kick serve has heavy topspin-sidespin that kicks high over backhands.',
                    'option_b' => 'All three serves travel at the exact same trajectory.',
                    'option_c' => 'Kick serve can only be hit underhand.',
                    'option_d' => 'Slice serve is illegal in Grand Slams.',
                    'correct_option' => 'A',
                    'explanation' => 'Flat maximizes direct kinetic speed, slice uses lateral sidespin to pull receivers off-court, and kick utilizes upward brushing for high bounce.'
                ],
                [
                    'question_text' => 'What is the "Split-Step" in tennis footwork, and when must it be executed?',
                    'option_a' => 'Splitting the racket in half after losing a point.',
                    'option_b' => 'A light, explosive hops landing on the balls of both feet right as the opponent strikes the ball, loading leg muscles to spring in any direction.',
                    'option_c' => 'Standing completely frozen on your heels.',
                    'option_d' => 'Taking two steps backward behind the baseline.',
                    'correct_option' => 'B',
                    'explanation' => 'The split-step pre-stretches the calf and quad tendons (stretch-shortening cycle) right as the opponent hits, enabling instant reactive movement.'
                ],
                [
                    'question_text' => 'Under ITF Grand Slam rules, what is the "Shot Clock" limit between points during a match?',
                    'option_a' => '10 seconds',
                    'option_b' => '25 seconds',
                    'option_c' => '60 seconds',
                    'option_d' => 'There is no time limit.',
                    'correct_option' => 'B',
                    'explanation' => 'The official ITF/ATP/WTA countdown clock allows 25 seconds between points; exceeding it results in a time violation.'
                ],
                [
                    'question_text' => 'What is a "Moonball" in tennis tactical strategy?',
                    'option_a' => 'A ball hit into outer space.',
                    'option_b' => 'A high, floating topspin ball hit 15–20 feet above the net that pushes aggressive hitters deep behind the baseline and breaks their rhythm.',
                    'option_c' => 'A serve hit during a full moon.',
                    'option_d' => 'An illegal shot penalized by a point deduction.',
                    'correct_option' => 'B',
                    'explanation' => 'Moonballs push impatient baseline attackers far behind their comfort zone, neutralising their pace and forcing unforced errors.'
                ],
                [
                    'question_text' => 'What does "Deuce" mean in tennis game scoring?',
                    'option_a' => 'The game is over.',
                    'option_b' => 'A score of 40–40, where a player must win two consecutive points (Advantage followed by Game) to win the game.',
                    'option_c' => 'The player has hit two consecutive double faults.',
                    'option_d' => 'Both players are serving simultaneously.',
                    'correct_option' => 'B',
                    'explanation' => 'Deuce represents a 40–40 deadlock requiring a 2-point consecutive margin (Ad-in/Ad-out and game point) to conclude the game.'
                ],
                [
                    'question_text' => 'In doubles tennis, what is the "I-Formation" tactic on serve?',
                    'option_a' => 'Both players standing on the baseline.',
                    'option_b' => 'The server’s net partner crouches directly over the center service line, disguising which side they will poach until after the serve is airborne.',
                    'option_c' => 'Standing in the shape of the letter O.',
                    'option_d' => 'Playing without a net partner.',
                    'correct_option' => 'B',
                    'explanation' => 'The I-Formation forces the returner to guess which direction the crouched net partner will poach, disrupting cross-court return habits.'
                ],
            ],

            // ==================== 8. VOLLEYBALL ====================
            'volleyball' => [
                [
                    'question_text' => 'In indoor volleyball, how many consecutive contacts with the ball is a team allowed before returning it over the net?',
                    'option_a' => '2 contacts',
                    'option_b' => '3 contacts (excluding a block touch)',
                    'option_c' => '5 contacts',
                    'option_d' => 'Unlimited contacts as long as ball is kept in air',
                    'correct_option' => 'B',
                    'explanation' => 'A team is entitled to a maximum of 3 hits (in addition to blocking) for returning the ball over the net.'
                ],
                [
                    'question_text' => 'What are the strict tactical restrictions placed on a "Libero" in volleyball?',
                    'option_a' => 'The Libero can only play as the main setter.',
                    'option_b' => 'The Libero cannot serve, block, attempt to block, or attack the ball above net height from anywhere on court.',
                    'option_c' => 'The Libero must wear the exact same jersey as the team captain.',
                    'option_d' => 'The Libero is the only player allowed to spike over the net.',
                    'correct_option' => 'B',
                    'explanation' => 'The Libero is a defensive specialist wearing a contrasting jersey who is restricted from front-row attacks, blocking, and attacking above net height.'
                ],
                [
                    'question_text' => 'In volleyball rotational rules, what is an "Overlapping (Rotational) Fault"?',
                    'option_a' => 'When a player wears socks that overlap their kneepads.',
                    'option_b' => 'When a player is out of their mandatory relative rotational position with respect to adjacent teammates at the instant the ball is served.',
                    'option_c' => 'When two players spike the ball simultaneously.',
                    'option_d' => 'When the ball hits the antenna.',
                    'correct_option' => 'B',
                    'explanation' => 'At the instant the server strikes the ball, each team must be within its own court in rotational order; violation forfeits the point.'
                ],
                [
                    'question_text' => 'What aerodynamic property gives a "Jump Float Serve" its erratic, unpredictable knuckleball dipping trajectory?',
                    'option_a' => 'Extremely rapid topspin rotation.',
                    'option_b' => 'Striking the center of the ball with a firm, flat palm and immediate stop (no follow-through), creating zero spin and turbulent boundary-layer air separation.',
                    'option_c' => 'Filling the volleyball with water before serving.',
                    'option_d' => 'Hitting the ball with closed fists.',
                    'correct_option' => 'B',
                    'explanation' => 'A float serve imparts zero spin; as it travels through air, fluctuating eddies create sudden unpredictable drops and side shifts.'
                ],
                [
                    'question_text' => 'In volleyball offense, what does the "5-1 System" signify?',
                    'option_a' => '5 balls and 1 net.',
                    'option_b' => '5 primary hitters and 1 dedicated setter who sets from all 6 rotational positions.',
                    'option_c' => '5 players on the court and 1 coach.',
                    'option_d' => 'Winning 5 sets to 1.',
                    'correct_option' => 'B',
                    'explanation' => 'The 5-1 uses a single setter throughout all rotations, ensuring consistent offensive tempo and maximizing hitter chemistry.'
                ],
                [
                    'question_text' => 'What is a "Quick Set" (also known as a "1" or "A-Quick") in volleyball offense?',
                    'option_a' => 'A set that is thrown under the net.',
                    'option_b' => 'A low, explosive set delivered directly into the hitting hand of a middle blocker who is already in mid-air right next to the setter.',
                    'option_c' => 'A set that takes 10 seconds to fall down.',
                    'option_d' => 'A set hit with the foot.',
                    'correct_option' => 'B',
                    'explanation' => 'A quick set requires the middle attacker to jump before or as the ball is set, catching the opposing blockers flat-footed.'
                ],
                [
                    'question_text' => 'What is the "Ten-Foot Line" (3-Meter Line) rule regarding back-row players attacking?',
                    'option_a' => 'Back-row players cannot run across the line.',
                    'option_b' => 'A back-row player may attack the ball above net height only if their takeoff foot takes off completely behind the 3-meter line.',
                    'option_c' => 'Back-row players must stay behind the line for the entire match.',
                    'option_d' => 'The line is purely decorative.',
                    'correct_option' => 'B',
                    'explanation' => 'Back-row hitters (e.g. pipe attack) must jump from behind the 3-meter line; stepping on or over the line during takeoff is an illegal attack.'
                ],
                [
                    'question_text' => 'In spike defense, what does "Closing the Block" mean?',
                    'option_a' => 'Packing up the volleyball net after the game.',
                    'option_b' => 'The outside blocker and middle blocker pressing their hands tightly together without leaving a gap between them for the ball to penetrate.',
                    'option_c' => 'Turning off the stadium floodlights.',
                    'option_d' => 'Standing behind the baseline with hands raised.',
                    'correct_option' => 'B',
                    'explanation' => 'Closing the block eliminates the seam between adjacent blockers, preventing attackers from tooling or driving the ball between arms.'
                ],
                [
                    'question_text' => 'What is a "Pancake" dig in emergency volleyball defense?',
                    'option_a' => 'Eating breakfast during time-outs.',
                    'option_b' => 'Sliding the hand flat onto the floor, palm down, so the ball rebounds off the back of the hand just millimeters before touching the floor.',
                    'option_c' => 'Kicking the ball over the net.',
                    'option_d' => 'Catching the ball with two hands.',
                    'correct_option' => 'B',
                    'explanation' => 'A pancake requires diving prone and sliding an open palm flat on the floor so the ball bounces off the dorsal surface of the hand.'
                ],
                [
                    'question_text' => 'Under FIVB scoring rules, how many points are needed to win the 5th (deciding) tiebreak set?',
                    'option_a' => '25 points with a 2-point lead',
                    'option_b' => '15 points with a 2-point lead',
                    'option_c' => '10 points flat',
                    'option_d' => '30 points sudden death',
                    'correct_option' => 'B',
                    'explanation' => 'Sets 1 to 4 are played to 25 points; the 5th deciding set is played to 15 points with a mandatory 2-point advantage.'
                ],
            ],

            // ==================== 9. TABLE TENNIS ====================
            'table-tennis' => [
                [
                    'question_text' => 'In competitive table tennis under ITTF rules, what is the mandatory service toss height?',
                    'option_a' => 'The ball can be rolled off the palm at table level.',
                    'option_b' => 'The ball must be tossed near-vertically upwards at least 16 cm (approx. 6 inches) from an open, flat palm without spin.',
                    'option_c' => 'The ball must be tossed at least 2 meters above the ceiling.',
                    'option_d' => 'The server may throw the ball sideways into the opponent’s face.',
                    'correct_option' => 'B',
                    'explanation' => 'ITTF Law 2.6 requires an open flat palm and a near-vertical toss of at least 16 cm after leaving the palm before being struck.'
                ],
                [
                    'question_text' => 'What is the difference between "Inverted (Smooth) Rubber" and "Pips-Out (Short/Long Pimples) Rubber"?',
                    'option_a' => 'Inverted rubber generates high spin and loop drive; pips-out rubber deadens spin, reverses opponent’s spin, or produces flat deceptive returns.',
                    'option_b' => 'Pips-out rubber is banned in international table tennis.',
                    'option_c' => 'Inverted rubber is only used on the wooden handle.',
                    'option_d' => 'Pips-out rubber adds 10 extra points to each game.',
                    'correct_option' => 'A',
                    'explanation' => 'Inverted rubber has high frictional grip for heavy topspin/looping; long pimples bend under ball contact, neutralizing or reversing incoming rotation.'
                ],
                [
                    'question_text' => 'In tactical table tennis, what is a "Third-Ball Attack"?',
                    'option_a' => 'Introducing a third ball onto the table simultaneously.',
                    'option_b' => 'The server uses their serve (1st ball) to anticipate the opponent’s predictable return (2nd ball), immediately unleashing a kill or powerful topspin loop (3rd ball).',
                    'option_c' => 'Serving 3 aces in a row.',
                    'option_d' => 'Hitting the ball against the wall three times.',
                    'correct_option' => 'B',
                    'explanation' => 'Third-ball attack is the foundational offensive strategy: tailoring the serve to draw a specific weak return that is immediately attacked.'
                ],
                [
                    'question_text' => 'What is a "Banana Flick" (Chiquita) in modern table tennis receiving?',
                    'option_a' => 'Eating a fruit between games.',
                    'option_b' => 'An aggressive backhand over-the-table topspin flick against a short serve, curving like a banana with heavy sidespin.',
                    'option_c' => 'Slipping on a banana peel on the court floor.',
                    'option_d' => 'Hitting the ball under the table net.',
                    'correct_option' => 'B',
                    'explanation' => 'The Chiquita (popularized by modern European and Chinese stars) lets receivers attack short backspin serves right over the table.'
                ],
                [
                    'question_text' => 'When reading an opponent’s serve, what visual cue indicates heavy "Backspin" (Under-spin)?',
                    'option_a' => 'The opponent hits upward with an open racket face brushing bottom-up.',
                    'option_b' => 'The racket moves downward underneath the ball with an open blade face at contact.',
                    'option_c' => 'The ball bounces higher than the player’s head.',
                    'option_d' => 'The opponent closes their eyes during service.',
                    'correct_option' => 'B',
                    'explanation' => 'Brushing underneath the ball with an open, downward-chopping motion imparts backspin, which will dive into the net if pushed passively.'
                ],
                [
                    'question_text' => 'In ITTF regulations, what colors must the two sides of a table tennis racket blade have?',
                    'option_a' => 'Both sides must be identical pitch black.',
                    'option_b' => 'One side must be black; the other side can be red, or an approved color (green, blue, purple, pink) that contrasts clearly with black.',
                    'option_c' => 'Both sides must be neon yellow.',
                    'option_d' => 'Any color is permitted, including white balls camouflage.',
                    'correct_option' => 'B',
                    'explanation' => 'ITTF requires one side black and the other an approved contrasting color (red, blue, pink, green, violet) so opponents can distinguish rubber types.'
                ],
                [
                    'question_text' => 'How many consecutive services does each player get in a standard 11-point table tennis game?',
                    'option_a' => '5 serves each',
                    'option_b' => '2 serves each (switching to 1 serve each at 10-all deuce)',
                    'option_c' => '1 serve each throughout the game',
                    'option_d' => 'The player who wins the point always serves.',
                    'correct_option' => 'B',
                    'explanation' => 'Service alternates every 2 points until the score reaches 10–10 (deuce), after which service alternates every single point.'
                ],
                [
                    'question_text' => 'What is the biomechanical function of the "Forehand Loop Drive" vs a flat smash?',
                    'option_a' => 'Loop drive uses upward brushing friction to generate heavy topspin that curves down into the table against heavy backspin.',
                    'option_b' => 'Loop drive is hit with the wooden edge of the racket.',
                    'option_c' => 'Flat smash curves like a boomerang.',
                    'option_d' => 'Loop drive must always land on the floor first.',
                    'correct_option' => 'A',
                    'explanation' => 'Looping overcomes backspin by brushing sharply upward to create lift and topspin dip; a flat smash against heavy backspin would crash into the net.'
                ],
                [
                    'question_text' => 'What is the "Expedite System" in table tennis rules?',
                    'option_a' => 'A rule requiring players to sprint between points.',
                    'option_b' => 'A rule introduced if a game is unfinished after 10 minutes (unless at least 18 points have been scored), where the receiver wins the point if they make 13 good returns.',
                    'option_c' => 'A sudden death rule where both players serve at the same time.',
                    'option_d' => 'An automatic disqualification for slow walking.',
                    'correct_option' => 'B',
                    'explanation' => 'The expedite system prevents marathon defensive pushing; after 10 minutes of play, service alternates every point and 13 good returns win the point.'
                ],
                [
                    'question_text' => 'In defensive play, what is modern "Chopping"?',
                    'option_a' => 'Hitting the table with an axe.',
                    'option_b' => 'Standing 8–15 feet back from the table and returning powerful topspin loops with deep, low backspin chops.',
                    'option_c' => 'Smashing high lobs into the ceiling.',
                    'option_d' => 'Stepping off the court and serving from the hallway.',
                    'correct_option' => 'B',
                    'explanation' => 'Classic defenders chop from deep court, imparting heavy backspin on every return to force the attacker to lift or hit into the net.'
                ],
            ],

            // ==================== 10. FIELD HOCKEY ====================
            'hockey' => [
                [
                    'question_text' => 'In Field Hockey under FIH rules, which side of the hockey stick is legally permitted to touch the ball?',
                    'option_a' => 'Both the flat side and rounded back side equally.',
                    'option_b' => 'Only the flat front side (and the edges of the flat side). Playing the ball with the rounded back is a foul.',
                    'option_c' => 'Only the wooden shaft, never the curved toe.',
                    'option_d' => 'Only left-handed players can use the rounded side.',
                    'correct_option' => 'B',
                    'explanation' => 'Under FIH Rule 9.6, players must not play the ball with the back (rounded side) of the stick.'
                ],
                [
                    'question_text' => 'What is a "Penalty Corner" in field hockey, and how is it executed?',
                    'option_a' => 'A one-on-one shootout with the goalkeeper from 25 yards.',
                    'option_b' => 'An attacking player pushes the ball from the backline to teammates outside the striking circle, defended by up to 5 defenders behind the goal line.',
                    'option_c' => 'A free kick from the center of the pitch.',
                    'option_d' => 'A penalty awarded when the coach steps on the pitch.',
                    'correct_option' => 'B',
                    'explanation' => 'Penalty corners award an injection from the backline to the circle perimeter, where a stopper and drag-flicker or striker attack against a 5-player defense.'
                ],
                [
                    'question_text' => 'What is a "Drag Flick" in penalty corner execution?',
                    'option_a' => 'Dragging the stick along the ground to waste time.',
                    'option_b' => 'A dynamic slingshot flick where the ball is scooped along the stick shaft in a continuous acceleration motion, generating speeds over 120 km/h without striking.',
                    'option_c' => 'An illegal shot that results in a red card.',
                    'option_d' => 'Hitting the ball with two sticks simultaneously.',
                    'correct_option' => 'B',
                    'explanation' => 'Drag flicking uses a fluid pulling and slingshot release that legalizes lifting the ball above backboard height on the first penalty corner shot.'
                ],
                [
                    'question_text' => 'Under FIH regulations, how long is a player suspended when shown a "Green Card"?',
                    'option_a' => 'Permanent ejection from the match.',
                    'option_b' => 'A temporary 2-minute suspension during which the team plays with one fewer player.',
                    'option_c' => 'A 10-minute suspension.',
                    'option_d' => 'No time suspension; it is only a verbal warning.',
                    'correct_option' => 'B',
                    'explanation' => 'In modern international hockey, a Green Card carries a mandatory 2-minute sin-bin suspension; a Yellow Card carries a 5 or 10-minute suspension.'
                ],
                [
                    'question_text' => 'What is the "Striking Circle" (D-Circle) rule for scoring a field goal in hockey?',
                    'option_a' => 'Goals can be scored from anywhere on the field, including the defense half.',
                    'option_b' => 'A goal is scored only if the ball is touched by the stick of an attacking or defending player inside the striking circle before entering the goal.',
                    'option_c' => 'The goalkeeper must touch the ball for it to count.',
                    'option_d' => 'Shooting inside the D is strictly prohibited.',
                    'correct_option' => 'B',
                    'explanation' => 'Under FIH rules, a goal cannot be scored directly from outside the shooting circle; it must touch an attacker or defender’s stick inside the circle.'
                ],
                [
                    'question_text' => 'What is an "Aerial Ball" (Scoop) rule in field hockey regarding player safety?',
                    'option_a' => 'Aerial balls are completely illegal and banned at all times.',
                    'option_b' => 'A lifted ball is legal, but players cannot close within 5 meters of a player receiving a falling aerial ball until the ball is controlled on the ground.',
                    'option_c' => 'Players can catch the ball with their bare hands in mid-air.',
                    'option_d' => 'The ball must reach at least 50 meters in height.',
                    'correct_option' => 'B',
                    'explanation' => 'Receivers of clean aerial balls have right-of-way; opponents cannot advance within 5m until the ball is received and safely controlled.'
                ],
                [
                    'question_text' => 'In Field Hockey penalty shootouts (after a tied knockout match), what format is used?',
                    'option_a' => 'Stationary penalty strokes from 7 yards.',
                    'option_b' => 'An 8-second 1-on-1 shootout starting from the 23-meter line where the attacker has 8 seconds to beat the goalkeeper and score.',
                    'option_c' => 'A coin toss.',
                    'option_d' => 'Playing 90 more minutes of golden goal.',
                    'correct_option' => 'B',
                    'explanation' => 'FIH shootouts give the attacker 8 seconds from the 23m line to dribble, shoot, or eliminate the goalkeeper in an exciting dynamic duel.'
                ],
                [
                    'question_text' => 'Why are modern international field hockey artificial turf pitches (water-based astroturf) heavily watered before and during matches?',
                    'option_a' => 'To make the grass grow faster.',
                    'option_b' => 'To lubricate the surface, eliminate ball friction/bouncing, enable true roll at high speeds, and reduce skin burns during sliding tackles.',
                    'option_c' => 'To make players slip and slide for comedy.',
                    'option_d' => 'To cool down the stadium air conditioning.',
                    'correct_option' => 'B',
                    'explanation' => 'Watered synthetic turf creates a uniform, friction-free surface for blisteringly fast ball roll, precision trapping, and safe sliding.'
                ],
                [
                    'question_text' => 'What is the "Self-Pass" rule in modern hockey on free hits?',
                    'option_a' => 'Players are not allowed to touch the ball twice.',
                    'option_b' => 'A player taking a free hit may immediately dribble the ball themselves without having to pass to a teammate first.',
                    'option_c' => 'Players must pass the ball to the goalkeeper on every free hit.',
                    'option_d' => 'The referee must pass the ball to the taker.',
                    'correct_option' => 'B',
                    'explanation' => 'Introduced in 2009, the self-pass rule drastically accelerated hockey by allowing free-hit takers to immediately commence dribbling.'
                ],
                [
                    'question_text' => 'In standard FIH matches, what is the official match duration structure?',
                    'option_a' => 'Two 45-minute halves.',
                    'option_b' => 'Four 15-minute quarters (60 minutes total regulation time) with clock stoppage for penalty corners and goals.',
                    'option_c' => 'Three 20-minute periods.',
                    'option_d' => 'Four 10-minute quarters.',
                    'correct_option' => 'B',
                    'explanation' => 'International hockey features four 15-minute quarters (60 min total) with 40-second clock stoppages during penalty corners and goal celebrations.'
                ],
            ],

            // ==================== 11. BOXING & COMBAT SPORTS ====================
            'boxing' => [
                [
                    'question_text' => 'In professional boxing under the "10-Point Must System", how is a standard competitive round scored?',
                    'option_a' => 'The winner of the round receives 10 points; the opponent receives 9 (or 8 if knocked down), unless a foul deduction occurs.',
                    'option_b' => 'Both boxers receive 5 points each.',
                    'option_c' => 'Points are awarded based on how loudly the crowd cheers.',
                    'option_d' => 'The fighter with longer arms automatically gets 10 points.',
                    'correct_option' => 'A',
                    'explanation' => 'Judges must award 10 points to the round winner. The loser gets 9 points, or 8 points if knocked down once (7 for two knockdowns).'
                ],
                [
                    'question_text' => 'In boxing biomechanics, where does the majority of punch power originate during a straight cross or hook?',
                    'option_a' => 'Strictly from biceps and triceps muscle contraction.',
                    'option_b' => 'From ground reaction forces driving through foot pivot, hip rotation, core torque, and shoulder whip (the kinetic chain).',
                    'option_c' => 'From holding breath tightly.',
                    'option_d' => 'From wearing heavier leather gloves.',
                    'correct_option' => 'B',
                    'explanation' => 'High-velocity striking derives power from ground force transfer through ankle pivot, explosive pelvic rotation, and trunk twisting.'
                ],
                [
                    'question_text' => 'What is the defensive maneuver known as the "Philly Shell" (Shoulder Roll) used by elite defensive boxers like Floyd Mayweather?',
                    'option_a' => 'Curling up into a tight ball on the canvas.',
                    'option_b' => 'Tucking the chin behind a raised lead shoulder, using the lead arm across the midsection and rear hand to parry/deflect punches.',
                    'option_c' => 'Running backwards around the ring continuously.',
                    'option_d' => 'Throwing both hands above the head like an umbrella.',
                    'correct_option' => 'B',
                    'explanation' => 'The shoulder roll deflects orthodox right hands harmlessly off the lead shoulder while loading an explosive counter right hand.'
                ],
                [
                    'question_text' => 'What is a "Southpaw" boxer in boxing terminology?',
                    'option_a' => 'A boxer who was born in the southern hemisphere.',
                    'option_b' => 'A left-hand dominant boxer who stands with their right foot and right hand forward, leading with their right jab.',
                    'option_c' => 'A boxer who only throws hooks with their feet.',
                    'option_d' => 'A boxer who has won a championship title.',
                    'correct_option' => 'B',
                    'explanation' => 'Southpaws lead with right hand and foot forward, posing awkward mirror-image angle challenges against conventional orthodox boxers.'
                ],
                [
                    'question_text' => 'In acute weight cutting for combat sports, why is rapid dehydration via sauna/sweatsuits within 24 hours of weigh-in dangerous for the brain?',
                    'option_a' => 'It causes the boxer to lose their memory permanently.',
                    'option_b' => 'Dehydration depletes cerebrospinal fluid (CSF) cushions around the brain, significantly increasing intracranial concussion and hematoma risk upon head impact.',
                    'option_c' => 'It makes the boxer’s teeth loose.',
                    'option_d' => 'It turns blood into clear water.',
                    'correct_option' => 'B',
                    'explanation' => 'Dehydration reduces fluid buffering surrounding the brain; blows can cause greater brain displacement against the skull wall, escalating knockout risk.'
                ],
                [
                    'question_text' => 'What is the tactical difference between a "Slip" and a "Roll" (Bob and Weave)?',
                    'option_a' => 'A slip moves the head slightly off-center to let straight punches pass; a roll bends at the knees and hips to weave under hooks.',
                    'option_b' => 'A slip is falling down; a roll is somersaulting.',
                    'option_c' => 'They are identical movements with no difference.',
                    'option_d' => 'Slips are only allowed in amateur boxing.',
                    'correct_option' => 'A',
                    'explanation' => 'Slipping rotates the shoulders to evade straight jabs and crosses; bobbing and weaving dips under circular hooks to counter to the body.'
                ],
                [
                    'question_text' => 'What constitutes a "Technical Knockout" (TKO) in boxing?',
                    'option_a' => 'When both boxers are counted out at 10 simultaneously.',
                    'option_b' => 'When the referee, ringside doctor, or cornerman halts the bout because a fighter is unable to safely defend themselves or continue.',
                    'option_c' => 'When a fighter wins on judges’ scorecards after 12 rounds.',
                    'option_d' => 'When a fighter accidentally loses a shoe.',
                    'correct_option' => 'B',
                    'explanation' => 'A TKO occurs when a bout is terminated due to severe damage, cuts, or defenselessness without waiting for a full 10-count.'
                ],
                [
                    'question_text' => 'Why is "Hand Wrapping" with gauze and athletic tape mandatory before boxing gloves are laced?',
                    'option_a' => 'To make the boxer’s punches heavier like bricks.',
                    'option_b' => 'To cast and align the 27 small bones of the hand, stabilizing metacarpals and wrist ligaments to prevent bone fractures on impact.',
                    'option_c' => 'To hide illegal coins inside the hand.',
                    'option_d' => 'It is purely a fashion accessory.',
                    'correct_option' => 'B',
                    'explanation' => 'Wraps bind the fragile metacarpals and wrist joint into a rigid structural unit, preventing the dreaded "boxer’s fracture" upon heavy impact.'
                ],
                [
                    'question_text' => 'What is a "Check Hook" counter-punch in boxing?',
                    'option_a' => 'A punch thrown to check if the opponent is awake.',
                    'option_b' => 'A short lead hook thrown while simultaneously pivoting on the lead foot and pivoting 90° away, catching an aggressively charging opponent off balance.',
                    'option_c' => 'A hook thrown directly at the referee.',
                    'option_d' => 'A punch that checks the opponent’s glove tape.',
                    'correct_option' => 'B',
                    'explanation' => 'The check hook uses the opponent’s forward momentum against them while the counter-puncher pivots out of harm’s way.'
                ],
                [
                    'question_text' => 'What is the "Clinch" tactic used for in boxing?',
                    'option_a' => 'Hugging the opponent to apologize for hitting them.',
                    'option_b' => 'Tying up the opponent’s arms and weight inside close range to smother their punches, break their momentum, or recover after being stunned.',
                    'option_c' => 'Attempting a judo throw to win points.',
                    'option_d' => 'Calling for a commercial break.',
                    'correct_option' => 'B',
                    'explanation' => 'Clinching smothers incoming strikes, neutralizes dangerous inside combinations, and grants precious recovery seconds under referee break.'
                ],
            ],

            // ==================== 12. SWIMMING & AQUATICS ====================
            'swimming' => [
                [
                    'question_text' => 'Under World Aquatics (FINA) rules, what is the maximum legal distance a swimmer may travel submerged underwater off the start or turn?',
                    'option_a' => '10 meters',
                    'option_b' => '15 meters (the head must break the surface at or before the 15m mark)',
                    'option_c' => '25 meters (half the pool)',
                    'option_d' => 'Unlimited distance in freestyle',
                    'correct_option' => 'B',
                    'explanation' => 'In freestyle, backstroke, and butterfly, swimmers cannot travel submerged past 15m; crossing the 15m line underwater causes instant disqualification.'
                ],
                [
                    'question_text' => 'What is the "Streamline" body position in competitive swimming, and why is it essential?',
                    'option_a' => 'Swimming with arms wide open like an eagle.',
                    'option_b' => 'Locking hands one over the other, squeezing biceps tightly against ears, and maintaining a rigid, straight line to minimize hydrodynamic frontal drag.',
                    'option_c' => 'Swimming with head tilted backward looking at the ceiling.',
                    'option_d' => 'Treading water vertically in place.',
                    'correct_option' => 'B',
                    'explanation' => 'Water is ~800 times denser than air; the streamline posture minimizes cross-sectional drag, maximizing pushoff speed from the wall.'
                ],
                [
                    'question_text' => 'Why is the "Underwater Dolphin Kick" often called the "5th Competitive Stroke" by elite swim coaches?',
                    'option_a' => 'Because it is an official 50m Olympic medal event.',
                    'option_b' => 'Because undulating powerful kicks generated from core/hips off walls underwater produce speeds significantly higher than surface swimming.',
                    'option_c' => 'Because real dolphins are trained to push swimmers.',
                    'option_d' => 'Because it requires zero oxygen consumption.',
                    'correct_option' => 'B',
                    'explanation' => 'Elite swimmers generate peak velocity through undulating core waves beneath surface turbulence, where wave resistance is dramatically lower.'
                ],
                [
                    'question_text' => 'In Freestyle (Front Crawl), what is the "High-Elbow Catch" (Early Vertical Forearm - EVF)?',
                    'option_a' => 'Lifting the elbow out of the water to wave at coaches.',
                    'option_b' => 'Flexing the wrist and elbow early in the underwater stroke to turn the forearm into an oar blade that pushes water directly backward.',
                    'option_c' => 'Swimming with straight arms like a windmill.',
                    'option_d' => 'Hitting the lane rope with the elbow.',
                    'correct_option' => 'B',
                    'explanation' => 'EVF or high-elbow catch rotates the entire forearm and palm into a vertical paddle plane perpendicular to forward motion, maximizing propulsion.'
                ],
                [
                    'question_text' => 'In Breaststroke rules under World Aquatics, what kick movement is strictly illegal and will cause immediate disqualification?',
                    'option_a' => 'Whip kick with outward foot rotation',
                    'option_b' => 'Dolphin/flutter kick movement during the stroke cycle (except one single downward butterfly kick during the pullout off the start/turn)',
                    'option_c' => 'Gliding with arms extended',
                    'option_d' => 'Touching the wall with both hands simultaneously',
                    'correct_option' => 'B',
                    'explanation' => 'Breaststroke requires simultaneous circular whip kicks with feet turned out; continuous butterfly dolphin kicks are strictly illegal.'
                ],
                [
                    'question_text' => 'What is the "Two-Hand Touch" rule in competitive swimming for Butterfly and Breaststroke turns and finishes?',
                    'option_a' => 'Both hands must touch the wall simultaneously and separately, either above or below the water surface.',
                    'option_b' => 'The swimmer must touch the wall with one hand followed by the other 2 seconds later.',
                    'option_c' => 'The swimmer can touch with their feet instead of hands.',
                    'option_d' => 'Touching with one hand is sufficient in all strokes.',
                    'correct_option' => 'A',
                    'explanation' => 'In both breaststroke and butterfly, touch at turns and finish must be made with both hands simultaneously and separated.'
                ],
                [
                    'question_text' => 'In competitive swimming physiology, what does the "Distance Per Stroke" (DPS) metric signify?',
                    'option_a' => 'How many laps a swimmer completes in an hour.',
                    'option_b' => 'The horizontal distance the swimmer travels through the water with each completed arm cycle, indicating technical efficiency.',
                    'option_c' => 'The total length of the swimming pool.',
                    'option_d' => 'The distance from the starting block to the deep end.',
                    'correct_option' => 'B',
                    'explanation' => 'DPS reflects propulsion efficiency; elite swimmers travel further per stroke without increasing metabolic energy expenditure.'
                ],
                [
                    'question_text' => 'What is the "Drafting" effect in open water swimming (10 km marathon swim)?',
                    'option_a' => 'Drawing a sketch of the lake before swimming.',
                    'option_b' => 'Swimming closely behind or adjacent to the hip of a leading swimmer to save up to 20–30% energetic cost due to the leader’s wake slipstream.',
                    'option_c' => 'Drinking cold water during the race.',
                    'option_d' => 'Wearing two pairs of goggles simultaneously.',
                    'correct_option' => 'B',
                    'explanation' => 'Swimming in the slipstream or hip pocket of another swimmer cuts drag substantially, preserving vital glycogen for the final sprint.'
                ],
                [
                    'question_text' => 'Why must a backstroke swimmer count their arm strokes from the overhead Backstroke Flags to the wall?',
                    'option_a' => 'To make sure they don’t get bored.',
                    'option_b' => 'Because flags are placed exactly 5 meters from the wall, allowing the swimmer to execute a blind flip-turn without crashing headfirst into the concrete.',
                    'option_c' => 'To notify the referee when to ring the bell.',
                    'option_d' => 'It is a mandatory rule that strokes must be recited out loud.',
                    'correct_option' => 'B',
                    'explanation' => 'Backstroke flags hang 5m from the wall; knowing their exact stroke count (e.g., 3 or 4 strokes) lets swimmers roll into a blind flip turn safely.'
                ],
                [
                    'question_text' => 'In Individual Medley (IM) events (e.g. 200m or 400m IM), what is the mandatory order of the four strokes?',
                    'option_a' => 'Freestyle, Backstroke, Breaststroke, Butterfly',
                    'option_b' => 'Butterfly, Backstroke, Breaststroke, Freestyle',
                    'option_c' => 'Breaststroke, Butterfly, Backstroke, Freestyle',
                    'option_d' => 'Backstroke, Butterfly, Freestyle, Breaststroke',
                    'correct_option' => 'B',
                    'explanation' => 'Individual Medley always proceeds: Fly -> Back -> Breast -> Free (note that in Medley Relays, the order starts with Backstroke).'
                ],
            ],

            // ==================== 13. CHESS (MIND SPORTS) ====================
            'chess' => [
                [
                    'question_text' => 'In chess strategy, what is an "Isolated Queen’s Pawn" (IQP) and what is its dynamic balance of advantages and disadvantages?',
                    'option_a' => 'It is an illegal pawn placement that forfeits the game.',
                    'option_b' => 'It has no friendly pawns on adjacent files; it offers open lines and outpost squares for dynamic attack, but becomes a chronic static weakness in endgames.',
                    'option_c' => 'It can move like a queen for 5 moves.',
                    'option_d' => 'It must be captured immediately on move 1.',
                    'correct_option' => 'B',
                    'explanation' => 'The IQP provides central control, open c- and e-files, and tactical dynamism in middle-games, but lacks pawn support and is vulnerable in endgames.'
                ],
                [
                    'question_text' => 'What is the special rule of "En Passant" pawn capture in chess?',
                    'option_a' => 'A pawn capturing a knight that jumped over it.',
                    'option_b' => 'When a pawn advances two squares from its starting rank and lands adjacent to an enemy pawn, that enemy pawn may capture it as if it had advanced only one square, immediately on the very next turn.',
                    'option_c' => 'A pawn promoting directly to a king.',
                    'option_d' => 'Capturing a pawn with the king across the board.',
                    'correct_option' => 'B',
                    'explanation' => 'En passant (in passing) prevents pawns from using the initial 2-square leap to bypass an opposing pawn’s capturing square without risk.'
                ],
                [
                    'question_text' => 'In chess endgame theory, what is "Zugzwang"?',
                    'option_a' => 'A German opening move involving moving the b-pawn.',
                    'option_b' => 'A position where any legal move a player can make will decisively worsen their position or lose the game; they would prefer to pass if permitted.',
                    'option_c' => 'A draw achieved by stalemate.',
                    'option_d' => 'Checkmating with two rooks simultaneously.',
                    'correct_option' => 'B',
                    'explanation' => 'Zugzwang (compulsion to move) occurs when having the move is a fatal disadvantage because every available legal move weakens the defense.'
                ],
                [
                    'question_text' => 'What defines a "Knight Outpost" in middle-game strategy?',
                    'option_a' => 'A knight standing on the starting b1 or g1 square.',
                    'option_b' => 'A square (typically on the 5th or 6th rank) protected by a friendly pawn that cannot be attacked or driven away by any enemy pawn.',
                    'option_c' => 'A knight that has been captured by a rook.',
                    'option_d' => 'A knight placed on the rim of the board (a1/h1).',
                    'correct_option' => 'B',
                    'explanation' => 'An outpost knight deep in enemy territory cannot be evicted by pawns and exerts suffocating control over critical surrounding squares.'
                ],
                [
                    'question_text' => 'In King and Pawn endgames, what does gaining the "Opposition" mean?',
                    'option_a' => 'Shouting at the opposing player.',
                    'option_b' => 'Positioning your king directly opposite the enemy king with an odd number of squares (usually 1) between them, forcing the opponent’s king to give way.',
                    'option_c' => 'Trading queens on move 10.',
                    'option_d' => 'Resigning before checkmate.',
                    'correct_option' => 'B',
                    'explanation' => 'Direct opposition puts the enemy king in zugzwang, forcing them to step aside and allowing your king to outflank and escort a passed pawn to promotion.'
                ],
                [
                    'question_text' => 'What is the "Lucena Position" in Rook and Pawn endgames?',
                    'option_a' => 'A completely lost position for the attacking side.',
                    'option_b' => 'The fundamental winning blueprint where the attacking rook builds a "bridge" to shield its king from checks and promote the pawn.',
                    'option_c' => 'A stalemate trap with king in the corner.',
                    'option_d' => 'An opening gambit named after Lucena.',
                    'correct_option' => 'B',
                    'explanation' => 'Building a bridge (e.g. Rook on 4th rank) shields the king from rear checks, allowing the pawn to advance safely to queen.'
                ],
                [
                    'question_text' => 'What is the strategic purpose of a "Pawn Storm" on the opposite side of the board in opposite-side castling games?',
                    'option_a' => 'Advancing pawns rapidly toward the enemy castled king to rip open files (lines) for rooks and queen to attack directly.',
                    'option_b' => 'To sacrifice all pawns so the board is clean.',
                    'option_c' => 'To prevent the opponent from using their knight.',
                    'option_d' => 'It is a defensive tactic to protect the center.',
                    'correct_option' => 'A',
                    'explanation' => 'When kings are castled on opposite wings, speed is paramount; players storm pawns to shatter pawn shields before the opponent does the same.'
                ],
                [
                    'question_text' => 'What is the "Fifty-Move Rule" in FIDE chess regulations?',
                    'option_a' => 'A match must end in 50 moves maximum.',
                    'option_b' => 'A player may claim a draw if no capture has been made and no pawn has been moved in the last 50 consecutive moves by each player.',
                    'option_c' => 'Players must play 50 blitz games per tournament.',
                    'option_d' => 'A pawn can only move 50 times in a lifetime.',
                    'correct_option' => 'B',
                    'explanation' => 'Under FIDE laws, 50 consecutive turns without a pawn move or capture entitles either player to claim a legal draw.'
                ],
                [
                    'question_text' => 'In tactical calculation, what is an "Intermezzo" (Zwischenzug / In-Between Move)?',
                    'option_a' => 'Taking a coffee break between moves.',
                    'option_b' => 'An unexpected intermediate move (such as a check or threat to a queen) inserted before playing an expected recapture, totally upending the opponent’s calculation.',
                    'option_c' => 'Playing with both black and white pieces simultaneously.',
                    'option_d' => 'Resigning in less than 5 moves.',
                    'correct_option' => 'B',
                    'explanation' => 'A Zwischenzug ruins calculations because the opponent assumed a direct sequence of captures, but is hit with an unpredicted intermediate threat.'
                ],
                [
                    'question_text' => 'What is the tactical motif known as an "Absolute Pin" in chess?',
                    'option_a' => 'A pin where a pinned piece cannot legally move at all because doing so would expose its king to check.',
                    'option_b' => 'A pin on the opponent’s queen.',
                    'option_c' => 'Pinning a knight to a bishop.',
                    'option_d' => 'A pin created by a pawn.',
                    'correct_option' => 'A',
                    'explanation' => 'An absolute pin involves the king behind the pinned piece; moving the pinned piece is illegal under the rules of chess.'
                ],
            ],

            // ==================== 14. SHOOTING & ARCHERY ====================
            'shooting' => [
                [
                    'question_text' => 'In precision 10m Air Rifle shooting, what is the crucial distinction between "Sight Alignment" and "Sight Picture"?',
                    'option_a' => 'Sight alignment is the relationship between eye, rear sight aperture, and front sight tunnel; sight picture is alignment placed onto the target bullseye.',
                    'option_b' => 'Sight picture is looking through binoculars; sight alignment is closing both eyes.',
                    'option_c' => 'They mean the exact same thing.',
                    'option_d' => 'Sight alignment is only used in archery, not rifle.',
                    'correct_option' => 'A',
                    'explanation' => 'Sight alignment is the concentric relationship of front and rear sights; sight picture is superimposing that aligned unit onto the target.'
                ],
                [
                    'question_text' => 'Why is "Follow-Through" vital during the trigger release in target shooting and archery?',
                    'option_a' => 'To pose nicely for spectator cameras.',
                    'option_b' => 'To maintain posture, sight alignment, and trigger pressure for split-seconds after release, preventing barrel flinching before the projectile exits.',
                    'option_c' => 'To reload the rifle faster.',
                    'option_d' => 'To celebrate before the score is registered.',
                    'correct_option' => 'B',
                    'explanation' => 'Flinching or dropping the head as the trigger breaks deflects the barrel before the pellet/arrow has exited the muzzle/bow.'
                ],
                [
                    'question_text' => 'In Olympic Recurve Archery, what is the purpose of the "Clicker"?',
                    'option_a' => 'To count the number of arrows shot.',
                    'option_b' => 'A thin spring blade that drops off the arrow point with an audible click when full consistent draw length is achieved, serving as the mental release cue.',
                    'option_c' => 'To magnify the target like a telescope.',
                    'option_d' => 'To prevent arrows from falling out of the quiver.',
                    'correct_option' => 'B',
                    'explanation' => 'The clicker guarantees millimetric draw length consistency, eliminating velocity variations and cueing an unconscious subconscious release.'
                ],
                [
                    'question_text' => 'In shooting sport respiratory biomechanics, when should the shot be released within the breathing cycle?',
                    'option_a' => 'At the peak of a deep, hyperventilated inhale.',
                    'option_b' => 'During the natural respiratory pause after exhaling approximately 50–70% of lung volume, where diaphragm tension and heart motion are lowest.',
                    'option_c' => 'While coughing or talking.',
                    'option_d' => 'Holding breath for 3 minutes before taking aim.',
                    'correct_option' => 'B',
                    'explanation' => 'The natural post-exhalation pause provides maximum diaphragm relaxation and core stability without causing oxygen-deprivation muscle tremors.'
                ],
                [
                    'question_text' => 'What is the "Archer’s Paradox"?',
                    'option_a' => 'An archer who never shoots an arrow.',
                    'option_b' => 'The phenomenon where an arrow must flex and oscillate around the bow handle upon release before straightening out toward the target.',
                    'option_c' => 'Shooting an arrow backwards into the wind.',
                    'option_d' => 'Arrows flying faster than the speed of light.',
                    'correct_option' => 'B',
                    'explanation' => 'When released from a traditional or recurve bow, the string forces the arrow shaft to bend dynamically around the riser before stabilizing in flight.'
                ],
                [
                    'question_text' => 'What is the "Decimals Scoring" rule in Olympic 10m Air Rifle finals (ISSF)?',
                    'option_a' => 'Scores are rounded down to zero.',
                    'option_b' => 'Target rings are subdivided into 10 concentric sub-rings, making the maximum possible single shot score a 10.9 (dead center).',
                    'option_c' => 'Shooters get 10 points for participating.',
                    'option_d' => 'Shooters can multiply their score by 10.',
                    'correct_option' => 'B',
                    'explanation' => 'ISSF electronic scoring measures hits in tenth-of-a-ring increments, ranking a dead-center hit as 10.9 down to a rim-grazing 10.0.'
                ],
                [
                    'question_text' => 'In Archery, what is the "Anchor Point"?',
                    'option_a' => 'Anchoring the bow to a tripod on the ground.',
                    'option_b' => 'A consistent physical contact point on the archer’s face (e.g. jawline, corner of mouth, or under chin) where the drawing hand rests at full draw.',
                    'option_c' => 'Dropping an anchor in a lake.',
                    'option_d' => 'The point where the target is nailed to the straw boss.',
                    'correct_option' => 'B',
                    'explanation' => 'A repeatable anchor point (e.g., shelf of hand firmly against jawbone) is essential for consistent eye-to-nock rear sight alignment.'
                ],
                [
                    'question_text' => 'What is "Windage" adjustment on a rifle sight or archery scope?',
                    'option_a' => 'Measuring how hot the air temperature is.',
                    'option_b' => 'Adjusting the sight horizontally (left or right) to compensate for crosswinds or horizontal barrel deviation.',
                    'option_c' => 'Adjusting the height of the shooting stand.',
                    'option_d' => 'Opening the window to let fresh air in.',
                    'correct_option' => 'B',
                    'explanation' => 'Elevation adjusts vertical trajectory (up/down); Windage adjusts horizontal deflection (left/right).'
                ],
                [
                    'question_text' => 'In Olympic Trap & Skeet Clay Shooting, what is "Lead" (Forward Allowance)?',
                    'option_a' => 'The metallic chemical element used in bullets.',
                    'option_b' => 'Aiming ahead of a moving flying clay target so the shot pellet pattern and target arrive at the same spatial point simultaneously.',
                    'option_c' => 'Leading the team as captain.',
                    'option_d' => 'Walking ahead of the referees.',
                    'correct_option' => 'B',
                    'explanation' => 'Clay targets fly at 80–100 km/h; shooting directly at the target misses behind. Shooters must aim ahead (lead the target).'
                ],
                [
                    'question_text' => 'Why do 10m Air Rifle and 50m 3-Position shooters wear heavy, stiff canvas/leather shooting jackets and trousers?',
                    'option_a' => 'To protect them from cold winter weather.',
                    'option_b' => 'To stabilize spinal posture, dampen cardiovascular pulse transmission to the barrel, and lock skeletal joints in steady support.',
                    'option_c' => 'They are strictly ceremonial uniforms.',
                    'option_d' => 'To store spare ammunition in the pockets.',
                    'correct_option' => 'B',
                    'explanation' => 'Stiff shooting apparel provides skeletal stabilization and absorbs arterial pulse vibrations that would otherwise wobble the micro-target sight.'
                ],
            ],

            // ==================== 15. WRESTLING (KUSHTI) ====================
            'wrestling' => [
                [
                    'question_text' => 'In Olympic Freestyle Wrestling under UWW rules, what action results in an immediate victory by "Fall" (Pin)?',
                    'option_a' => 'Throwing the opponent out of the mat circle.',
                    'option_b' => 'Holding both of the opponent’s shoulders (scapulae) pinned flat against the mat simultaneously for a discernible time (1 second).',
                    'option_c' => 'Scoring 5 points in a single period.',
                    'option_d' => 'When both wrestlers fall asleep on the mat.',
                    'correct_option' => 'B',
                    'explanation' => 'A Fall (pin) terminates the bout immediately regardless of point score when both shoulders of a wrestler are held flat on the mat.'
                ],
                [
                    'question_text' => 'What is the fundamental difference between Freestyle Wrestling and Greco-Roman Wrestling?',
                    'option_a' => 'Freestyle is held on grass; Greco-Roman is held on sand.',
                    'option_b' => 'In Greco-Roman, wrestlers are strictly forbidden from attacking the opponent’s legs or using their own legs to trip or execute holds; Freestyle allows full leg attacks.',
                    'option_c' => 'Greco-Roman does not allow throws.',
                    'option_d' => 'Freestyle is only played by heavyweights.',
                    'correct_option' => 'B',
                    'explanation' => 'Greco-Roman prohibits touching or attacking anything below the waist; Freestyle allows single-leg, double-leg, and ankle pick attacks.'
                ],
                [
                    'question_text' => 'What point margin triggers a victory by "Technical Superiority" in Freestyle Wrestling?',
                    'option_a' => 'A lead of 5 points',
                    'option_b' => 'A lead of 10 points (in Freestyle; 8 points in Greco-Roman)',
                    'option_c' => 'A lead of 25 points',
                    'option_d' => 'Winning by 1 point at any time in the match',
                    'correct_option' => 'B',
                    'explanation' => 'Under UWW rules, building a 10-point margin in Freestyle (or 8-point margin in Greco-Roman) automatically terminates the match by Technical Superiority.'
                ],
                [
                    'question_text' => 'In takedown mechanics, what is a "Double-Leg Takedown" primarily reliant upon for penetration?',
                    'option_a' => 'Jumping onto the opponent’s shoulders.',
                    'option_b' => 'Level change (deep knee bend), driving the lead knee between opponent’s legs, wrapping both hands behind knees, and driving hips through with head up.',
                    'option_c' => 'Pulling the opponent’s wrestling singlet.',
                    'option_d' => 'Falling flat on your back.',
                    'correct_option' => 'B',
                    'explanation' => 'Effective double-leg attacks require deep explosive level change, hip penetration, head in chest/ribs, and cutting angles to sweep the legs.'
                ],
                [
                    'question_text' => 'What is a "Sprawl" in wrestling defense?',
                    'option_a' => 'Lying on the mat during a medical timeout.',
                    'option_b' => 'Kicking both legs backward and driving the hips hard downward onto the opponent’s neck and shoulders to defend against a leg takedown.',
                    'option_c' => 'A referee warning for passive wrestling.',
                    'option_d' => 'A throw that awards 4 points.',
                    'correct_option' => 'B',
                    'explanation' => 'Sprawling uses hip weight to flatten the shooting wrestler into the mat, keeping legs out of reach and creating front headlock counters.'
                ],
                [
                    'question_text' => 'What is the "Gut Wrench" turn executed in the Par Terre (ground) position?',
                    'option_a' => 'An illegal strike to the stomach.',
                    'option_b' => 'Locking hands around the opponent’s midsection/ribs from above, bridging and rolling them across their shoulders for 2-point exposure turns.',
                    'option_c' => 'Tickling the opponent until they give up.',
                    'option_d' => 'A submission choke hold.',
                    'correct_option' => 'B',
                    'explanation' => 'The gut wrench locks around the diaphragm/floating ribs; explosive hip drive rolls the defending wrestler over their shoulders for exposure points.'
                ],
                [
                    'question_text' => 'What happens when a wrestler is penalized for "Passivity" under UWW Freestyle rules?',
                    'option_a' => 'They are immediately disqualified.',
                    'option_b' => 'A 30-second "Shot Clock" is activated; if neither wrestler scores in 30 seconds, the non-passive wrestler is awarded 1 point.',
                    'option_c' => 'The passive wrestler must do 20 pushups.',
                    'option_d' => 'The match ends in an automatic draw.',
                    'correct_option' => 'B',
                    'explanation' => 'The 30-second activity clock forces the passive wrestler to score; if they fail to score within 30 seconds, 1 technical point goes to the opponent.'
                ],
                [
                    'question_text' => 'In traditional Indian Dangal (Kushti in Akhada/mud pit), what is the "Dhak" technique?',
                    'option_a' => 'Splashing red clay into the opponent’s eyes.',
                    'option_b' => 'A devastating hip-toss throw where the pehlwan traps the opponent’s arm, turns their hip underneath, and hurls them head-over-heels onto their back.',
                    'option_c' => 'A defensive block using feet.',
                    'option_d' => 'A ceremonial handshake.',
                    'correct_option' => 'B',
                    'explanation' => 'The Dhak is the iconic kushti hip throw utilizing underhook leverage and hip fulcrum to launch the opponent cleanly through the air.'
                ],
                [
                    'question_text' => 'How many points are awarded for a high-amplitude throw from a standing position that lands the opponent directly into danger (on their back)?',
                    'option_a' => '1 point',
                    'option_b' => '4 points (or 5 points in Greco-Roman grand amplitude)',
                    'option_c' => '10 points',
                    'option_d' => '2 points only',
                    'correct_option' => 'B',
                    'explanation' => 'Under UWW rules, a grand amplitude throw where the opponent is lifted and lands directly in danger awards 4 points in Freestyle (5 points in Greco-Roman).'
                ],
                [
                    'question_text' => 'What is the duration and period structure of an official Olympic wrestling match?',
                    'option_a' => 'One 10-minute continuous period.',
                    'option_b' => 'Two periods of 3 minutes each, with a 30-second rest break between periods.',
                    'option_c' => 'Three periods of 5 minutes each.',
                    'option_d' => 'Four 2-minute quarters.',
                    'correct_option' => 'B',
                    'explanation' => 'Senior international wrestling matches consist of two 3-minute periods separated by a 30-second break (6 minutes total regulation time).'
                ],
            ],
        ];
    }
}
