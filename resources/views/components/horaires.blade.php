<!-- filepath: /Users/eeelfedali/Code/laravel-Lumina/resources/views/components/horaires.blade.php -->
@props(['hours'])

@php
    $days = [
        'monday' => 'Lundi',
        'tuesday' => 'Mardi',
        'wednesday' => 'Mercredi',
        'thursday' => 'Jeudi',
        'friday' => 'Vendredi',
        'saturday' => 'Samedi',
        'sunday' => 'Dimanche',
    ];
@endphp

<section x-data="{
    days: ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'],
    hours: {
        @foreach ($days as $day => $label)
            @isset($hours[$day])
                {{ $day }}: { open: {{ $hours[$day]['open'] ? 'true' : 'false' }}, start: '{{ $hours[$day]['start'] }}', end: '{{ $hours[$day]['end'] }}' },
            @else
                {{ $day }}: { open: false, start: '09:00', end: '21:00' },
            @endisset @endforeach
    }
}">


    <div class="mb-4">
        <h4>Horaires d'ouverture</h4>
        <p class="text-muted">Entrez vos propres horaires d'ouverture.</p>
    </div>
    @error('hours')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    @error('hours.*')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    {{-- show errors ajax --}}
    <section class="hoursSection"></section>

    @foreach ($days as $day => $label)
        <section>


            <div class="row mb-3">
                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="{{ $day }}_open"
                            name="hours[{{ $day }}][open]" value="1"
                            x-model="hours.{{ $day }}.open"
                            x-on:change="if (hours.{{ $day }}.open) { hours.{{ $day }}.start = '09:00'; hours.{{ $day }}.end = '21:00'; }">
                        <label class="form-check-label" for="{{ $day }}_open">
                            <span class="-lead"> {{ $label }}</span>
                        </label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="input-group" x-show="hours.{{ $day }}.open">
                        <input type="time" class="form-control" id="{{ $day }}_start"
                            name="hours[{{ $day }}][start]" x-bind:disabled="!hours.{{ $day }}.open"
                            x-model="hours.{{ $day }}.start">
                    </div>
                    <span class="text-muted" x-show="!hours.{{ $day }}.open">Indisponible</span>
                </div>
                <div class="col-md-5">
                    <div class="input-group" x-show="hours.{{ $day }}.open">
                        <input type="time" class="form-control" id="{{ $day }}_end"
                            name="hours[{{ $day }}][end]" x-bind:disabled="!hours.{{ $day }}.open"
                            x-model="hours.{{ $day }}.end">
                    </div>
                </div>
            </div>
        </section>
    @endforeach
</section>
