<x-app-layout>
    @php
        // ===== IMAGE FALLBACK =====
        $img = $activity->image_url ?? null;
        if ($img && filter_var($img, FILTER_VALIDATE_URL)) {
            $imgUrl = $img;
        } elseif ($img && file_exists(public_path($img))) {
            $imgUrl = asset($img);
        } else {
            $imgUrl = asset('images/default.jpg');
        }

        // ===== COMPANY LOGO =====
        if (!empty($activity->company_code) && file_exists(public_path("img/company-{$activity->company_code}.jpg"))) {
            $companyLogo = asset("img/company-{$activity->company_code}.jpg");
        } else {
            $companyLogo = asset('images/company-default.jpg');
        }

        // ===== DATE LOGIC (NO `use`) =====
        $today = now()->startOfDay();
        $start = $activity->start_date ? \Carbon\Carbon::parse($activity->start_date) : null;
        $end   = $activity->end_date ? \Carbon\Carbon::parse($activity->end_date) : null;

        $isUpcoming = $start && $start->gt($today);
        $isOngoing  = $start && (!$end || $end->gte($today)) && $start->lte($today);
        $isEnded    = $end && $end->lt($today);

        // ===== REGISTRATION STATUS CHECK =====
        $alreadyRegistered = auth()->check() && $activity->registrations()->where('user_id', auth()->id())->exists();
        $registration = auth()->check() ? $activity->registrations()->where('user_id', auth()->id())->first() : null;
    @endphp


    <div class="py-10 max-w-7xl mx-auto px-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

            <div class="md:flex">

                {{-- LEFT : IMAGE --}}
                <div class="md:w-1/2 relative">
                    <img src="{{ $imgUrl }}" class="w-full h-80 md:h-full object-cover">

                    {{-- STATUS BADGE --}}
                    <div class="absolute top-4 left-4">
                        @if($isOngoing)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                Ongoing
                            </span>
                        @elseif($isUpcoming)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                Upcoming
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                Ended
                            </span>
                        @endif
                    </div>

                    {{-- ORGANIZER --}}
                    <div class="absolute bottom-4 left-4 flex items-center gap-3 bg-black/50 px-3 py-2 rounded-lg">
                        <img src="{{ $companyLogo }}" class="w-10 h-10 rounded-full object-cover">
                        <div class="text-white text-sm">
                            <div class="font-semibold">{{ $companyName ?? $activity->organizer }}</div>
                            <div class="opacity-80">{{ $activity->location ?? 'Virtual' }}</div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT : CONTENT --}}
                <div class="md:w-1/2 p-6 flex flex-col">
                    {{-- @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif --}}

                    @if(session('error'))
                        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($registration)
                        @if($registration->status === 'pending')
                            <div class="mb-4 p-4 rounded-lg bg-yellow-50 text-yellow-800 border border-yellow-200">
                                <strong>Registration Submitted</strong><br>
                                Your registration has been successfully submitted.
                                Please wait for the organization’s review and announcement.
                            </div>

                        @elseif($registration->status === 'approved')
                            <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-800 border border-green-200">
                                <strong>Action Required</strong><br>
                                Your registration has been approved.
                                Please complete the participation confirmation form after you finish this activity.
                            </div>

                        @elseif($registration->status === 'rejected')
                            <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700 border border-red-200">
                                <strong>Update on Your Registration</strong><br>
                                Thank you for your interest.
                                Unfortunately, your registration could not be approved at this time.
                                Please feel free to join other upcoming activities.
                            </div>

                        @elseif($registration->status === 'confirmed')
                            <div class="mb-4 p-4 rounded-lg bg-purple-50 text-purple-800 border border-purple-200">
                                <strong>Points Earned 🎉</strong><br>
                                Thank you for participating in this activity.
                                Your points have been successfully added to your account.
                            </div>

                        @endif
                    @endif

                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $activity->title }}
                    </h1>

                    <p class="mt-3 text-gray-600 dark:text-gray-300">
                        {{ $activity->description }}
                    </p>

                    {{-- INFO --}}
                    <div class="mt-6 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                        <p><strong>Date:</strong>
                            {{ $start?->format('d M Y') }}
                            @if($end && $end != $start)
                                - {{ $end->format('d M Y') }}
                            @endif
                        </p>
                        <p><strong>Category:</strong> {{ $activity->category ?? '-' }}</p>
                        <p><strong>Type:</strong> {{ ucfirst($activity->type ?? 'event') }}</p>
                    </div>

                    {{-- ACTION --}}
                    <div class="mt-8 space-y-2">

                        {{-- ONGOING --}}
                        @if($isOngoing)
                            @if(!$alreadyRegistered)
                                <button
                                    onclick="document.getElementById('registerModal').classList.remove('hidden')"
                                    class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold">
                                    Register Now
                                </button>

                                <p class="text-green-600 text-sm font-medium text-center">
                                    ✔ Registration is open
                                </p>
                            @else
                                <button disabled class="w-full py-3 bg-gray-300 text-gray-600 rounded-lg">
                                    Already Registered
                                </button>
                            @endif

                        {{-- UPCOMING --}}
                        @elseif($isUpcoming)
                            <button disabled class="w-full py-3 bg-gray-300 text-gray-600 rounded-lg cursor-not-allowed">
                                Registration Not Open
                            </button>
                            <p class="text-yellow-600 text-sm font-medium text-center">
                                ⏳ Registration opens on {{ $start->format('d M Y') }}
                            </p>

                        {{-- ENDED --}}
                        @else
                        <button disabled class="w-full py-3 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                            Event Ended
                        </button>
                        <p class="text-red-500 text-sm font-medium text-center">
                            ❌ This event has ended
                        </p>
                        @endif

                        {{-- PARTICIPATION CONFIRMATION --}}
                        @if($registration && $registration->status === 'approved')
                            <button onclick="document.getElementById('confirmModal').classList.remove('hidden')" class="w-full py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold">
                                Confirm Participation
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- REGISTER MODAL --}}
    <div id="registerModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50"
            onclick="document.getElementById('registerModal').classList.add('hidden')"></div>

        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md z-10">
            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                Register for {{ $activity->title }}
            </h3>

            <form method="POST" action="{{ route('activities.register', $activity->id) }}">
                @csrf

                <div class="mb-3">
                    <label class="text-sm font-medium text-gray-600">Motivation</label>
                    <textarea name="motivation" class="w-full mt-1 rounded border-gray-300" rows="3" placeholder="Why do you want to join?"></textarea>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-600">Contact Number</label>
                    <input type="text" name="phone" class="w-full mt-1 rounded border-gray-300" placeholder="08xxxxxxxx">
                </div>

                <p class="text-xs text-gray-500 mb-4">
                    By registering, you agree that the organization may contact you via this phone number.
                </p>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="document.getElementById('registerModal').classList.add('hidden')" class="px-4 py-2 border rounded-lg">
                        Cancel
                    </button>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                        Submit Registration
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- CONFIRMATION MODAL --}}
    <div id="confirmModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50"
            onclick="document.getElementById('confirmModal').classList.add('hidden')"></div>

        <div class="bg-white rounded-lg p-6 w-full max-w-md z-10">
            <h3 class="text-lg font-semibold mb-4">
                Confirm Participation
            </h3>

            <form method="POST" action="{{ route('activities.confirm', $activity) }}">
                @csrf
                <p class="text-sm text-gray-600 mb-4">
                    Please confirm that you have participated in this activity.
                </p>

                <div class="mb-4">
                    <label class="text-sm font-medium text-gray-600">
                        Participation Code
                    </label>

                    <input type="text" name="confirmation_code" class="w-full mt-1 rounded border-gray-300" placeholder="Enter code provided by supervisor" required>
                </div>

                <button type="submit" class="w-full py-2 bg-green-600 text-white rounded-lg">
                    Confirm Participation
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
