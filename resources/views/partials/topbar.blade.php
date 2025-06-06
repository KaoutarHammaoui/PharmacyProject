@php
    $user = auth()->user();
    $now = now()->setTimezone('Africa/Casablanca'); 
    $hour = $now->hour;    
    if ($hour >= 5 && $hour < 12) {
        $greeting = 'Bonjour'; // Good Morning
    } elseif ($hour >= 12 && $hour < 17) {
        $greeting = 'Bon Après-midi'; // Good Afternoon
    } elseif ($hour >= 17 && $hour < 22) {
        $greeting = 'Bonsoir'; // Good Evening
    } else {
        $greeting = 'Bonne Nuit'; // Good Night
    }
    
    $currentTime = now()->format('h:i A');
    $currentDate = now()->format('M j, Y');
@endphp

<div style="background-color: white; color: black; padding: 8px 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); position: fixed; top: 10px; right: 20px; z-index: 1000; border-radius: 8px; width: 300px;">
    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
        <div style="font-size: 13px; font-weight: 500;">
            @if($user)
                {{ $greeting }}, {{ $user->name }}!
            @else
                {{ $greeting }}!
            @endif
        </div>
        
        <div style="display: flex; flex-direction: column; align-items: flex-end; font-size: 12px; color: #666;">
            <span>{{ $currentTime }}</span>
            <span>{{ $currentDate }}</span>
        </div>
    </div>
</div>