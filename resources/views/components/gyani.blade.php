@props(['state' => 'idle', 'size' => '200'])
{{-- Gyani: CareerGyan's animated SVG mascot character --}}
{{-- States: idle | happy | sad | thinking --}}

<div class="gyani-wrapper gyani-{{ $state }}" style="width: {{ $size }}px; height: {{ $size }}px; position: relative; display: inline-block;">
  <svg viewBox="0 0 200 220" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;overflow:visible;">

    {{-- ── SHADOW ── --}}
    <ellipse cx="100" cy="210" rx="40" ry="8" fill="rgba(0,0,0,0.12)" class="gyani-shadow"/>

    {{-- ── BODY ── --}}
    <ellipse cx="100" cy="155" rx="38" ry="44" fill="#3b82f6" class="gyani-body"/>
    {{-- Body highlight --}}
    <ellipse cx="90" cy="140" rx="14" ry="20" fill="rgba(255,255,255,0.15)" class="gyani-body-shine"/>

    {{-- ── ARMS ── --}}
    {{-- Left arm --}}
    <path d="M62 148 Q42 145 38 160 Q36 168 44 170" stroke="#3b82f6" stroke-width="10" stroke-linecap="round" fill="none" class="gyani-arm-left"/>
    {{-- Right arm --}}
    <path d="M138 148 Q158 145 162 160 Q164 168 156 170" stroke="#3b82f6" stroke-width="10" stroke-linecap="round" fill="none" class="gyani-arm-right"/>

    {{-- ── HANDS ── --}}
    <circle cx="42" cy="172" r="9" fill="#fbbf24" class="gyani-hand-left"/>
    <circle cx="158" cy="172" r="9" fill="#fbbf24" class="gyani-hand-right"/>

    {{-- ── LEGS ── --}}
    <rect x="80" y="193" width="14" height="16" rx="7" fill="#1e40af" class="gyani-leg-left"/>
    <rect x="108" y="193" width="14" height="16" rx="7" fill="#1e40af" class="gyani-leg-right"/>
    {{-- Shoes --}}
    <ellipse cx="87" cy="210" rx="10" ry="6" fill="#0f172a" class="gyani-shoe-left"/>
    <ellipse cx="115" cy="210" rx="10" ry="6" fill="#0f172a" class="gyani-shoe-right"/>

    {{-- ── NECK ── --}}
    <rect x="91" y="108" width="18" height="14" rx="6" fill="#fde68a"/>

    {{-- ── HEAD ── --}}
    <ellipse cx="100" cy="90" rx="42" ry="40" fill="#fde68a" class="gyani-head"/>
    {{-- Head shine --}}
    <ellipse cx="85" cy="72" rx="12" ry="8" fill="rgba(255,255,255,0.3)" transform="rotate(-15 85 72)"/>

    {{-- ── GRADUATION CAP ── --}}
    {{-- Cap base (fits on head) --}}
    <ellipse cx="100" cy="54" rx="46" ry="10" fill="#1e293b" class="gyani-cap-base"/>
    {{-- Cap top --}}
    <rect x="72" y="22" width="56" height="34" rx="4" fill="#1e293b" class="gyani-cap-top"/>
    {{-- Cap decoration stripe --}}
    <rect x="72" y="44" width="56" height="6" rx="2" fill="#fbbf24"/>
    {{-- Tassel string --}}
    <line x1="142" y1="26" x2="155" y2="50" stroke="#fbbf24" stroke-width="2.5" class="gyani-tassel-string"/>
    {{-- Tassel ball --}}
    <circle cx="155" cy="54" r="5" fill="#fbbf24" class="gyani-tassel-ball"/>
    {{-- Tassel fringe --}}
    <line x1="152" y1="58" x2="150" y2="68" stroke="#fbbf24" stroke-width="1.5"/>
    <line x1="155" y1="59" x2="155" y2="70" stroke="#fbbf24" stroke-width="1.5"/>
    <line x1="158" y1="58" x2="160" y2="68" stroke="#fbbf24" stroke-width="1.5"/>

    {{-- ── EYES ── --}}
    {{-- Eye whites --}}
    <ellipse cx="86" cy="88" rx="11" ry="12" fill="white" class="gyani-eye-white-left"/>
    <ellipse cx="114" cy="88" rx="11" ry="12" fill="white" class="gyani-eye-white-right"/>
    {{-- Pupils --}}
    <circle cx="88" cy="90" r="6" fill="#1e293b" class="gyani-pupil-left"/>
    <circle cx="116" cy="90" r="6" fill="#1e293b" class="gyani-pupil-right"/>
    {{-- Iris shine --}}
    <circle cx="90" cy="88" r="2" fill="white"/>
    <circle cx="118" cy="88" r="2" fill="white"/>
    {{-- Eyebrows --}}
    <path d="M76 77 Q86 73 96 76" stroke="#92400e" stroke-width="2.5" stroke-linecap="round" fill="none" class="gyani-brow-left"/>
    <path d="M104 76 Q114 73 124 77" stroke="#92400e" stroke-width="2.5" stroke-linecap="round" fill="none" class="gyani-brow-right"/>

    {{-- ── MOUTH (changes per state) ── --}}
    {{-- Happy mouth --}}
    @if($state === 'happy')
    <path d="M86 106 Q100 118 114 106" stroke="#92400e" stroke-width="3" stroke-linecap="round" fill="#ef4444" class="gyani-mouth"/>
    {{-- Rosy cheeks --}}
    <ellipse cx="76" cy="100" rx="8" ry="5" fill="rgba(239,68,68,0.25)"/>
    <ellipse cx="124" cy="100" rx="8" ry="5" fill="rgba(239,68,68,0.25)"/>

    {{-- ── STAR PARTICLES (happy only) ── --}}
    <g class="gyani-stars">
      <text x="14" y="50" font-size="18" class="gyani-star gyani-star-1">⭐</text>
      <text x="160" y="45" font-size="14" class="gyani-star gyani-star-2">✨</text>
      <text x="10" y="110" font-size="12" class="gyani-star gyani-star-3">🌟</text>
      <text x="165" y="105" font-size="16" class="gyani-star gyani-star-4">⭐</text>
      <text x="85" y="14" font-size="12" class="gyani-star gyani-star-5">✨</text>
    </g>

    @elseif($state === 'sad')
    {{-- Sad frown --}}
    <path d="M86 112 Q100 104 114 112" stroke="#92400e" stroke-width="3" stroke-linecap="round" fill="none" class="gyani-mouth"/>
    {{-- Sad tears --}}
    <ellipse cx="86" cy="100" rx="3" ry="5" fill="#93c5fd" class="gyani-tear-left" style="opacity:0.8"/>
    <ellipse cx="114" cy="100" rx="3" ry="5" fill="#93c5fd" class="gyani-tear-right" style="opacity:0.8"/>
    {{-- Sad eyebrows (angled inward) --}}

    @elseif($state === 'thinking')
    {{-- Neutral thinking mouth --}}
    <path d="M90 108 Q100 108 110 108" stroke="#92400e" stroke-width="3" stroke-linecap="round" fill="none" class="gyani-mouth"/>
    {{-- Thought bubble --}}
    <circle cx="148" cy="50" r="3" fill="#cbd5e1" opacity="0.8"/>
    <circle cx="158" cy="38" r="5" fill="#cbd5e1" opacity="0.8"/>
    <circle cx="168" cy="24" r="8" fill="#e2e8f0" opacity="0.9"/>
    <text x="162" y="29" font-size="9" fill="#475569">?</text>

    @else
    {{-- Idle: gentle smile --}}
    <path d="M88 108 Q100 114 112 108" stroke="#92400e" stroke-width="3" stroke-linecap="round" fill="none" class="gyani-mouth"/>
    @endif

  </svg>
</div>

<style>
/* ── Gyani Base Animations ── */
.gyani-wrapper { display: inline-block; }

/* Idle: gentle floating + breathing */
.gyani-idle .gyani-head,
.gyani-idle .gyani-cap-base,
.gyani-idle .gyani-cap-top { animation: gyaniFloat 3s ease-in-out infinite; }
.gyani-idle .gyani-body     { animation: gyaniBreathe 3s ease-in-out infinite; }
.gyani-idle .gyani-shadow   { animation: gyaniShadow 3s ease-in-out infinite; }

/* Happy: jump + arm wave */
.gyani-happy .gyani-head,
.gyani-happy .gyani-cap-base,
.gyani-happy .gyani-cap-top,
.gyani-happy .gyani-body,
.gyani-happy .gyani-arm-left,
.gyani-happy .gyani-arm-right,
.gyani-happy .gyani-leg-left,
.gyani-happy .gyani-leg-right,
.gyani-happy .gyani-shoe-left,
.gyani-happy .gyani-shoe-right,
.gyani-happy .gyani-hand-left,
.gyani-happy .gyani-hand-right,
.gyani-happy .gyani-neck { animation: gyaniJump 0.6s ease-in-out infinite alternate; }
.gyani-happy .gyani-arm-left  { animation: gyaniArmWaveL 0.5s ease-in-out infinite alternate; transform-origin: 62px 148px; }
.gyani-happy .gyani-arm-right { animation: gyaniArmWaveR 0.5s ease-in-out infinite alternate; transform-origin: 138px 148px; }
.gyani-happy .gyani-tassel-ball,
.gyani-happy .gyani-tassel-string { animation: gyaniTasselSwing 0.4s ease-in-out infinite alternate; transform-origin: 142px 26px; }
.gyani-happy .gyani-shadow    { animation: gyaniShadowJump 0.6s ease-in-out infinite alternate; }

/* Stars: floating up */
.gyani-star { animation-timing-function: ease-out; animation-fill-mode: forwards; }
.gyani-star-1 { animation: starFloat1 1.2s ease-out infinite; }
.gyani-star-2 { animation: starFloat2 1.5s ease-out infinite; animation-delay: 0.2s; }
.gyani-star-3 { animation: starFloat3 1.3s ease-out infinite; animation-delay: 0.4s; }
.gyani-star-4 { animation: starFloat1 1.4s ease-out infinite; animation-delay: 0.1s; }
.gyani-star-5 { animation: starFloat2 1.6s ease-out infinite; animation-delay: 0.3s; }

/* Sad: head droop + shake */
.gyani-sad .gyani-head,
.gyani-sad .gyani-cap-base,
.gyani-sad .gyani-cap-top { animation: gyaniDroop 2s ease-in-out infinite; transform-origin: 100px 90px; }
.gyani-sad .gyani-tear-left  { animation: gyaniFall 1.5s ease-in infinite; animation-delay: 0s; }
.gyani-sad .gyani-tear-right { animation: gyaniFall 1.5s ease-in infinite; animation-delay: 0.6s; }
.gyani-sad .gyani-body       { animation: gyaniSadSway 2.5s ease-in-out infinite; transform-origin: 100px 155px; }

/* Thinking: head tilt + scratch */
.gyani-thinking .gyani-head,
.gyani-thinking .gyani-cap-base,
.gyani-thinking .gyani-cap-top { animation: gyaniThink 2s ease-in-out infinite; transform-origin: 100px 90px; }
.gyani-thinking .gyani-arm-right { animation: gyaniScratch 0.4s ease-in-out infinite alternate; transform-origin: 138px 140px; }

/* ── Keyframes ── */
@keyframes gyaniFloat {
  0%,100% { transform: translateY(0); }
  50%      { transform: translateY(-8px); }
}
@keyframes gyaniBreathe {
  0%,100% { transform: scaleY(1); }
  50%      { transform: scaleY(1.03); }
}
@keyframes gyaniShadow {
  0%,100% { transform: scaleX(1); opacity: 1; }
  50%      { transform: scaleX(0.85); opacity: 0.7; }
}
@keyframes gyaniJump {
  0%   { transform: translateY(0); }
  100% { transform: translateY(-18px); }
}
@keyframes gyaniShadowJump {
  0%   { transform: scaleX(1); opacity: 1; }
  100% { transform: scaleX(0.7); opacity: 0.5; }
}
@keyframes gyaniArmWaveL {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(-40deg); }
}
@keyframes gyaniArmWaveR {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(40deg); }
}
@keyframes gyaniTasselSwing {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(20deg); }
}
@keyframes starFloat1 {
  0%   { transform: translate(0,0); opacity: 1; }
  100% { transform: translate(-10px,-40px); opacity: 0; }
}
@keyframes starFloat2 {
  0%   { transform: translate(0,0); opacity: 1; }
  100% { transform: translate(12px,-50px); opacity: 0; }
}
@keyframes starFloat3 {
  0%   { transform: translate(0,0); opacity: 1; }
  100% { transform: translate(5px,-45px); opacity: 0; }
}
@keyframes gyaniDroop {
  0%,100% { transform: rotate(0deg); }
  50%      { transform: rotate(-8deg); }
}
@keyframes gyaniFall {
  0%   { transform: translateY(0); opacity: 1; }
  100% { transform: translateY(18px); opacity: 0; }
}
@keyframes gyaniSadSway {
  0%,100% { transform: rotate(0deg); }
  25%      { transform: rotate(-3deg); }
  75%      { transform: rotate(3deg); }
}
@keyframes gyaniThink {
  0%,100% { transform: rotate(0deg); }
  50%      { transform: rotate(6deg); }
}
@keyframes gyaniScratch {
  0%   { transform: rotate(-10deg) translateY(0); }
  100% { transform: rotate(10deg) translateY(-6px); }
}
</style>
