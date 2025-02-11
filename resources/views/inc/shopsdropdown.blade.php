@php
    $user = auth()->user();
    $locales = $user->company->locales;
@endphp

<div class="px-3  w-100">
    <div class="dropdown w-100 mb-4">
        <button class="btn btn-outline-light border  dropdown-toggle w-100 text-start " type="button"
            data-bs-toggle="dropdown" data-bs-auto-close="false" aria-haspopup="true" aria-expanded="false">
            <div class="d-inline-block text-sm"
                style="width:90%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; line-height:1;">
                {!! session()->get(\App\Models\Locale::ACTIVE_LOCALE_NAME) ?? 'Choisir un locale' !!}
            </div>
        </button>
        <ul class="dropdown-menu w-100" data-bs-theme="light">
            {{-- <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Action two</a></li>
            <li><a class="dropdown-item" href="#">Action three</a></li> --}}
            @foreach ($locales as $locale)
                <li
                    class="dropdown-item text-sm
                   d-flex justify-content-between align-items-center
                
                @if ($locale->id == session()->get(\App\Models\Locale::ACTIVE_LOCALE)) active @endif">
                    <div class="d-flex align-items-center">
                        @if ($locale->id == session()->get(\App\Models\Locale::ACTIVE_LOCALE))
                            <div class="text-info me-2" style="width: 1.3rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.3em" height="1.3em"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M12 21a9 9 0 1 0 0-18a9 9 0 0 0 0 18m-.232-5.36l5-6l-1.536-1.28l-4.3 5.159l-2.225-2.226l-1.414 1.414l3 3l.774.774z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                        <div>
                            <a class="text-decoration-none d-block" id="locale-{{ $locale->id }}"
                                href="{{ route('locales.set-active', $locale) }}"
                                style="display:block; width:100%; overflow:hidden; text-overflow:ellipsis; white-space:wrap;">
                                {!! $locale->displayName !!}
                            </a>
                        </div>
                    </div>
                    <div class="px-2 py-1 rounded bg-white cursor-pointer ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M12 5.92A.96.96 0 1 0 12 4a.96.96 0 0 0 0 1.92m0 7.04a.96.96 0 1 0 0-1.92a.96.96 0 0 0 0 1.92M12 20a.96.96 0 1 0 0-1.92a.96.96 0 0 0 0 1.92" />
                        </svg>
                    </div>
                </li>
            @endforeach
            <li>
                <hr class="dropdown-divider">
                <a class="dropdown-item text-sm" href="#">
                    <span class="icon-plus me-2"></span>
                    Ajouter un locale
                </a>
            </li>
        </ul>
    </div>

</div>
